@extends('seller.template.main')

@section('title', 'seller-Home')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="col-span-2">
            <div class="col-span-2">
                <div class="card h-full">
                    <div class="card-body">
                        <h4 class="text-gray-500 text-lg font-semibold mb-5">history</h4>
                        <div class="relative overflow-x-auto">
                            <!-- table -->
                            <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                                <thead>
                                    <tr class="text-sm">
                                        <th scope="col" class="p-4 font-semibold">tanggal</th>
                                        <th scope="col" class="p-4 font-semibold">nominal</th>
                                        <th scope="col" class="p-4 font-semibold">keterangan</th>
                                        <th scope="col" class="p-4 font-semibold">jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Auth::user()->wallet()->whereNot('unique', '!=', null)->get() as $riwayat)
<tr>
                                            <td class="p-4">
                                                <h3 class="font-medium">{{ $riwayat->created_at->format('d-m-Y') }}</h3>
                                            </td>
                                            <td class="p-4">
                                                <h3 class="font-medium">Rp {{ number_format($riwayat->nominal) }}</h3>
                                            </td>
                                            <td class="p-4">
                                                <h3 class="font-medium">{{ $riwayat->keterangan }}</h3>
                                            </td>
                                            <td class="p-4 flex gap-2">
                                                @if ($riwayat->jenis == 'uang masuk')
<i class="bi text-green-500 bi-arrow-down-right-circle"></i>
@else
<i class="bi text-red-500 bi-arrow-up-right-circle"></i>
@endif
                                                {{-- <p></p> --}}
                                                <h3 class="font-medium">{{ $riwayat->jenis }}</h3>
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

        <div class="flex flex-col gap-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-gray-500 text-lg font-semibold mb-4">Wallet</h4>
                    <div class="flex items-center justify-between gap-12">
                        <div>
                            <h3 class="text-[22px] font-semibold text-gray-500 mb-4">
                                Rp
                                {{ number_format(Auth::user()->wallet()->where('jenis', 'uang masuk')->whereNot('unique', '!=', null)->sum('nominal')) }}
                            </h3>
                            <div class="flex items-center gap-1 mb-3">
                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-teal-400">
                                    <i class="bi bi-currency-dollar text-white"></i>
                                </span>
                                <p class="text-gray-400 text-sm font-normal text-nowrap">dalam 1 bulan
                                </p>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex gap-2 items-center">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                                    <p class="text-gray-400 font-normal text-xs">
                                        Rp
                                        {{ number_format(Auth::user()->wallet()->where('jenis', 'uang masuk')->whereMonth('created_at', now())->sum('nominal')) }}
                                    </p>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    <p class="text-gray-400 font-normal text-xs">
                                        Rp
                                        {{ number_format(Auth::user()->wallet()->where('jenis', 'uang keluar')->whereMonth('created_at', now())->sum('nominal')) }}
                                    </p>
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
                                <h3 class="text-[22px] font-semibold text-gray-500">Rp {{ number_format($pesanan->sum('uang_masuk')) }}</h3>
                                <div class="flex items-center gap-1">
                                    <span class="flex items-center justify-center w-5 h-5 rounded-full bg-teal-400">
                                        <i class="bi bi-currency-dollar text-white"></i>
                                    </span>
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

        // sweet alert konfirmasi
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
                                    // {{-- chart --}}
                                    var grade = {
                                        series: [
                                            {{ Auth::user()->wallet()->where('jenis', 'lainnya')->sum('nominal') + Auth::user()->wallet()->where('jenis', 'uang keluar')->sum('nominal') }},
                                            {{ Auth::user()->wallet()->where('jenis', 'uang masuk')->whereNot('unique', '!=', null)->sum('nominal') }},
                                            {{ Auth::user()->wallet()->where('jenis', 'uang keluar')->sum('nominal') }}
                                        ],
                                        labels: ["other", "Uang Masuk", "Uang Keluar"],
                                        chart: {
                                            height: 170,
                                            type: "donut",
                                            fontFamily: "Plus Jakarta Sans', sans-serif",
                                            foreColor: "#c6d1e9",
                                        },

                                        tooltip: {
                                            theme: "dark",
                                            fillSeriesColor: false,
                                        },

                                        colors: ["#e7ecf0", "#fb977d", "#0085db"],
                                        dataLabels: {
                                            enabled: false,
                                        },

                                        legend: {
                                            show: false,
                                        },

                                        stroke: {
                                            show: false,
                                        },
                                        responsive: [{
                                            breakpoint: 991,
                                            options: {
                                                chart: {
                                                    width: 150,
                                                },
                                            },
                                        }, ],
                                        plotOptions: {
                                            pie: {
                                                donut: {
                                                    size: '80%',
                                                    background: "none",
                                                    labels: {
                                                        show: true,
                                                        name: {
                                                            show: true,
                                                            fontSize: "12px",
                                                            color: undefined,
                                                            offsetY: 5,
                                                        },
                                                        value: {
                                                            show: false,
                                                            color: "#98aab4",
                                                        },
                                                    },
                                                },
                                            },
                                        },
                                        responsive: [{
                                                breakpoint: 1476,
                                                options: {
                                                    chart: {
                                                        height: 120,
                                                    },
                                                },
                                            },
                                            {
                                                breakpoint: 1280,
                                                options: {
                                                    chart: {
                                                        height: 170,
                                                    },
                                                },
                                            },
                                            {
                                                breakpoint: 1166,
                                                options: {
                                                    chart: {
                                                        height: 120,
                                                    },
                                                },
                                            },
                                            {
                                                breakpoint: 1024,
                                                options: {
                                                    chart: {
                                                        height: 170,
                                                    },
                                                },
                                            },
                                        ],
                                    };
                                </script>
                                
                                
                                <script>
                                    // {{-- chart penjualan --}}
                                    var earning = {
                                        chart: {
                                            id: "sparkline3",
                                            type: "area",
                                            height: 60,
                                            sparkline: {
                                                enabled: true,
                                            },
                                            group: "sparklines",
                                            fontFamily: "Plus Jakarta Sans', sans-serif",
                                            foreColor: "#adb0bb",
                                        },
                                        series: [{
                                            name: "Earnings",
                                            color: "#8763da",
                                            data: {{ json_encode($datapenjualan) }},
                                        }, ],
                                        stroke: {
                                            curve: "smooth",
                                            width: 2,
                                        },
                                        fill: {
                                            colors: ["#f3feff"],
                                            type: "solid",
                                            opacity: 0.05,
                                        },

                                        markers: {
                                            size: 0,
                                        },
                                        tooltip: {
                                            theme: "dark",
                                            fixed: {
                                                enabled: true,
                                                position: "right",
                                            },
                                            x: {
                                                show: false,
                                            },
                                        },
                                    };
                                </script>
@endpush
@endsection

