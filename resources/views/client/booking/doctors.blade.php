@extends('layouts.app')

@section('title', 'Find a Doctor - HealthSync')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Find a Doctor</h3>
                    <p class="text-gray-600">Browse our network of healthcare professionals and book an appointment with the doctor of your choice.</p>
                </div>
                
                <!-- Filter Section -->
                <div class="mb-8 bg-gray-50 p-4 rounded-lg">
                    <form action="{{ route('client.booking.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
                        <div>
                            <label for="specialization" class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
                            <select id="specialization" name="specialization" 
                                class="rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                                <option value="">All Specializations</option>
                                @foreach ($specializations as $specialization)
                                    <option value="{{ $specialization }}" {{ request('specialization') == $specialization ? 'selected' : '' }}>
                                        {{ $specialization }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Filter Results
                            </button>
                            @if (request()->has('specialization') && request('specialization'))
                                <a href="{{ route('client.booking.index') }}" class="ml-2 text-sm text-gray-600 hover:text-gray-900">
                                    Clear Filters
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                
                <!-- Doctor Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($doctors as $doctor)
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition">
                            <div class="p-5">
                                <div class="flex items-center mb-4">
                                    <div class="h-12 w-12 rounded-full overflow-hidden bg-primary-100 flex items-center justify-center text-primary-600">
                                        <img src="{{ $doctor->avatar_url }}" alt="Dr. {{ $doctor->first_name }}" class="h-12 w-12 object-cover">
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold text-gray-900">Dr. {{ $doctor->first_name }} {{ $doctor->last_name }}</h4>
                                        <p class="text-sm text-primary-600">{{ $doctor->profile->specialization ?? 'General Practitioner' }}</p>
                                    </div>
                                </div>
                                
                                <div class="border-t border-gray-100 pt-4 mt-2">
                                    @if ($doctor->profile && $doctor->profile->bio)
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $doctor->profile->bio }}</p>
                                    @else
                                        <p class="text-gray-600 text-sm mb-3 italic">No bio available</p>
                                    @endif
                                    
                                    <div class="flex items-center text-yellow-400 mb-3">
                                        @php
                                            $rating = $doctor->reviews->avg('rating') ?: 0;
                                            $fullStars = floor($rating);
                                            $halfStar = $rating - $fullStars >= 0.5;
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
                                            {{ number_format($rating, 1) }} ({{ $doctor->reviews->count() }} reviews)
                                        </span>
                                    </div>
                                    
                                    @if ($doctor->profile && $doctor->profile->consultation_fee)
                                        <p class="text-sm mb-4">
                                            <span class="font-medium">Consultation Fee:</span> 
                                            <span class="text-gray-700">${{ number_format($doctor->profile->consultation_fee, 2) }}</span>
                                        </p>
                                    @endif
                                    
                                    <a href="{{ route('client.booking.doctor', $doctor->id) }}" 
                                        class="block w-full text-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        View Profile & Book
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-8 text-center">
                            <p class="text-gray-500">No doctors found matching your criteria. Please try different filters.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection 