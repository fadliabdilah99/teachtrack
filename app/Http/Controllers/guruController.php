<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class guruController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'NoUnik' => 'required',
        ]);


        User::create(
            [
                'name' => $request->name,
                'rombel_id' => $request->rombel,
                'NoUnik' => $request->NoUnik,
                'role' => 'guru',
                'password' => Hash::make('*' . $request->NoUnik),
                'email' => $request->NoUnik . '@gmail.com',
            ]
        );
    }
}
