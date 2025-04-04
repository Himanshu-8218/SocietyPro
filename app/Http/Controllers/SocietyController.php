<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\AdminNotifiaction;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocietyController extends Controller
{
    public function index()
    {
        $notices = Notification::orderBy('created_at', 'desc')->get();
        return view('notices.index', compact('notices'));
    }

    public function create()
    {
        return view('notices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $notice = Notification::create([
            'user' => Auth::user()->name,
            'title' => $request->title,
            'data' => $request->content,
        ]);

        // Notify all residents
        $residents = User::where('usertype', 'Resident')->get();
        foreach ($residents as $resident) {
            $resident->notify(new AdminNotifiaction($notice));
        }

        return redirect()->route('admin/notices')->with('success', 'Notice posted successfully.');
    }

    public function notify()
    {
        $user = Auth::user();
        if ($user->usertype === "Resident") {
            $user->notify(new AdminNotifiaction($user));
        }
    }
}
