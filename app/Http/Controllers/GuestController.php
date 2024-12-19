<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Guest;

class GuestController extends Controller
{
    public function showGuestLoginForm()
    {
        return view('guest_login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_card' => 'required|image|max:2048',
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:6|max:12|unique:guests',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $guest = new Guest();
        $guest->id_card = $request->file('id_card')->store('id_cards', 'public');
        $guest->name = $request->name;
        $guest->username = $request->username;
        $guest->password = Hash::make($request->password);
        $guest->created_at = now();
        $guest->valid_until = now()->addDays(3);
        $guest->save();

        return redirect()->route('guest.dashboard');
    }


    public function viewResources()
    {
        // Fetch and display books, journals, CDs, and newspapers
    }

    public function showGuestDashboard()
    {
        return view('guest_dashboard');  // Pastikan ada file guest_dashboard.blade.php di resources/views
    }

    public function makeReservation(Request $request)
    {
        // Logic for guest reservation (less than 3 days)
    }
}
