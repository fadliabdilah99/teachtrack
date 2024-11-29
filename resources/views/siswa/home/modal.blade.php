<div id="modalpost" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-2/4 lg:w-2/2 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Upload postingan</h2>
            <button onclick="closemodalpost()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('posting') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="number" name="user_id" value="{{ Auth::user()->id }}" id="user_id" hidden>
                    <div class="mb-6">
                        <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Teks</label>
                        <textarea type="Number" name="konten" id="konten"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                            placeholder="" aria-describedby="hs-input-helper-text"></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Tambah
                            Foto</label>
                        <input type="file" name="foto[]" multiple accept="image/*"
                            class="block w-full px-4 py-3 text-gray-500 border border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="" aria-describedby="hs-input-helper-text">
                    </div>


                    <div class="flex justify-end">
                        <button type="button" onclick="closemodalpost()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                        <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700"
                            type="submit">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
