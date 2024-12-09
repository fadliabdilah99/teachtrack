<?php

namespace App\Livewire;

use App\Models\message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guru')]

class ReplyGuru extends Component
{

    public User $user;
    public string $pesan = '';


    public function render()
    {
        return view(
            'livewire.reply-guru',
            [
                // Pesan hanya antara pengguna login dan pengguna target
                'pesans' => Message::where(function ($query) {
                    $query->where('from_user_id', Auth::user()->id)
                        ->where('to_user_id', $this->user->id);
                })
                    ->orWhere(function ($query) {
                        $query->where('from_user_id', $this->user->id)
                            ->where('to_user_id', Auth::user()->id);
                    })
                    ->orderBy('created_at', 'asc') // Urutkan pesan berdasarkan waktu
                    ->get(),
                'chats' => message::select('from_user_id')->distinct()->where('from_user_id', '!=', Auth::user()->id)->with('fromUser')->get(),
            ]
        );


        
    }

    public function sendMessageGuru()
    {
        message::create([
            'from_user_id' => Auth::user()->id,
            'to_user_id' => $this->user->id,
            'message' => $this->pesan,
        ]);
    
        $this->pesan = '';
        $this->reset('pesan'); // Reset properti Livewire
    
    }
    
}
