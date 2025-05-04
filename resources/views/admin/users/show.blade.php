@extends('layouts.app')

@section('title', 'User Details - HealthSync Admin')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="w-64 bg-primary-800 text-white shadow-lg hidden md:block">
        <div class="p-6 border-b border-primary-700">
            <h2 class="text-2xl font-semibold">Admin Portal</h2>
        </div>
        <nav class="mt-6">
            <ul>
                <li class="py-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-2 hover:bg-primary-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('admin.users.index') }}" class="flex items-center px-6 py-2 hover:bg-primary-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Manage Users
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('admin.users.suspended') }}" class="flex items-center px-6 py-2 hover:bg-primary-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        Suspended Users
                    </a>
                </li>
                <li class="py-2">
                    <a href="{{ route('profile') }}" class="flex items-center px-6 py-2 hover:bg-primary-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        My Profile
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <!-- Mobile Header with Menu Toggle -->
        <div class="md:hidden bg-primary-800 text-white p-4 flex items-center justify-between">
            <h1 class="text-xl font-semibold">Admin Portal</h1>
            <button id="mobile-menu-toggle" class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu (Hidden by Default) -->
        <div id="mobile-menu" class="md:hidden hidden bg-primary-800 text-white">
            <nav class="px-4 py-2">
                <ul>
                    <li class="py-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Manage Users
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="{{ route('admin.users.suspended') }}" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            Suspended Users
                        </a>
                    </li>
                    <li class="py-2">
                        <a href="{{ route('profile') }}" class="flex items-center py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Page Content -->
        <div class="p-6">
            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
            @endif

            <!-- Back Navigation -->
            <div class="mb-6">
                <a href="{{ $user->is_suspended ? route('admin.users.suspended') : route('admin.users.index') }}" class="flex items-center text-primary-600 hover:text-primary-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to {{ $user->is_suspended ? 'Suspended Users' : 'Active Users' }}
                </a>
            </div>

            <!-- User Details -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-primary-500 to-primary-600 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">User Details</h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col md:flex-row">
                        <!-- User Avatar -->
                        <div class="md:w-1/4 flex flex-col items-center p-4">
                            <div class="w-32 h-32 rounded-full bg-gray-200 overflow-hidden mb-4">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->full_name }}" class="w-full h-full object-cover">
                            </div>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                @if($user->role->value === 'admin') bg-purple-100 text-purple-800 
                                @elseif($user->role->value === 'doctor') bg-blue-100 text-blue-800 
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($user->role->value) }}
                            </span>
                            <div class="mt-4 flex flex-col w-full space-y-2">
                                @if($user->is_suspended)
                                    <a href="{{ route('admin.users.unsuspend', $user->id) }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded text-center transition">
                                        Unsuspend User
                                    </a>
                                @else
                                    <a href="{{ route('admin.users.suspend', $user->id) }}" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded text-center transition">
                                        Suspend User
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- User Information -->
                        <div class="md:w-3/4 p-4">
                            <div class="border-b pb-4 mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Basic Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Full Name</p>
                                        <p class="font-medium">{{ $user->full_name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Username</p>
                                        <p class="font-medium">{{ $user->username }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Email</p>
                                        <p class="font-medium">{{ $user->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Account Status</p>
                                        <p class="font-medium">
                                            @if($user->is_suspended)
                                                <span class="text-red-600">Suspended</span>
                                            @else
                                                <span class="text-green-600">Active</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-b pb-4 mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Account Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Registration Date</p>
                                        <p class="font-medium">{{ $user->created_at->format('F d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Last Updated</p>
                                        <p class="font-medium">{{ $user->updated_at->format('F d, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($user->isDoctor())
                            <div class="border-b pb-4 mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Doctor Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Specialty</p>
                                        <p class="font-medium">{{ $user->specialty ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Experience (Years)</p>
                                        <p class="font-medium">{{ $user->experience_years ?? 'Not specified' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Mobile Menu Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
@endpush
@endsection 