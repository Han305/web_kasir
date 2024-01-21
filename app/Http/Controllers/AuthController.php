<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login_process(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $password = bcrypt($request->password);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = User::where('username', $request->username)->first();
            if ($user->category === 'admin') {
                return redirect(route('admin.index'));
            } else {
                return redirect(route('index'));
            }
        }
        return redirect()->back()->withErrors([
            'message' => 'username atau Password salah!',
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect(route('login'));
    }
}
