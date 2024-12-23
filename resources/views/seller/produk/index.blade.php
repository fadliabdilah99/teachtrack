@extends('seller.template.main')

@section('title', 'seller-Produk')

@section('content')
<button onclick="modalproduk()" class="btn text-base py-2.5 text-white font-medium w-fit  hover:bg-blue-700"><i class="ti ti-plus "></i></button>
    <div class="grid grid-cols-1 xl:grid-cols-4 lg:grid-cols-2 gap-6">
        <div class="card overflow-hidden">
            <div class="relative">
                <a href="javascript:void(0)">
                    <img src="/assets/images/products/product-1.jpg" alt="product_img" class="w-full" />
                </a>
                <a href="javascript:void(0)"
                    class="bg-blue-600 w-8 h-8 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3">
                    <i class="ti ti-basket text-base"></i>
                </a>
            </div>
            <div class="card-body">
                <h6 class="text-base font-semibold text-gray-500 mb-1">Boat Headphone</h6>
                <div class="flex justify-between">
                    <div class="flex gap-2 items-center">
                        <h6 class="text-gray-500 font-semibold text-base">$50</h6>
                        <span class="text-gray-400 font-medium text-sm opacity-80">
                            <del>$65</del>
                        </span>
                    </div>
                    <ul class="list-none flex gap-1">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star-filled text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star-filled text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star-filled text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ti ti-star text-yellow-500 text-sm"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('seller.produk.modal')
    @push('script')
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
