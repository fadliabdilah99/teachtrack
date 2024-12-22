<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mailController extends Controller
{
    public function mailSiswa(){
        notification::where('user_id', Auth::user()->id)->update(['status' => 'read']);
        return view('siswa.mail.index');
    }
}
