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
                        href="{{ url('admin') }}"> <i class="ti ti-layout-dashboard ps-2 text-2xl"></i>
                        <span>Dashboard</span> </a>
                </li>

                <li class="text-xs font-bold mb-4 mt-6">
                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                    <span class="text-xs text-gray-400 font-semibold">UI COMPONENTS</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('user') }}"> <i class="ti ti-user ps-2 text-2xl"></i>
                        <span>User</span> </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('mapel') }}"> <i class="ti ti-book ps-2 text-2xl"></i>
                        <span>Mapel</span> </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('admin-kategori') }}"> <i class="ti ti-cards ps-2 text-2xl"></i>
                        <span>Wira Usaha</span> </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Bottom Upgrade Option -->
    <!-- </aside> -->
</aside>
