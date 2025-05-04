@extends('layouts.app')

@section('title', 'Doctor Profile - HealthSync')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Doctor Profile</h3>
                    <a href="{{ route('client.booking.index') }}" class="text-sm text-primary-600 hover:text-primary-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Doctors
                    </a>
                </div>
                
                <div class="md:grid md:grid-cols-3 md:gap-8">
                    <!-- Doctor Profile -->
                    <div class="md:col-span-2">
                        <div class="border rounded-lg overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row sm:items-center">
                                    <div class="h-24 w-24 rounded-full overflow-hidden bg-primary-100 flex items-center justify-center text-primary-600 mb-4 sm:mb-0">
                                        <img src="{{ $doctor->avatar_url }}" alt="Dr. {{ $doctor->first_name }}" class="h-24 w-24 object-cover">
                                    </div>
                                    <div class="sm:ml-6">
                                        <h4 class="text-xl font-bold text-gray-900">Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</h4>
                                        <p class="text-primary-600 font-medium">{{ $doctor->profile->specialization ?? 'General Practitioner' }}</p>
                                        
                                        <div class="flex items-center text-yellow-400 mt-2">
                                            @php
                                                $fullStars = floor($averageRating);
                                                $halfStar = $averageRating - $fullStars >= 0.5;
                                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                            @endphp
                                            
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                            
                                            @if ($halfStar)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            @endif
                                            
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            @endfor
                                            
                                            <span class="ml-1 text-sm text-gray-600">
                                                {{ number_format($averageRating, 1) }} ({{ $doctor->reviews->count() }} reviews)
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <h5 class="text-lg font-medium text-gray-900 mb-2">About</h5>
                                    @if ($doctor->profile && $doctor->profile->bio)
                                        <p class="text-gray-600">{{ $doctor->profile->bio }}</p>
                                    @else
                                        <p class="text-gray-500 italic">No biography provided.</p>
                                    @endif
                                </div>
                                
                                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if ($doctor->profile && $doctor->profile->office_address)
                                        <div>
                                            <h5 class="text-sm font-medium text-gray-900">Office Address</h5>
                                            <p class="text-gray-600">{{ $doctor->profile->office_address }}</p>
                                        </div>
                                    @endif
                                    
                                    @if ($doctor->profile && $doctor->profile->office_phone)
                                        <div>
                                            <h5 class="text-sm font-medium text-gray-900">Office Phone</h5>
                                            <p class="text-gray-600">{{ $doctor->profile->office_phone }}</p>
                                        </div>
                                    @endif
                                    
                                    @if ($doctor->profile && $doctor->profile->consultation_fee)
                                        <div>
                                            <h5 class="text-sm font-medium text-gray-900">Consultation Fee</h5>
                                            <p class="text-gray-600">${{ number_format($doctor->profile->consultation_fee, 2) }}</p>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-900">Availability</h5>
                                        <p class="text-gray-600">
                                            @if (count($activeDays) > 0)
                                                @php
                                                    $dayNames = [
                                                        1 => 'Monday',
                                                        2 => 'Tuesday',
                                                        3 => 'Wednesday',
                                                        4 => 'Thursday',
                                                        5 => 'Friday',
                                                        6 => 'Saturday',
                                                        7 => 'Sunday',
                                                    ];
                                                    $availableDays = [];
                                                    foreach ($activeDays as $day) {
                                                        $availableDays[] = $dayNames[$day];
                                                    }
                                                @endphp
                                                {{ implode(', ', $availableDays) }}
                                            @else
                                                No regular hours set
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                @if ($doctor->reviews->count() > 0)
                                    <div class="mt-8">
                                        <h5 class="text-lg font-medium text-gray-900 mb-4">Patient Reviews</h5>
                                        <div class="space-y-4">
                                            @foreach ($reviews as $review)
                                                <div class="border-b border-gray-100 pb-4">
                                                    <div class="flex justify-between">
                                                        <div>
                                                            <p class="font-medium text-gray-900">{{ $review->appointment->client->first_name }}</p>
                                                            <div class="flex text-yellow-400 mt-1">
                                                                @for ($i = 0; $i < 5; $i++)
                                                                    @if ($i < $review->rating)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                        </svg>
                                                                    @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                                        </svg>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <p class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</p>
                                                    </div>
                                                    <p class="text-gray-600 mt-2">{{ $review->comment }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        @if ($doctor->reviews->count() > 3)
                                            <div class="mt-4 text-center">
                                                <button type="button" class="text-primary-600 hover:text-primary-900 text-sm font-medium">
                                                    View All {{ $doctor->reviews->count() }} Reviews
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Booking Form -->
                    <div class="mt-8 md:mt-0">
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Book an Appointment</h4>
                            
                            <form action="{{ route('client.booking.check-availability') }}" method="POST">
                                @csrf
                                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                                
                                <div class="mb-4">
                                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Select Date</label>
                                    <input type="date" id="date" name="date" required min="{{ date('Y-m-d') }}"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                    @error('date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mt-6">
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        Check Available Time Slots
                                    </button>
                                </div>
                            </form>
                            
                            <div class="mt-6">
                                <h5 class="text-sm font-medium text-gray-900 mb-2">About Bookings</h5>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li>• Select a date that works for your schedule</li>
                                    <li>• You'll see available time slots to choose from</li>
                                    <li>• Appointment duration: {{ $doctor->schedules->first() ? $doctor->schedules->first()->slot_duration : 30 }} minutes</li>
                                    <li>• Please arrive 10 minutes before your scheduled time</li>
                                    <li>• Cancel at least 24 hours in advance if needed</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 