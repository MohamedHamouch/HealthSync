<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\UserRole;

class UserController extends Controller
{
    /**
     * Display a listing of active users.
     */
    public function index(Request $request)
    {
        $query = User::where('is_suspended', false);
        
        // Search by name if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Filter by role if provided
        if ($request->has('role') && $request->role != 'all') {
            $query->where('role', $request->role);
        }
        
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        $roles = UserRole::cases();
        
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Display a listing of suspended users.
     */
    public function suspended(Request $request)
    {
        $query = User::where('is_suspended', true);
        
        // Search by name if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Filter by role if provided
        if ($request->has('role') && $request->role != 'all') {
            $query->where('role', $request->role);
        }
        
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        $roles = UserRole::cases();
        
        return view('admin.users.suspended', compact('users', 'roles'));
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Suspend a user.
     */
    public function suspend(User $user)
    {
        $user->is_suspended = true;
        $user->save();
        
        return redirect()->back()->with('success', 'User has been suspended successfully.');
    }

    /**
     * Unsuspend a user.
     */
    public function unsuspend(User $user)
    {
        $user->is_suspended = false;
        $user->save();
        
        return redirect()->back()->with('success', 'User has been unsuspended successfully.');
    }

    /**
     * Display a listing of inactive doctors.
     */
    public function inactiveDoctors(Request $request)
    {
        $query = User::where('role', UserRole::DOCTOR->value)
                    ->where('is_active', false)
                    ->where('is_suspended', false);
        
        // Search by name if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
                    
        $users = $query->orderBy('created_at', 'desc')
                    ->paginate(10);
        
        return view('admin.users.inactive-doctors', compact('users'));
    }
    
    /**
     * Activate a doctor.
     */
    public function activateDoctor(User $user)
    {
        if ($user->role !== UserRole::DOCTOR) {
            return redirect()->back()->with('error', 'Only doctors can be activated.');
        }
        
        $user->is_active = true;
        $user->save();
        
        return redirect()->back()->with('success', 'Doctor has been activated successfully.');
    }
} 