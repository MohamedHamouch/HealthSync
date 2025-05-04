@extends('layouts.app')

@section('title', 'My Appointments - HealthSync')

@section('content')
<div class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-primary-600 hover:text-primary-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between mb-6">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-gray-800">My Appointments</h2>
                </div>
                <a href="{{ route('client.booking.index') }}" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                    Book New Appointment
                </a>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="mb-6">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('client.appointments.index') }}" class="px-3 py-1 rounded-md {{ !request('status') ? 'bg-primary-100 text-primary-700 font-semibold' : 'bg-gray-100' }}">
                        All
                    </a>
                    <a href="{{ route('client.appointments.index', ['status' => 'pending']) }}" class="px-3 py-1 rounded-md {{ request('status') == 'pending' ? 'bg-yellow-100 text-yellow-800 font-semibold' : 'bg-gray-100' }}">
                        Pending
                    </a>
                    <a href="{{ route('client.appointments.index', ['status' => 'confirmed']) }}" class="px-3 py-1 rounded-md {{ request('status') == 'confirmed' ? 'bg-blue-100 text-blue-800 font-semibold' : 'bg-gray-100' }}">
                        Confirmed
                    </a>
                    <a href="{{ route('client.appointments.index', ['status' => 'completed']) }}" class="px-3 py-1 rounded-md {{ request('status') == 'completed' ? 'bg-green-100 text-green-800 font-semibold' : 'bg-gray-100' }}">
                        Completed
                    </a>
                    <a href="{{ route('client.appointments.index', ['status' => 'cancelled']) }}" class="px-3 py-1 rounded-md {{ request('status') == 'cancelled' ? 'bg-red-100 text-red-800 font-semibold' : 'bg-gray-100' }}">
                        Cancelled
                    </a>
                </div>
            </div>
            
            @if($appointments->isEmpty())
                <div class="bg-gray-50 p-6 rounded-md text-center">
                    <p class="text-gray-500">You don't have any appointments yet.</p>
                    <a href="{{ route('client.booking.index') }}" class="inline-block mt-4 px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                        Book Your First Appointment
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Doctor
                                </th>
                                <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Time
                                </th>
                                <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="py-3 px-4 border-b border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
                                    <td class="py-4 px-4 border-b border-gray-200">
                                        @if(isset($doctors[$appointment->doctor_id]))
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 rounded-full overflow-hidden bg-gray-100 mr-3">
                                                    <img src="{{ $doctors[$appointment->doctor_id]->avatar_url }}" alt="Dr. {{ $doctors[$appointment->doctor_id]->first_name }}" class="h-full w-full object-cover">
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Dr. {{ $doctors[$appointment->doctor_id]->first_name }} {{ $doctors[$appointment->doctor_id]->last_name }}</p>
                                                    <p class="text-xs text-gray-500">{{ $doctors[$appointment->doctor_id]->profile->specialization ?? 'Doctor' }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-sm text-gray-500">Doctor (ID: {{ $appointment->doctor_id }})</p>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 border-b border-gray-200">
                                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('g:i A') }}</p>
                                    </td>
                                    <td class="py-4 px-4 border-b border-gray-200">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            bg-{{ $appointment->status->color() }}-100 text-{{ $appointment->status->color() }}-800">
                                            {{ $appointment->status->label() }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 border-b border-gray-200">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('client.appointments.show', $appointment) }}" class="text-blue-600 hover:text-blue-900">
                                                View
                                            </a>
                                            
                                            @if(in_array($appointment->status->value, ['pending', 'confirmed']))
                                                <form action="{{ route('client.appointments.cancel', $appointment) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($appointment->status->value == 'completed' && !$appointment->review)
                                                <a href="{{ route('client.appointments.show', $appointment) }}#review" class="text-green-600 hover:text-green-900">
                                                    Leave Review
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 