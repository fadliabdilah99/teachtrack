@extends('siswa.template.main')

@section('title', 'Siswa-Market')

@push('style')
@endpush

@section('content')
<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($sell as $product)
    <div class="card">
        <img class="w-full" src="https://picsum.photos/300/300/?random" alt="">
        <div class="p-4">
            <h2 class="text-lg font-bold">{{$product->materiGuru->judul}}</h2>
            <p class="text-sm text-gray-500">Rekomendasi {{ $product->materiGuru->gurumapel->mapel->jenis }}</p>
            <p class="text-sm text-gray-500">pelajaran {{ $product->materiGuru->gurumapel->mapel->pelajaran }}</p>
            <p class="text-sm text-gray-500">Dibuat oleh: {{$product->materiGuru->user->name}}</p>
            <p class="text-lg font-bold">Rp. {{number_format($product->harga)}}</p>
            <button class="mt-2 w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Beli
            </button>
        </div>
    </div>
    @endforeach
@endSection

@push('script')
@endpush
