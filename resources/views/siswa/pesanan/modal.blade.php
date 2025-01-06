<div id="refund"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden" style="overflow-y: auto;">
    <div class="bg-white rounded-lg shadow-lg w-full md:w-3/4 lg:w-2/4 p-8 max-h-screen overflow-y-auto">
        <div class="card">
            <div class="card-body">
            <form action="{{route('refund')}}" method="POST">
                @csrf
                <input hidden type="number" id="id_pesanan" name="id_pesanan">
                <div>
                    <label for="harga" class="block text-sm  font-medium text-gray-700">Alasan pengembalian</label>
                    <textarea type="text" name="alasan"
                        class="mt-1 w-full p-3 mb-5 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Alasan.."></textarea>
                </div>
                <div class="flex justify-end gap-2">  
                    <button type="button" class="btn refund text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">konfirmasi</button>
                    <button type="button" class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700 bg-red-500" onclick="refundclose()">cancel</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
