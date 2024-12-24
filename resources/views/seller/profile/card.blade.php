<div class="flex justify-start gap-x-4 m-2">
    <!-- Tombol Filter untuk Semua -->
    <a href="javascript:void(0)"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full filter-button"
        data-filter="all">All</a>

    <!-- Tombol Filter Berdasarkan Kategori -->
    @foreach ($user->produk->unique('kategori_id')->pluck('kategori') as $kategoris)
        <a href="javascript:void(0)"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full filter-button"
            data-filter="{{ $kategoris->kategori }}">{{ $kategoris->kategori }}</a>
    @endforeach
</div>

<div class="p-10 grid grid-cols-1 xl:grid-cols-4 lg:grid-cols-2 gap-6">
    @foreach ($user->produk as $prod)
        <!-- Kartu Produk dengan Kelas Kategori -->
        <div class="filter-card card overflow-hidden {{ $prod->kategori->kategori }}">
            <div class="relative">
                <a href="javascript:void(0)">
                    <img src="{{ asset('file/produk/' . $prod->foto[0]->foto) }}" alt="product_img" class="w-full">
                </a>
                <a href="javascript:void(0)"
                    class="bg-blue-600 w-8 h-8 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3">
                    <i class="ti ti-basket text-base"></i>
                </a>
            </div>
            <div class="card-body">
                <h6 class="text-base font-semibold text-gray-500 mb-1">{{ $prod->judul }}</h6>
                <div class="flex justify-between">
                    <div class="flex gap-2 items-center">
                        <h6 class="text-gray-500 font-semibold text-base">Rp {{ number_format($prod->harga) }}</h6>
                    </div>
                    <ul class="list-none flex gap-1">
                        <li><a href="javascript:void(0)"><i class="ti ti-star-filled text-yellow-500 text-sm"></i></a>
                        </li>
                        <li><a href="javascript:void(0)"><i class="ti ti-star-filled text-yellow-500 text-sm"></i></a>
                        </li>
                        <li><a href="javascript:void(0)"><i class="ti ti-star-filled text-yellow-500 text-sm"></i></a>
                        </li>
                        <li><a href="javascript:void(0)"><i class="ti ti-star text-yellow-500 text-sm"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="ti ti-star text-yellow-500 text-sm"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
