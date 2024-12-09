<div class="container mx-auto shadow-lg rounded-lg h-screen overflow-hidden">
    <!-- headaer -->
    <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
        <div class="font-semibold text-2xl">Bimbingan Konseling</div>
        <div class="h-12 w-12 p-2 bg-yellow-500 rounded-full text-white font-semibold flex items-center justify-center">
            RA
        </div>
    </div>
    <!-- end header -->
    <!-- Chatting -->
    <div class="flex flex-row h-full bg-white">
        <!-- chat list -->
        <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
            <!-- user list -->
            @foreach ($chats as $chat)
                <a href="{{ route('reply', $chat->fromUser->id) }}">
                    <div class="flex flex-row py-4 px-2 justify-center items-center border-b-2 cursor-pointer">
                        <div class="w-1/4">
                            <i class="bi bi-person-circle text-gray-400 text-3xl"></i>
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">Anonim</div>
                            <div class="flex flex-col">
                                <span class="text-gray-500">{{ $chat->fromUser->message->last()->message }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            <!-- end user list -->
        </div>
        <!-- end chat list -->
        <!-- message -->
        <div id="chatArea" class="overflow-y-auto flex-1 p-6 space-y-6 bg-gray-100">
            <div wire:poll>
                @foreach ($pesans as $message)
                    @if ($message->from_user_id != auth()->id())
                        <!-- Message from another user -->
                        <div class="flex justify-start mb-4">
                            <i class="bi bi-person-circle text-gray-400 text-3xl"></i>
                            <div class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                {{ $message->message }}
                            </div>
                        </div>
                    @else
                        <!-- Message from the current user -->
                        <div class="flex justify-end mb-4">
                            <div>
                                <div class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                    {{ $message->message }}
                                </div>
                            </div>
                            <i class="bi bi-person-circle text-gray-400 text-3xl"></i>
    
                        </div>
                    @endif
                @endforeach
        </div>
    
        <div style="margin-bottom: 80px;" class="bg-white w-full border-t border-gray-300 p-4 flex items-center space-x-2">
            <form wire:submit.prevent="sendMessageGuru" class="flex w-full items-center space-x-4">
                <input type="text" placeholder="Tulis pesan..." wire:model="pesan"
                    class="flex-1 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition duration-300">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                    Kirim
                </button>
            </form>
        </div>
    </div>
    <!-- Input Area -->
</div>