@extends('seller.template.main')

@section('title', 'seller-Home')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="col-span-2">
            <div class="card">
                <div class="card-body">
                    <div class="flex justify-between mb-5">
                        <h4 class="text-gray-500 text-lg font-semibold sm:mb-0 mb-2">Profit &
                            Expenses</h4>
                        <div class="hs-dropdown relative inline-flex [--placement:bottom-right] sm:[--trigger:hover]">
                            <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                                <i class="ti ti-dots-vertical text-2xl text-gray-400"></i>
                            </a>
                            <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max w-[150px] hidden z-[12]"
                                aria-labelledby="hs-dropdown-custom-icon-trigger">
                                <div class="card-body p-0 py-2">
                                    <a href="javscript:void(0)"
                                        class="flex gap-2 items-center font-medium px-4 py-2.5 hover:bg-gray-200 text-gray-400">
                                        <p class="text-sm">Action</p>
                                    </a>
                                    <a href="javscript:void(0)"
                                        class="flex gap-2 items-center font-medium px-4 py-2.5 hover:bg-gray-200 text-gray-400">
                                        <p class="text-sm">Another Action</p>
                                    </a>
                                    <a href="javscript:void(0)"
                                        class="flex gap-2 items-center font-medium px-4 py-2.5 hover:bg-gray-200 text-gray-400">
                                        <p class="text-sm">Something else here</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="profit"></div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-gray-500 text-lg font-semibold mb-4">Traffic Distribution</h4>
                    <div class="flex items-center justify-between gap-12">
                        <div>
                            <h3 class="text-[22px] font-semibold text-gray-500 mb-4">$36,358</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-teal-400">
                                    <i class="ti ti-arrow-up-left text-teal-500"></i>
                                </span>
                                <p class="text-gray-500 text-sm font-normal">+9%</p>
                                <p class="text-gray-400 text-sm font-normal text-nowrap">last year
                                </p>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex gap-2 items-center">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                    <p class="text-gray-400 font-normal text-xs">Oragnic</p>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    <p class="text-gray-400 font-normal text-xs">Refferal</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div id="grade"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex gap-6 items-center justify-between">
                        <div class="flex flex-col gap-4">
                            <h4 class="text-gray-500 text-lg font-semibold">Product Sales</h4>
                            <div class="flex flex-col gap-4">
                                <h3 class="text-[22px] font-semibold text-gray-500">$6,820</h3>
                                <div class="flex items-center gap-1">
                                    <span class="flex items-center justify-center w-5 h-5 rounded-full bg-red-400">
                                        <i class="ti ti-arrow-down-right text-red-500"></i>
                                    </span>
                                    <p class="text-gray-500 text-sm font-normal">+9%</p>
                                    <p class="text-gray-400 text-sm font-normal text-nowrap">last
                                        year</p>
                                </div>
                            </div>
                        </div>

                        <div
                            class="w-11 h-11 flex justify-center items-center rounded-full bg-red-500 text-white self-start">
                            <i class="ti ti-currency-dollar text-xl"></i>
                        </div>
                    </div>
                </div>
                <div id="earning"></div>
            </div>
        </div>
    </div>
  

    @push('script')
        {{-- modal foto --}}
        <script>
            function modalFoto(url) {
                var modal = document.getElementById("modal-foto");
                var img = document.getElementById("foto");
                img.src = url;
                modal.classList.remove("hidden");
            }

            function closeModalFoto() {
                var modal = document.getElementById("modal-foto");
                modal.classList.add("hidden");
            }
        </script>

        {{-- sweet alert konfirmasi --}}
        <script>
            function confirmAction(formId, actionName) {
                Swal.fire({
                    title: `Apakah anda yakin untuk ${actionName.toLowerCase()}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, ' + actionName,
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                    }
                });
            }
        </script>
    @endpush
@endsection
