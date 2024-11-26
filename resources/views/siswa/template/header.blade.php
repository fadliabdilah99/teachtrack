<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 rounded-xl left-0 with-vertical h-screen z-[999] shrink-0 w-[270px] shadow-md rounded bg-white left-sidebar transition-all duration-300">
    <!-- Profile Section -->
    <div class="flex flex-col items-center py-6 px-4 rounded-xl bg-gray-200">
        <!-- Profile Image -->
        <div class="w-24 h-24 bg-white rounded-full overflow-hidden border-4 border-green-500 mb-2">
            <img src="https://via.placeholder.com/96" alt="User Avatar" class="w-full h-full object-cover">
        </div>
        <!-- Profile Name and Experience -->
        <h4 class="text-lg font-bold text-center text-gray-800">{{Auth::user()->role}}</h4>
        <p class="text-center font-semibold text-lg">{{Auth::user()->name}}</p>
        <div class="flex items-center mt-2 text-pink-500 font-semibold">
            <i class="ti ti-flame mr-1"></i> 198 Exp
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-6">
        <ul class="text-gray-600 text-sm space-y-4 px-4">
            <!-- sosmed Link -->
            <li>
                <a href="{{url('siswa')}}" class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                    <i class="ti ti-world text-2xl"></i> Sosial Media
                </a>
            </li>
            <!-- Profile Link -->
            <li>
                <a href="{{url('profile')}}" class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                    <i class="ti ti-user text-2xl"></i> Profil Saya
                </a>
            </li>
            <!-- kelas Link -->
            <li>
                <a href="{{route('kelas')}}" class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                    <i class="ti ti-book text-2xl"></i> Kelas Saya
                </a>
            </li>
            <!-- Thread Link -->
            <li>
                <a href="#" class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                    <i class="ti ti-comments text-2xl"></i> Thread Saya
                </a>
            </li>
            <!-- Bookmark Link -->
            <li>
                <a href="#" class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                    <i class="ti ti-bookmark text-2xl"></i> Bookmark Saya
                </a>
            </li>
            <!-- Question Link -->
            <li>
                <a href="#" class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                    <i class="ti ti-question text-2xl"></i> Pertanyaan Saya
                </a>
            </li>
        </ul>
    </nav>

    <!-- Bottom Buttons -->
    <div class="mt-8 px-4">
        <button class="w-full py-2.5 bg-blue-500 text-white rounded-md font-semibold hover:bg-blue-600 transition">
            Gabung Komunitas
        </button>
        <button
            class="w-full mt-4 py-2.5 bg-gray-200 text-gray-600 rounded-md font-semibold hover:bg-gray-300 transition">
            Butuh Bantuan?
        </button>
    </div>
</aside>
