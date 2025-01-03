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
                                    <th scope="col" class="p-4 font-semibold">Pemesan</th>
                                    <th scope="col" class="p-4 font-semibold">ID pesanan</th>
                                    <th scope="col" class="p-4 font-semibold">kirim ke</th>
                                    <th scope="col" class="p-4 font-semibold">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $pesanans)
                                    <tr>
                                        <td class="p-4 text-sm">
                                            <div class="flex gap-6 items-center">
                                                <div class="h-12 w-12 inline-block"><img
                                                        src="{{ asset('file/profile/' . $pesanans->user->fotoProfile) }}"
                                                        alt="" class="rounded-full w-100"></div>
                                                <div class="flex flex-col gap-1 text-gray-500">
                                                    <h3 class="font-bold">{{ $pesanans->user->name }} <span
                                                            class="font-normal {{ $pesanans->status == 'payment' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-green-800 text-xs mr-2 px-2.5 py-0.5 rounded">{{ $pesanans->status }}</span>
                                                    </h3>

                                                    <span
                                                        class="font-normal">{{ $pesanans->user->rombel->kelas . ' ' . $pesanans->user->rombel->jurusan->jurusan . ' ' . $pesanans->user->rombel->jurusan->no }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <h3 class="font-medium">{{ $pesanans->kode }}</h3>
                                        </td>
                                        <td class="p-4">
                                            <h3 class="font-medium">{{ $pesanans->alamat }}</h3>
                                        </td>
                                        <td class="p-4">
                                        <button onclick="showinfo({{ $pesanans->id }})" class="btn text-base py-1 text-white w-fit hover:bg-blue-700">proses</button>
                                        </td>
                                    </tr>
                                @endforeach

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
                    @foreach ($proses as $prosess)
                        
                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                        <div class="timeline-badge-wrap flex flex-col items-center">
                            <div
                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-blue-600 my-[10px]">
                            </div>
                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-400">
                            </div>
                        </div>
                        <div class="timeline-desc py-[6px] px-4">
                            <p class="text-gray-500 text-sm font-normal">Payment received from John
                                Doe of $385.90</p>
                                <button class="btn text-base mt-2 py-1 text-white w-fit hover:bg-blue-700">tes</button>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @include('seller.home.modal')
     
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

        {{-- show modal --}}
        <script>
            function showinfo(id) {
                document.getElementById(`modalinfo${id}`).classList.remove("hidden");
            }

            function closemodalinfo(id) {
                document.getElementById(`modalinfo${id}`).classList.add("hidden");
            }
        </script>
    @endpush
    
@endsection
