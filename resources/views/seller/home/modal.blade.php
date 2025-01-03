@foreach ($pesanan as $proses)
    <div id="modalinfo{{ $proses->id }}"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden"
        style="overflow-y: auto;">
        <div class="bg-white rounded-lg shadow-lg w-full md:w-3/4 lg:w-2/4 p-8 max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <button onclick="closemodalinfo({{ $proses->id }})"
                    class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <div class="card">
                <div class="card-body">
                    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Detail Pesanan</h1>
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">List Pesanan</h2>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($proses->cart as $modalcart)
                            <div class="divide-y divide-gray-200">
                                <div class="py-4 flex justify-between items-center">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('file/produk/' . $modalcart->produk->foto[0]->foto) }}" alt="Produk"
                                            class="w-16 h-16 rounded-lg shadow">
                                        <div>
                                            <h3 class="text-gray-800 font-semibold">{{$modalcart->produk->judul}}</h3>
                                            <p class="text-sm text-gray-500">{{$modalcart->qty}}x</p>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $total += $modalcart->produk->harga * $modalcart->qty;
                                @endphp
                        @endforeach
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Catatan Pembeli</h2>
                    <div class="p-4 bg-gray-100 rounded-lg">
                        <p class="text-sm text-gray-600">Tolong dikirim secepat mungkin ya, saya butuh barang ini
                            untuk acara minggu depan. Terima kasih!</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Info Metode Pembayaran</h2>
                    <div class="p-4 bg-gray-100 rounded-lg space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Metode: </span>
                            <span class="text-gray-800 font-medium">{{$proses->status}}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Pembayaran:</span>
                            <span class="text-gray-800 font-bold">Rp {{number_format($total)}}</span>
                        </div>
                    </div>
                </div>

                <div class="flex mt-3 gap-2"> 
                <form action="{{ route('proses', $pesanans->id) }}"  method="POST">
                    @csrf
                    <button type="submit" class="btn text-base py-1 text-white w-fit hover:bg-blue-700">proses</button>
                </form>
                    <button onclick="closemodalinfo({{ $proses->id }})" class="btn text-base py-1 text-white w-fit hover:bg-blue-700">close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
