<div class="flex flex-wrap justify-start gap-4 m-4">
    <!-- Tombol Filter untuk Semua -->
    <a href="javascript:void(0)"
        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out filter-button"
        data-filter="all">
        <span class="uppercase">All</span>
    </a>

    <!-- Tombol Filter Berdasarkan Kategori -->
    @foreach ($user->produk->unique('kategori_id')->pluck('kategori') as $kategoris)
        <a href="javascript:void(0)"
            class="bg-gradient-to-r from-teal-400 to-teal-500 hover:from-teal-500 hover:to-teal-600 text-white font-semibold py-2 px-6 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out filter-button"
            data-filter="{{ $kategoris->kategori }}">
            <span class="uppercase">{{ $kategoris->kategori }}</span>
        </a>
    @endforeach
</div>


<div class="p-10 grid grid-cols-1 xl:grid-cols-4 lg:grid-cols-2 gap-6">
    @foreach ($user->produk->shuffle() as $prod)
        <!-- Kartu Produk dengan Kelas Kategori -->
        <div class="filter-card card overflow-hidden {{ $prod->kategori->kategori }}">
            <div class="relative">
                <a href="javascript:void(0)">
                    <img src="{{ asset('file/produk/' . $prod->foto[0]->foto) }}" alt="product_img" class="w-full">
                </a>
                @if (Auth::user()->id == $id)
                    <form action="{{ route('pin', $prod->id) }}" method="post" id="pin-form">
                        @csrf
                        <button type="button"
                            class="bg-blue-600 w-8 h-8 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3"
                            onclick="confirmPin(this)">
                            <i class="bi bi-pin-angle-fill text-base"></i>
                        </button>
                    </form>
                @else
                    <a href="javascript:void(0)"
                        class="bg-blue-600 w-8 h-8 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3">
                        <i class="bi bi-bag-plus-fill text-base"></i>
                    </a>
                @endif
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
