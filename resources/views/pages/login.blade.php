@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="w-25 mt-5 rounded p-4 shadow-lg">
            <h1 class="text-center mb-5">Login</h1>
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3 mt-3">Login</button>
                <p class="text-center mb-0">Belum punya akun? <a href="/register" class="text-decoration-none">daftar</a>
                </p>
            </form>
        </div>
    </div>
@endsection
