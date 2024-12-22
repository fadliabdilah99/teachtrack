<div class="h-screen flex flex-col bg-gray-50">
    <!-- Header -->
    <header class="bg-gray-800 text-white px-8 py-4 shadow-md">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="hidden sm:inline">{{ Auth::user()->rombel->kelas . ' ' . Auth::user()->rombel->jurusan->jurusan . ' ' . Auth::user()->rombel->jurusan->no }}</span>
                </h1>
                <p class="text-sm text-gray-400 sm:text-base mt-1">
                    @foreach (Auth::user()->where('rombel_id', Auth::user()->rombel_id)->get() as $get)
                        {{ $get->name }},
                    @endforeach
                </p>
            </div>
        </div>
    </header>

    <!-- Chat Area -->
    <main id="chatArea" class="flex-1 overflow-y-auto p-6 bg-gray-100 space-y-6">
        <div wire:poll>
            @foreach ($messages as $message)
                @if ($message->from_user_id != auth()->id())
                    <!-- Message from another user -->
                    <div class="flex justify-start mb-4">
                        <img 
                            @if ($message->fromUser->fotoProfile == null) 
                                src="https://via.placeholder.com/40" 
                            @else 
                                src="{{ asset('file/profile/' . $message->fromUser->fotoProfile) }}" 
                            @endif
                            alt="User Avatar" class="w-10 h-10 rounded-full mr-3">
                        <div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                            <div class="text-sm text-green-200 font-semibold">{{ $message->fromUser->name }}</div>
                            {{ $message->message }}
                            <div class="text-xs text-gray-200 mt-1">
                                {{ $message->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Message from the current user -->
                    <div class="flex justify-end mb-4">
                        <div class="mr-2 text-right py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                            <div class="text-sm font-semibold">You</div>
                            {{ $message->message }}
                            <div class="text-xs text-gray-200 mt-1">
                                {{ $message->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <img 
                            @if ($message->fromUser->fotoProfile == null) 
                                src="https://via.placeholder.com/40" 
                            @else 
                                src="{{ asset('file/profile/' . $message->fromUser->fotoProfile) }}" 
                            @endif
                            alt="User Avatar" class="w-10 h-10 rounded-full ml-3">
                    </div>
                @endif
            @endforeach
        </div>
    </main>

    <!-- Input Area -->
    <footer class="bg-white border-t border-gray-300 p-4">
        <form wire:submit.prevent="sendMessage" class="flex items-center space-x-4">
            <div class="flex-1 relative">
                <input 
                    type="text" 
                    placeholder="Tulis pesan..." 
                    wire:model="message" 
                    class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition duration-300">
                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <i class="bi bi-chat-left-text"></i>
                </span>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                <i class="bi bi-send"></i>
            </button>
        </form>
    </footer>
</div>


<!-- Add this script to automatically scroll to the bottom -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatArea = document.getElementById('chatArea');
        chatArea.scrollTop = chatArea.scrollHeight;
    });

    Livewire.on('messageSent', () => {
        const chatArea = document.getElementById('chatArea');
        chatArea.scrollTop = chatArea.scrollHeight;
    });
</script>
