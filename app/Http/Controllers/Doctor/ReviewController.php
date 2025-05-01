<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the doctor's reviews.
     */
    public function index()
    {
        $doctorId = Auth::id();
        
        // Get all reviews for the doctor's appointments
        $reviews = Review::with(['appointment.client'])
            ->whereHas('appointment', function ($query) use ($doctorId) {
                $query->where('doctor_id', $doctorId);
            })
            ->latest()
            ->paginate(10);
        
        // Calculate statistics
        $allReviews = Review::whereHas('appointment', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })->get();
        
        $totalReviews = $allReviews->count();
        $averageRating = $totalReviews > 0 ? $allReviews->avg('rating') : 0;
        $fiveStarReviews = $allReviews->where('rating', 5)->count();
        
        // Count ratings by star
        $ratingCounts = [
            1 => $allReviews->where('rating', 1)->count(),
            2 => $allReviews->where('rating', 2)->count(),
            3 => $allReviews->where('rating', 3)->count(),
            4 => $allReviews->where('rating', 4)->count(),
            5 => $allReviews->where('rating', 5)->count(),
        ];
        
        return view('doctor.reviews.index', compact(
            'reviews', 
            'totalReviews', 
            'averageRating', 
            'fiveStarReviews', 
            'ratingCounts'
        ));
    }
} 