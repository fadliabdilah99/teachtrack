<div id="modal-transfer" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Transfer</h2>
            <button onclick="closeModaltransefer()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{ route('transfer') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">NIS Tujuan</label>
                <input type="Number" name="user_id"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Nominal</label>
                <input type="Number" name="nominal" max="{{ $nominal }}"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">keterangan</label>
                <textarea name="keterangan"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                    placeholder="" aria-describedby="hs-input-helper-text">transfer</textarea>
            </div>
            <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Transfer</button>
            <button type="button" onclick="closeModaltransefer()"
                class="btn text-base py-2.5 text-white font-medium w-fit bg-gray-500 hover:bg-gray-700">close</button>
        </form>
    </div>
</div>
