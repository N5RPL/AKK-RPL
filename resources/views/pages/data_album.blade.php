@extends('layouts.app')

@section('content')
    <div class="my-5 d-flex flex-column align-items-center">
        <div class="container">
            <div class="row">
                <div class="d-flex ">
                    <div class="w-75 row ">
                        @foreach ($photos as $photo)
                            <a href="{{ route('photo.index', $photo->id) }}" class="m-1 col-4 w-25 ratio ratio-1x1">
                                <div class="image"
                                    style="background: url({{ asset('storage/' . $photo->lokasi_file) }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
