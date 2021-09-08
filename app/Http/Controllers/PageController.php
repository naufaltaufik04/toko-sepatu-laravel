<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Models\ShoeDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/home');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            return redirect('/home');
        } else {
            Session::flash('error', 'Email atau password salah');
            return redirect('login');
        }
    }

    public function home()
    {

        return view('home', [
            'title' => 'Home',
            'shoes' => Shoe::with('shoeDetails')->get()
        ]);
    }

    public function details($type)
    {
        $details = explode('&', $type);
        $shoe_id = $details[0];
        $color = $details[1];
        $size = $details[2];

        return view('details', [
            'title' => 'Details',
            'shoeDetails' => ShoeDetails::with('shoe')
                ->where('shoe_id', $shoe_id)
                ->where('color', $color)
                ->where('size', $size)
                ->first(),
            'listOfColor' => ShoeDetails::select('color')
                ->distinct()
                ->where('shoe_id', $shoe_id)
                ->where('size', $size)
                ->get(),
            'listOfSize' => ShoeDetails::select('size')
                ->distinct()
                ->where('shoe_id', $shoe_id)
                ->where('color', $color)
                ->get()
        ]);
    }

    public function register()
    {
        return view('register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
