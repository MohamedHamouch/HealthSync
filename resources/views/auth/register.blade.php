@extends('layouts.app')

@section('title', 'HealthSync - Register')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">
        <!-- Brand Identity -->
        <div class="text-center mb-4">
            <a href="{{ route('home') }}" class="inline-block">
                <div class="flex items-center justify-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span class="font-bold text-xl text-gray-800">HealthSync</span>
                </div>
            </a>
        </div>
        
        <!-- Register Form Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 text-center mb-4">Create Your Account</h2>
            
            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                
                <!-- Role Selection with Tabs -->
                <div class="mb-4">
                    <div class="flex border-b border-gray-200">
                        <button type="button" id="client-tab" class="flex-1 py-2 font-medium text-center border-b-2 border-primary-600 text-primary-600">Patient</button>
                        <button type="button" id="doctor-tab" class="flex-1 py-2 font-medium text-center border-b-2 border-transparent text-gray-500 hover:text-gray-700">Doctor</button>
                    </div>
                    <input type="hidden" name="role" id="role" value="client">
                </div>
                
                <!-- Personal Information Section -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1" for="first_name">
                            First Name
                        </label>
                        <input class="appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors @error('first_name') border-red-500 @enderror" id="first_name" name="first_name" type="text" placeholder="John" required value="{{ old('first_name') }}">
                        @error('first_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1" for="last_name">
                            Last Name
                        </label>
                        <input class="appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors @error('last_name') border-red-500 @enderror" id="last_name" name="last_name" type="text" placeholder="Doe" required value="{{ old('last_name') }}">
                        @error('last_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-1" for="email">
                        Email Address
                    </label>
                    <input class="appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors @error('email') border-red-500 @enderror" id="email" name="email" type="email" placeholder="your@email.com" required value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1" for="password">
                            Password
                        </label>
                        <input class="appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors @error('password') border-red-500 @enderror" id="password" name="password" type="password" placeholder="••••••••" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1" for="password_confirmation">
                            Confirm Password
                        </label>
                        <input class="appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors" id="password_confirmation" name="password_confirmation" type="password" placeholder="••••••••" required>
                    </div>
                </div>
                
                <!-- Client Fields (Visible by default) -->
                <div id="client-fields" class="mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1" for="phone">
                            Phone Number
                        </label>
                        <input class="appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors @error('phone') border-red-500 @enderror" id="phone" name="phone" type="text" placeholder="(123) 456-7890" value="{{ old('phone') }}">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Doctor Fields (Hidden by default) -->
                <div id="doctor-fields" class="grid grid-cols-2 gap-4 mb-4 hidden">
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1" for="specialization">
                            Medical Specialization
                        </label>
                        <select class="appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors @error('specialization') border-red-500 @enderror" id="specialization" name="specialization">
                            <option value="">Select Specialization</option>
                            <option value="Cardiology" {{ old('specialization') == 'Cardiology' ? 'selected' : '' }}>Cardiology</option>
                            <option value="Dermatology" {{ old('specialization') == 'Dermatology' ? 'selected' : '' }}>Dermatology</option>
                            <option value="Endocrinology" {{ old('specialization') == 'Endocrinology' ? 'selected' : '' }}>Endocrinology</option>
                            <option value="Family Medicine" {{ old('specialization') == 'Family Medicine' ? 'selected' : '' }}>Family Medicine</option>
                            <option value="Gastroenterology" {{ old('specialization') == 'Gastroenterology' ? 'selected' : '' }}>Gastroenterology</option>
                            <option value="Neurology" {{ old('specialization') == 'Neurology' ? 'selected' : '' }}>Neurology</option>
                            <option value="Obstetrics & Gynecology" {{ old('specialization') == 'Obstetrics & Gynecology' ? 'selected' : '' }}>Obstetrics & Gynecology</option>
                            <option value="Ophthalmology" {{ old('specialization') == 'Ophthalmology' ? 'selected' : '' }}>Ophthalmology</option>
                            <option value="Pediatrics" {{ old('specialization') == 'Pediatrics' ? 'selected' : '' }}>Pediatrics</option>
                            <option value="Psychiatry" {{ old('specialization') == 'Psychiatry' ? 'selected' : '' }}>Psychiatry</option>
                            <option value="Urology" {{ old('specialization') == 'Urology' ? 'selected' : '' }}>Urology</option>
                        </select>
                        @error('specialization')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-semibold mb-1" for="consultation_fee">
                            Consultation Fee ($)
                        </label>
                        <input class="appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors @error('consultation_fee') border-red-500 @enderror" id="consultation_fee" name="consultation_fee" type="number" min="0" step="0.01" placeholder="100.00" value="{{ old('consultation_fee') }}">
                        @error('consultation_fee')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Terms Agreement -->
                <div class="mb-4">
                    <div class="flex items-center">
                        <input class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded @error('terms') border-red-500 @enderror" id="terms" name="terms" type="checkbox" required {{ old('terms') ? 'checked' : '' }}>
                        <label class="ml-2 block text-sm text-gray-700" for="terms">
                            I agree to the <a href="#" class="text-primary-600 hover:text-primary-800">Terms of Service</a> and <a href="#" class="text-primary-600 hover:text-primary-800">Privacy Policy</a>
                        </label>
                    </div>
                    @error('terms')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button and Sign In Link in same row -->
                <div class="flex items-center justify-between">
                    <button class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out" type="submit">
                        Create Account
                    </button>
                    
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-800 font-medium">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
        
        <!-- Back to home link -->
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-primary-600">
                ← Back to home page
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clientTab = document.getElementById('client-tab');
        const doctorTab = document.getElementById('doctor-tab');
        const clientFields = document.getElementById('client-fields');
        const doctorFields = document.getElementById('doctor-fields');
        const roleInput = document.getElementById('role');
        
        // Initialize based on old input if it exists
        @if(old('role') == 'doctor')
            doctorTab.click();
        @endif
        
        clientTab.addEventListener('click', function() {
            // UI changes
            clientTab.classList.add('border-primary-600', 'text-primary-600');
            clientTab.classList.remove('border-transparent', 'text-gray-500');
            doctorTab.classList.remove('border-primary-600', 'text-primary-600');
            doctorTab.classList.add('border-transparent', 'text-gray-500');
            
            // Show/hide appropriate fields
            clientFields.classList.remove('hidden');
            doctorFields.classList.add('hidden');
            
            // Update role value
            roleInput.value = 'client';
            
            // Make client fields required
            document.getElementById('phone').setAttribute('required', '');
            document.getElementById('specialization').removeAttribute('required');
            document.getElementById('consultation_fee').removeAttribute('required');
        });
        
        doctorTab.addEventListener('click', function() {
            // UI changes
            doctorTab.classList.add('border-primary-600', 'text-primary-600');
            doctorTab.classList.remove('border-transparent', 'text-gray-500');
            clientTab.classList.remove('border-primary-600', 'text-primary-600');
            clientTab.classList.add('border-transparent', 'text-gray-500');
            
            // Show/hide appropriate fields
            doctorFields.classList.remove('hidden');
            clientFields.classList.add('hidden');
            
            // Update role value
            roleInput.value = 'doctor';
            
            // Make doctor fields required
            document.getElementById('specialization').setAttribute('required', '');
            document.getElementById('consultation_fee').setAttribute('required', '');
            document.getElementById('phone').removeAttribute('required');
        });
    });
</script>
@endpush
@endsection