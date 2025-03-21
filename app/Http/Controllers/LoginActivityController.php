<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginActivity;
use App\Models\User;

class LoginActivityController extends Controller
{
    public function index()
    {

        $users = User::get();
        $activities  = LoginActivity::latest()->paginate(10);
        return view('login_activity', compact('activities','users'));
    }


    public function search(Request $request)
    {

        $request->validate([
        'from_date' => 'nullable|date',
        'to_date' => 'nullable|date|after_or_equal:from_date',
        'user_id' => 'nullable|exists:users,id'
        ]);
        $query = LoginActivity::with('user');
        // Filter by user_id if selected
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Apply date filters if provided
        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->to_date) {
        $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Fetch filtered data
        $activities = $query->latest()->get();

        return response()->json($activities);
    }
    
}
