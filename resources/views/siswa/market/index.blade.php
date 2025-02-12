@extends('siswa.template.main')

@section('title', 'Siswa-Market')

@push('style')
    <style>
        .popup {
            position: fixed;
            bottom: 4rem;
            right: 4rem;
            background-color: white;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            transform: translateX(100%);
            /* Awalnya di luar layar */
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
            opacity: 0;
        }

        .popup.show {
            transform: translateX(0);
            /* Muncul dari kanan ke posisi normal */
            opacity: 1;
        }

        .popup.hide {
            transform: translateX(-100%);
            /* Keluar ke kiri layar */
            opacity: 0;
        }
    </style>
@endpush

@section('content')
    <div style="height: 120vh">
        {{-- button --}}
        <div class="grid grid-cols-3 gap-4 mb-6">
            <!-- materi -->
            <button onclick="materi()"
                class="relative rounded-lg p-4 bg-gradient-to-r from-blue-500 to-blue-700 text-white flex items-center group cursor-pointer overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <i
                    class="bi bi-journals text-4xl mr-4 transform group-hover:rotate-12 transition-transform duration-300"></i>
                <span
                    class="font-semibold text-lg relative z-10 group-hover:tracking-wide transition-all duration-300">Materi</span>
                <div
                    class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-lg">
                </div>
            </button>
            <!-- produk -->
            <button onclick="produk()"
                class="relative rounded-lg p-4 bg-gradient-to-r from-blue-400 to-blue-600 text-white flex items-center group cursor-pointer overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <i class="bi bi-bag text-4xl mr-4 transform group-hover:rotate-12 transition-transform duration-300"></i>
                <span
                    class="font-semibold text-lg relative z-10 group-hover:tracking-wide transition-all duration-300">Produk</span>
                <div
                    class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-lg">
                </div>
            </button>
            <!-- cart -->
            <button onclick="cart()"
                class="relative rounded-lg p-4 bg-gradient-to-r from-blue-400 to-blue-600 text-white flex items-center group cursor-pointer overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="absolute top-0 left-0 z-10 m-1 text-white bg-red-700 rounded-full px-2 text-sm">
                    {{ Auth::user()->cart->where('status', 'cart')->count() == 0 ? '' : Auth::user()->cart->where('status', 'cart')->count() }}
                </div>
                <i class="bi bi-cart3 text-4xl mr-4 transform group-hover:rotate-12 transition-transform duration-300"></i>
                <span
                    class="font-semibold text-lg relative z-10 group-hover:tracking-wide transition-all duration-300">Cart</span>
                <div
                    class="absolute inset-0 bg-blue-800 opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-lg">
                </div>
            </button>
        </div>
        {{-- produk --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 hidden" id="produk">
            @foreach ($barang as $product)
                <div class="filter-card card overflow-hidden {{ $product->kategori->kategori }}">
                    <div class="relative">
                        <a href="{{ route('viewshop', $product->id) }}">
                            <img src="{{ asset('file/produk/' . $product->foto[0]->foto) }}" alt="product_img"
                                class="w-full">
                        </a>
                        <button
                            class="bg-blue-600 w-10 h-10 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3"
                            onclick="modalcart('{{ $product->id }}','{{ $product->judul }}','{{ $product->harga }}','{{ asset('file/produk/' . $product->foto[0]->foto) }}','{{ $product->stok }}')">
                            <i class="bi bi-bag-plus-fill"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <h6 class="text-base font-semibold text-gray-500 mb-1">{{ $product->judul }}</h6>
                        <div class="flex justify-between">
                            <div class="flex gap-2 items-center">
                                <h6 class="text-gray-500 font-semibold text-base">Rp {{ number_format($product->harga) }}
                                </h6>
                            </div>
                            <ul class="list-none flex gap-1">
                                <li><a href="javascript:void(0)"><i
                                            class="ti ti-star-filled text-yellow-500 text-sm"></i></a>
                                </li>
                                <li><a href="javascript:void(0)"><i
                                            class="ti ti-star-filled text-yellow-500 text-sm"></i></a>
                                </li>
                                <li><a href="javascript:void(0)"><i
                                            class="ti ti-star-filled text-yellow-500 text-sm"></i></a>
                                </li>
                                <li><a href="javascript:void(0)"><i class="ti ti-star text-yellow-500 text-sm"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="ti ti-star text-yellow-500 text-sm"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- materi --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 hidden" id="materi">
            @foreach ($sell as $materi)
                <div class="card">
                    <img class="w-full h-48 object-cover" src="{{ asset('assets/images/materi/' . $materi->materiGuru->foto) }}" alt="">
                    <div class="p-4">
                        <h2 class="text-lg font-bold">{{ $materi->materiGuru->judul }}</h2>
                        <p class="text-sm text-gray-500">Rekomendasi {{ $materi->materiGuru->gurumapel->mapel->jenis }}</p>
                        <p class="text-sm text-gray-500">pelajaran {{ $materi->materiGuru->gurumapel->mapel->pelajaran }}
                        </p>
                        <p class="text-sm text-gray-500">Dibuat oleh: {{ $materi->materiGuru->user->name }}</p>
                        <p class="text-lg font-bold">Rp. {{ number_format($materi->harga) }}</p>
                        <div class="flex justify-between space-x-4">
                            <form action="#" id="donation_form_{{ $loop->index }}">
                                <input type="number" name="pembayaran" id="pembayaran_{{ $loop->index }}"
                                    value="{{ $materi->harga }}" hidden>
                                <input type="number" name="sell_id" id="sell_id_{{ $loop->index }}"
                                    value="{{ $materi->id }}" hidden>
                                @if ($materi->pembeli->where('status', 'payment')->where('user_id', Auth::user()->id)->count() > 0)
                                    <p class="text-sm text-green-500"> <i class="bi bi-check-circle"></i> Sudah di beli</p>
                                @else
                                    <button class="btn btn-success" type="submit">Beli</button>
                                @endif
                            </form>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="bi bi-people-fill mr-1"></i>
                                <span>{{ $materi->pembeli->where('status', 'payment')->count() }} terjual</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- cart --}}
        <div class="container mt-5 hidden" id="cart">
            <div class="card h-full" id="kelastable">
                <div class="card-body">
                    <div class="relative overflow-x-auto">
                        <h2 class="mb-4">Shopping Cart</h2>

                        <form id="form-cart" method="POST">
                            @csrf
                            <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                                <thead>
                                    <tr class="text-sm">
                                        <th scope="col" class="p-4 font-semibold">Select</th>
                                        <th scope="col" class="p-4 font-semibold">Nama</th>
                                        <th scope="col" class="p-4 font-semibold">Harga</th>
                                        <th scope="col" class="p-4 font-semibold">Qty</th>
                                        <th scope="col" class="p-4 font-semibold">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTableguru">
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach (Auth::user()->cart->where('status', 'cart') as $carts)
                                        @php
                                            $subtotal = $carts->qty * $carts->produk->harga;
                                            $total += $subtotal;
                                        @endphp
                                        <tr>
                                            <td class=" text-sm flex items-center gap-4">
                                                <input type="checkbox" name="cart_items[]" value="{{ $carts->id }}"
                                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 select-item"
                                                    onchange="updateTotal()">
                                                <div class="flex gap-6 items-center">
                                                    <div class="h-12 w-12 inline-block"><img
                                                            src="{{ $carts->produk->user->fotoProfile == null ? asset('assets/images/profile/user-3.jpg') : asset('file/profile/' . $carts->produk->user->fotoProfile) }}"
                                                            alt="" class="rounded-full w-100"></div>
                                                    <div class="flex flex-col gap-1 text-gray-500">
                                                        <h3 class="font-bold">{{ $carts->produk->user->name }}
                                                        </h3>
                                                        <span
                                                            class="font-normal">{{ $carts->produk->user->NoUnik }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 text-sm">
                                                <div class="flex gap-6 items-center">
                                                    <div class="h-20 w-20 inline-block">
                                                        <img src="{{ asset('file/produk/' . $carts->produk->foto[0]->foto) }}"
                                                            alt="" class="rounded-full w-100" />
                                                    </div>
                                                    <div class="flex flex-col gap-1 text-gray-500">
                                                        <h3 class="font-bold">{{ $carts->produk->judul }}</h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 text-sm">
                                                <div class="flex gap-6 items-center">
                                                    <div class="flex flex-col gap-1 text-gray-500">
                                                        <h3 class="font-bold">
                                                            Rp.{{ number_format($carts->produk->harga) }}</h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 text-sm">
                                                <div class="flex gap-6 items-center">
                                                    <div class="flex flex-col gap-1 text-gray-500">
                                                        <h3 class="font-bold">{{ $carts->qty }}</h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 text-sm">
                                                <div class="flex flex-col gap-1 text-gray-500">
                                                    <h3 class="font-bold">Rp.{{ number_format($subtotal) }}</h3>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="flex flex-col">
                                    <tr>
                                        <td>
                                            <div class="mb-4">
                                                <label for="alamat" class="block text-sm mb-2 text-gray-400">antar ke
                                                    (lingkungan sekolah)</label>
                                                <input type="text" name="alamat" id="alamat"
                                                    value="{{ Auth::user()->rombel->kelas . '-' . Auth::user()->rombel->jurusan->jurusan . ' ' . Auth::user()->rombel->jurusan->no }}"
                                                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0" />
                                            </div>
                                            <div class="mb-4">
                                                <label for="catatan"
                                                    class="block text-sm mb-2 text-gray-400">catatan</label>
                                                <textarea name="catatan" id="catatan" rows="3"
                                                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right font-bold p-4">Total:</td>
                                        <td colspan="2" class="text-left font-bold p-4" id="totalAmount">
                                            Rp.{{ number_format(0) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-center p-4">
                                            <button onclick="checkout()" type="button"
                                                class="btn btn-primary">Checkout</button>
                                        </td>
                                        <td colspan="6" class="text-center p-4">
                                            <button onclick="deleteCart()" type="button"
                                                class="btn btn-primary">Delete</button>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('siswa.market.modal')


@endSection

@push('script')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script
        src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    {{-- chekout/delete --}}
    <script>
        function checkout() {
            document.getElementById('form-cart').action = 'checkout';
            document.getElementById('form-cart').submit();
        }

        function deleteCart() {
            document.getElementById('form-cart').action = 'deleteCart';
            document.getElementById('form-cart').submit();
        }
    </script>

    <script>
        // manampilkan materi saat pertama kali di buka
        document.getElementById('materi').classList.remove('hidden');

        //  menampilkan card materi / produk
        function materi() {
            document.getElementById('materi').classList.remove('hidden');
            document.getElementById('produk').classList.add('hidden');
            document.getElementById('cart').classList.add('hidden');
        }

        // menampilkan halaman produk
        function produk() {
            document.getElementById('materi').classList.add('hidden');
            document.getElementById('produk').classList.remove('hidden');
            document.getElementById('cart').classList.add('hidden');
        }

        // menampilkan halaman cart
        function cart() {
            document.getElementById('cart').classList.remove('hidden');
            document.getElementById('materi').classList.add('hidden');
            document.getElementById('produk').classList.add('hidden');
        }
    </script>



    <script>
        $('form[id^="donation_form_"]').submit(function(event) {
            event.preventDefault();

            // Ambil indeks dari ID form
            const formIndex = $(this).attr('id').split('_')[2];

            const pembayaran = $(`#pembayaran_${formIndex}`).val();
            const sellId = $(`#sell_id_${formIndex}`).val();

            $.post("/donation", {
                    _method: 'POST',
                    _token: '{{ csrf_token() }}',
                    pembayaran: pembayaran,
                    sell_id: sellId,
                },
                function(data, status) {
                    console.log("Response Data:", data);
                    console.log("Status:", status);
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            console.log("Payment Success:", result);
                            location.reload();
                        },
                        onPending: function(result) {
                            console.log("Payment Pending:", result);
                            location.reload();
                        },
                        onError: function(result) {
                            console.log("Payment Error:", result);
                            location.reload();
                        }
                    });
                    return false;
                }
            );
        });


        $('.delete-data').click(function(e) {
            e.preventDefault();
            const data = $(this).closest('tr').find('td:eq(1)').text();
            console.log("Data to delete:", data);
            Swal.fire({
                    title: 'Data akan hilang!',
                    text: `Apakah penghapusan data ${data} akan dilanjutkan?`,
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'Ya',
                    denyButtonText: 'Tidak',
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

    {{-- popup --}}
    <script>
        let currentPopup = 0;
        const popups = [];

        document.querySelectorAll('.popup').forEach((popup) => {
            popups.push(popup.id);
        });

        function showPopup() {
            popups.forEach((id, index) => {
                const popup = document.getElementById(id);
                if (index === currentPopup) {
                    popup.classList.add('show');
                    popup.classList.remove('hide', 'hidden');
                } else {
                    popup.classList.add('hide');
                    setTimeout(() => popup.classList.add('hidden'), 500);
                    popup.classList.remove('show');
                }
            });

            currentPopup = (currentPopup + 1) % popups.length; // Cycle through popups
        }

        // Change popups every 3 seconds
        setInterval(showPopup, 3000);
    </script>

    {{-- fungsi modal bottom --}}
    <script>
        function modalcart(id, judul, harga, foto, stok) {
            document.getElementById('produk_id').value = id;
            document.getElementById('judul').value = judul;
            document.getElementById('harga').value = harga;
            document.getElementById('stok').value = stok;
            document.getElementById('foto').src = foto;
            document.getElementById('qty').max = stok;
            const modal = document.getElementById('bottomModal');
            if (modal.classList.contains('invisible')) {
                modal.classList.remove('invisible', 'opacity-0');
                setTimeout(() => {
                    modal.querySelector('.transform').classList.remove('translate-y-full');
                }, 10);
            } else {
                modal.querySelector('.transform').classList.add('translate-y-full');
                setTimeout(() => {
                    modal.classList.add('invisible', 'opacity-0');
                }, 300);
            }
        }
    </script>


    <script>
        // update total harga
        function updateTotal() {
            const checkboxes = document.querySelectorAll('.select-item');
            let total = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const row = checkbox.closest('tr');
                    const subtotal = row.querySelector('td:nth-child(5) h3').innerText.replace('Rp.', '').replace(
                        ',', '');
                    total += parseFloat(subtotal);
                }
            });

            document.getElementById('totalAmount').innerText = 'Rp.' + total.toLocaleString('id-ID');
        }
    </script>
@endpush
