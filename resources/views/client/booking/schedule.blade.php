@extends('layouts.app')

@section('title', 'Book Appointment - HealthSync')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('client.booking.doctor', $doctor->id) }}" class="flex items-center text-primary-600 hover:text-primary-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Doctor Profile
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex items-start mb-6">
                    <div class="h-16 w-16 rounded-full overflow-hidden bg-gray-100 mr-4">
                        <img src="{{ $doctor->avatar_url }}" alt="Dr. {{ $doctor->first_name }}" class="h-full w-full object-cover">
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</h2>
                        <p class="text-gray-600">{{ $doctor->profile->specialization ?? 'Doctor' }}</p>
                    </div>
                </div>
                
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Select Date</h3>
                    
                    @if(empty($activeDays))
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        This doctor has not set any availability. Please choose another doctor or check back later.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-6">
                            <form action="{{ route('client.booking.schedule', $doctor->id) }}" method="GET" id="date-select-form">
                                <div class="mb-4">
                                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Select a date</label>
                                    <input type="date" id="date" name="date" 
                                        min="{{ date('Y-m-d') }}" 
                                        max="{{ date('Y-m-d', strtotime('+3 months')) }}"
                                        class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                        required>
                                </div>
                                
                                <div class="mb-4">
                                    <p class="text-sm text-gray-500 mb-2">Available Days:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $index => $day)
                                            <span class="px-2 py-1 text-xs rounded-full {{ in_array($index + 1, $activeDays) ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                                                {{ $day }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                                    Check Availability
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const activeDays = @json($activeDays);
        const dateInput = document.getElementById('date');
        
        if (dateInput) {
            dateInput.addEventListener('input', function() {
                const selectedDate = new Date(this.value);
                const dayOfWeek = selectedDate.getDay() || 7; // Convert 0 (Sunday) to 7 to match ISO day numbering
                
                if (!activeDays.includes(dayOfWeek)) {
                    Swal.fire({
                        title: 'Not Available',
                        text: 'The doctor is not available on the selected day. Please choose another date.',
                        icon: 'warning',
                        confirmButtonColor: '#3085d6'
                    });
                    this.value = '';
                }
            });
        }
    });
</script>
@endsection 