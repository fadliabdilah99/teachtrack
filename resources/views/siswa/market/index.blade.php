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
        <div class="grid grid-cols-3 gap-4 mb-6">
            <!-- materi -->
            <button onclick="materi()"
                class="relative rounded-lg p-4 bg-gradient-to-r from-emerald-500 to-emerald-700 text-white flex items-center group cursor-pointer overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <i
                    class="bi bi-journals text-4xl mr-4 transform group-hover:rotate-12 transition-transform duration-300"></i>
                <span
                    class="font-semibold text-lg relative z-10 group-hover:tracking-wide transition-all duration-300">Materi</span>
                <div
                    class="absolute inset-0 bg-emerald-800 opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-lg">
                </div>
            </button>
            <!-- produk -->
            <button onclick="produk()"
                class="relative rounded-lg p-4 bg-gradient-to-r from-emerald-400 to-emerald-600 text-white flex items-center group cursor-pointer overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <i class="bi bi-bag text-4xl mr-4 transform group-hover:rotate-12 transition-transform duration-300"></i>
                <span
                    class="font-semibold text-lg relative z-10 group-hover:tracking-wide transition-all duration-300">Produk</span>
                <div
                    class="absolute inset-0 bg-emerald-800 opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-lg">
                </div>
            </button>
            <!-- cart -->
            <button onclick="cart()"
                class="relative rounded-lg p-4 bg-gradient-to-r from-emerald-400 to-emerald-600 text-white flex items-center group cursor-pointer overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <i class="bi bi-cart3 text-4xl mr-4 transform group-hover:rotate-12 transition-transform duration-300"></i>
                <span
                    class="font-semibold text-lg relative z-10 group-hover:tracking-wide transition-all duration-300">Cart</span>
                <div
                    class="absolute inset-0 bg-emerald-800 opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-lg">
                </div>
            </button>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 hidden" id="produk">
            @foreach ($barang as $product)
                <div class="filter-card card overflow-hidden {{ $product->kategori->kategori }}">
                    <div class="relative">
                        <a href="javascript:void(0)">
                            <img src="{{ asset('file/produk/' . $product->foto[0]->foto) }}" alt="product_img"
                                class="w-full">
                        </a>
                        <button
                            class="bg-blue-600 w-8 h-8 flex justify-center items-center text-white rounded-full absolute bottom-0 right-0 mr-4 -mb-3"
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
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 hidden" id="materi">
            @foreach ($sell as $materi)
                <div class="card">
                    <img class="w-full" src="https://picsum.photos/300/300/?random" alt="">
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
    </div>
    @foreach ($terjual as $history)
        <div id="popup{{ $history->id }}" class="popup hidden">
            <p>{{ $history->user->name }}</p>
            <p>Membeli {{ $history->materiGuru->judul }}</p>
        </div>
    @endforeach

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


    {{-- menampilkan card materi / produk --}}
    <script>
        // manampilkan materi saat pertama kali di buka
        document.getElementById('materi').classList.remove('hidden');

        function materi() {
            document.getElementById('materi').classList.remove('hidden');
            document.getElementById('produk').classList.add('hidden');
        }

        function produk() {
            document.getElementById('materi').classList.add('hidden');
            document.getElementById('produk').classList.remove('hidden');
        }
    </script>

    {{-- reload produk --}}
    <script>
        function reaload() {
            // Manipulasi elemen sebelum reload (jika memang diperlukan)
            document.getElementById('materi').classList.add('hidden');
            document.getElementById('produk').classList.remove('hidden');

            // Pastikan halaman dimuat ulang setelah semua perubahan selesai
            setTimeout(() => {
                location.reload();
            }, 100); // Memberikan sedikit jeda waktu agar perubahan DOM terlihat sebelum reload
        }
    </script>


    <script>
        $('form[id^="donation_form_"]').submit(function(event) {
            event.preventDefault();

            // Ambil indeks dari ID form
            const formIndex = $(this).attr('id').split('_')[2];

            const pembayaran = $(`#pembayaran_${formIndex}`).val();
            const sellId = $(`#sell_id_${formIndex}`).val();

            console.log("Form submitted");
            console.log("Pembayaran:", pembayaran);
            console.log("Sell ID:", sellId);

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
@endpush
