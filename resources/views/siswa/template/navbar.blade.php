   <!--  Header Start -->
   <header class="bg-white shadow-md rounded-md w-full text-sm py-4 px-6">
       <!-- ========== HEADER ========== -->
       <nav class="w-ful flex items-center justify-between" aria-label="Global">
           <ul class="icon-nav flex items-center gap-4">
               <li class="relative xl:hidden">
                   <a class="text-xl icon-hover cursor-pointer text-heading" id="headerCollapse"
                       data-hs-overlay="#application-sidebar-brand" aria-controls="application-sidebar-brand"
                       aria-label="Toggle navigation" href="javascript:void(0)">
                       <i class="ti ti-menu-2 relative z-1"></i>
                   </a>
               </li>

               <li class="relative">
                   <div class="hs-dropdown relative inline-flex [--placement:bottom-left] sm:[--trigger:hover]">
                       <a class="relative hs-dropdown-toggle inline-flex hover:text-gray-500 text-gray-300"
                           href="#">
                           <i class="ti ti-bell-ringing text-xl relative z-[1]"></i>
                           <h1></h1>
                           <div
                               class="absolute inline-flex items-center justify-center text-white text-[11px] font-medium bg-blue-600 w-2 h-2 rounded-full -top-[1px] -right-[6px]">
                           </div>
                       </a>
                       <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max w-[300px] hidden z-[12]"
                           aria-labelledby="hs-dropdown-custom-icon-trigger">
                           <div>
                               <h3 class="text-gray-500 font-semibold text-base px-6 py-3">
                                   Notification</h3>
                               <ul class="list-none flex flex-col">
                                   @foreach (Auth::user()->notif()->orderByDesc('id')->limit(10)->get() as $notifc)
                                       <li class="">
                                           <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                               <p
                                                   class=" font-medium {{ $notifc->status == 'unread' ? 'text-blue-600 ' : 'text-gray-400' }}">
                                                   {{ $notifc->title }}
                                               </p>
                                               <p class="text-xs text-gray-400 font-medium">
                                                   {{ Str::limit($notifc->message, 20) }}
                                               </p>
                                           </a>
                                       </li>
                                   @endforeach
                                   <a href="{{ route('mailsiswa') }}"
                                       class="py-3 bg-gray-100 px-6 block hover:bg-gray-200">
                                       Lihat semua Notifikasi</a>
                               </ul>
                           </div>
                       </div>
                   </div>
               </li>
           </ul>
           <div class="flex items-center gap-4">
               <div class="mx-4 relative grid">

               </div>
               <div class="hs-dropdown relative inline-flex [--placement:bottom-right] sm:[--trigger:hover]">
                   <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                       <i class="bi bi-person-circle text-gray-400 text-3xl"></i>
                   </a>
                   <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max w-[200px] hidden z-[12]"
                       aria-labelledby="hs-dropdown-custom-icon-trigger">
                       <div class="card-body p-0 py-2">
                           <a href="{{ route('siswa-profile') }}"
                               class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                               <i class="ti ti-user text-xl"></i>
                               <p class="text-sm">My Profile</p>
                           </a>
                           <button onclick="modalpengajuan()"
                               class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                               <i class="ti ti-paperclip text-xl"></i>
                               <p class="text-sm">pengajuan akun seller</p>
                           </button>


                           <div class="px-4 mt-[7px] grid">
                               <form action="{{ url('logout') }}" method="POST">
                                   @csrf
                                   <button
                                       class="btn-outline-primary font-medium text-[15px] w-full hover:bg-blue-600 hover:text-white"
                                       type="submit">Logout</button>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </nav>

       <!-- ========== END HEADER ========== -->
   </header>
   <!--  Header End -->
