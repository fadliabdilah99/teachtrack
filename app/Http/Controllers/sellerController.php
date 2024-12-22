<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sellerController extends Controller
{
    public function index()
    {
        return view('seller.home.index');
    }

    public function keuangan()
    {
        return view('seller.keuangan.index');
    }

    public function profile()
    {
        return view('seller.profile.index');
    }

    public function produk()
    {
        return view('seller.produk.index');
    }
}
