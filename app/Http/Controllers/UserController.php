<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // It will display Register form
    public function showRegister(){
        return view('account.register');
    }

    public function showLogin(){
        return view('account.login');
    }

    public function showProfile(){
        $user = User::findOrFail(Auth::user()->id);
        return view('account.profile', compact('user'));
    }

    public function saveRegister(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);

        if($user){
            return redirect()->route('account.login')->with('message', 'User created successfully!');
        }
    }

    public function saveLogin(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            return redirect()->route('account.profile');
        }else{
            return redirect()->route('account.login')->with('error', 'Either Email Or Password is Incorrect!');
        }

    }

    public function logout(Request $req){
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function updateProfile(Request $req){
        $user = User::findOrFail(Auth::user()->id);
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'image' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        if ($req->has('image')) {
            $file = $req->file('image');
            $ext = $req->image->extension();
            $fileName = time() . '.' . $ext;
            $path = public_path('images/user');
            $file->move($path, $fileName);

            $path = public_path('images/') . $user->image;

            if (file_exists($path)) {
                @unlink($path);
            }
        }

        $user->update([
            'name' => $req->name,
            'email' => $req->email,
            'image' => $req->has('image') ? $fileName : $user->image
        ]);


        return redirect()->route('account.profile')->with('message', 'User Updated Successfully!');
    }

}
