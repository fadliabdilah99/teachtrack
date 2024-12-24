<div id="modalproduk"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden overflow-y-auto">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6 max-h-[90vh] overflow-y-auto">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Tambah Produk</h2>
            <button onclick="closemodalproduk()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{ route('addproduk') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="number" name="user_id" hidden value="{{ Auth::user()->id }}" id="user_id">
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Nama Produk</label>
                <input type="text" name="judul" id="judul"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Harga</label>
                <input type="number" name="harga" id="harga"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Stok</label>
                <input type="number" name="stok" id="stok"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Kategori</label>
                <select name="kategori_id" id="kategori"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-full">
                <label for="cover-photo" class="block text-sm font-medium text-gray-400">Foto Produk</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                    <div class="text-center">
                        <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm text-gray-600">
                            <label for="file-upload"
                                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                <span>Upload a file</span>
                                <input id="file-upload" name="foto[]" accept="image/*" multiple type="file"
                                    class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-600">PNG, JPG, GIF up to 10MB</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    placeholder="" aria-describedby="hs-input-helper-text"></textarea>
            </div>
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Kode Barang</label>
                <input type="text" name="kode" id="kode"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <button type="submit"
                class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Upload</button>
            <button type="button" onclick="closemodalproduk()"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-full mr-2">Cancel</button>
        </form>
    </div>
</div>
