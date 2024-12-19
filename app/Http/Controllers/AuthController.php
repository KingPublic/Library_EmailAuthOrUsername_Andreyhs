<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
    
class AuthController extends Controller
    {
        // Menampilkan halaman login
        public function showLoginForm()
        {
            return view('dashboard');
        }

        public function dashboard()
        {
            return view('dashboard');
        }

        
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'email_or_username' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // Mencari user berdasarkan email atau username
        $user = User::where('email', $validated['email_or_username'])
                    ->orWhere('username', $validated['email_or_username'])
                    ->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            // Jika user ditemukan dan password cocok
            Auth::login($user);

            // Periksa peran pengguna dan arahkan ke controller yang sesuai
            if ($user->role == 'admin') {
                return redirect()->action([AdminController::class, 'index']);
            } elseif ($user->role == 'librarian') {
                return redirect()->action([LibrarianController::class, 'index']);
            } else {
                // Jika peran tidak dikenali, arahkan ke halaman default
                return redirect()->route('dashboard');
            }
        } else {
            // Jika login gagal, beri pesan error dan redirect kembali
            return back()->withErrors(['email_or_username' => 'Invalid credentials.'])->withInput();
        }
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
    

    
