<div class="container mx-auto shadow-lg rounded-lg">
    <!-- headaer -->
    <div class="px-5 py-5 flex justify-between items-center bg-white border-b-2">
        <div class="font-semibold text-2xl">Bimbingan Konseling</div>
        <div class="h-12 w-12 p-2 bg-yellow-500 rounded-full text-white font-semibold flex items-center justify-center">
            RA
        </div>
    </div>
    <!-- end header -->
    <!-- Chatting -->
    <div class="flex flex-row justify-between bg-white">
        <!-- chat list -->
        <div class="flex flex-col w-2/5 border-r-2 overflow-y-auto">
            <!-- user list -->
            @foreach ($chats as $chat)
                <a href="{{route('reply', $chat->fromUser->id)}}">
                    <div class="flex flex-row py-4 px-2 justify-center items-center border-b-2 cursor-pointer">
                        <div class="w-1/4">
                            <i class="bi bi-person-circle text-gray-400 text-3xl"></i>
                        </div>
                        <div class="w-full">
                            <div class="text-lg font-semibold">Anonim</div>
                            <div class="flex flex-col">
                                <span class="text-gray-500">{{$chat->fromUser->message->last()->message}} </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            <!-- end user list -->
        </div>

        <!-- end chat list -->
        <!-- message -->
        <div class="w-full px-5 flex flex-col justify-between">
            <div style="height: 100vh" class="bg-gray-200   flex flex-col justify-center items-center">
                <div class="text-center">
                    <i class="bi bi-incognito text-8xl text-gray-500"></i>
                    <h1 class="text-2xl font-bold">Anonymous Chat</h1>
                    <p class="text-gray-500">Bimbingan Konseling Ini Bersifat Anonim, demi kenyamanan dan keterbukaan siswa</p>
                </div>
            </div>
        </div>
    </div>
</div>

