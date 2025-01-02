<div id="bottomModal"
    class="fixed inset-0 z-50  bg-gray-800 bg-opacity-50 flex justify-center items-end invisible opacity-0 transition-opacity duration-300">
    <!-- Modal Content -->
    <div
        class="bg-white w-full md:w-3/4 lg:w-2/3 rounded-t-lg shadow-lg transform translate-y-full transition-transform duration-300">
        <div class="flex flex-col md:flex-row">
            <!-- Left Side (Image) -->
            <div class="w-full md:w-1/2 h-64 md:h-auto rounded-t-lg md:rounded-t-none md:rounded-l-lg">
                <img src="https://source.unsplash.com/400x400/?nature" id="foto"
                    class="h-full w-full object-cover rounded-t-lg md:rounded-t-none md:rounded-l-lg" />
            </div>

            <!-- Right Side (Form) -->
            <div class="w-full md:w-1/2 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Masukan Keranjang</h2>
                <form class="space-y-4" action="{{ route('add-to-cart') }}" method="POST">
                    @csrf
                    <input type="number" hidden name="produk_id" id="produk_id">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700">nama</label>
                            <input type="text" disabled id="judul"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Your Name" />
                        </div>
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700">harga</label>
                            <input type="text" disabled id="harga"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Your Name" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="stok" class="block text-sm font-medium text-gray-700">stok</label>
                            <input type="text" disabled id="stok"
                                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Your Name" />
                        </div>
                        <div>
                            <label for="qty" class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" name="qty" id="qty"
                               value="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                            onclick="modalcart()">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"><i
                                class="bi bi-cart-plus"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
