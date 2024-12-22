@extends('seller.template.main')

@section('title', 'seller-Home')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="col-span-2">
            <div class="card h-full">
                <div class="card-body">
                    <h4 class="text-gray-500 text-lg font-semibold mb-5">Pesanan</h4>
                    <div class="relative overflow-x-auto">
                        <!-- table -->
                        <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                            <thead>
                                <tr class="text-sm">
                                    <th scope="col" class="p-4 font-semibold">Profile</th>
                                    <th scope="col" class="p-4 font-semibold">nama toko</th>
                                    <th scope="col" class="p-4 font-semibold">Dokumen
                                    </th>
                                    <th scope="col" class="p-4 font-semibold">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-4">
                                        <h3 class="font-medium">nama toko</h3>
                                    </td>
                                    <td class="p-4">
                                        <h3 class="font-medium">nama toko</h3>
                                    </td>
                                    <td class="p-4">
                                        <h3 class="font-medium">nama toko</h3>
                                    </td>
                                    <td class="p-4">
                                        <h3 class="font-medium">nama toko</h3>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="text-gray-500 text-lg font-semibold mb-5">Dalam Proses</h4>
                <ul class="timeline-widget relative">
                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-500 text-sm min-w-[90px] py-[6px] pr-4 text-end">
                            9:30 am</div>
                        <div class="timeline-badge-wrap flex flex-col items-center">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-blue-600 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4">
                            <p class="text-gray-500 text-sm font-normal">Payment received from John
                                Doe of $385.90</p>
                        </div>
                    </li>
                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-500 min-w-[90px] py-[6px] text-sm pr-4 text-end">
                            10:00 am</div>
                        <div class="timeline-badge-wrap flex flex-col items-center">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-blue-300 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4 text-sm">
                            <p class="text-gray-500 font-semibold">New sale recorded</p>
                            <a href="javascript:void('')" class="text-blue-600">#ML-3467</a>
                        </div>
                    </li>

                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-500 min-w-[90px] text-sm py-[6px] pr-4 text-end">
                            12:00 am</div>
                        <div class="timeline-badge-wrap flex flex-col items-center">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-teal-500 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4">
                            <p class="text-gray-500 text-sm font-normal">Payment was made of $64.95
                                to Michael</p>
                        </div>
                    </li>

                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-500 min-w-[90px] text-sm py-[6px] pr-4 text-end">
                            9:30 am</div>
                        <div class="timeline-badge-wrap flex flex-col items-center">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-yellow-500 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4 text-sm">
                            <p class="text-gray-500 font-semibold">New sale recorded</p>
                            <a href="javascript:void('')" class="text-blue-600">#ML-3467</a>
                        </div>
                    </li>

                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-time text-gray-500 text-sm min-w-[90px] py-[6px] pr-4 text-end">
                            9:30 am</div>
                        <div class="timeline-badge-wrap flex flex-col items-center">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-red-500 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4">
                            <p class="text-gray-500 text-sm font-semibold">New arrival recorded</p>
                        </div>
                    </li>
                    <li class="timeline-item flex relative overflow-hidden">
                        <div class="timeline-time text-gray-500 text-sm min-w-[90px] py-[6px] pr-4 text-end">
                            12:00 am</div>
                        <div class="timeline-badge-wrap flex flex-col items-center">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-teal-500 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4">
                            <p class="text-gray-500 text-sm font-normal">Payment Done</p>
                        </div>
                    </li>
                </ul>
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
