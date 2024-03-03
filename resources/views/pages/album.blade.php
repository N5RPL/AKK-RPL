@extends('layouts.app')

@section('content')
    <div class="my-5 d-flex flex-column align-items-center">
        <div class="container">
            <div class="row">

                @foreach ($albums as $album)
                    <div class="col-3 rounded shadow-lg">

                        <a href="{{ route('album.data_album', $album->id) }}"class="ms-3 mt-3 mb-4 d-flex">
                            <h4 class="card-title">{{ $album->nama_album }}</h4>
                        </a>
                        <h4 class="card-text">{{ $album->deskripsi }}</h4>

                        <h6 class="text-muted fs-6 me-3">{{ date('d-m-Y', strtotime($album->created_at)) }}</h6>
                        <form action="{{ route('album.delete', $album->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn" onclick="return confirm('Apakah anda yakin ingin menghapus Album ini?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg></button>
                        </form>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
