<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0 w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar transition-all duration-300">
    <div class="scroll-sidebar" data-simplebar="">
        <nav class="w-full flex flex-col sidebar-nav px-4 mt-5">
            <ul id="sidebarnav" class="text-gray-600 text-sm">
                <!-- Timeline Header -->
                <li class="text-xs font-bold mb-4 mt-6">
                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                    <span class="text-lg text-gray-400 font-semibold">{{$materi->judul}}</span>
                </li>

                <!-- Timeline Step 1 -->
                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ url('introduction') }}">
                        <div class="step-marker bg-blue-500 w-3 h-3 rounded-full"></div>
                        <span class="ml-2">Introduction to Course</span>
                    </a>
                </li>

                <!-- Timeline Step 2 (current step) -->
                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full active"
                        href="{{ url('basic-concepts') }}">
                        <div class="step-marker bg-green-500 w-3 h-3 rounded-full"></div>
                        <span class="ml-2 font-semibold text-gray-800">Basic Concepts</span>
                    </a>
                </li>

                <!-- Timeline Step 3 -->
                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ url('advanced-topics') }}">
                        <div class="step-marker bg-gray-300 w-3 h-3 rounded-full"></div>
                        <span class="ml-2">Advanced Topics</span>
                    </a>
                </li>

                <!-- Timeline Step 4 -->
                <li class="sidebar-item">
                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                        href="{{ url('final-project') }}">
                        <div class="step-marker bg-gray-300 w-3 h-3 rounded-full"></div>
                        <span class="ml-2">Final Project</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>