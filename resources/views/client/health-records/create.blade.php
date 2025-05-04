@extends('layouts.app')

@section('title', 'Add Health Record - HealthSync')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="flex items-center mb-6">
            <a href="{{ route('health-records.index') }}" class="mr-2 text-gray-600 hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Add New Health Record</h1>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <form action="{{ route('health-records.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500" required>
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                                <textarea id="description" name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="record_date" class="block text-sm font-medium text-gray-700 mb-1">Record Date <span class="text-red-500">*</span></label>
                                <input type="date" id="record_date" name="record_date" value="{{ old('record_date', now()->format('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500" required>
                                @error('record_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Health Measurements</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="blood_pressure_systolic" class="block text-sm font-medium text-gray-700 mb-1">Blood Pressure (Systolic)</label>
                                <div class="flex items-center">
                                    <input type="number" step="0.01" id="blood_pressure_systolic" name="blood_pressure_systolic" value="{{ old('blood_pressure_systolic') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                    <span class="ml-2 text-sm text-gray-500">{{ $measurementUnits['blood_pressure_systolic'] }}</span>
                                </div>
                                @error('blood_pressure_systolic')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="blood_pressure_diastolic" class="block text-sm font-medium text-gray-700 mb-1">Blood Pressure (Diastolic)</label>
                                <div class="flex items-center">
                                    <input type="number" step="0.01" id="blood_pressure_diastolic" name="blood_pressure_diastolic" value="{{ old('blood_pressure_diastolic') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                    <span class="ml-2 text-sm text-gray-500">{{ $measurementUnits['blood_pressure_diastolic'] }}</span>
                                </div>
                                @error('blood_pressure_diastolic')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="pulse_rate" class="block text-sm font-medium text-gray-700 mb-1">Pulse Rate</label>
                                <div class="flex items-center">
                                    <input type="number" step="0.01" id="pulse_rate" name="pulse_rate" value="{{ old('pulse_rate') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                    <span class="ml-2 text-sm text-gray-500">{{ $measurementUnits['pulse_rate'] }}</span>
                                </div>
                                @error('pulse_rate')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="temperature" class="block text-sm font-medium text-gray-700 mb-1">Temperature</label>
                                <div class="flex items-center">
                                    <input type="number" step="0.01" id="temperature" name="temperature" value="{{ old('temperature') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                    <span class="ml-2 text-sm text-gray-500">{{ $measurementUnits['temperature'] }}</span>
                                </div>
                                @error('temperature')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="respiration_rate" class="block text-sm font-medium text-gray-700 mb-1">Respiration Rate</label>
                                <div class="flex items-center">
                                    <input type="number" step="0.01" id="respiration_rate" name="respiration_rate" value="{{ old('respiration_rate') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                    <span class="ml-2 text-sm text-gray-500">{{ $measurementUnits['respiration_rate'] }}</span>
                                </div>
                                @error('respiration_rate')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="blood_sugar" class="block text-sm font-medium text-gray-700 mb-1">Blood Sugar</label>
                                <div class="flex items-center">
                                    <input type="number" step="0.01" id="blood_sugar" name="blood_sugar" value="{{ old('blood_sugar') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                    <span class="ml-2 text-sm text-gray-500">{{ $measurementUnits['blood_sugar'] }}</span>
                                </div>
                                @error('blood_sugar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                                <div class="flex items-center">
                                    <input type="number" step="0.01" id="weight" name="weight" value="{{ old('weight') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                    <span class="ml-2 text-sm text-gray-500">{{ $measurementUnits['weight'] }}</span>
                                </div>
                                @error('weight')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="oxygen_saturation" class="block text-sm font-medium text-gray-700 mb-1">Oxygen Saturation</label>
                                <div class="flex items-center">
                                    <input type="number" step="0.01" id="oxygen_saturation" name="oxygen_saturation" value="{{ old('oxygen_saturation') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                    <span class="ml-2 text-sm text-gray-500">{{ $measurementUnits['oxygen_saturation'] }}</span>
                                </div>
                                @error('oxygen_saturation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Attachments</h3>
                        <div id="file-inputs-container">
                            <div class="file-input-group mb-3">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center gap-2">
                                        <input type="file" name="files[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                        <button type="button" class="remove-file-btn bg-red-500 hover:bg-red-600 text-white p-2 rounded-md hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">File Type</label>
                                        <select name="file_types[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                            <option value="lab_result">Lab Result</option>
                                            <option value="prescription">Prescription</option>
                                            <option value="x_ray">X-Ray</option>
                                            <option value="mri">MRI</option>
                                            <option value="ct_scan">CT Scan</option>
                                            <option value="ultrasound">Ultrasound</option>
                                            <option value="doctor_note">Doctor Note</option>
                                            <option value="insurance">Insurance</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-2">
                            <button type="button" id="add-file-btn" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow transition inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Another File
                            </button>
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-500">You can upload multiple files (images, PDFs, etc.)</p>
                        @error('files.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white py-2 px-4 rounded-md shadow transition">
                            Save Health Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('file-inputs-container');
        const addButton = document.getElementById('add-file-btn');
        const form = document.querySelector('form');
        
        // Fix for form submission
        form.addEventListener('submit', function(e) {
            // Force form submission regardless of any prevented events
            this.submit();
        });
        
        // Function to update the remove buttons visibility
        function updateRemoveButtons() {
            const groups = container.querySelectorAll('.file-input-group');
            groups.forEach(group => {
                const removeBtn = group.querySelector('.remove-file-btn');
                if (groups.length > 1) {
                    removeBtn.classList.remove('hidden');
                } else {
                    removeBtn.classList.add('hidden');
                }
            });
        }
        
        // Add new file input
        addButton.addEventListener('click', function() {
            const newGroup = document.createElement('div');
            newGroup.className = 'file-input-group mb-3';
            newGroup.innerHTML = `
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <input type="file" name="files[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                        <button type="button" class="remove-file-btn bg-red-500 hover:bg-red-600 text-white p-2 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">File Type</label>
                        <select name="file_types[]" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                            <option value="lab_result">Lab Result</option>
                            <option value="prescription">Prescription</option>
                            <option value="x_ray">X-Ray</option>
                            <option value="mri">MRI</option>
                            <option value="ct_scan">CT Scan</option>
                            <option value="ultrasound">Ultrasound</option>
                            <option value="doctor_note">Doctor Note</option>
                            <option value="insurance">Insurance</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            `;
            
            container.appendChild(newGroup);
            updateRemoveButtons();
            
            // Add event listener to the new remove button
            newGroup.querySelector('.remove-file-btn').addEventListener('click', function() {
                newGroup.remove();
                updateRemoveButtons();
            });
        });
        
        // Initial setup for existing remove buttons
        document.querySelectorAll('.remove-file-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.file-input-group').remove();
                updateRemoveButtons();
            });
        });
        
        updateRemoveButtons();
    });
</script>
@endpush
@endsection 