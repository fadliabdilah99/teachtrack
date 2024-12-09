<?php

namespace App\Livewire;

use App\Models\message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public User $user;
    public string $message = '';

    public function render()
    {
        return view(
            'livewire.chat',
            [
                'messages' => Message::where(function ($query) {
                    $query->where('from_user_id', Auth::user()->id)
                        ->where('to_user_id', $this->user->id);
                })
                    ->orWhere(function ($query) {
                        $query->where('from_user_id', $this->user->id)
                            ->where('to_user_id', Auth::user()->id);
                    })
                    ->orderBy('created_at', 'asc') // Urutkan pesan berdasarkan waktu
                    ->get(),
            ]
        );
    }

    public function sendMessage()
    {
        message::create([
            'from_user_id' => Auth::user()->id,
            'to_user_id' => $this->user->id,
            'message' => $this->message,
        ]);

        $this->reset('message');
    }
}
