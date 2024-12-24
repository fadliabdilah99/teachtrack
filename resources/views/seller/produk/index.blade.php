@extends('seller.template.main')

@section('title', 'seller-Produk')

@push('style')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endpush

@section('content')
    <div class="card h-full">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">prod</h4>
            <div class="relative overflow-x-auto">
                <button onclick="modalproduk()" class="bg-teal-500 text-white px-4 py-2 rounded-md"><i
                        class="bi bi-plus-lg"></i></button>

                <input type="text" id="searchInputprod" placeholder="  Search..."
                    class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    onkeyup="searchTableprod()" />

                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">kode & foto</th>
                            <th scope="col" class="p-4 font-semibold">produk</th>
                            <th scope="col" class="p-4 font-semibold">Kategori</th>
                            <th scope="col" class="p-4 font-semibold">Stok</th>
                            <th scope="col" class="p-4 font-semibold">aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataTableprod">
                        @foreach (Auth::user()->produk()->orderByDesc('created_at')->get() as $prod)
                            <tr>
                                <td class="p-4 text-sm">
                                    <!-- Slider Container -->
                                    <div id="indicators-carousel" class="relative w-full max-w-lg" data-carousel="static">
                                        <!-- Wrapper for slides -->
                                        <div class="relative h-64 overflow-hidden rounded-lg">
                                            @foreach ($prod->foto as $index => $pict)
                                                <div class="{{ $index == 0 ? 'block' : 'hidden' }} duration-700 ease-in-out"
                                                    data-carousel-item>
                                                    <img src="{{ asset('file/produk/' . $pict->foto) }}"
                                                        class="block object-cover w-64 h-64"
                                                        alt="Slide {{ $index + 1 }}">
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Slider Indicators -->
                                        <div class="absolute z-30 flex space-x-3 bottom-5 left-1/2 -translate-x-1/2">
                                            @foreach ($prod->foto as $index => $pict)
                                                <button type="button"
                                                    class="w-3 h-3 rounded-full {{ $index == 0 ? 'bg-white' : 'bg-gray-300' }}"
                                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                                    aria-label="Slide {{ $index + 1 }}"
                                                    data-carousel-slide-to="{{ $index }}"></button>
                                            @endforeach
                                        </div>

                                        <!-- Slider Controls -->
                                        <button type="button"
                                            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                            data-carousel-prev>
                                            <span
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/30 group-hover:bg-white/50">
                                                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                                </svg>
                                                <span class="sr-only">Previous</span>
                                            </span>
                                        </button>
                                        <button type="button"
                                            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                            data-carousel-next>
                                            <span
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white/30 group-hover:bg-white/50">
                                                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 6 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                                </svg>
                                                <span class="sr-only">Next</span>
                                            </span>
                                        </button>
                                    </div>

                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $prod->kode }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $prod->judul }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $prod->kategori->kategori }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $prod->stok }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <button onclick="prod(this, {{ $prod->id }})"
                                        class="inline-flex
                                            items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                            class="bi bi-plus-lg"></i></button>
                                    <button onclick="prod(this, {{ $prod->id }})"
                                        class="inline-flex
                                            items-center py-2 px-4 rounded-3xl font-semibold bg-red-400 text-white"><i
                                            class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    @include('seller.produk.modal')
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                console.log('Slider initialized successfully.');
            });
        </script>

        {{-- modal add produk --}}
        <script>
            function modalproduk() {
                console.log('modalproduk');
                document.getElementById("modalproduk").classList.remove("hidden");
            }


            function closemodalproduk() {
                document.getElementById("modalproduk").classList.add("hidden");
            }
        </script>
    @endpush
@endsection
