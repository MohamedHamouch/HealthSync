<!-- Navigation - Enhanced mobile responsiveness -->
<nav class="bg-primary-600 text-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="font-bold text-xl">HealthSync</span>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="hover:text-primary-200 transition duration-300 font-medium">Home</a>
                <a href="{{ url('/#features') }}" class="hover:text-primary-200 transition duration-300 font-medium">Features</a>
                <a href="{{ url('/#roles') }}" class="hover:text-primary-200 transition duration-300 font-medium">User Roles</a>
                <a href="{{ url('/#testimonials') }}" class="hover:text-primary-200 transition duration-300 font-medium">Testimonials</a>
            </div>
            
            <div class="hidden md:block">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded bg-white text-primary-600 font-medium hover:bg-primary-50 transition duration-300 shadow-sm hover:shadow">Sign In</a>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile menu, hidden by default -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 mt-3 bg-primary-700 rounded-lg">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-primary-600">Home</a>
                <a href="{{ url('/#features') }}" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-primary-600">Features</a>
                <a href="{{ url('/#roles') }}" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-primary-600">User Roles</a>
                <a href="{{ url('/#testimonials') }}" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-primary-600">Testimonials</a>
                <a href="{{ route('login') }}" class="block px-3 py-2 mt-3 rounded-md text-white font-medium bg-primary-800 hover:bg-primary-900">Sign In</a>
            </div>
        </div>
    </div>
</nav>