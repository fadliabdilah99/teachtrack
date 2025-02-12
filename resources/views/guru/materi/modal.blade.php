<div id="addmateri" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Tambah materi</h2>
            <button onclick="closeModalmateri()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>

        <div class="card">
            <div class="card-body">
                <form id="addmateri" action="{{ route('addmateri') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div hidden class="mb-6">
                        <label for="input-label-with-helper-text"
                            class="block text-sm mb-2 text-gray-400">GuruId</label>
                        <input type="Number" name="user_id" value="{{ Auth::user()->id }}"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                            placeholder="" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="mb-6">
                        <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Judul</label>
                        <input type="text" name="judul"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                            placeholder="" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="mb-6">
                        <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">materi
                            mapel</label>
                        <select type="text" name="guru_mapel_id"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                            placeholder="" aria-describedby="hs-input-helper-text">
                            @foreach (Auth::user()->guruMapel as $mapels)
                                <option value="{{ $mapels->id }}">
                                    {{ $mapels->mapel->pelajaran . ' - ' . $mapels->mapel->jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Jenis</label>
                        <select type="text" name="jenis" onchange="showWaktuUjian(this.value)"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                            placeholder="" aria-describedby="hs-input-helper-text">
                            <option value="materi">Materi</option>
                            <option value="ujian">ujian</option>
                        </select>
                    </div>

                    <div class="mb-6 hidden" id="ujian">
                        <label for="input-label-with-helper-text"
                            class="block text-sm mb-2 text-gray-400">Waktu(menit)</label>
                        <input type="text" name="menit"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                            placeholder="" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="mb-6" id="ujian">
                        <label for="input-label-with-helper-text"
                            class="block text-sm mb-2 text-gray-400">Sampul</label>
                        <input type="file" name="foto"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="" aria-describedby="hs-input-helper-text">
                    </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="closeModalmateri()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                        <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700"
                            type="submit">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="sell" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Jual Materi</h2>
            <button onclick="closeModalsell()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('jualmateri') }}" method="POST">
                    @csrf
                    <div hidden class="mb-6">
                        <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">materi guru
                            id</label>
                        <input type="Number" name="materi_guru_id" id="materi_guru_id"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                            placeholder="" aria-describedby="hs-input-helper-text">
                    </div>
                    <div class="mb-6">
                        <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Harga</label>
                        <input type="number" name="harga"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                            placeholder="" aria-describedby="hs-input-helper-text">
                    </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="closeModalsell()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                        <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700"
                            type="submit">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
