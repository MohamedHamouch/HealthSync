<nav class="bg-teal-600 text-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <a href="{{ route('home') }}" class="font-bold text-xl">HealthSync</a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-6">
                @guest
                    <a href="{{ route('home') }}" class="hover:text-teal-200 transition duration-300 font-medium">Home</a>
                    <a href="{{ route('home') }}#services"
                        class="hover:text-teal-200 transition duration-300 font-medium">Services</a>
                    <a href="{{ route('home') }}#doctors"
                        class="hover:text-teal-200 transition duration-300 font-medium">Our Doctors</a>
                    <a href="{{ route('home') }}#contact"
                        class="hover:text-teal-200 transition duration-300 font-medium">Contact</a>
                @else
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('dashboard') }}"
                            class="hover:text-teal-200 transition duration-300 font-medium">Dashboard</a>
                        <a href="#" class="hover:text-teal-200 transition duration-300 font-medium">Manage Users</a>
                        <a href="#" class="hover:text-teal-200 transition duration-300 font-medium">Reports</a>
                        <a href="#" class="hover:text-teal-200 transition duration-300 font-medium">Settings</a>
                    @elseif(Auth::user()->isDoctor())
                        <a href="{{ route('dashboard') }}"
                            class="hover:text-teal-200 transition duration-300 font-medium">Dashboard</a>
                        <a href="#" class="hover:text-teal-200 transition duration-300 font-medium">Appointments</a>
                        <a href="#" class="hover:text-teal-200 transition duration-300 font-medium">Patients</a>
                        <a href="#" class="hover:text-teal-200 transition duration-300 font-medium">Schedule</a>
                    @elseif(Auth::user()->isClient())
                        <a href="{{ route('dashboard') }}"
                            class="hover:text-teal-200 transition duration-300 font-medium">Dashboard</a>
                        <a href="#" class="hover:text-teal-200 transition duration-300 font-medium">Book Appointment</a>
                        <a href="#" class="hover:text-teal-200 transition duration-300 font-medium">My Records</a>
                        <a href="#" class="hover:text-teal-200 transition duration-300 font-medium">Consultations</a>
                    @endif
                @endguest
            </div>

            <div class="hidden md:block">
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded bg-white text-teal-600 font-medium hover:bg-teal-50 transition duration-300 shadow-sm hover:shadow mr-2">Sign
                        In</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 rounded bg-teal-700 text-white font-medium hover:bg-teal-800 transition duration-300 shadow-sm hover:shadow">Register</a>
                @else
                    <div class="flex items-center">
                        <div class="relative group">
                            <button class="flex items-center mr-4 focus:outline-none group">
                                <img src="{{ Auth::user()->getAvatarUrlAttribute() }}" alt="{{ Auth::user()->getFullNameAttribute() }}" class="w-8 h-8 rounded-full mr-2 object-cover border border-teal-200">
                                <span>{{ Auth::user()->getFullNameAttribute() }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Add pt-2 to create padding that connects the button to the dropdown menu -->
                            <div class="absolute right-0 pt-2 w-48 z-50 hidden group-hover:block">
                                <!-- This is the invisible "connector" to prevent the hover state from being lost -->
                                <div class="h-2 bg-transparent"></div>
                                <!-- The actual dropdown menu -->
                                <div class="bg-white rounded-md shadow-lg py-1">
                                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-teal-50">My Profile</a>
                                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-teal-50">Settings</a>
                                    <div class="border-t border-gray-100"></div>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-gray-800 hover:bg-teal-50">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu, hidden by default -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 mt-3 bg-teal-700 rounded-lg">
                @guest
                    <a href="{{ route('home') }}"
                        class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Home</a>
                    <a href="{{ route('home') }}#services"
                        class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Services</a>
                    <a href="{{ route('home') }}#doctors"
                        class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Our Doctors</a>
                    <a href="{{ route('home') }}#contact"
                        class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Contact</a>
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 mt-3 rounded-md text-white font-medium bg-teal-800 hover:bg-teal-900">Sign
                        In</a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 mt-1 rounded-md text-white font-medium bg-teal-800 hover:bg-teal-900">Register</a>
                @else
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('dashboard') }}"
                            class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Dashboard</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Manage Users</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Reports</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Settings</a>
                    @elseif(Auth::user()->isDoctor())
                        <a href="{{ route('dashboard') }}"
                            class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Dashboard</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Appointments</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Patients</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Schedule</a>
                    @elseif(Auth::user()->isClient())
                        <a href="{{ route('dashboard') }}"
                            class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Dashboard</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Book
                            Appointment</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">My Records</a>
                        <a href="#"
                            class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Consultations</a>
                    @endif
                    <div class="border-t border-teal-600 mt-2 pt-2">
                        <div class="flex items-center px-3 py-2">
                            <img src="{{ Auth::user()->getAvatarUrlAttribute() }}" alt="{{ Auth::user()->getFullNameAttribute() }}" class="w-8 h-8 rounded-full mr-2 object-cover border border-teal-200">
                            <span class="text-white font-medium">{{ Auth::user()->getFullNameAttribute() }}</span>
                        </div>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">My Profile</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-white font-medium hover:bg-teal-600">Settings</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();" 
                            class="block px-3 py-2 mt-1 rounded-md text-white font-medium bg-teal-800 hover:bg-teal-900">Logout</a>
                        <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>