@extends('siswa.template.main')

@section('title', 'view-produk')

@push('style')
@endpush

@section('content')
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="flex items-center">
            <li>
                <a href="{{ route('shop') }}" class="text-gray-600 hover:text-gray-900">Market/</a>
            </li>
            <li>
                <a href="/siswa/market" class="text-gray-600 hover:text-gray-900">{{$produks->judul}}</a>
            </li>
        </ol>
    </nav>
    <div class="bg-white">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-wrap -mx-4">
                <!-- Product Images -->
                <div class="w-full md:w-1/2 px-4 mb-8">
                    <img src="{{ asset('file/produk/' . $produks->foto[0]->foto) }}" alt="Product"
                        class="w-full h-auto rounded-lg shadow-md mb-4" id="mainImage">
                    <div class="flex gap-4 py-4 justify-center overflow-x-auto">
                        @foreach ($produks->foto as $fotoProduk)
                            <img src="{{ asset('file/produk/' . $fotoProduk->foto) }}" alt="Thumbnail 1"
                                class="size-16 sm:size-20 object-cover rounded-md cursor-pointer opacity-60 hover:opacity-100 transition duration-300"
                                onclick="changeImage(this.src)">
                        @endforeach
                    </div>
                </div>

                <!-- Product Details -->
                <div class="w-full md:w-1/2 px-4">
                    <h2 class="text-3xl font-bold mb-2">{{ $produks->judul }}</h2>
                    <div class="flex gap-6 py-6 items-center">
                        <div class="h-20 w-20 inline-block"><img
                                src="{{ asset('file/profile/' . $produks->user->seller->user->fotoProfile) }}"
                                alt="" class="rounded-full w-100"></div>
                        <div class="flex flex-col gap-1 text-gray-500">
                            <h3 class="font-bold">{{ $produks->user->seller->namaToko }}</h3>
                            <span class="font-normal">Owner: {{ $produks->user->seller->owner->name }}</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="text-2xl font-bold mr-2">Rp. {{ number_format($produks->harga) }}</span>
                        {{-- <span class="text-gray-500 line-through">$399.99</span> --}}
                    </div>
                    <div class="flex items-center mb-4">
                        <span class=" text-gray-600">Terjual {{ $produks->cart->count() }}</span>
                    </div>
                    <p class="text-gray-700 mb-6">{{ $produks->deskripsi }}</p>


                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">jenis:</h3>
                        <div class="flex space-x-2">
                            <button
                                class="w-8 h-8 bg-black rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black"></button>
                            <button
                                class="w-8 h-8 bg-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"></button>
                            <button
                                class="w-8 h-8 bg-blue-500 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"></button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1"
                            class="w-12 text-center rounded-md border-gray-300  shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="flex space-x-4 mb-6">
                        <button
                            class="bg-indigo-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function changeImage(src) {
                document.getElementById('mainImage').src = src;
            }
        </script>
    </div>
@endSection

@push('script')
@endpush
