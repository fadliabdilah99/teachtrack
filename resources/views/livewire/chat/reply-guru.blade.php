<div class="h-screen flex flex-col">
    <!-- Wrapper untuk keseluruhan komponen -->
    <div class="container mx-auto shadow-lg rounded-lg h-full flex flex-col overflow-hidden">
        <!-- Header -->
        <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
            <div class="font-semibold text-2xl">Bimbingan Konseling</div>
            <div
                class="h-12 w-12 p-2 bg-yellow-500 rounded-full text-white font-semibold flex items-center justify-center">
                RA
            </div>
        </div>

        <!-- Body -->
        <div class="flex flex-1 bg-white">
            <!-- Sidebar Chat List -->
            <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
                @foreach ($chats as $chat)
                    <a href="{{ route('reply', $chat->fromUser->id) }}"
                        class="hover:bg-gray-100 transition cursor-pointer">
                        <div class="flex flex-row py-4 px-2 items-center border-b-2">
                            <div class="w-1/4">
                                <i class="bi bi-person-circle text-gray-400 text-3xl"></i>
                            </div>
                            <div class="w-full">
                                <div class="text-lg font-semibold">Anonim</div>
                                <div class="text-gray-500 text-sm truncate">
                                    {{ $chat->fromUser->message->last()->message }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Chat Area -->
            <div id="chatArea" class="flex-1 p-6 bg-gray-100 overflow-y-auto">
                <div wire:poll>
                    @foreach ($pesans as $message)
                        @if ($message->from_user_id != auth()->id())
                            <!-- Incoming Message -->
                            <div class="flex justify-start mb-4">
                                <i class="bi bi-person-circle text-gray-400 text-3xl"></i>
                                <div
                                    class="ml-2 py-3 px-4 bg-gray-400 text-white rounded-tr-3xl rounded-br-3xl rounded-tl-xl">
                                    {{ $message->message }}
                                </div>
                            </div>
                        @else
                            <!-- Outgoing Message -->
                            <div class="flex justify-end mb-4">
                                <div
                                    class="mr-2 py-3 px-4 bg-blue-400 text-white rounded-tl-3xl rounded-bl-3xl rounded-tr-xl">
                                    {{ $message->message }}
                                </div>
                                <i class="bi bi-person-circle text-gray-400 text-3xl"></i>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Fixed Form -->
        {{-- <div class="bg-white border-t border-gray-300 fixed bottom-0 left-0 w-full p-4 flex items-center space-x-2">
            <form wire:submit.prevent="sendMessageGuru" class="flex w-full items-center space-x-4">
                <input type="text" placeholder="Tulis pesan..." wire:model="pesan"
                    class="flex-1 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition duration-300">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                    Kirim
                </button>
            </form>
        </div> --}}
        <!-- Input Area -->
        <footer class="bg-white border-t border-gray-300 p-4">
            <form wire:submit.prevent="sendMessageGuru" class="flex items-center space-x-4">
                <input type="text" placeholder="Tulis pesan..." wire:model="pesan"
                    class="flex-1 px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition duration-300">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                    Kirim
                </button>
            </form>
        </footer>
    </div>

</div>
