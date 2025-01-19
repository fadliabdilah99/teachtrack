@extends('siswa.template.main')

@section('title', 'Siswa-payment')

@push('style')
@endpush

@section('content')
    <div class="font-[sans-serif] bg-white">
        <div class="flex max-sm:flex-col gap-12 max-lg:gap-4 h-full">
            <div class="bg-gray-100 sm:h-screen sm:sticky sm:top-0 lg:min-w-[370px] sm:min-w-[300px]">
                <div class="relative h-full">
                    <div class="px-4 py-8 sm:overflow-auto sm:h-[calc(100vh-60px)]">
                        <div class="space-y-4">
                            @php
                                $hargatotal = 0;
                            @endphp
                            @foreach ($pesanans->cart as $pesanan)
                                <div class="flex items-start gap-4">
                                    <div class="w-32 h-28 max-lg:w-24 max-lg:h-24 flex p-3 shrink-0 bg-gray-200 rounded-md">
                                        <img src='{{ asset('file/produk/' . $pesanan->produk->foto[0]->foto) }}'
                                            class="w-full object-contain" />
                                    </div>
                                    <div class="w-full">
                                        <h3 class="text-sm lg:text-base text-gray-800">{{ $pesanan->produk->judul }}</h3>
                                        <ul class="text-xs text-gray-800 space-y-1 mt-3">
                                            <li class="flex flex-wrap gap-4">Harga <span
                                                    class="ml-auto">Rp.{{ number_format($pesanan->produk->harga) }}</span>
                                            </li>
                                            <li class="flex flex-wrap gap-4">jumlah <span
                                                    class="ml-auto">{{ $pesanan->qty }}</span></li>
                                            <li class="flex flex-wrap gap-4">Total Harga <span
                                                    class="ml-auto">Rp.{{ number_format($pesanan->qty * $pesanan->produk->harga) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @php
                                    $hargatotal += $pesanan->qty * $pesanan->produk->harga;
                                @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-4xl w-full h-max rounded-md px-4 py-8 sticky top-0">
                <h2 class="text-2xl font-bold text-gray-800">Complete your order</h2>
                <div class="bg-gray-100 p-6 rounded-md">
                    <h2 class="text-3xl font-bold text-gray-800">Rp.{{ number_format($hargatotal) }}</h2>

                    <ul class="text-gray-800 mt-8 space-y-3">
                        <li class="flex flex-wrap gap-4 text-sm">Jasa aplikasi <span class="ml-auto font-bold">Rp.500</span>
                        </li>
                        <li class="flex flex-wrap gap-4 text-sm">Tax <span class="ml-auto font-bold">Rp.500</span></li>
                        <li class="flex flex-wrap gap-4 text-sm font-bold border-t-2 pt-4">Total <span
                                class="ml-auto">Rp{{ number_format($bayar = $hargatotal + 1000) }}</span></li>
                        <li class="flex flex-wrap gap-4 text-sm font-bold border-t-2 pt-4">Discount <span
                                class="ml-auto">Rp-</span></li>
                    </ul>
                </div>
                <div class="mt-8 space-y-4">
                    <h1>Metode Pembayaran</h1>
                    <div class="flex items-center">
                        <input type="radio" id="radio-2" name="radio" class="hidden" />
                        <label for="radio-2"
                            class="flex items-center px-4 py-2 rounded-md border-2 border-gray-300 cursor-pointer">
                            <form id="payment_form">
                                <input type="number" name="pembayaran" id="pembayaran" value="{{ $bayar }}" hidden>
                                <input type="number" name="pesanan_id" id="pesanan_id" value="{{ $pesanans->id }}" hidden>
                                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" hidden>
                                <input type="text" name="email" id="email" value="{{ Auth::user()->email }}"
                                    hidden>
                                <button type="submit" class="text-sm text-gray-800 mr-2">Dompet Digital
                                    <span class="text-sm font-bold text-gray-800">Rp. {{ number_format($bayar) }}</span>
                                </button>
                            </form>
                        </label>
                    </div>
                    <form action="{{ route('COD', $id) }}" method="POST">
                        @csrf
                        <div class="flex items-center">
                            <input type="radio" id="radio-3" name="radio" class="hidden" />
                            <label for="radio-3"
                                class="flex items-center px-4 py-2 rounded-md border-2 border-gray-300 cursor-pointer">
                                <button type="submit" class="text-sm text-gray-800 mr-2">Bayar Di Tempat
                                    <span class="text-sm font-bold text-gray-800">Rp. {{ number_format($bayar) }}</span>
                                </button>
                            </label>
                        </div>
                    </form>
                    <form action="{{ route('bayar-ZIEwallet', $id) }}" method="POST">
                        @csrf
                        <div class="flex items-center">
                            <input type="radio" id="radio-3" name="radio" class="hidden" />
                            <label for="radio-3"
                                class="flex items-center px-4 py-2 rounded-md border-2 border-gray-300 cursor-pointer">
                                @php
                                    $saldoWallet =
                                        Auth::user()
                                            ->wallet->where('jenis', 'uang masuk')
                                            ->where('unique', '==', null)
                                            ->sum('nominal') -
                                        Auth::user()->wallet->where('jenis', 'uang keluar')->sum('nominal');
                                @endphp
                                @if ($saldoWallet <= $bayar)
                                    <button type="button" onclick="saldokurang()" class="text-sm text-gray-800 mr-2">Bayar
                                        ZIEWallet
                                        <span class="text-sm font-bold text-gray-800">saldo :
                                            {{ number_format($saldoWallet) }}</span>
                                    </button>
                                @else
                                    <button type="submit" class="text-sm text-gray-800 mr-2">Bayar ZIEWallet
                                        <span class="text-sm font-bold text-gray-800">saldo :
                                            {{ number_format($saldoWallet) }}</span>
                                    </button>
                                @endif
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script
        src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $("#payment_form").submit(function(event) {
            console.log("Form submitted");
            event.preventDefault();


            $.post("/api/payment", {
                    _method: 'POST',
                    _token: '{{ csrf_token() }}',
                    pembayaran: $('#pembayaran').val(),
                    pesanan_id: $('#pesanan_id').val(),
                    name: $('#name').val(),
                    email: $('#email').val(),
                },
                function(data, status) {
                    console.log(data);
                    snap.pay(data.snap_token, {
                        // Optional
                        onSuccess: function(result) {
                            location.reload();
                        },
                        // Optional
                        onPending: function(result) {
                            location.reload();
                        },
                        // Optional
                        onError: function(result) {
                            location.reload();
                        }
                    });
                    return false;
                }
            );
        });
    </script>

    {{-- alert saldo kurang --}}
    <script>
        function saldokurang() {
            Swal.fire({
                title: 'Saldo tidak mencukupi',
                text: 'Saldo ZIEWallet Anda tidak mencukupi untuk membayar pesanan ini',
                icon: 'info',
                confirmButtonColor: '#0ea5e9'
            })
        }
    </script>
@endpush
