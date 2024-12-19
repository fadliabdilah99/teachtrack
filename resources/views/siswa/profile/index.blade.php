@extends('siswa.template.main')

@section('title', 'Siswa-Profile')

@push('style')
@endpush

@section('content')
    <!-- component -->


    <main class="profile-page">
        <section class="relative block h-500-px">
            <div class="absolute top-0 w-full h-full bg-center bg-cover"
                style="
            background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2710&amp;q=80');
          ">
                <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
            </div>
            <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
                style="transform: translateZ(0px)">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                    version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>
        <section class="relative py-16 bg-blueGray-200">
            <div class="container mx-auto px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="relative">
                                    <img alt="..."
                                        src="https://demos.creative-tim.com/notus-js/assets/img/team-2-800x800.jpg"
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="py-6 px-3 mt-32 sm:mt-0">
                                    <button
                                        class="bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150"
                                        type="button">
                                        Connect
                                    </button>
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                    <div class="mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">22</span><span
                                            class="text-sm text-blueGray-400">Friends</span>
                                    </div>
                                    <div class="mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">10</span><span
                                            class="text-sm text-blueGray-400">Photos</span>
                                    </div>
                                    <div class="lg:mr-4 p-3 text-center">
                                        <span
                                            class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">89</span><span
                                            class="text-sm text-blueGray-400">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-12">
                            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                              {{ $user->name }}
                            </h3>
                            <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                                {{ $user->rombel->kelas . ' ' . $user->rombel->jurusan->jurusan . ' ' . $user->rombel->jurusan->no }}
                            </div>
                            <div class="mb-2 text-blueGray-600 mt-10">
                                Postingan
                            </div>
                        </div>
                        <div class="w-full ">
                            @foreach ($user->post as $post)
                                <div class="mb-6">
                                    <div class="bg-white rounded-lg shadow-lg p-4">
                                        <!-- Informasi Post -->
                                        <div class="flex items-center mb-4">
                                            <img src="https://via.placeholder.com/40" alt="User Avatar"
                                                class="w-10 h-10 rounded-full mr-3">
                                            <div>
                                                <h3 class="font-semibold">{{ $post->user->name }}</h3>
                                                <p class="text-sm text-gray-500">
                                                    {{ $post->user->rombel->kelas . ' ' . $post->user->rombel->jurusan->jurusan . ' ' . $post->user->rombel->jurusan->no }}
                                                    • {{ $post->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Konten Post -->
                                        <h4 class="text-xl text-gray-800 mb-2">{{ $post->konten }}</h4>
                                        @foreach ($post->fotopost as $foto)
                                            <img src="{{ asset('file/sosmed/' . $foto->foto) }}" alt="Thread Image"
                                                class="w-full h-60 object-cover rounded-lg mb-4">
                                        @endforeach

                                        <!-- Likes, Comments, and Save Actions -->
                                        <div class="flex items-center text-gray-500 text-sm">
                                            <div class="flex items-center mr-4" id="post-{{ $post->id }}">
                                                <span class="likes-count">{{ $post->likes->count() }}</span>
                                                <button class="like-btn" data-post-id="{{ $post->id }}"
                                                    data-liked="{{ $post->likes->contains('user_id', auth()->id()) ? 'true' : 'false' }}">
                                                    <i
                                                        class="{{ $post->likes->contains('user_id', auth()->id()) ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }}"></i>
                                                </button>
                                            </div>
                                            <span class="flex items-center mr-4">
                                                <i class="ti ti-message mr-1"></i> {{ $post->comments->count() }} Komentar
                                            </span>
                                            <span class="flex items-center">
                                                <i class="ti ti-bookmark mr-1"></i> Simpan
                                            </span>
                                        </div>

                                        <!-- Komentar -->
                                        <!-- Komentar -->
                                        <div class="mt-4">
                                            <h5 class="text-gray-700 font-semibold mb-2">Komentar</h5>

                                            <!-- Form Tambah Komentar -->
                                            <form action="#" method="POST" class="flex items-center mb-4 comment-form"
                                                data-post-id="{{ $post->id }}">
                                                <input type="text" name="komentar" placeholder="Tulis komentar..."
                                                    class="flex-grow px-4 py-2 border rounded-l-lg focus:outline-none focus:ring focus:ring-blue-300"
                                                    required>
                                                <button type="submit"
                                                    class="bg-blue-500 text-white px-4 py-2 rounded-r-lg hover:bg-blue-600 transition">
                                                    Kirim
                                                </button>
                                            </form>

                                            <!-- List Komentar -->
                                            <div id="comments-list-{{ $post->id }}" class="space-y-4">
                                                <!-- Tampilkan Komentar Teratas -->
                                                @if ($post->comments->count() > 0)
                                                    <div class="flex items-start">
                                                        <img src="https://via.placeholder.com/30" alt="User Avatar"
                                                            class="w-8 h-8 rounded-full mr-3">
                                                        <div>
                                                            <p class="text-sm text-gray-800">
                                                                <span
                                                                    class="font-semibold">{{ $post->comments->first()->user->name }}</span>
                                                                {{ $post->comments->first()->created_at->diffForHumans() }}
                                                            </p>
                                                            <p class="text-gray-600">
                                                                {{ $post->comments->first()->content }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- Tombol Tampilkan Semua Komentar -->
                                                <button onclick="toggleComments('{{ $post->id }}')"
                                                    class="text-blue-500 hover:underline">
                                                    Tampilkan Semua Komentar
                                                </button>

                                                <!-- Semua Komentar (Dropdown) -->
                                                <div id="all-comments-{{ $post->id }}" class="hidden space-y-4">
                                                    @foreach ($post->comments as $comment)
                                                        <div class="flex items-start">
                                                            <img src="https://via.placeholder.com/30" alt="User Avatar"
                                                                class="w-8 h-8 rounded-full mr-3">
                                                            <div>
                                                                <p class="text-sm text-gray-800">
                                                                    <span
                                                                        class="font-semibold">{{ $comment->user->name }}</span>
                                                                    {{ $comment->created_at->diffForHumans() }}
                                                                </p>
                                                                <p class="text-gray-600">{{ $comment->content }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <footer class="relative bg-blueGray-200 pt-8 pb-6 mt-8">
                <div class="container mx-auto px-4">
                    <div class="flex flex-wrap items-center md:justify-between justify-center">
                        <div class="w-full md:w-6/12 px-4 mx-auto text-center">
                            <div class="text-sm text-blueGray-500 font-semibold py-1">
                                Made with <a href="https://www.creative-tim.com/product/notus-js"
                                    class="text-blueGray-500 hover:text-gray-800" target="_blank">Notus JS</a> by <a
                                    href="https://www.creative-tim.com" class="text-blueGray-500 hover:text-blueGray-800"
                                    target="_blank"> Creative Tim</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </section>
    </main>

@endsection

@push('script')
@endpush
