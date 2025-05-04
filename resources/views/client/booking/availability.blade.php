@extends('layouts.app')

@section('title', 'Available Appointment Slots - HealthSync')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="border-b border-gray-200 pb-4 mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Appointment with Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</h3>
                    <p class="text-gray-600">{{ $doctor->profile->specialization }}</p>
                    <p class="text-gray-600">Date: {{ $formattedDate }}</p>
                </div>
                
                @if (!$schedule)
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
                        <p>The doctor is not available on this day. Please choose another date.</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('client.booking.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                            Go Back
                        </a>
                    </div>
                @else
                    <div class="mb-6">
                        <h4 class="text-md font-medium text-gray-900 mb-2">Available Time Slots</h4>
                        <p class="text-gray-600 mb-4">Please select a time slot for your appointment:</p>
                        
                        @php
                            // Generate available time slots
                            $startTime = Carbon\Carbon::parse($schedule->start_time);
                            $endTime = Carbon\Carbon::parse($schedule->end_time);
                            $slotDuration = $schedule->slot_duration;
                            $availableSlots = [];
                            
                            while ($startTime->lt($endTime)) {
                                $slotTime = $startTime->format('H:i');
                                $isBooked = in_array($slotTime, $bookedTimeSlots);
                                
                                if (!$isBooked) {
                                    $availableSlots[] = $slotTime;
                                }
                                
                                $startTime->addMinutes($slotDuration);
                            }
                        @endphp
                        
                        @if (count($availableSlots) > 0)
                            <form action="{{ route('client.booking.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                <input type="hidden" name="date" value="{{ $date }}">
                                
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach ($availableSlots as $slot)
                                        <label class="relative flex items-center cursor-pointer p-4 border border-gray-200 rounded-md bg-white hover:bg-gray-50">
                                            <input type="radio" name="time" value="{{ $slot }}" class="h-5 w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" required>
                                            <span class="ml-3 text-gray-900">{{ Carbon\Carbon::parse($slot)->format('g:i A') }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                
                                <div>
                                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason for Appointment</label>
                                    <textarea id="reason" name="reason" rows="3" required 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"></textarea>
                                </div>
                                
                                <div class="flex items-center justify-end">
                                    <a href="{{ route('client.booking.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        Cancel
                                    </a>
                                    <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        Book Appointment
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
                                <p>No available time slots for this date. Please select another date.</p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('client.booking.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                                    Go Back
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
                
                <div class="bg-gray-50 p-4 rounded mt-8">
                    <h4 class="font-medium text-gray-900 mb-2">About Appointments</h4>
                    <ul class="list-disc list-inside text-sm text-gray-600 ml-2">
                        <li>Appointments are {{ $schedule ? $schedule->slot_duration : '30' }} minutes long</li>
                        <li>Please arrive 10 minutes before your scheduled time</li>
                        <li>If you need to cancel, please do so at least 24 hours in advance</li>
                        <li>You can view and manage your appointments in your dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection 