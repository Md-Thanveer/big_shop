<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        
        @guest
        <li class="nav-item">
            <a class="nav-link" href="/login">Login / Register</a>
        </li>
        @endguest
        
        @if (Auth::check())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }} <!-- Display the user's name -->
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('cart.index') }}">cart</a></li>
                    <li><a class="dropdown-item" href="{{ route('order.index') }}">order</a></li>
                    <li><a class="dropdown-item" href="{{ route('home.profile') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>

                    
                </ul>
            </li>
        @endif

    </ul>
</div>
</nav>