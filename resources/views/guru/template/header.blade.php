<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0 w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar transition-all duration-300">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="p-4">
        <a href="../" class="text-nowrap">
            <img src="{{ asset('assets/images/logos/logo-light.svg') }}" alt="Logo-Dark" />
        </a>
    </div>
    <div class="scroll-sidebar" data-simplebar="">
        <nav class="w-full flex flex-col sidebar-nav px-4 mt-5">
            <ul id="sidebarnav" class="text-gray-600 text-sm">
                <li class="text-xs font-bold pb-[5px]">
                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                    <span class="text-xs text-gray-400 font-semibold">HOME</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('guru') }}"> <i class="ti ti-layout-dashboard ps-2 text-2xl"></i>
                        <span>Dashboard</span> </a>
                </li>

                @if (Auth::user()->role == 'konseling')
                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="{{ route('konseling') }}"> <i class="bi bi-chat-left-heart ps-2 text-2xl"></i>
                            <span>Bimbingan Konseling</span> </a>
                    </li>
                @endif

                <li class="text-xs font-bold mb-4 mt-6">
                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                    <span class="text-xs text-gray-400 font-semibold">Lainnya</span>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('gurumateri') }}"> <i class="ti ti-school ps-2 text-2xl"></i>
                        <span>kelas</span> </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('materi') }}"> <i class="ti ti-book ps-2 text-2xl"></i>
                        <span>Materi</span> </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="./components/cards.html"> <i class="ti ti-cards ps-2 text-2xl"></i>
                        <span>Card</span> </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="./components/forms.html"> <i class="ti ti-file-description ps-2 text-2xl"></i>
                        <span>Forms</span> </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="./components/typography.html">
                        <i class="ti ti-typography ps-2 text-2xl"></i> <span>Typography</span>
                    </a>
                </li>

                <li class="text-xs font-bold mb-4 mt-8">
                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                    <span class="text-xs text-gray-400 font-semibold">AUTH</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="./pages/authentication-login.html"> <i class="ti ti-login ps-2 text-2xl"></i>
                        <span>Login</span> </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="./pages/authentication-register.html">
                        <i class="ti ti-user-plus ps-2 text-2xl"></i> <span>Register</span>
                    </a>
                </li>

                <li class="text-xs font-bold mb-4 mt-8">
                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                    <span class="text-xs text-gray-400 font-semibold">EXTRA</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="./pages/icons.html"> <i class="ti ti-mood-happy ps-2 text-2xl"></i>
                        <span>Icons</span> </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="./pages/sample-page.html"> <i class="ti ti-aperture ps-2 text-2xl"></i>
                        <span>Sample Page</span> </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Bottom Upgrade Option -->
    <div class="m-4 relative grid">
        <form action="{{ url('logout') }}" method="POST">
            @csrf
            <button class="text-base font-semibold hover:bg-blue-700 btn" type="submit">Logout</button>
        </form>
    </div>
    <!-- </aside> -->
</aside>
