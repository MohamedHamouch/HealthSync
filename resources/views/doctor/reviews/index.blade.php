@extends('layouts.app')

@section('title', 'My Reviews - HealthSync')

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

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="border-b border-gray-200 bg-white px-6 py-4">
                <h2 class="text-xl font-semibold text-gray-800">My Patient Reviews</h2>
                <p class="text-gray-600 mt-1">See what your patients are saying about their appointments</p>
            </div>

            <div class="bg-white p-6">
                <!-- Stats Summary -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Average Rating</p>
                                <p class="text-2xl font-bold text-gray-800">{{ number_format($averageRating, 1) }}</p>
                                <div class="flex text-yellow-400 mt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= round($averageRating))
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
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Reviews</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $totalReviews }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">5-Star Reviews</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $fiveStarReviews }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $fiveStarReviews > 0 && $totalReviews > 0 ? number_format(($fiveStarReviews / $totalReviews) * 100) : 0 }}% of total</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Distribution -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Rating Distribution</h3>
                    <div class="space-y-3">
                        @for ($rating = 5; $rating >= 1; $rating--)
                            <div class="flex items-center">
                                <div class="w-10 text-right mr-3">
                                    <span class="font-medium text-gray-700">{{ $rating }} star</span>
                                </div>
                                <div class="flex-1 h-6 bg-gray-200 rounded-full overflow-hidden">
                                    @php
                                        $percentage = $totalReviews > 0 ? ($ratingCounts[$rating] ?? 0) / $totalReviews * 100 : 0;
                                    @endphp
                                    <div 
                                        class="h-full 
                                        @if($rating == 5) bg-green-500 
                                        @elseif($rating == 4) bg-green-400 
                                        @elseif($rating == 3) bg-yellow-400 
                                        @elseif($rating == 2) bg-orange-400 
                                        @else bg-red-400 @endif" 
                                        style="width: {{ $percentage }}%">
                                    </div>
                                </div>
                                <div class="w-16 text-right ml-3">
                                    <span class="text-gray-600">{{ $ratingCounts[$rating] ?? 0 }}</span>
                                </div>
                                <div class="w-16 text-right ml-3">
                                    <span class="text-gray-500 text-sm">{{ number_format($percentage, 1) }}%</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Reviews List -->
                @if($reviews->isEmpty())
                    <div class="text-center py-12 bg-gray-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No reviews yet</h3>
                        <p class="mt-1 text-gray-500">You haven't received any reviews from your patients yet.</p>
                    </div>
                @else
                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-800">Patient Reviews</h3>
                    </div>
                    
                    <div class="space-y-6">
                        @foreach($reviews as $review)
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-start">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3 overflow-hidden">
                                            <img src="{{ $review->appointment->client->avatar_url }}" alt="{{ $review->appointment->client->full_name }}" class="h-full w-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $review->appointment->client->full_name }}</p>
                                            <div class="flex text-yellow-400 mt-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                                <span class="text-gray-500 text-sm ml-2">{{ $review->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right text-sm text-gray-500">
                                        <p>Appointment: {{ $review->appointment->appointment_date->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <p class="mt-4 text-gray-700">{{ $review->comment }}</p>
                                <a href="{{ route('doctor.appointments.show', $review->appointment) }}" class="inline-block mt-4 text-sm text-primary-600 hover:text-primary-800">
                                    View appointment details
                                </a>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $reviews->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 