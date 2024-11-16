<div id="addmateri" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Tambah pengajar</h2>
            <button onclick="closeModalmateri()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>

        <div class="card">
            <div class="card-body">
                <form id="addmateri" action="{{ route('addmaterirombel') }}" method="POST">
                    @csrf
                    <input type="number" name="rombel_mapel_guru_id" id="rombel_mapel_guru_id" hidden>
                    <input type="number" name="rombel_id" id="rombel_id" hidden>
                    <div class="mb-6">
                        <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Jenis</label>
                        <select type="text" name="materi_guru_id"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                            placeholder="" aria-describedby="hs-input-helper-text">
                            @foreach ($listMateri as $materi)
                                <option value="{{ $materi->id }}">{{ $materi->judul }}</option>
                            @endforeach
                        </select>
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

@foreach ($kelas as $list)
    <div id="modallist{{ $list->id }}"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">list materi kelas</h2>
                <button onclick="closeModallist({{ $list->id }})" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <div class="">
                <div class="card h-full">
                    <div class="card-body">
                        <div class="relative overflow-x-auto">
                            <input type="text" id="searchInputmapel" placeholder="  Search..."
                                class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                                onkeyup="searchTablemapel()" />

                            <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                                <thead>
                                    <tr class="text-sm">
                                        <th scope="col" class="p-4 font-semibold">Materi</th>
                                        <th scope="col" class="p-4 font-semibold">aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTablemapel">
                                    @foreach ($list->materiGuru as $materiGurus)
                                        <tr>
                                            <td class="p-4 text-sm">
                                                <div class="flex gap-6 items-center">
                                                    <div class="flex flex-col gap-1 text-gray-500">
                                                        <h3 class="font-bold">
                                                            {{ $materiGurus->judul }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                <button
                                                    class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                                        class="bi bi-trash font-bold "></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endforeach
