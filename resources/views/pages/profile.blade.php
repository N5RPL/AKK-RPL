@extends('layouts.app')

@section('content')
    <div class="my-5 d-flex flex-column align-items-center">
        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://dummyimage.com/640x1:1/' }}"
            alt="profile-picture" width="200" height="200" class="mb-2 d-block"
            style="object-fit: cover; border-radius: 100%" />
        <div class="d-flex align-items-center gap-2">
            <p class="fs-2 fw-semibold text-center">{{ $user->nama }}</p>
            <svg data-bs-toggle="modal" data-bs-target="#editProfileModal" xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16" style="cursor: pointer">
                <path
                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd"
                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
            </svg>
            <!-- Modal -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="avatar" class="form-label">Avatar</label>
                                    <input type="file" name="avatar" id="avatar" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="{{ Auth::user()->nama }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-muted fs-6">Register at: {{ date('d-m-Y', strtotime($user->created_at)) }}</p>
    </div>
    <div class="d-flex justify-content-center">
        <div class="w-75 row justify-content-center">
            @foreach ($photos as $photo)
                <a href="{{ route('photo.index', $photo->id) }}" class="m-1 col-4 w-25 ratio ratio-1x1">
                    <div class="image"
                        style="background: url({{ asset('storage/' . $photo->lokasi_file) }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
