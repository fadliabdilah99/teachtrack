<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siswaController extends Controller
{
    public function index()
    {
        return view('siswa.home.index');
    }
}
