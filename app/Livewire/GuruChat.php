<?php

namespace App\Livewire;

use App\Models\message;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guru')]
class GuruChat extends Component
{
    public function render()
    {
        $data['chats'] = message::select('from_user_id')->distinct()->where('from_user_id', '!=', FacadesAuth::user()->id)->with('fromUser')->get();
        return view('livewire.chat.guru-chat')->with($data);
    }

    
}
