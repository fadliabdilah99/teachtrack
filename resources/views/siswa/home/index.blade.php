@extends('siswa.template.main')

@section('title', 'Siswa-Home')

@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .slider-container {
            position: relative;
            overflow: hidden;
            height: 2rem;
            /* Pastikan sesuai dengan tinggi teks */
            display: flex;
            align-items: center;
        }

        .slider-words {
            display: flex;
            flex-direction: column;
            animation: slide-up 8s ease-in-out infinite;
        }

        .slider-words span {
            display: block;
            height: 2rem;
            line-height: 2rem;
            text-align: left;
        }

        @keyframes slide-up {
            0% {
                transform: translateY(0);
            }

            33% {
                transform: translateY(-2rem);
            }

            66% {
                transform: translateY(-4rem);
            }

            100% {
                transform: translateY(0);
            }

        }
    </style>
@endpush

@section('content')




    <div class="min-h-screen bg-gray-100 p-6">
        <!-- Dashboard Cards -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-green-500 rounded-lg p-4 flex items-center text-white">
                <i class="ti ti-layout-dashboard text-3xl mr-3"></i>
                <span class="font-semibold text-lg">Dashboard Kelas</span>
            </div>
            <div class="bg-pink-400 rounded-lg p-4 flex items-center text-white">
                <i class="ti ti-trophy text-3xl mr-3"></i>
                <span class="font-semibold text-lg">Achievement</span>
            </div>
            <div class="bg-yellow-400 rounded-lg p-4 flex items-center text-white">
                <i class="ti ti-star text-3xl mr-3"></i>
                <div class="slider-container overflow-hidden">
                    <div class="slider-words">
                        <span class="font-semibold text-lg">Achievements</span>
                        <span class="font-semibold text-lg"></span>
                        <span class="font-semibold text-lg">Nilai Tertinggi</span>
                        <span
                            class="font-semibold text-lg">{{ $kelasRank->kelas . ' ' . $kelasRank->jurusan->jurusan . ' ' . $kelasRank->jurusan->no }}
                            nilai {{ $kelasRank->rataRataNilai }}</span>
                        <span class="font-semibold text-lg">{{ $siswaNilaiTertinggi->name }} nilai
                            {{ $siswaNilaiTertinggi->tes }}</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- konten sosial media -->
        <div class="flex gap-6">

            <div class="w-2/3">
                @foreach ($postingan as $post)
                    <div class="mb-6">
                        <div class="bg-white rounded-lg shadow-lg p-4">
                            <!-- Informasi Post -->
                            <div class="flex items-center mb-4">
                                <img @if ($post->user->fotoProfile == null) src="https://via.placeholder.com/40"
                                @else
                                src="{{ asset('file/profile/' . $post->user->fotoProfile) }}" @endif
                                    alt="User Avatar" class="w-10 h-10 rounded-full mr-3">
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
                                            <img @if ($post->user->fotoProfile == null) src="https://via.placeholder.com/40"
                                            @else
                                            src="{{ asset('file/profile/' . $post->user->fotoProfile) }}" @endif
                                                alt="User Avatar" class="w-10 h-10 rounded-full mr-3">
                                            <div>
                                                <p class="text-sm text-gray-800">
                                                    <span
                                                        class="font-semibold">{{ $post->comments->first()->user->name }}</span>
                                                    {{ $post->comments->first()->created_at->diffForHumans() }}
                                                </p>
                                                <p class="text-gray-600">{{ $post->comments->first()->content }}</p>
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
                                                <img @if ($comment->user->fotoProfile == null) src="https://via.placeholder.com/40"
                                                @else
                                                src="{{ asset('file/profile/' . $comment->user->fotoProfile) }}" @endif
                                                    alt="User Avatar" class="w-10 h-10 rounded-full mr-3">
                                                <div>
                                                    <p class="text-sm text-gray-800">
                                                        <span class="font-semibold">{{ $comment->user->name }}</span>
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


            <!-- Sidebar Section -->
            <div class="w-1/3">
                <button onclick="openModalpost()"
                    class="w-full bg-green-500 text-white font-semibold py-2 rounded-lg mb-6 hover:bg-green-600 transition">
                    + Buat Postingan
                </button>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-bold mb-4">Jadwal Pelajaran</h3>
                    @foreach ($groupedByHari as $hari => $jadwals)
                        <h4 class="text-gray-500 text-lg font-semibold mb-5">{{ $hari }}</h4>
                        <ul class="timeline-widget relative">
                            @foreach ($jadwals as $jadwal)
                                <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                                    <div class="timeline-time text-gray-500 min-w-[90px] py-[6px] text-sm pr-4 text-end">
                                        jam ke {{ $jadwal->dari }} - {{ $jadwal->sampai }}
                                    </div>
                                    <div class="timeline-badge-wrap flex flex-col items-center">
                                        <div
                                            class="timeline-badge w-3 h-3 rounded-full shrink-0 border-2 bg-blue-300 border-blue-300 my-[10px]">
                                        </div>
                                        <div class="timeline-badge-border block h-full w-[1px] bg-gray-100"></div>
                                    </div>
                                    <div class="timeline-desc py-[6px] px-4 text-sm">
                                        <p class="text-gray-500 font-semibold"></p>
                                        <a href="javascript:void(0)" class="text-blue-600">
                                            {{ $jadwal->guruMapel->mapel->pelajaran }} -
                                            {{ $jadwal->guruMapel->user->name }}
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @include('siswa.home.modal')

@endSection

@push('script')
    {{-- modal tambah postingan --}}
    <script>
        function openModalpost() {
            document.getElementById("modalpost").classList.remove("hidden");
        }

        function closemodalpost() {
            document.getElementById("modalpost").classList.add("hidden");
        }
    </script>

    {{-- like function --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.like-btn', function() {
            let button = $(this);
            let postId = button.data('post-id');
            let icon = button.find('i');

            $.ajax({
                url: `/post/${postId}/like`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Update icon
                    if (response.status === 'liked') {
                        icon.removeClass('bi-hand-thumbs-up').addClass('bi-hand-thumbs-up-fill');
                    } else {
                        icon.removeClass('bi-hand-thumbs-up-fill').addClass('bi-hand-thumbs-up');
                    }

                    // Update like count
                    button.siblings('.likes-count').text(response.likes_count);
                },
                error: function(err) {
                    console.error(err);
                }
            });
        });
    </script>


    {{-- komentar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const commentForms = document.querySelectorAll('.comment-form');

            commentForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const postId = form.getAttribute('data-post-id');
                    const input = form.querySelector('input[name="komentar"]');
                    const commentContent = input.value;
                    console.log(commentContent);
                    console.log(postId);


                    if (commentContent.trim() === '') return;

                    // Kirim AJAX Request
                    fetch(`/comments/${postId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                komentar: commentContent
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const commentsList = document.getElementById(
                                    `comments-list-${postId}`);
                                const commentCount = document.getElementById(
                                    `comment-count-${postId}`);

                                const newComment = `
                            <div class="flex items-start">
                                <img src="https://via.placeholder.com/30" alt="User Avatar" class="w-8 h-8 rounded-full mr-3">
                                <div>
                                    <p class="text-sm text-gray-800">
                                        <span class="font-semibold">${data.user.name}</span>
                                        Baru Saja
                                    </p>
                                    <p class="text-gray-600">${data.comment.content}</p>
                                </div>
                            </div>
                        `;

                                commentsList.insertAdjacentHTML('beforeend', newComment);

                                commentCount.textContent = parseInt(commentCount.textContent) +
                                    1;

                                input.value = '';
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>

    {{-- hidden dan tampilkan komentar --}}
    <script>
        function toggleComments(postId) {
            const commentsDiv = document.getElementById(`all-comments-${postId}`);
            commentsDiv.classList.toggle('hidden');
        }
    </script>
@endpush
