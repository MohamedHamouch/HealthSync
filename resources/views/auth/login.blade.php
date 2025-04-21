@extends('layouts.app')

@section('title', 'HealthSync - Login')

@section('content')
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Brand Identity - More compact -->
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
        
        <!-- Login Form Card - More compact padding -->
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 text-center mb-4">Welcome Back</h2>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-1" for="email">
                        Email Address
                    </label>
                    <input class="appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors @error('email') border-red-500 @enderror" id="email" name="email" type="email" placeholder="your@email.com" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-1" for="password">
                        Password
                    </label>
                    <input class="appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors @error('password') border-red-500 @enderror" id="password" name="password" type="password" placeholder="••••••••" required autocomplete="current-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <label class="ml-2 block text-sm text-gray-700" for="remember">
                            Remember me
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-800 font-medium">
                        Forgot password?
                    </a>
                    @endif
                </div>
                
                <button class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2.5 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out" type="submit">
                    Sign In
                </button>
            </form>
            
            <div class="mt-5 pt-4 border-t border-gray-200">
                <div class="text-center mb-3">
                    <p class="text-xs text-gray-600">Or sign in with</p>
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <button class="flex items-center justify-center py-1.5 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.283 10.356h-8.327v3.451h4.792c-.446 2.193-2.313 3.453-4.792 3.453a5.27 5.27 0 0 1-5.279-5.28 5.27 5.27 0 0 1 5.279-5.279c1.259 0 2.397.447 3.29 1.178l2.6-2.599c-1.584-1.381-3.615-2.233-5.89-2.233a8.908 8.908 0 0 0-8.934 8.934 8.907 8.907 0 0 0 8.934 8.934c4.467 0 8.529-3.249 8.529-8.934 0-.528-.081-1.097-.202-1.625z" fill="#4285F4"/>
                            <path d="M4.17 12.958l-.553 2.06-.2.762C4.6 17.358 6.73 19.5 9.45 19.5c1.715 0 3.14-.568 4.108-1.54l-2.635-2.044c-.748.544-1.727.86-2.803.724-1.662-.2-3.041-1.537-3.35-3.213h-.001z" fill="#34A853"/>
                            <path d="M9.45 5.5a5.23 5.23 0 0 1 3.73 1.5l2.204-2.204A9.225 9.225 0 0 0 9.45 2.5 9.007 9.007 0 0 0 3.2 5.5l2.44 1.88C6.664 6.182 7.99 5.5 9.45 5.5z" fill="#EA4335"/>
                            <path d="M14.986 10.284c.242-.714.37-1.484.37-2.284 0-.79-.125-1.551-.356-2.269l-2.204 2.204c.545.643.873 1.459.897 2.35h1.293z" fill="#FBBC05"/>
                        </svg>
                        <span class="text-sm">Google</span>
                    </button>
                    <button class="flex items-center justify-center py-1.5 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.5436 8.62526C14.3673 7.72684 15.0297 6.45656 14.9974 5.12105C13.8357 5.16816 12.491 5.85105 11.6404 6.73368C10.8491 7.53947 10.0878 8.84421 10.1297 10.1126C11.4143 10.2 12.6795 9.48947 13.5436 8.62526Z" fill="#000000"/>
                            <path d="M16.8033 12.6502C16.7808 10.8368 18.2451 9.71579 18.3163 9.66868C17.4208 8.34316 15.9948 8.14 15.5087 8.12421C14.1876 7.98947 12.9175 8.8879 12.2454 8.8879C11.5636 8.8879 10.5182 8.13947 9.41854 8.16105C7.99483 8.18263 6.65928 8.98842 5.92707 10.2879C4.43229 12.9239 5.52218 16.8184 6.95567 18.9891C7.6713 20.0553 8.52344 21.2516 9.65806 21.2042C10.7641 21.1568 11.1889 20.4887 12.5458 20.4887C13.9027 20.4887 14.2934 21.2042 15.4566 21.1805C16.6533 21.1568 17.3678 20.0984 18.0592 19.0218C18.9022 17.7818 19.2409 16.5747 19.2614 16.5129C19.2307 16.4963 16.8279 15.6044 16.8033 12.6502Z" fill="#000000"/>
                        </svg>
                        <span class="text-sm">Apple</span>
                    </button>
                </div>
            </div>
            
            <!-- Account creation link inside the form -->
            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-800 font-medium">
                        Create an account
                    </a>
                </p>
            </div>
        </div>
        
        <!-- Back to home link - Moved outside the form card to match register page -->
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-primary-600">
                ← Back to home page
            </a>
        </div>
    </div>
</div>
@endsection