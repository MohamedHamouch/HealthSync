@extends('layouts.app')

@section('title', 'HealthSync - Admin Profile')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <!-- Profile Header -->
            <div class="mb-8 flex flex-col md:flex-row justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Admin Profile</h1>
                    <p class="text-gray-600">Manage your administrator account information</p>
                </div>
                <p class="text-sm text-gray-500 mt-2" id="last-updated">Last updated:
                    {{ $profileData['created_at']->format('Y-m-d H:i:s') }}</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8" id="profile-container">
                <!-- Left Column - Basic Profile -->
                <div class="col-span-1">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <!-- Profile Picture and Name -->
                        <div class="bg-primary-600 p-6 text-center">
                            <div class="relative w-32 h-32 mx-auto mb-4">
                                <img src="{{ $profileData['avatar'] ? asset('storage/' . $profileData['avatar']) : asset('images/defaults/avatar.png') }}"
                                    alt="{{ $profileData['first_name'] }} {{ $profileData['last_name'] }}"
                                    class="w-full h-full object-cover rounded-full border-4 border-white shadow-md"
                                    id="profile-image">
                                <div class="absolute bottom-0 right-0">
                                    <button
                                        class="bg-white p-1.5 rounded-full shadow-lg text-gray-600 hover:text-primary-600 transition"
                                        id="change-photo-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <h2 class="text-xl font-bold text-white" id="profile-name">{{ $profileData['first_name'] }}
                                {{ $profileData['last_name'] }}</h2>
                            <p class="text-primary-100" id="profile-role">{{ ucfirst($profileData['role']) }}</p>
                        </div>

                        <!-- Basic Profile Information -->
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Basic Profile</h3>
                                <button class="text-primary-600 hover:text-primary-800 transition"
                                    id="edit-basic-profile-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                            </div>

                            <div class="space-y-3" id="basic-profile-details">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">First Name</p>
                                    <p class="text-gray-800 font-medium" id="first-name">{{ $profileData['first_name'] }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Last Name</p>
                                    <p class="text-gray-800 font-medium" id="last-name">{{ $profileData['last_name'] }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Email</p>
                                    <p class="text-gray-800 font-medium" id="email">{{ $profileData['email'] }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Username</p>
                                    <p class="text-gray-800 font-medium" id="username">{{ $profileData['username'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Column - Admin Information -->
                <div class="col-span-1">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="bg-blue-600 p-6 text-center">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white text-blue-600 mb-4 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-white">Administrator Details</h2>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Account Information</h3>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-500">Member Since</p>
                                        <p class="font-medium">
                                            {{ \Carbon\Carbon::parse($profileData['created_at'])->format('F d, Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-500">Role</p>
                                        <p class="font-medium">{{ ucfirst($profileData['role']) }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-blue-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-500">Account Status</p>
                                        <p class="font-medium">Active</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Admin Stats -->
                <div class="col-span-1">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="bg-green-600 p-6 text-center">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white text-green-600 mb-4 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-white">System Overview</h2>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Dashboard Stats</h3>
                            </div>

                            <div class="space-y-6">
                                <div class="bg-gray-50 p-4 rounded-lg flex items-center">
                                    <div class="bg-blue-100 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total Users</p>
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ $profileData['profile']['total_users'] }}</p>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg flex items-center">
                                    <div class="bg-green-100 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total Appointments</p>
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ $profileData['profile']['total_appointments'] }}</p>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg flex items-center">
                                    <div class="bg-purple-100 p-3 rounded-full mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">System Status</p>
                                        <p class="text-2xl font-bold text-gray-800">Active</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Backdrop -->
    <div id="modal-backdrop" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <!-- Basic Profile Edit Form -->
        <div id="basic-profile-modal" class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 hidden">
            <div class="bg-primary-600 px-6 py-4 rounded-t-xl">
                <h3 class="text-lg font-semibold text-white">Edit Basic Profile</h3>
            </div>
            <form id="basic-profile-form" action="{{ route('profile.update.basic') }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit-first-name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" id="edit-first-name" name="first_name" value="{{ $profileData['first_name'] }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label for="edit-last-name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" id="edit-last-name" name="last_name" value="{{ $profileData['last_name'] }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label for="edit-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="edit-email" name="email" value="{{ $profileData['email'] }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>

                    <div>
                        <label for="edit-username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" id="edit-username" name="username" value="{{ $profileData['username'] }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button"
                        class="close-modal-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">Save
                        Changes</button>
                </div>
            </form>
        </div>

        <!-- Photo Upload Modal -->
        <div id="photo-modal" class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 hidden">
            <div class="bg-primary-600 px-6 py-4 rounded-t-xl">
                <h3 class="text-lg font-semibold text-white">Change Profile Photo</h3>
            </div>
            <form id="photo-form" action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <div
                        class="w-32 h-32 mx-auto border-2 border-dashed border-gray-300 rounded-full flex items-center justify-center relative overflow-hidden">
                        <img id="photo-preview"
                            src="{{ $profileData['avatar'] ? asset('storage/' . $profileData['avatar']) : asset('images/defaults/avatar.png') }}"
                            alt="Profile Photo Preview" class="w-full h-full object-cover hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" id="photo-placeholder">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="photo-upload"
                        class="block text-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition cursor-pointer">
                        Select Photo
                    </label>
                    <input type="file" id="photo-upload" name="avatar" class="hidden" accept="image/*">
                    <p class="text-center text-sm text-gray-500 mt-2">Maximum file size: 5MB. Supported formats: JPG, PNG
                    </p>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button"
                        class="close-modal-btn px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">Upload
                        Photo</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Photo upload functionality
            const changePhotoBtn = document.getElementById('change-photo-btn');
            const photoModal = document.getElementById('photo-modal');
            const modalBackdrop = document.getElementById('modal-backdrop');
            const photoUpload = document.getElementById('photo-upload');
            const photoPreview = document.getElementById('photo-preview');
            const photoPlaceholder = document.getElementById('photo-placeholder');

            // Basic profile edit functionality
            const editBasicProfileBtn = document.getElementById('edit-basic-profile-btn');
            const basicProfileModal = document.getElementById('basic-profile-modal');

            // All close modal buttons
            const closeModalBtns = document.querySelectorAll('.close-modal-btn');

            // Show photo modal
            if (changePhotoBtn) {
                changePhotoBtn.addEventListener('click', function () {
                    modalBackdrop.classList.remove('hidden');
                    photoModal.classList.remove('hidden');
                });
            }

            // Show basic profile modal
            if (editBasicProfileBtn) {
                editBasicProfileBtn.addEventListener('click', function () {
                    modalBackdrop.classList.remove('hidden');
                    basicProfileModal.classList.remove('hidden');
                });
            }

            // Close modals
            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    modalBackdrop.classList.add('hidden');
                    photoModal.classList.add('hidden');
                    basicProfileModal.classList.add('hidden');
                });
            });

            // Photo preview
            if (photoUpload) {
                photoUpload.addEventListener('change', function (e) {
                    if (e.target.files && e.target.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function (event) {
                            photoPreview.src = event.target.result;
                            photoPreview.classList.remove('hidden');
                            photoPlaceholder.classList.add('hidden');
                        }

                        reader.readAsDataURL(e.target.files[0]);
                    }
                });
            }

            // Close modal on backdrop click
            if (modalBackdrop) {
                modalBackdrop.addEventListener('click', function (e) {
                    if (e.target === modalBackdrop) {
                        modalBackdrop.classList.add('hidden');
                        photoModal.classList.add('hidden');
                        basicProfileModal.classList.add('hidden');
                    }
                });
            }
        });
    </script>
@endpush