<div class="h-screen flex flex-col bg-gray-50">
    <!-- Header -->
    <div class="bg-gray-800 text-white px-8 py-5 shadow-lg flex justify-between items-center">
        <div class="">
            <h1 class="text-2xl font-semibold tracking-wide">
                <i class="bi bi-incognito mr-2"></i>
                <span class="hidden sm:inline">Anonymous Chat</span> 
            </h1>
            <p class="text-sm sm:text-base">Bimbingan Konseling Ini Bersifat Anonim</p>
        </div>
    </div>

    <!-- Chat Area -->
    <div id="chatArea" class="overflow-y-auto flex-1 p-6 space-y-6 bg-gray-100">
        <div wire:poll>
            @foreach ($messages as $message)
                @if ($message->from_user_id != auth()->id())
                    <!-- Message from another user -->
                    <div class="flex justify-start mb-4">
                        <i class="bi bi-person-circle text-gray-400 text-3xl"></i>
                        <div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                            {{ $message->message }}
                            <div class="text-xs text-white-500">
                                {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Message from the current user -->
                    <div class="flex justify-end mb-4">
                        <div>
                            <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                {{ $message->message }}
                                <div class="text-white-500 text-sm text-right">
                                    {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        <i class="bi bi-person-circle text-gray-400 text-3xl"></i>

                    </div>
                @endif
            @endforeach
    </div>

    <!-- Input Area -->
    <div class="bg-white border-t border-gray-300 p-5 flex items-center space-x-4">
        <form wire:submit.prevent="sendMessage" class="flex w-full items-center space-x-4">
            <div class="flex-1 relative">
                <input type="text" placeholder="Tulis pesan..." wire:model="message"
                    class="w-full px-5 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition duration-300">
                <span class="absolute right-0 top-0 h-full flex items-center px-3 text-gray-400">
                    <i class="bi bi-chat-left-text"></i>
                </span>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-5 py-3 rounded-md hover:bg-blue-700 transition duration-300">
                <i class="bi bi-send"></i>
            </button>
        </form>
    </div>
</div>

<!-- Add this script to automatically scroll to the bottom -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatArea = document.getElementById('chatArea');
        chatArea.scrollTop = chatArea.scrollHeight;
    });

    Livewire.on('messageSent', () => {
        const chatArea = document.getElementById('chatArea');
        chatArea.scrollTop = chatArea.scrollHeight;
    });
</script> 
