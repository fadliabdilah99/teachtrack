<?php

namespace App\Livewire;


use App\Models\message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('components.layouts.siswa')]
class ChatKelas extends Component
{
    public string $message = '';


    public function render()
    {
        // Ambil semua anggota grup berdasarkan rombel pengguna
        $rombel = User::where('rombel_id', Auth::user()->rombel_id)->pluck('id');

        return view(
            'livewire.chat.chat-kelas',
            [
                'messages' => Message::where(function ($query) use ($rombel) {
                    $query->whereIn('from_user_id', $rombel) // Pesan yang dikirim oleh anggota grup
                        ->whereNull('to_user_id')          // Hanya pesan grup
                        ->where('group_id', Auth::user()->rombel_id); // Grup spesifik
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
            'group_id' => Auth::user()->rombel_id,
            'message' => $this->message,
        ]);

        $this->reset('message');
    }
}
