@extends('layouts.app')

@section('title', 'My Weekly Schedule')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="flex items-center text-primary-600 hover:text-primary-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Weekly Working Hours</h3>
                    <p class="text-gray-600">Set your availability for each day of the week. Clients will be able to book appointments during these hours.</p>
                </div>
                
                <form action="{{ route('doctor.schedules.update-all') }}" method="POST" class="mb-8">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Day</th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Start Time</th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">End Time</th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Slot Duration</th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Active</th>
                                    <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-sm font-semibold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $dayNumber => $schedule)
                                    <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                        <td class="py-4 px-4 border-b border-gray-200 text-sm font-medium">
                                            {{ $dayNames[$dayNumber] }}
                                            <input type="hidden" name="days[{{ $dayNumber }}][day_of_week]" value="{{ $dayNumber }}">
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            <input type="time" name="days[{{ $dayNumber }}][start_time]" 
                                                value="{{ substr($schedule->start_time, 0, 5) }}" 
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" required>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            <input type="time" name="days[{{ $dayNumber }}][end_time]" 
                                                value="{{ substr($schedule->end_time, 0, 5) }}" 
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500" required>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            <select name="days[{{ $dayNumber }}][slot_duration]" 
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                                <option value="30" {{ $schedule->slot_duration == 30 ? 'selected' : '' }}>30 minutes</option>
                                                <option value="60" {{ $schedule->slot_duration == 60 ? 'selected' : '' }}>1 hour</option>
                                            </select>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="days[{{ $dayNumber }}][is_active]" value="1" 
                                                    {{ $schedule->is_active ? 'checked' : '' }}
                                                    class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50">
                                                <span class="ml-2 text-sm text-gray-600">Available</span>
                                            </label>
                                        </td>
                                        <td class="py-4 px-4 border-b border-gray-200">
                                            <button type="submit" formaction="{{ route('doctor.schedules.update-day', $dayNumber) }}" 
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                                Save this day
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Save All Changes
                        </button>
                    </div>
                </form>
                
                <div class="bg-gray-50 p-4 rounded mt-8">
                    <h4 class="font-medium text-gray-900 mb-2">About Doctor Scheduling</h4>
                    <p class="text-gray-600 text-sm mb-2">Your schedule defines when clients can book appointments with you:</p>
                    <ul class="list-disc list-inside text-sm text-gray-600 ml-2">
                        <li>Set your working hours for each day of the week</li>
                        <li>Choose either 30-minute or 1-hour appointment slots</li>
                        <li>You can mark days as inactive if you don't work on those days</li>
                        <li>Changes to your schedule won't affect existing appointments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection 