<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
    
class AuthController extends Controller
    {
        // Menampilkan halaman login
        public function showLoginForm()
        {
            return view('auth.login');
        }
    
        // Menangani proses login
        public function login(Request $request)
        {
            // Validasi input
            $request->validate([
                'email_or_username' => 'required',  // sesuaikan dengan nama input form
                'password' => 'required',
            ]);
        
            $name = $request->input('email_or_username');  // ambil inputan dengan nama 'email_or_username'
            $password = $request->input('password');
        
            // Cari pengguna berdasarkan email atau username
            $user = User::where('email', $name)
                        ->orWhere('username', $name)
                        ->first();
        
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }
        
            // Periksa apakah email pengguna sudah diverifikasi
            // if (!$user->hasVerifiedEmail()) {
            //     return redirect()->back()->with('error', 'Please verify your email before logging in.');
            // }
        
            // Verifikasi password
            if (Hash::check($password, $user->password)) {
                // Simpan data pengguna ke session
                session([
                    'user' => [
                        'name' => $user->name,
                        'role' => $user->role,
                    ]
                ]);
        
                // Arahkan berdasarkan role
                return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'librarian.dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid username, email, or password');
            }
        }
        

        

    
        // Menangani proses logout
        public function logout()
        {
            // Hapus session user
            session()->forget('user');
            return redirect()->route('login')->with('success', 'Logged out successfully');
        }
    }
    

    
