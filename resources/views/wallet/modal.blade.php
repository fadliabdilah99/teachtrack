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
        </form>
    </div>
</div>


<div id="modal-TopUp" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Top-Up</h2>
            <button onclick="closeModalTopUp()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form id="topupForm">
            @csrf
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Nominal</label>
                <input type="Number" name="nominal" id="nominal"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" hidden>
            <input type="text" name="email" id="email" value="{{ Auth::user()->email }}" hidden>
            <input type="text" name="number" id="user_id" value="{{ Auth::user()->id }}" hidden>
            <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Top-Up</button>
            <button onclick="closeModalTopUp()" type="button" class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Close</button>
        </form>
    </div>
</div>

<div id="modal-tarik-saldo" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Ajukan Tarik Saldo</h2>
            <button onclick="closeModalTarikSaldo()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{route('tarik-saldo')}}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Bank</label>
                <input type="text" name="bank" id="noRek"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">No Rek</label>
                <input type="Number" name="noRek" id="noRek"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Rekening Atas Nama</label>
                <input type="text" name="nama" id="noRek"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Nominal</label>
                <input type="Number" name="nominal" id="nominal"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                    placeholder="" min="10000" aria-describedby="hs-input-helper-text">
            </div>
            <input type="text" name="number" id="user_id" value="{{ Auth::user()->id }}" hidden>
            <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Ajukan</button>
            <button onclick="closeModalTarikSaldo()" type="button" class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">close</button>
        </form>
    </div>
</div>
