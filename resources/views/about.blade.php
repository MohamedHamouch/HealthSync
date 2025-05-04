@extends('layouts.app')

@section('title', 'About Us - HealthSync')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">About HealthSync</h1>
            <p class="mt-4 text-lg text-gray-500 max-w-3xl mx-auto">Transforming healthcare management through innovation and accessibility.</p>
        </div>

        <!-- Our Story Section -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl mb-16">
            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Our Story</h2>
                        <p class="text-gray-600 mb-4">HealthSync was founded in 2023 with a simple yet powerful mission: to make healthcare more accessible, organized, and efficient for everyone involved. Our team of healthcare professionals and technology experts came together to address the common challenges faced in healthcare management.</p>
                        <p class="text-gray-600 mb-4">What started as a small project to streamline appointment booking has evolved into a comprehensive platform that connects patients, doctors, and administrators in one ecosystem.</p>
                        <p class="text-gray-600">Today, HealthSync serves thousands of users across the country, continuously improving and expanding our services to meet the evolving needs of modern healthcare.</p>
                    </div>
                    <div class="relative h-64 md:h-full rounded-lg overflow-hidden shadow-lg bg-gray-100 flex items-center justify-center">
                        <!-- Image Placeholder -->
                        <div class="text-gray-400 flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-2">Our Office Image</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Mission Section -->
        <div class="mb-16">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-800">Our Mission & Values</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Guided by our core principles to improve healthcare for all</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Mission Card 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="bg-primary-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Accessibility</h3>
                    <p class="text-gray-600">We believe healthcare management should be accessible to everyone, regardless of technical ability or location. Our platform is designed with simplicity and inclusivity in mind.</p>
                </div>

                <!-- Mission Card 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="bg-primary-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Innovation</h3>
                    <p class="text-gray-600">We continuously strive to innovate and improve our platform, incorporating the latest technologies and best practices in healthcare management to provide exceptional service.</p>
                </div>

                <!-- Mission Card 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="bg-primary-100 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Security & Privacy</h3>
                    <p class="text-gray-600">We understand the sensitive nature of healthcare data and are committed to maintaining the highest standards of security and privacy protection for all our users.</p>
                </div>
            </div>
        </div>

        <!-- Our Team Section -->
        <div class="mb-16">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-800">Our Leadership Team</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Meet the dedicated professionals behind HealthSync</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="h-64 bg-gray-100 flex items-center justify-center">
                        <!-- Image Placeholder -->
                        <div class="text-gray-400 flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <p class="mt-2">CEO Photo</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800">Dr. Sarah Johnson</h3>
                        <p class="text-primary-600 mb-3">Chief Executive Officer</p>
                        <p class="text-gray-600">With over 15 years of experience in healthcare administration, Dr. Johnson leads our strategic vision and operations.</p>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="h-64 bg-gray-100 flex items-center justify-center">
                        <!-- Image Placeholder -->
                        <div class="text-gray-400 flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <p class="mt-2">CTO Photo</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800">Michael Chen</h3>
                        <p class="text-primary-600 mb-3">Chief Technology Officer</p>
                        <p class="text-gray-600">A technology innovator with expertise in healthcare IT systems, Michael oversees our platform development and security.</p>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="h-64 bg-gray-100 flex items-center justify-center">
                        <!-- Image Placeholder -->
                        <div class="text-gray-400 flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <p class="mt-2">CMO Photo</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800">Dr. James Wilson</h3>
                        <p class="text-primary-600 mb-3">Chief Medical Officer</p>
                        <p class="text-gray-600">A practicing physician with a passion for healthcare innovation, Dr. Wilson ensures our platform meets the needs of medical professionals.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl mb-16">
            <div class="p-8 md:p-12">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-10">HealthSync Impact</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                    <!-- Stat 1 -->
                    <div>
                        <p class="text-4xl font-bold text-primary-600 mb-2">10,000+</p>
                        <p class="text-gray-600">Registered Users</p>
                    </div>
                    
                    <!-- Stat 2 -->
                    <div>
                        <p class="text-4xl font-bold text-primary-600 mb-2">500+</p>
                        <p class="text-gray-600">Healthcare Providers</p>
                    </div>
                    
                    <!-- Stat 3 -->
                    <div>
                        <p class="text-4xl font-bold text-primary-600 mb-2">50,000+</p>
                        <p class="text-gray-600">Appointments Booked</p>
                    </div>
                    
                    <!-- Stat 4 -->
                    <div>
                        <p class="text-4xl font-bold text-primary-600 mb-2">98%</p>
                        <p class="text-gray-600">User Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="mb-16">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-800">What People Say About Us</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Hear from our satisfied users</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="text-primary-500">
                            <span class="text-lg">★★★★★</span>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">"HealthSync has completely transformed how I manage my healthcare. Booking appointments is seamless, and having all my records in one place is invaluable."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold mr-3">
                            RD
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Robert Davis</h4>
                            <p class="text-sm text-gray-500">Patient</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="text-primary-500">
                            <span class="text-lg">★★★★★</span>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">"As a physician, HealthSync has significantly reduced administrative work, allowing me to focus more on patient care. The scheduling system is particularly impressive."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold mr-3">
                            EL
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Dr. Emily Lee</h4>
                            <p class="text-sm text-gray-500">Pediatrician</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="text-primary-500">
                            <span class="text-lg">★★★★★</span>
                        </div>
                    </div>
                    <p class="text-gray-600 italic mb-6">"I implemented HealthSync at our medical center, and it has streamlined operations beyond our expectations. The support team is responsive and always helpful."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold mr-3">
                            JT
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Jessica Turner</h4>
                            <p class="text-sm text-gray-500">Healthcare Administrator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-primary-600 rounded-xl overflow-hidden shadow-xl mb-16">
            <div class="p-8 md:p-12 text-center text-white">
                <h2 class="text-3xl font-bold mb-6">Ready to experience HealthSync?</h2>
                <p class="text-xl mb-8 max-w-3xl mx-auto opacity-90">Join thousands of users who are transforming their healthcare experience with our platform.</p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-primary-600 rounded-lg font-bold text-lg hover:bg-primary-50 transition duration-300 shadow-lg">
                        Get Started
                    </a>
                    <a href="{{ route('contact') }}" class="px-8 py-4 bg-transparent border-2 border-white rounded-lg font-bold text-lg hover:bg-white hover:text-primary-600 transition duration-300">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 