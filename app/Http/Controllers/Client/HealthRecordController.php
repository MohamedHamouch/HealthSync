<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\HealthRecord;
use App\Models\HealthRecordFile;
use App\Enums\HealthRecordFileType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HealthRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = HealthRecord::where('user_id', Auth::id());
        
        // Date range filtering
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('record_date', '>=', $request->start_date);
        }
        
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('record_date', '<=', $request->end_date);
        }
        
        $healthRecords = $query->latest()->paginate(10)->withQueryString();
        
        return view('client.health-records.index', compact('healthRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $measurementUnits = HealthRecord::getMeasurementUnits();
        return view('client.health-records.create', compact('measurementUnits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'record_date' => 'required|date',
            'blood_pressure_systolic' => 'nullable|numeric',
            'blood_pressure_diastolic' => 'nullable|numeric',
            'respiration_rate' => 'nullable|numeric',
            'blood_sugar' => 'nullable|numeric',
            'pulse_rate' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'oxygen_saturation' => 'nullable|numeric',
            'files.*' => 'nullable|file|max:10240',
            'file_types.*' => 'nullable|string|in:lab_result,prescription,x_ray,mri,ct_scan,ultrasound,doctor_note,insurance,other',
        ]);

        $healthRecord = HealthRecord::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'record_date' => $request->record_date,
            'blood_pressure_systolic' => $request->blood_pressure_systolic,
            'blood_pressure_diastolic' => $request->blood_pressure_diastolic,
            'respiration_rate' => $request->respiration_rate,
            'blood_sugar' => $request->blood_sugar,
            'pulse_rate' => $request->pulse_rate,
            'temperature' => $request->temperature,
            'weight' => $request->weight,
            'oxygen_saturation' => $request->oxygen_saturation,
        ]);

        // Process files if any
        if ($request->hasFile('files')) {
            $fileTypes = $request->file_types ?? [];
            
            foreach ($request->file('files') as $index => $file) {
                // Skip if the file is invalid or empty
                if (!$file || !$file->isValid()) {
                    continue;
                }
                
                $path = $file->store('health-records/' . $healthRecord->id, 'public');
                
                // Get the file type from the request if available, otherwise use default
                $fileType = HealthRecordFileType::OTHER;
                if (isset($fileTypes[$index])) {
                    $fileType = HealthRecordFileType::from($fileTypes[$index]);
                } else {
                    $mimeType = $file->getMimeType();
                    if (str_contains($mimeType, 'image')) {
                        $fileType = HealthRecordFileType::X_RAY;
                    } elseif (str_contains($mimeType, 'pdf')) {
                        $fileType = HealthRecordFileType::DOCTOR_NOTE;
                    }
                }
                
                HealthRecordFile::create([
                    'health_record_id' => $healthRecord->id,
                    'filename' => $file->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'type' => $fileType,
                ]);
            }
        }

        return redirect()->route('health-records.index')
            ->with('success', 'Health record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HealthRecord $healthRecord)
    {
        if ($healthRecord->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to health record.');
        }
        
        $files = $healthRecord->files;
        $measurementUnits = HealthRecord::getMeasurementUnits();
        
        return view('client.health-records.show', compact('healthRecord', 'files', 'measurementUnits'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HealthRecord $healthRecord)
    {
        if ($healthRecord->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to health record.');
        }
        
        $files = $healthRecord->files;
        $measurementUnits = HealthRecord::getMeasurementUnits();
        
        return view('client.health-records.edit', compact('healthRecord', 'files', 'measurementUnits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HealthRecord $healthRecord)
    {
        if ($healthRecord->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to health record.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'record_date' => 'required|date',
            'blood_pressure_systolic' => 'nullable|numeric',
            'blood_pressure_diastolic' => 'nullable|numeric',
            'respiration_rate' => 'nullable|numeric',
            'blood_sugar' => 'nullable|numeric',
            'pulse_rate' => 'nullable|numeric',
            'temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'oxygen_saturation' => 'nullable|numeric',
            'files.*' => 'nullable|file|max:10240',
            'file_types.*' => 'nullable|string|in:lab_result,prescription,x_ray,mri,ct_scan,ultrasound,doctor_note,insurance,other',
        ]);

        $healthRecord->update([
            'title' => $request->title,
            'description' => $request->description,
            'record_date' => $request->record_date,
            'blood_pressure_systolic' => $request->blood_pressure_systolic,
            'blood_pressure_diastolic' => $request->blood_pressure_diastolic,
            'respiration_rate' => $request->respiration_rate,
            'blood_sugar' => $request->blood_sugar,
            'pulse_rate' => $request->pulse_rate,
            'temperature' => $request->temperature,
            'weight' => $request->weight,
            'oxygen_saturation' => $request->oxygen_saturation,
        ]);

        // Process new files if any
        if ($request->hasFile('files')) {
            $fileTypes = $request->file_types ?? [];
            
            foreach ($request->file('files') as $index => $file) {
                // Skip if the file is invalid or empty
                if (!$file || !$file->isValid()) {
                    continue;
                }
                
                $path = $file->store('health-records/' . $healthRecord->id, 'public');
                
                // Get the file type from the request if available, otherwise use default
                $fileType = HealthRecordFileType::OTHER;
                if (isset($fileTypes[$index])) {
                    $fileType = HealthRecordFileType::from($fileTypes[$index]);
                } else {
                    $mimeType = $file->getMimeType();
                    if (str_contains($mimeType, 'image')) {
                        $fileType = HealthRecordFileType::X_RAY;
                    } elseif (str_contains($mimeType, 'pdf')) {
                        $fileType = HealthRecordFileType::DOCTOR_NOTE;
                    }
                }
                
                HealthRecordFile::create([
                    'health_record_id' => $healthRecord->id,
                    'filename' => $file->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                    'type' => $fileType,
                ]);
            }
        }

        return redirect()->route('health-records.show', $healthRecord)
            ->with('success', 'Health record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HealthRecord $healthRecord)
    {
        if ($healthRecord->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to health record.');
        }
        
        // Delete associated files from storage
        foreach ($healthRecord->files as $file) {
            if (Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }
        }
        
        // Delete the health record (this will cascade delete files)
        $healthRecord->delete();

        return redirect()->route('health-records.index')
            ->with('success', 'Health record deleted successfully.');
    }
    
    /**
     * Delete a file from a health record
     */
    public function deleteFile(HealthRecord $healthRecord, HealthRecordFile $file)
    {
        if ($healthRecord->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to health record.');
        }
        
        if ($file->health_record_id !== $healthRecord->id) {
            abort(403, 'Unauthorized action.');
        }
        
        // Only attempt to delete the file if path exists
        if ($file->path && Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }
        
        $file->delete();
        
        return redirect()->back()->with('success', 'File deleted successfully.');
    }
} 