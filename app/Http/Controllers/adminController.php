<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        $data['pemohon'] = User::where('role', 'pengajuan')->with('seller')->get();
        return view('admin.home.index')->with($data);
    }
}