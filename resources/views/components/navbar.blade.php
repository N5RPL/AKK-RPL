<nav class="navbar navbar-expand-lg bg-primary navbar-dark py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
            @if (!Auth::check())
                <div>
                    <a href="{{ route('login.index') }}" class="btn btn-info text-white">Login</a>
                </div>
            @else
                <div class="dropdown">
                    <a class="btn text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->nama }}
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('photo.post') }}">Post</a></li>
                        <li><a class="dropdown-item" href="{{ route('album.create_album') }}">Create Album</a></li>
                        <li><a class="dropdown-item" href="{{ route('album.index', Auth::user()->id) }}">Album</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>
