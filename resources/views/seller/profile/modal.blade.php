<div id="modalprofile" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Foto profile</h2>
            <button onclick="closeModalprofile()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-file" type="file" name="foto" class="hidden" />
                    <button type="submit"
                        class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Upload</button>
                </label>
            </div>
        </form>
    </div>
</div>


<div id="modalpinpict" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">sampul</h2>
            <button onclick="pinPictclose()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{ route('update-bg-pin') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file2"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-file2" type="file" name="pinPict" class="hidden" />
                    <button type="submit"
                        class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Upload</button>
                </label>
            </div>
        </form>
    </div>
</div>


<div id="modalsampul" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Sampul</h2>
            <button onclick="sampulclose()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{ route('update-sampul') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file3"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-file3" type="file" name="sampul" class="hidden" />
                    <button type="submit"
                        class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Upload</button>
                </label>
            </div>
        </form>
    </div>
</div>

<div id="modaltitle" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
        <!-- Header Modal -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Ubah judul</h2>
            <button onclick="edittitleclose()" class="text-gray-400 hover:text-gray-600">&times;</button>
        </div>
        <form action="{{ route('update-title') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Judul</label>
                <input type="text" name="title"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                    placeholder="" aria-describedby="hs-input-helper-text">
            </div>
            <button type="submit"
                class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700">Simpan</button>
            <button type="button" onclick="edittitleclose()"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-full mr-2">Cancel</button>
        </form>
    </div>
</div>
