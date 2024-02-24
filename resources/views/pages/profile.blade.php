@extends('layouts.app')

@section('content')
    <div class="my-5 d-flex flex-column align-items-center">
        <img src="https://dummyimage.com/640x1:1/" alt="profile-picture" width="200"
            class="img-fluid rounded-circle mb-2 d-block" />
        <p class="fs-2 fw-semibold text-center">{{ $user->nama }}</p>
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
