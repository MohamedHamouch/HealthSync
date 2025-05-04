@extends('layouts.app')

@section('title', 'Appointment Details - HealthSync')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('client.appointments.index') }}" class="flex items-center text-primary-600 hover:text-primary-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Appointments
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-t-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Appointment #{{ $appointment->id }}</h2>
                    <span class="px-3 py-1 inline-flex text-sm font-medium rounded-full 
                        @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($appointment->status == 'confirmed') bg-blue-100 text-blue-800
                        @elseif($appointment->status == 'completed') bg-green-100 text-green-800
                        @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($appointment->status->value) }}
                    </span>
                </div>
                
                <!-- Doctor Information -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Doctor Information</h3>
                    @if($doctor)
                        <div class="flex items-start">
                            <div class="h-16 w-16 rounded-full overflow-hidden bg-gray-100 mr-4">
                                <img src="{{ $doctor->avatar_url }}" alt="Dr. {{ $doctor->first_name }}" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <p class="text-lg font-medium text-gray-900">Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</p>
                                <p class="text-gray-600">{{ $doctor->profile->specialization ?? 'Doctor' }}</p>
                                <p class="text-gray-600 mt-1">{{ $doctor->email }}</p>
                                <div class="mt-3">
                                    <a href="{{ route('client.booking.doctor', $doctor->id) }}" class="text-primary-600 hover:text-primary-800">
                                        View Doctor Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-600">Doctor information not available.</p>
                    @endif
                </div>
                
                <!-- Appointment Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Appointment Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Date</p>
                            <p class="text-base font-medium">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Time</p>
                            <p class="text-base font-medium">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('g:i A') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Duration</p>
                            <p class="text-base font-medium">{{ $appointment->duration ?? '30' }} minutes</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Type</p>
                            <p class="text-base font-medium">{{ isset($appointment->type) ? ucfirst($appointment->type->value) : 'Regular' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Reason for Visit</p>
                            <p class="text-base">{{ $appointment->reason ?? 'Not specified' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Notes</p>
                            <p class="text-base">{{ $appointment->notes ?? 'No notes available' }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                @if(in_array($appointment->status->value, ['pending', 'confirmed']))
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                        <form action="{{ route('client.appointments.cancel', $appointment) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to cancel this appointment?')" 
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Cancel Appointment
                            </button>
                        </form>
                    </div>
                @endif
                
                <!-- Review Section -->
                @if($appointment->status->value == 'completed')
                    <div id="review" class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Review</h3>
                        
                        @if($appointment->review)
                            <div class="mb-4">
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $appointment->review->rating)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-gray-600">{{ $appointment->review->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700">{{ $appointment->review->comment }}</p>
                            </div>
                            <form action="{{ route('client.reviews.delete', $appointment->review) }}" method="POST" class="inline-block" id="delete-review-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    Delete Review
                                </button>
                            </form>
                        @else
                            <form action="{{ route('client.reviews.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                                
                                <div class="mb-4">
                                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <div class="flex items-center">
                                        <div class="flex space-x-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <input type="radio" id="rating{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer" required>
                                                <label for="rating{{ $i }}" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                    @error('rating')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
                                    <textarea id="comment" name="comment" rows="4" 
                                            class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            required></textarea>
                                    @error('comment')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                                    Submit Review
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteReviewForm = document.getElementById('delete-review-form');
        if (deleteReviewForm) {
            const deleteButton = deleteReviewForm.querySelector('button[type="submit"]');
            if (deleteButton) {
                deleteButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: 'Delete Review',
                        text: 'Are you sure you want to delete this review?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteReviewForm.submit();
                        }
                    });
                });
            }
        }
    });
</script>
@endsection 