@extends('layouts.app')

@section('title', 'Your Health Companion')

@section('content')

    <!-- Hero Section - Improved responsiveness and visual appeal -->
    <section class="py-12 md:py-20 hero-gradient text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 text-center lg:text-left mb-10 lg:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Streamline Your Healthcare Experience</h1>
                    <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto lg:mx-0">HealthSync brings together patients,
                        doctors, and healthcare providers in one comprehensive platform.</p>
                    <div
                        class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}"
                            class="px-6 py-3 bg-white text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition duration-300 text-center shadow-lg hover:shadow-xl">Get
                            Started</a>
                        <a href="#features"
                            class="px-6 py-3 bg-transparent border-2 border-white rounded-lg font-semibold hover:bg-white hover:text-primary-600 transition duration-300 text-center">Learn
                            More</a>
                    </div>
                </div>
                <div class="lg:w-1/2 grid grid-cols-2 gap-4">
                    <div class="transform hover:scale-105 transition duration-300 hover:rotate-1">
                        <img src="{{ asset('images/Doctor.jpg') }}" alt="Doctor Consultation" class="rounded-lg shadow-xl">
                    </div>
                    <div class="transform hover:scale-105 transition duration-300 hover:-rotate-1 mt-8">
                        <img src="{{ asset('images/Healthmonitor.avif')}}" alt="Health Monitoring"
                            class="rounded-lg shadow-xl">
                    </div>
                    <div class="transform hover:scale-105 transition duration-300 hover:-rotate-1">
                        <img src="{{ asset('images/Medicalrecord.png') }}" alt="Medical Records"
                            class="rounded-lg shadow-xl">
                    </div>
                    <div class="transform hover:scale-105 transition duration-300 hover:rotate-1 mt-8">
                        <img src="{{ asset('images/Appointment.jpg') }}"
                            alt="Appointment Booking" class="rounded-lg shadow-xl">
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave divider for visual appeal -->
        <div class="w-full absolute left-0 bottom-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" fill="#ffffff">
                <path
                    d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z">
                </path>
            </svg>
        </div>
    </section>

    <!-- Features Section - Improved card design -->
    <section id="features" class="py-16 md:py-24 bg-white relative">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4 text-gray-800">Key Features</h2>
            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">HealthSync provides a comprehensive suite of tools
                to manage your healthcare needs efficiently.</p>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div
                    class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-xl transition duration-300 feature-card">
                    <div class="p-3 bg-primary-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Appointment Scheduling</h3>
                    <p class="text-gray-600">Book appointments with preferred doctors, choose available time slots, and
                        manage your healthcare visits all in one place.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-xl transition duration-300 feature-card">
                    <div class="p-3 bg-primary-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Health Records Management</h3>
                    <p class="text-gray-600">Securely store and manage your health records, including vital measurements and
                        file attachments, for a complete medical history.</p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-xl transition duration-300 feature-card">
                    <div class="p-3 bg-primary-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Doctor Reviews</h3>
                    <p class="text-gray-600">Rate and review your healthcare providers, helping others make informed
                        decisions when choosing doctors.</p>
                </div>

                <!-- Feature 4 -->
                <div
                    class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-xl transition duration-300 feature-card">
                    <div class="p-3 bg-primary-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Nutritional Information</h3>
                    <p class="text-gray-600">Search for food items and access detailed nutritional information from the USDA
                        database to support your health goals.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- User Roles Section - Enhanced responsiveness -->
    <section id="roles" class="py-16 md:py-24 bg-gray-50 relative">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4 text-gray-800">Who Uses HealthSync?</h2>
            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">Our platform serves multiple stakeholders in the
                healthcare ecosystem, providing specialized tools for each user role.</p>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Role 1: Clients -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-2xl">
                    <div class="h-52 bg-primary-600 flex items-center justify-center relative overflow-hidden">
                        <img src="{{ asset('images/patient.jpg') }}" alt="Clients"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-800 to-transparent opacity-50"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4 text-primary-600">For Clients</h3>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Book appointments with preferred doctors</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Create and manage health records</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Track appointment history</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Submit reviews for doctors</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Access nutritional information</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Role 2: Doctors -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-2xl">
                    <div class="h-52 bg-secondary-500 flex items-center justify-center relative overflow-hidden">
                        <img src="{{ asset('images/doctor.jpg') }}" alt="Doctors"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-cyan-800 to-transparent opacity-50"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4 text-secondary-500">For Doctors</h3>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Set weekly schedule availability</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>View and manage appointments</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Access patient health records</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>View client reviews</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Update professional profile</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Role 3: Administrators -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-2xl">
                    <div class="h-52 bg-blue-600 flex items-center justify-center relative overflow-hidden">
                        <img src="{{ asset('images/admin.jpg') }}" alt="Administrators"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-800 to-transparent opacity-50"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4 text-blue-600">For Administrators</h3>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Manage all system users</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Activate new doctor accounts</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Suspend and unsuspend user accounts</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>View detailed user information</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Update doctor professional info</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section - Improved visual presentation -->
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4 text-gray-800">How HealthSync Works</h2>
            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">A seamless healthcare experience in just a few
                simple steps</p>

            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="lg:w-2/5 mb-10 lg:mb-0 lg:pr-10">
                    <img src="{{ asset('images/how-it-works.cms') }}" alt="HealthSync Workflow"
                        class="rounded-xl shadow-xl hover:shadow-2xl transition duration-300">
                </div>

                <div class="lg:w-3/5">
                    <div class="space-y-8">
                        <!-- Step 1 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center h-14 w-14 rounded-full bg-primary-600 text-white text-xl font-bold shadow-lg">
                                    1
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Create Your Account</h3>
                                <p class="text-gray-600 text-lg">Register as a client or doctor and complete your profile
                                    with relevant information about yourself.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center h-14 w-14 rounded-full bg-primary-600 text-white text-xl font-bold shadow-lg">
                                    2
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Explore Available Doctors</h3>
                                <p class="text-gray-600 text-lg">Browse through our network of qualified doctors, view their
                                    specializations, and read reviews from other clients.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center h-14 w-14 rounded-full bg-primary-600 text-white text-xl font-bold shadow-lg">
                                    3
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Book Appointments</h3>
                                <p class="text-gray-600 text-lg">Select a doctor, choose from their available time slots,
                                    and confirm your appointment with just a few clicks.</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center h-14 w-14 rounded-full bg-primary-600 text-white text-xl font-bold shadow-lg">
                                    4
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Manage Your Health</h3>
                                <p class="text-gray-600 text-lg">Create health records, track your appointments, leave
                                    reviews for doctors, and access nutritional information to maintain your wellbeing.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials - Updated with card design -->
    <section id="testimonials" class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">What Our Users Say</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="text-primary-500">
                            <span class="text-lg">★★★★★</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"HealthSync has made managing my medical appointments so much
                        easier. The health records feature is especially useful for tracking my vital signs over time."</p>
                    <div class="flex items-center mt-auto">
                        <div
                            class="w-12 h-12 bg-primary-200 rounded-full flex items-center justify-center text-primary-700 font-bold mr-3 shadow-md">
                            M</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Maria Rodriguez</h4>
                            <p class="text-sm text-gray-500">Client</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="text-primary-500">
                            <span class="text-lg">★★★★★</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"As a doctor, I appreciate how HealthSync streamlines my schedule
                        management. Setting my weekly availability once and letting the system handle bookings saves me
                        hours every week."</p>
                    <div class="flex items-center mt-auto">
                        <div
                            class="w-12 h-12 bg-primary-200 rounded-full flex items-center justify-center text-primary-700 font-bold mr-3 shadow-md">
                            D</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Dr. David Kim</h4>
                            <p class="text-sm text-gray-500">Cardiologist</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md testimonial-card">
                    <div class="flex items-center mb-4">
                        <div class="text-primary-500">
                            <span class="text-lg">★★★★★</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">"The user management system in HealthSync is excellent. Being able
                        to easily activate doctor accounts and monitor all users from a single dashboard makes
                        administration efficient."</p>
                    <div class="flex items-center mt-auto">
                        <div
                            class="w-12 h-12 bg-primary-200 rounded-full flex items-center justify-center text-primary-700 font-bold mr-3 shadow-md">
                            J</div>
                        <div>
                            <h4 class="font-bold text-gray-800">James Wilson</h4>
                            <p class="text-sm text-gray-500">System Administrator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section - Enhanced with animation -->
    <section class="py-20 md:py-28 hero-gradient text-white relative overflow-hidden">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Transform Your Healthcare Experience?</h2>
            <p class="text-xl mb-8 max-w-3xl mx-auto opacity-90">Join HealthSync today to manage your health records, book
                doctor appointments, and take control of your healthcare journey.</p>
            <a href="{{ route('register') }}"
                class="px-8 py-4 bg-white text-primary-600 rounded-lg font-bold text-lg hover:bg-primary-50 transition duration-300 inline-block shadow-lg hover:shadow-xl transform hover:-translate-y-1">Create
                Your Account Now</a>
        </div>

        <!-- Animated background elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20">
            <div class="absolute w-72 h-72 rounded-full bg-white top-10 left-10 animate-pulse-slow"></div>
            <div class="absolute w-48 h-48 rounded-full bg-white bottom-10 right-10 animate-pulse"></div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Any page-specific JavaScript
    </script>
@endpush