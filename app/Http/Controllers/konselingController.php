<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;

class konselingController extends Controller
{
    public function index()
    {
        $data['chats'] = message::select('from_user_id')->distinct()->with('fromUser')->get();
        return view('guru.konseling.index')->with($data);
    }
}   
