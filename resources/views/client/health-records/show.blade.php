@extends('layouts.app')

@section('title', 'View Health Record - HealthSync')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <a href="{{ route('health-records.index') }}" class="mr-2 text-gray-600 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-800">Health Record Details</h1>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('health-records.edit', $healthRecord) }}" class="inline-flex items-center text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('health-records.destroy', $healthRecord) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this health record? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Session Messages -->
        @if(session('success'))
        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow" role="alert">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800">Basic Information</h3>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <h4 class="text-md font-medium text-gray-700">{{ $healthRecord->title }}</h4>
                    <p class="text-sm text-gray-500">Record Date: {{ $healthRecord->record_date->format('F d, Y') }}</p>
                </div>
                <div class="text-gray-600">
                    {{ $healthRecord->description }}
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800">Health Measurements</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if($healthRecord->blood_pressure_systolic && $healthRecord->blood_pressure_diastolic)
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h4 class="text-md font-medium text-gray-700 mb-2">Blood Pressure</h4>
                        <div class="flex items-baseline">
                            <span class="text-2xl font-bold text-primary-600">{{ $healthRecord->blood_pressure_systolic }}/{{ $healthRecord->blood_pressure_diastolic }}</span>
                            <span class="ml-1 text-sm text-gray-500">{{ $measurementUnits['blood_pressure_systolic'] }}</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($healthRecord->pulse_rate)
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h4 class="text-md font-medium text-gray-700 mb-2">Pulse Rate</h4>
                        <div class="flex items-baseline">
                            <span class="text-2xl font-bold text-primary-600">{{ $healthRecord->pulse_rate }}</span>
                            <span class="ml-1 text-sm text-gray-500">{{ $measurementUnits['pulse_rate'] }}</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($healthRecord->temperature)
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h4 class="text-md font-medium text-gray-700 mb-2">Temperature</h4>
                        <div class="flex items-baseline">
                            <span class="text-2xl font-bold text-primary-600">{{ $healthRecord->temperature }}</span>
                            <span class="ml-1 text-sm text-gray-500">{{ $measurementUnits['temperature'] }}</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($healthRecord->respiration_rate)
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h4 class="text-md font-medium text-gray-700 mb-2">Respiration Rate</h4>
                        <div class="flex items-baseline">
                            <span class="text-2xl font-bold text-primary-600">{{ $healthRecord->respiration_rate }}</span>
                            <span class="ml-1 text-sm text-gray-500">{{ $measurementUnits['respiration_rate'] }}</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($healthRecord->blood_sugar)
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h4 class="text-md font-medium text-gray-700 mb-2">Blood Sugar</h4>
                        <div class="flex items-baseline">
                            <span class="text-2xl font-bold text-primary-600">{{ $healthRecord->blood_sugar }}</span>
                            <span class="ml-1 text-sm text-gray-500">{{ $measurementUnits['blood_sugar'] }}</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($healthRecord->weight)
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h4 class="text-md font-medium text-gray-700 mb-2">Weight</h4>
                        <div class="flex items-baseline">
                            <span class="text-2xl font-bold text-primary-600">{{ $healthRecord->weight }}</span>
                            <span class="ml-1 text-sm text-gray-500">{{ $measurementUnits['weight'] }}</span>
                        </div>
                    </div>
                    @endif
                    
                    @if($healthRecord->oxygen_saturation)
                    <div class="bg-gray-50 p-4 rounded-md">
                        <h4 class="text-md font-medium text-gray-700 mb-2">Oxygen Saturation</h4>
                        <div class="flex items-baseline">
                            <span class="text-2xl font-bold text-primary-600">{{ $healthRecord->oxygen_saturation }}</span>
                            <span class="ml-1 text-sm text-gray-500">{{ $measurementUnits['oxygen_saturation'] }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Attachments ({{ $files->count() }})</h3>
            </div>
            <div class="p-6">
                @if($files->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($files as $file)
                    <div class="bg-gray-50 p-3 rounded-md border border-gray-200">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-medium truncate">{{ $file->filename }}</span>
                            <form action="{{ route('health-records.files.delete', [$healthRecord, $file]) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this file?');">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="text-xs text-gray-500">
                            @if(str_contains($file->path, '.pdf'))
                                <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="text-blue-500 hover:text-blue-700">View PDF</a>
                            @elseif(str_contains($file->path, '.jpg') || str_contains($file->path, '.jpeg') || str_contains($file->path, '.png') || str_contains($file->path, '.gif'))
                                <a href="{{ asset('storage/' . $file->path) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $file->path) }}" alt="{{ $file->filename }}" class="w-full h-20 object-cover rounded mt-1">
                                </a>
                            @else
                                <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="text-blue-500 hover:text-blue-700">Download File</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-6">
                    <p class="text-gray-500">No files attached to this health record.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 