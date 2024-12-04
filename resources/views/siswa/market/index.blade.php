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
                    <h2 class="text-lg font-bold">{{ $product->materiGuru->judul }}</h2>
                    <p class="text-sm text-gray-500">Rekomendasi {{ $product->materiGuru->gurumapel->mapel->jenis }}</p>
                    <p class="text-sm text-gray-500">pelajaran {{ $product->materiGuru->gurumapel->mapel->pelajaran }}</p>
                    <p class="text-sm text-gray-500">Dibuat oleh: {{ $product->materiGuru->user->name }}</p>
                    <p class="text-lg font-bold">Rp. {{ number_format($product->harga) }}</p>

                    <div class="flex justify-between space-x-4">
                        <form action="#" id="donation_form">
                            <input type="number" name="pembayaran" id="pembayaran" value="{{ $product->harga }}" hidden>
                            <input type="number" name="sell_id" id="sell_id" value="{{ $product->id }}" hidden>
                            @if ($product->pembeli->where('user_id', Auth::user()->id)->count() > 0)
                                <p class="text-sm text-green-500"> <i class="bi bi-check-circle"></i> Sudah di beli</p>
                            @else
                                <button class="btn btn-success" type="submit">Bayar</button>
                            @endif
                        </form>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="bi bi-people-fill mr-1"></i>
                            <span>{{ $product->pembeli->count() }} terjual</span>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    @endSection

    @push('script')
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script
            src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



        <script>
            $("#donation_form").submit(function(event) {
                console.log("Form submitted");
                event.preventDefault();
                console.log("Pembayaran:", $('#pembayaran').val());
                console.log("Sell ID:", $('#sell_id').val());

                $.post("/donation", {
                        _method: 'POST',
                        _token: '{{ csrf_token() }}',
                        pembayaran: $('#pembayaran').val(),
                        sell_id: $('#sell_id').val(),
                    },
                    function(data, status) {
                        console.log("Response Data:", data);
                        console.log("Status:", status);
                        snap.pay(data.snap_token, {
                            // Optional
                            onSuccess: function(result) {
                                console.log("Payment Success:", result);
                                location.reload();
                            },
                            // Optional
                            onPending: function(result) {
                                console.log("Payment Pending:", result);
                                location.reload();
                            },
                            // Optional
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
    @endpush
