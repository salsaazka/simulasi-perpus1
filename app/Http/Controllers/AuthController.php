<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('Auth.sign-in');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ],
        [
            'username.exists' => "Username ini tidak tersedia"
        ]);

        $user = $request->only('username', 'password');
        if (Auth::attempt($user)) {
            return redirect()->route('dashboard.dashboard');
        } else {
            return redirect('/sign-in')->with('fail', 'Gagal login, silahkan periksa dan coba lagi!');
        }
    }
    public function signUp()
    {
        return view('Auth.sign-up');
    }

    public function register(Request $request)
    {
        $request->validate = ([
            'name' => 'required|min:3|max:50',
            'username' => 'required|min:3|max:10',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => 'user',
            'password' => Hash::make($request->password),
            'address' => $request->address,
        ]);
        return redirect('/sign-in')->with('success', 'Selamat, anda berhasil membuat akun!');
    }

    public function dashboard()
    {
        $dataOffice = User::where('role', 'officer')->get();
        $dataBook = Book::all();
        return view('dashboard', compact('dataOffice', 'dataBook'));
    }
    public function officer()
    {
        return view('admin.create-officer');
    }
    public function createOfficer(Request $request)
    {
        $request->validate = ([
            'name' => 'required|min:3|max:50',
            'username' => 'required|min:3|max:10',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => 'officer',
            'password' => Hash::make($request->password),
            'address' => $request->address,
        ]);
        return redirect('/dashboard')->with('success', 'Selamat, anda berhasil membuat akun!');
    }

    public function deleteOfficer($id)
    { 
        //
        User::where('id', $id)->delete();
        return redirect('/dashboard')->with('delete', 'Data buku berhasil dihapus');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
