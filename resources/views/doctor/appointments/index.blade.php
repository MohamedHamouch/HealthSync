@extends('layouts.app')

@section('title', 'Manage Appointments - HealthSync')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('dashboard') }}" class="flex items-center text-primary-600 hover:text-primary-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Dashboard
            </a>
        </div>
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-800">Manage Patient Appointments</h1>
                <p class="text-gray-600 mt-1">View and manage your scheduled appointments</p>
            </div>

            <!-- Filter Tabs -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex overflow-x-auto space-x-2">
                    <a href="{{ route('doctor.appointments.index') }}" class="inline-block px-4 py-2 rounded-full {{ request()->query('status') === null ? 'bg-primary-100 text-primary-800 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                        All
                    </a>
                    <a href="{{ route('doctor.appointments.index', ['status' => 'pending']) }}" class="inline-block px-4 py-2 rounded-full {{ request()->query('status') === 'pending' ? 'bg-yellow-100 text-yellow-800 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                        Pending
                    </a>
                    <a href="{{ route('doctor.appointments.index', ['status' => 'confirmed']) }}" class="inline-block px-4 py-2 rounded-full {{ request()->query('status') === 'confirmed' ? 'bg-blue-100 text-blue-800 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                        Confirmed
                    </a>
                    <a href="{{ route('doctor.appointments.index', ['status' => 'completed']) }}" class="inline-block px-4 py-2 rounded-full {{ request()->query('status') === 'completed' ? 'bg-green-100 text-green-800 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                        Completed
                    </a>
                    <a href="{{ route('doctor.appointments.index', ['status' => 'cancelled']) }}" class="inline-block px-4 py-2 rounded-full {{ request()->query('status') === 'cancelled' ? 'bg-red-100 text-red-800 font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">
                        Cancelled
                    </a>
                </div>
            </div>

            <!-- Appointments Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reason</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($appointments as $appointment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 overflow-hidden">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ $appointment->client->avatar_url }}" alt="{{ $appointment->client->full_name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $appointment->client->full_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $appointment->client->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $appointment->appointment_date->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $appointment->status->color() }}-100 text-{{ $appointment->status->color() }}-800">
                                        {{ $appointment->status->label() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::limit($appointment->reason, 40) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('doctor.appointments.show', $appointment) }}" class="text-primary-600 hover:text-primary-900 mr-3">View</a>
                                    
                                    @if($appointment->status->value === 'pending')
                                        <form method="POST" action="{{ route('doctor.appointments.update-status', $appointment) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="text-blue-600 hover:text-blue-900 mr-3">Confirm</button>
                                        </form>
                                    @endif
                                    
                                    @if($appointment->status->value === 'confirmed')
                                        <form method="POST" action="{{ route('doctor.appointments.update-status', $appointment) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Complete</button>
                                        </form>
                                    @endif
                                    
                                    @if(in_array($appointment->status->value, ['pending', 'confirmed']))
                                        <form method="POST" action="{{ route('doctor.appointments.update-status', $appointment) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="text-red-600 hover:text-red-900">Cancel</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No appointments found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 