<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0 w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar transition-all duration-300">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="p-4">
        <h1 class="text-2xl font-bold">{{Auth::user()->seller->namaToko}}</h1>
    </div>
    <div class="scroll-sidebar" data-simplebar="">
        <nav class="w-full flex flex-col sidebar-nav px-4 mt-5">
            <ul id="sidebarnav" class="text-gray-600 text-sm">
                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('seller') }}"> <i class="ti ti-layout-dashboard ps-2 text-2xl"></i>
                        <span>Dashboard</span> </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('keuangan') }}"> <i class="bi bi-cash-coin ps-2 text-2xl"></i>
                        <span>Keuangan</span> </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('profile.toko') }}"> <i class="bi bi-shop ps-2 text-2xl"></i>
                        <span>Tampilan Toko</span> </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ route('produk') }}"> <i class="bi bi-box ps-2 text-2xl"></i>
                        <span>Produk</span> </a>
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
