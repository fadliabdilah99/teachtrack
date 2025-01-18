@extends('admin.template.main')

@section('title', 'Admin-Home')

@push('style')
@endpush

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="col-span-2">
            <div class="card">
                <div class="card-body">
                    <div class="flex justify-between mb-5">
                        <h4 class="text-gray-500 text-lg font-semibold sm:mb-0 mb-2">Traffic Kehadiran</h4>
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
                    <h4 class="text-gray-500 text-lg font-semibold mb-4">Siswa Hadir</h4>
                    <div class="flex items-center justify-between gap-12">
                        <div>
                            <h3 class="text-[22px] font-semibold text-gray-500 mb-4">{{ $siswaHadir }}</h3>
                            <div class="flex items-center gap-1 mb-3">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-gray-200">
                                    @if ($status == '1')
                                        <i class="ti ti-arrow-up-left text-teal-500"></i>
                                    @elseif($status == '2')
                                        <i class="ti ti-currency-dollar text-xl"></i>
                                    @elseif($status == '3')
                                        <i class="ti ti-minus text-blue-500"></i>
                                    @endif
                                </span>
                                <p class="text-gray-500 text-sm font-normal">{{ $presentase }}</p>
                                <p class="text-gray-400 text-sm font-normal text-nowrap">Dari kemarin
                                </p>
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
                            <h4 class="text-gray-500 text-lg font-semibold">Transaksi per-hari ini</h4>
                            <div class="flex flex-col gap-4">
                                <h3 class="text-[22px] font-semibold text-gray-500">{{ $transaksiHariIni }}</h3>
                                <div class="flex items-center gap-1">
                                    <span class="flex items-center justify-center w-5 h-5 rounded-full bg-gray-200">
                                        <i class="ti ti-minus text-red-500"></i>
                                    </span>
                                    <p class="text-gray-500 text-sm font-normal">{{ $presentaseTransaksi }}</p>
                                    <p class="text-gray-400 text-sm font-normal text-nowrap">Dari kemarin</p>
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
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="col-span-3">
            <div class="card h-full">
                <div class="card-body">
                    <h4 class="text-gray-500 text-lg font-semibold mb-5">Permohonan akun penjualan</h4>
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
                                @if ($pemohon->count() == 0)
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-sm text-gray-500">
                                            belum ada pengaju
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($pemohon as $waiting)
                                    <tr>
                                        <td class="p-4 text-sm">
                                            <div class="flex gap-6 items-center">
                                                <div class="h-12 w-12 inline-block"><img
                                                        src="./assets/images/profile/user-1.jpg" alt=""
                                                        class="rounded-full w-100" />
                                                </div>
                                                <div class="flex flex-col gap-1 text-gray-500">
                                                    <h3 class="font-bold">{{ $waiting->seller->owner->name }}</h3>
                                                    <span
                                                        class="font-normal">{{ $waiting->seller->owner->rombel->kelas . ' ' . $waiting->seller->owner->rombel->jurusan->jurusan . ' ' . $waiting->seller->owner->rombel->jurusan->no }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <h3 class="font-medium">{{ $waiting->seller->namaToko }}</h3>
                                        </td>
                                        <td class="p-4">
                                            <button class="font-medium text-teal-500">
                                                <img width="100"
                                                    src="{{ asset('file/identitas/' . $waiting->seller->identitas) }}"
                                                    alt=""
                                                    onclick="modalFoto('{{ asset('file/identitas/' . $waiting->seller->identitas) }}')">
                                            </button>
                                        </td>
                                        <div id="modal-foto"
                                            class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
                                            <div class="bg-white rounded-lg shadow-lg w-1/2 p-6">
                                                <img id="foto" src="" alt="foto" class="w-full">
                                                <p>deskripsi toko : {{ $waiting->seller->deskripsi }}</p>
                                                <button onclick="closeModalFoto()"
                                                    class="text-gray-400 hover:text-gray-600 float-right">&times;</button>
                                            </div>
                                        </div>
                                        <td class="p-4 flex ">
                                            <form class="mr-1" id="konfirmasiForm{{ $waiting->id }}"
                                                action="{{ route('konfirmasi') }}" method="POST">
                                                @csrf
                                                <input type="number" value="{{ $waiting->id }}" hidden name="user_id"
                                                    id="">
                                                <button type="button"
                                                    onclick="confirmAction('konfirmasiForm{{ $waiting->id }}', 'Konfirmasi')"
                                                    class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">konfirm</button>
                                            </form>
                                            <form id="tolakForm{{ $waiting->id }}" action="{{ route('tolak') }}"
                                                method="POST">
                                                @csrf
                                                <input type="number" value="{{ $waiting->id }}" hidden name="user_id"
                                                    id="">
                                                <button type="button"
                                                    onclick="confirmAction('tolakForm{{ $waiting->id }}', 'Tolak')"
                                                    class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-red-400 text-white">tolak</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p class="text-base text-gray-400 font-normal p-3 text-center">Design and Developed by <a
                href="https://www.wrappixel.com/" target="_blank"
                class="text-blue-600 underline hover:text-blue-700">wrappixel.com</a></p>
    </footer>


@endsection


@push('script')
    <script>
        $(document).ready(function() {
            document.getElementById("main").classList.remove("hidden");
        });
    </script>
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

    <script>
        $(function() {
            // =====================================
            // Profit
            // =====================================
            var profit = {
                series: [{
                        name: "Siswa Hadir ",
                        data: {{ $kehadiranChart }},
                    },
                    {
                        name: "Penjualan ",
                        data: {{ $tidakhadirChart }},
                    },
                ],
                chart: {
                    fontFamily: "Poppins,sans-serif",
                    type: "bar",
                    height: 370,
                    offsetY: 10,
                    toolbar: {
                        show: false,
                    },
                },
                grid: {
                    show: true,
                    strokeDashArray: 3,
                    borderColor: "rgba(0,0,0,.1)",
                },
                colors: ["#1e88e5", "#21c1d6"],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "30%",
                        endingShape: "flat",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 5,
                    colors: ["transparent"],
                },
                xaxis: {
                    type: "category",
                    categories: ["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus",
                        "september",
                        "oktober", "november", "desember"
                    ],
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    labels: {
                        style: {
                            colors: "#a1aab2",
                        },
                    },
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: "#a1aab2",
                        },
                    },
                },
                fill: {
                    opacity: 1,
                    colors: ["#0085db", "#fb977d"],
                },
                tooltip: {
                    theme: "dark",
                },
                legend: {
                    show: false,
                },
                responsive: [{
                    breakpoint: 767,
                    options: {
                        stroke: {
                            show: false,
                            width: 5,
                            colors: ["transparent"],
                        },
                    },
                }, ],
            };

            var chart_column_basic = new ApexCharts(
                document.querySelector("#profit"),
                profit
            );
            chart_column_basic.render();



            // =====================================
            // Breakup
            // =====================================


            var chart = new ApexCharts(document.querySelector("#grade"), grade);
            chart.render();



            // =====================================
            // Earning
            // =====================================

            new ApexCharts(document.querySelector("#earning"), earning).render();
        })
    </script>
@endpush
