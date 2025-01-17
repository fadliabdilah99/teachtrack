@extends('siswa.template.main')

@section('title', 'Siswa-Pesanan')

@push('style')
    <style>
        .bg-white {
            background-color: #fafbf6;
        }
    </style>
@endpush

@section('content')
    <section class="">
        <p class="text-sm font-light px-16 py-5 text-slate-500">
            <a href="{{route('pesanan')}}" class="text-blue-500 hover:underline">pesanan</a>
            <span class="mx-1">/</span>
            <span class="text-slate-700">invoice</span>
        </p>
        <div class="max-w-5xl mx-auto py-16 bg-white">
            <article class="overflow-hidden">
                <div class="bg-[white] rounded-b-md">
                    <div class="px-9">
                        <div class="space-y-6 text-slate-700">
                            <p class="text-xl font-extrabold tracking-tight uppercase font-body">
                                {{ $pesanan->cart[0]->produk->user->name }}
                            </p>
                        </div>
                    </div>
                    <div class="p-9">
                        <div class="flex w-full">
                            <div class="grid grid-cols-4 gap-12">
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">
                                        pengirim:
                                    </p>
                                    <p>toko: {{$pesanan->cart[0]->produk->user->seller->namaToko}}</p>
                                    <p>owner: {{$pesanan->cart[0]->produk->user->name}}</p>
                                    <p>NIS: {{$pesanan->cart[0]->produk->user->NoUnik}}</p>
                                </div>
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">Penerima</p>
                                    <p>{{$pesanan->cart[0]->user->name}}</p>
                                    <p>Tesla Street 007</p>
                                    <p>Frisco</p>
                                    <p>CA 0000</p>
                                </div>
                                <div class="text-sm font-light text-slate-500">
                                    <p class="text-sm font-normal text-slate-700">Invoice Number</p>
                                    <p>#{{$pesanan->kode}}</p>

                                    <p class="mt-2 text-sm font-normal text-slate-700">
                                        Date of Issue
                                    </p>
                                    <p>{{$pesanan->created_at->format('H:i:s')}}</p>
                                </div>
                                <div class="text-sm font-light text-slate-500">
                                    <p class="mt-2 text-sm font-normal text-slate-700">Due</p>
                                    <p>{{$pesanan->created_at->format('d-m-Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-9">
                        <div class="flex flex-col mx-0 mt-8">
                            <table class="min-w-full divide-y divide-slate-500">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-normal text-slate-700 sm:pl-6 md:pl-0">
                                            Description
                                        </th>
                                        <th scope="col"
                                            class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                                            Quantity
                                        </th>
                                        <th scope="col"
                                            class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                                            Rate
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pl-3 pr-4 text-right text-sm font-normal text-slate-700 sm:pr-6 md:pr-0">
                                            Amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($pesanan->cart as $produk)
                                        <tr class="border-b border-slate-200">
                                            <td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0">
                                                <div class="font-medium text-slate-700">{{$produk->produk->judul}}</div>
                                                <div class="mt-0.5 text-slate-500 ">
                                                    {{-- }} --}}
                                                </div>
                                            </td>
                                            <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                                {{ $qty = $produk->qty }}
                                            </td>
                                            <td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">
                                               Rp. {{ $harga = $produk->produk->harga }}
                                            </td>
                                            <td class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                               Rp. {{ number_format($total = $qty * $harga) }}
                                            </td>
                                            @php
                                                $subtotal += $total
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <!-- Here you can write more products/tasks that you want to charge for-->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row" colspan="3"
                                            class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                            Subtotal
                                        </th>
                                        <td class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                           Rp. {{ number_format($subtotal) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3"
                                            class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                            Discount
                                        </th>
                                        <td class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                            0.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3"
                                            class="hidden pt-4 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                            Tax
                                        </th>
                                        <th scope="row"
                                            class="pt-4 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                                            Tax
                                        </th>
                                        <td class="pt-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                            0.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" colspan="3"
                                            class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                                            Total
                                        </th>
                                        <td
                                            class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                                           Rp {{number_format($subtotal)}}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="mt-48 p-9">
                        <div class="border-t pt-9 border-slate-200">
                            <div class="text-sm font-light text-slate-700">
                                <p>
                                  Transaksi di awasi langsung oleh pihak PKK. Jika terdapat kendala atau masalah, silahkan menghubungi pihak PKK.                               </p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
@endsection

@push('script')
@endpush
