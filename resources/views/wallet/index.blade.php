<div class="grid grid-cols-1 lg:grid-cols-10 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
    <div class="flex col-span-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-gray-500 text-lg font-semibold mb-4">
                    Wallet
                    <span class="text-gray-400 text-sm" onclick="copyToClipboard(this)"><a href=""><i
                                class="bi bi-clipboard"></i> {{ Auth::user()->NoUnik }}</a></span>
                </h4>
                <div class="flex items-center justify-between gap-2 ">
                    <div>
                        <h3 class="text-[22px] font-semibold text-gray-500 mb-4">
                            Rp
                            {{ number_format($nominal = Auth::user()->wallet()->where('jenis', 'uang masuk')->whereNot('unique', '!=', null)->sum('nominal') - Auth::user()->wallet()->where('jenis', 'uang keluar')->sum('nominal')) }}
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
                <button class="btn btn-primary" onclick="modalTransfer()">Transfer</button>
                <button class="btn btn-primary" onclick="modalTopUp()">Top Up</button>
                <button class="btn btn-primary" onclick="modalTarikSaldo()">Tarik Uang</button>
            </div>
        </div>
    </div>
    <div class="col-span-6">
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
                                @foreach (Auth::user()->wallet()->get() as $riwayat)
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
                                            @if ($riwayat->unique != null)
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">sedang di proses</span>
                                            @elseif ($riwayat->jenis == 'uang masuk')
                                                <i class="bi text-green-500 bi-arrow-down-right-circle"></i>
                                                <h3 class="font-medium">{{ $riwayat->jenis }}</h3>
                                            @else
                                                <i class="bi text-red-500 bi-arrow-up-right-circle"></i>
                                                <h3 class="font-medium">{{ $riwayat->jenis }}</h3>
                                            @endif
                                            {{-- <p></p> --}}
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


</div>


@include('wallet.modal')
