@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="w-25 my-5 rounded p-4 shadow-lg">
            <h2 class="text-center mb-5">POST PHOTO</h2>
            <form action="{{ route('photo.postProcess') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <input class="form-control" type="file" id="photo" accept="image/jpg,image/jpeg,image/png" name="photo" aria-label="photo upload">
                    @error('photo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="judul_foto" class="form-label">Judul Foto</label>
                    <input type="text" class="form-control" name="judul_foto" id="judul_foto"
                        placeholder="Judul Foto...">
                    @error('judul_foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi_foto" class="form-label">Deskripsi Foto</label>
                    <textarea name="deskripsi_foto" class="form-control" id="deskripsi_foto" rows="10"></textarea>
                    @error('deskripsi_foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="d-flex justify-content-center mb-2">
                    <button type="submit" class="btn btn-primary w-100">POST</button>
                </div>

            </form>
        </div>
    </div>
@endsection
