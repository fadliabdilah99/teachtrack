@extends('seller.template.main')

@section('title', 'seller-Home')
@push('style')
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
@endpush

@section('content')
<main class="profile-page ">
    <button class="bg-teal-500 text-white px-4 py-2 m-2 rounded-md" onclick="sampul()"><i class="bi bi-pen-fill"></i></button>
    <section class="relative block h-500-px">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
        style="background: {{ $user->seller->sampul ? "url('" . asset('file/seller/' . $user->seller->sampul) . "') center/cover no-repeat" : "url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2710&q=80')" }};">
        </div>
        <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
            style="transform: translateZ(0px)">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>
    <section class="relative py-16 bg-blueGray-200">
        <div class="container mx-auto px-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
                <div class="bg-gray-100">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                            <div class="relative">
                                <img alt="..."
                                    @if (Auth::user()->fotoProfile == null) src="https://via.placeholder.com/150"
                                @else
                                src="{{ asset('file/profile/' . Auth::user()->fotoProfile) }}" @endif
                                    class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                                @if ($id == Auth::user()->id)
                                    <button onclick="showmodalprofile()"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full absolute right-0 top-0 mt-9 mr-5"
                                        type="button">
                                        <i class="bi bi-pen-fill"></i>
                                    </button> @endif
                            </div>
                        </div>

                        <div class="w-full
        lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
    <div class="py-6 px-3 mt-32 sm:mt-0">
        <button
            class="bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
            type="button">
            Connect
        </button>
    </div>
    </div>
    <div class="w-full lg:w-4/12 px-4 lg:order-1 ">
        <div class="flex justify-center py-4 lg:pt-4 pt-8">
            <div class="mr-4 p-3 text-center">
                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">22</span><span
                    class="text-sm text-blueGray-400">Produk</span>
            </div>
            <div class="mr-4 p-3 text-center">
                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">10</span><span
                    class="text-sm text-blueGray-400">Kategori</span>
            </div>
            <div class="lg:mr-4 p-3 text-center">
                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">89</span><span
                    class="text-sm text-blueGray-400">Penjualan</span>
            </div>
        </div>
    </div>
    </div>
    <div class="text-center mt-12 bg-gray-100">
        <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
            {{ $user->seller->namaToko }}
        </h3>
        <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
            owner of {{ $user->seller->owner->name }}
        </div>
        <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
            {{ $user->seller->deskripsi }}
        </div>
        <div class="mb-2 text-blueGray-600 mt-10">
            Postingan
        </div>
        @if ($user->produk->where('pin', 1)->count() != 0)
            <div style="background: {{ $user->seller->pinPict ? "url('" . asset('file/seller/' . $user->seller->pinPict) . "') center/cover no-repeat" : 'rgb(229 231 235)' }};">
                <h1 class="text-2xl font-semibold leading-normal text-blueGray-700  text-start pt-4 px-10 flex items-center">
                    {{ $user->seller->title }}
                    <button class="bg-teal-500 text-white px-2 py-1 rounded-md ml-2" onclick="edittitle()"><i class="bi bi-pen-fill text-sm"></i></button>
                </h1>
                <div class="px-10 pb-10 grid grid-cols-1 xl:grid-cols-4 lg:grid-cols-2 gap-6">
                    @foreach ($user->produk->where('pin', 1) as $prod)
                        <div class="card overflow-hidden">
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
                                        {{-- <span class="text-gray-400 font-medium text-sm opacity-80">
                                            <del>$65</del>
                                        </span> --}}
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
                        </div> @endforeach
                                                </div>
                                                @if (Auth::user()->id == $user->id)
                                                    
                                                <div class="text-end
        pb-5 pr-5">
    <button class="bg-teal-500 text-white px-4 py-2 rounded-md" onclick="pinPict()"><i class="bi bi-pen-fill"></i></button>
    </div>
    @endif
    </div>
    @endif

    </div>
    @include('seller.profile.card')
    </div>
    </div>
    </div>
    </section>
    </main>
    @include('seller.profile.modal')
@endsection

@push('script')
    {{-- modal profile --}}
    <script>
        function showmodalprofile() {
            document.getElementById("modalprofile").classList.remove("hidden");
        }

        function closeModalprofile() {
            document.getElementById("modalprofile").classList.add("hidden");
        }
    </script>

    {{-- modal profile --}}
    <script>
        function edittitle() {
            document.getElementById("modaltitle").classList.remove("hidden");
        }

        function edittitleclose() {
            document.getElementById("modaltitle").classList.add("hidden");
        }
    </script>

    {{-- modal bg pin --}}
    <script>
        function pinPict() {
            document.getElementById("modalpinpict").classList.remove("hidden");
        }

        function pinPictclose() {
            document.getElementById("modalpinpict").classList.add("hidden");
        }
    </script>

    {{-- modal bg sampul --}}
    <script>
        function sampul() {
            document.getElementById("modalsampul").classList.remove("hidden");
        }

        function sampulclose() {
            document.getElementById("modalsampul").classList.add("hidden");
        }
    </script>


    {{-- sortir data sesuai kategori --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua tombol filter
            const filterButtons = document.querySelectorAll('.filter-button');

            // Tambahkan event listener ke setiap tombol filter
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter'); // Dapatkan kategori filter
                    const cards = document.querySelectorAll('.filter-card'); // Ambil semua kartu
                    console.log(filter);
                    // Tampilkan atau sembunyikan kartu berdasarkan filter
                    cards.forEach(card => {
                        if (filter === 'all') {
                            card.style.display = 'block'; // Tampilkan semua kartu
                        } else {
                            if (card.classList.contains(filter)) {
                                card.style.display = 'block'; // Tampilkan kartu yang sesuai
                            } else {
                                card.style.display = 'none'; // Sembunyikan kartu lainnya
                            }
                        }
                    });

                    // Ubah gaya tombol aktif
                    filterButtons.forEach(btn => btn.classList.remove('bg-blue-700'));
                    this.classList.add('bg-blue-700');
                });
            });
        });
    </script>

    {{-- konfirmasi pin --}}
    <script>
        function confirmPin(button) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Produk ini akan dijadikan produk utama",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya yakin'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = button.closest('form');
                    if (form) {
                        form.submit();
                    }
                }
            });
        }
    </script>
@endpush
