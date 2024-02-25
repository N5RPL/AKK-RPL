@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="w-50 my-3 p-1 rounded shadow-lg">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('profile.people', $data->user->id) }}"
                    class="ms-3 mt-3 mb-4 d-flex justify-content-start align-items-center mb-2 text-decoration-none">
                    <img src="{{ $data->user->avatar != null ? asset('storage/' . $data->user->avatar) : 'https://dummyimage.com/640x1:1/' }}"
                        alt="profile-picture" width="50" height="50" style="object-fit: cover; border-radius: 100%">
                    <span class="ms-2 fs-5 text-dark">{{ $data->user->nama }}</span>
                </a>
                <div class="d-flex align-items-center gap-2">
                    @if (Auth::user()->id == $data->user_id)
                        <svg data-bs-toggle="modal" data-bs-target="#editPhoto{{ $data->id }}"
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>

                        <!-- Modal -->
                        <div class="modal fade" id="editPhoto{{ $data->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Foto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('photo.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="judul_foto" class="form-label">Judul Foto</label>
                                                <input type="text" name="judul_foto" id="judul_foto" class="form-control"
                                                    value="{{ $data->judul_foto }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="deskripsi_foto" class="form-label">Deskripsi Foto</label>
                                                <textarea name="deskripsi_foto" id="deskripsi_foto" cols="30" rows="%" class="form-control">{{ $data->deskripsi_foto }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    <p class="text-muted fs-6 me-3">{{ date('d-m-Y', strtotime($data->created_at)) }}</p>
                </div>
            </div>
            <img class="img-fluid mx-auto d-block" src="{{ asset('storage/' . $data->lokasi_file) }}"
                alt="{{ $data->judul_foto }}">
            <div class="p-3 d-flex justify-content-start align-items-center">
                @if ($data->liked_by_user_exists)
                    <form action="{{ route('like_photo.unlike') }}" method="post">
                        @csrf
                        <input type="hidden" name="photo_id" value="{{ $data->id }}">
                        <button class="btn p-0" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                class="bi bi-heart-fill text-danger" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                            </svg>
                        </button>
                    </form>
                @else
                    <form action="{{ route('like_photo.like') }}" method="post">
                        @csrf
                        <input type="hidden" name="photo_id" value="{{ $data->id }}">
                        <button class="btn p-0" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor"
                                class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                            </svg>
                        </button>
                    </form>
                @endif
                <span class="fs-4 ms-2">{{ $data->likes_count }}</span>
            </div>

            <div id="post-detail" class="my-2 ms-3">
                <span class="fw-bold fs-5 d-block">{{ $data->judul_foto }}</span>
                <span class="text-muted fs-6">{{ $data->deskripsi_foto }}</span>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="w-50 my-1 p-1 rounded shadow-lg">
            <ul class="list-group">
                <li class="list-group-item border-start-0 border-end-0 d-flex flex-column">
                    <p class="fs-5 fw-semibold">Komentar</p>
                    <form action="{{ route('comment.post') }}" method="POST">
                        @csrf
                        <input type="hidden" name="photo_id" value="{{ $data->id }}">
                        <div class="input-group">
                            <textarea class="form-control" name="isi_komentar" aria-label="Comment content"></textarea>
                            @error('isi_komentar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <button type="submit" class="input-group-text">Send</button>
                        </div>
                    </form>
                </li>
                @foreach ($data->comments as $comment)
                    <li class="list-group-item border-start-0 border-end-0 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('profile.people', $comment->user->id) }}”
                                class="d-flex
                                justify-content-start align-items-center mb-2 text-decoration-none">
                                <img src="https://dummyimage.com/640x1:1/" alt="profile-picture"
                                    class="img-fluid rounded-circle" width="50">
                                <span class="ms-2 fs-5 text-dark">{{ $comment->user->nama }}</span>
                            </a>
                            <div class="d-flex align-items-center gap-2">
                                @if (Auth::user()->id == $comment->user->id)
                                    <svg data-bs-toggle="modal" data-bs-target="#editComment{{ $comment->id }}"
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editComment{{ $comment->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Komentar</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('comment.update', $comment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label for="isi_komentar" class="form-label">Isi
                                                                Komentar</label>
                                                            <input type="text" name="isi_komentar" id="isi_komentar"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <p class="text-muted fs-6">{{ date('d-m-Y', strtotime($comment->created_at)) }}</p>
                            </div>
                        </div>
                        <span class="text-muted fs-6">
                            {{ $comment->isi_komentar }}
                            @if ($comment->updated_at != $comment->created_at)
                                <span class="text-muted fst-italic">(edited)</span>
                            @endif
                        </span>
                    </li>)
                @endforeach
            </ul>
        </div>
    </div>
@endsection
