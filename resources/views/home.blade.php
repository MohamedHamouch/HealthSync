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
                        <img src="https://placehold.co/600x400/teal/white?text=Doctor+Consultation"
                            alt="Doctor Consultation" class="rounded-lg shadow-xl">
                    </div>
                    <div class="transform hover:scale-105 transition duration-300 hover:-rotate-1 mt-8">
                        <img src="https://placehold.co/600x400/cyan/white?text=Health+Monitoring" alt="Health Monitoring"
                            class="rounded-lg shadow-xl">
                    </div>
                    <div class="transform hover:scale-105 transition duration-300 hover:-rotate-1">
                        <img src="https://placehold.co/600x400/blue/white?text=Medical+Records" alt="Medical Records"
                            class="rounded-lg shadow-xl">
                    </div>
                    <div class="transform hover:scale-105 transition duration-300 hover:rotate-1 mt-8">
                        <img src="https://placehold.co/600x400/teal/white?text=Appointment+Booking"
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
                    <p class="text-gray-600">Book, reschedule, or cancel appointments with healthcare providers in
                        real-time.</p>
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
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Medical Records</h3>
                    <p class="text-gray-600">Securely store and access your complete medical history, test results, and
                        prescriptions.</p>
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
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Doctor Profiles</h3>
                    <p class="text-gray-600">Browse detailed profiles of healthcare providers including specialties,
                        experience, and patient reviews.</p>
                </div>

                <!-- Feature 4 -->
                <div
                    class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-xl transition duration-300 feature-card">
                    <div class="p-3 bg-primary-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-primary-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-800">Secure Messaging</h3>
                    <p class="text-gray-600">Communicate directly with your healthcare team through our encrypted messaging
                        system.</p>
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
                <!-- Role 1: Patients -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-2xl">
                    <div class="h-52 bg-primary-600 flex items-center justify-center relative overflow-hidden">
                        <img src="https://placehold.co/400x300/teal/white?text=Patients" alt="Patients"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-800 to-transparent opacity-50"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4 text-primary-600">For Patients</h3>
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
                                <span>View and manage medical records</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Receive medication reminders</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-primary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Communicate with healthcare providers</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Role 2: Doctors -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-2xl">
                    <div class="h-52 bg-secondary-500 flex items-center justify-center relative overflow-hidden">
                        <img src="https://placehold.co/400x300/cyan/white?text=Doctors" alt="Doctors"
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
                                <span>Manage daily appointment schedule</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Access patient medical histories</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Issue prescriptions digitally</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-secondary-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Share diagnostic results securely</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Role 3: Healthcare Administrators -->
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-2xl">
                    <div class="h-52 bg-blue-600 flex items-center justify-center relative overflow-hidden">
                        <img src="https://placehold.co/400x300/blue/white?text=Administrators" alt="Administrators"
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
                                <span>Oversee all appointments and schedules</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Manage staff and doctor availability</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Generate reports and analytics</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Monitor system performance</span>
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
                    <img src="https://placehold.co/800x600/teal/white?text=HealthSync+Workflow" alt="HealthSync Workflow"
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
                                <p class="text-gray-600 text-lg">Sign up and complete your profile with relevant health
                                    information and preferences.</p>
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
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Find Healthcare Providers</h3>
                                <p class="text-gray-600 text-lg">Browse through our network of qualified doctors and
                                    specialists based on your needs.</p>
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
                                <p class="text-gray-600 text-lg">Schedule consultations at your convenience with real-time
                                    availability information.</p>
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
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Receive Care & Follow-up</h3>
                                <p class="text-gray-600 text-lg">Get treatment, access your records, and maintain ongoing
                                    communication with your healthcare team.</p>
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
                    <p class="text-gray-600 mb-6 italic">"HealthSync has completely transformed how I manage my healthcare.
                        The appointment booking feature is so convenient, and having all my medical records in one place is
                        invaluable."</p>
                    <div class="flex items-center mt-auto">
                        <div
                            class="w-12 h-12 bg-primary-200 rounded-full flex items-center justify-center text-primary-700 font-bold mr-3 shadow-md">
                            J</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Jessica Miller</h4>
                            <p class="text-sm text-gray-500">Patient</p>
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
                    <p class="text-gray-600 mb-6 italic">"As a doctor, HealthSync helps me keep track of my appointments and
                        patient records efficiently. The interface is intuitive and saves me hours each week in
                        administrative work."</p>
                    <div class="flex items-center mt-auto">
                        <div
                            class="w-12 h-12 bg-primary-200 rounded-full flex items-center justify-center text-primary-700 font-bold mr-3 shadow-md">
                            R</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Dr. Robert Chen</h4>
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
                    <p class="text-gray-600 mb-6 italic">"Our healthcare facility has seen a 40% reduction in scheduling
                        errors since implementing HealthSync. The administrative dashboard provides valuable insights for
                        our operations."</p>
                    <div class="flex items-center mt-auto">
                        <div
                            class="w-12 h-12 bg-primary-200 rounded-full flex items-center justify-center text-primary-700 font-bold mr-3 shadow-md">
                            S</div>
                        <div>
                            <h4 class="font-bold text-gray-800">Sarah Johnson</h4>
                            <p class="text-sm text-gray-500">Hospital Administrator</p>
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
            <p class="text-xl mb-8 max-w-3xl mx-auto opacity-90">Join thousands of users who trust HealthSync for their
                healthcare management needs.</p>
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