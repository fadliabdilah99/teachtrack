@extends('siswa.template.main')

@section('title', 'Siswa-Pesanan')

@push('style')
@endpush

@section('content')
    <div class="flex justify-center space-x-4 my-4">
        <button onclick="pesanan()"
            class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-full hover:bg-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
            <i class="bi bi-clock text-xl mr-2"></i> Belum di bayar
        </button>
        <button onclick="diproses()"
            class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-full hover:bg-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
            <i class="bi bi-arrow-repeat text-xl mr-2"></i> Di proses
        </button>
        <button onclick="selesai()"
            class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-full hover:bg-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
            <i class="bi bi-check-circle text-xl mr-2 "></i> Selesai
        </button>
    </div>
    <div class="card h-full " id="pesanan">
        <div class="card-body"> 
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Perlu di bayar</h4>
            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Id pesanan</th>
                            <th scope="col" class="p-4 font-semibold">Barang</th>
                            <th scope="col" class="p-4 font-semibold">total</th>
                            <th scope="col" class="p-4 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody id="dataTableguru">
                        @foreach (Auth::user()->pesanan->where('status', 'pending') as $pesanans)
                            <tr>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">
                                        {{ $pesanans->kode }}</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">
                                        {{ $pesanans->cart->count() }} item</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500"> Rp.
                                        {{ number_format(
                                            $pesanans->cart->sum(function ($harga) {
                                                return $harga->produk->harga;
                                            }),
                                        ) }}
                                    </h3>
                                </td>
                                <td class="p-4">
                                    <a href="{{ route('bayar', $pesanans->id) }}"
                                        class="btn text-base py-1 text-white w-fit hover:bg-blue-700">Bayar</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="card h-full hidden" id="diproses">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Dalam Proses</h4>
            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Id pesanan</th>
                            <th scope="col" class="p-4 font-semibold">Barang</th>
                            <th scope="col" class="p-4 font-semibold">total</th>
                            <th scope="col" class="p-4 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody id="dataTableguru">
                        @foreach (Auth::user()->pesanan->where('status', 'diproses') as $pesanans)
                            <tr>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">
                                        {{ $pesanans->kode }}</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">
                                        {{ $pesanans->cart->count() }} item</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500"> Rp.
                                        {{ number_format(
                                            $pesanans->cart->sum(function ($harga) {
                                                return $harga->produk->harga;
                                            }),
                                        ) }}
                                    </h3>
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('selesai', $pesanans->id) }}" method="POST">
                                        @csrf
                                        <button type="button"
                                            class="btn confirmation text-base py-1 text-white w-fit hover:bg-blue-700">selesai
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </div>
    <div class="card h-full hidden" id="selesai">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Selesai</h4>
            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Id pesanan</th>
                            <th scope="col" class="p-4 font-semibold">Barang</th>
                            <th scope="col" class="p-4 font-semibold">total</th>
                            <th scope="col" class="p-4 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody id="dataTableguru">
                        @foreach (Auth::user()->pesanan->where('status', 'selesai') as $pesanans)
                            <tr>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">
                                        {{ $pesanans->kode }}</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">
                                        {{ $pesanans->cart->count() }} item</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500"> Rp.
                                        {{ number_format(
                                            $pesanans->cart->sum(function ($harga) {
                                                return $harga->produk->harga;
                                            }),
                                        ) }}
                                    </h3>
                                </td>
                                <td class="p-4">
                                    <a href="#"
                                        class="btn confirmation text-base py-1 text-white w-fit hover:bg-blue-700">invoice
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

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
        $('.confirmation').click(function(e) {
            e.preventDefault();
            const data = $(this).closest('tr').find('td:eq(1)').text();
            console.log("Data to delete:", data);
            Swal.fire({
                    title: 'Apakah pesanan sudah sesuai!',
                    text: `pesanan akan di selesaikan dan tidak bisa dikembalikan`,
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'Ya',
                    denyButtonText: 'Tidak',
                    confirmButtonColor: "#3085d6",
                    denyButtonColor: "#d33",
                    focusConfirm: false
                })
                .then((result) => {
                    console.log("Delete Confirmation Result:", result);
                    if (result.isConfirmed) {
                        console.log("Confirmed: Submitting form");
                        $(e.target).closest('form').submit();
                    } else {
                        console.log("Denied: Closing Swal");
                        swal.close();
                    }
                });
        });
    </script>

    {{-- menampilkan halaman --}}
    <script>
        function pesanan() {
            document.getElementById('pesanan').classList.remove('hidden');
            document.getElementById('diproses').classList.add('hidden');
            document.getElementById('selesai').classList.add('hidden');
        }

        function diproses() {
            document.getElementById('pesanan').classList.add('hidden');
            document.getElementById('diproses').classList.remove('hidden');
            document.getElementById('selesai').classList.add('hidden');
        }

        function selesai() {
            document.getElementById('pesanan').classList.add('hidden');
            document.getElementById('diproses').classList.add('hidden');
            document.getElementById('selesai').classList.remove('hidden');
        }
    </script>
@endpush