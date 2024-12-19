<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class GuestLoginController extends Controller
{
    public function showGuestForm()
    {
        return view('auth.guest-login'); // Pastikan Anda membuat view ini
    }

    public function loginGuest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:6|max:12',
            'id_card' => 'required|image|mimes:jpeg,png,jpg',
            'password' => 'required|min:6',
        ]);

        // Simpan data tamu
        $path = $request->file('id_card')->store('guest_ids', 'public');
        $guest = Guest::create([
            'id_card' => $path,
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'valid_until' => Carbon::now()->addDays(3),
        ]);

        Auth::login($guest);

        return redirect()->route('home')->with('success', 'Anda login sebagai tamu.');
    }
}
