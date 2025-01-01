<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pesananController extends Controller
{
    public function addcart($id){


        cart::create([
           'user_id' => Auth::user()->id,
           'produk_id' => $id,
        ]);
    }
}
