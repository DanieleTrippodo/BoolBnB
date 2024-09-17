<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo del sito che punta alla home (user.apartments.index) -->
        <a class="navbar-brand" href="{{ route('user.apartments.index') }}">
            <img src="{{ asset('img/Logo_BoolBnB_copy.png') }}" alt="BoolBnB Logo" style="height: 40px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Lato sinistro della navbar -->
            <ul class="navbar-nav me-auto">

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.apartments.index') }}">I tuoi appartamenti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.apartments.create') }}">Crea un nuovo appartamento</a>
                    </li>
                    <!-- Sezione per i messaggi -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.messages.index') }}">Messaggi ricevuti</a>
                    </li>
                @endauth
            </ul>

            <!-- Lato destro della navbar -->
            <ul class="navbar-nav ms-auto">


                <li class="nav-item">
                    <a href="http://localhost:5173" class="btn btn-primary">Sito Guest</a> <!-- Link al sito guest DA CAMBIARE IN BASE ALL'INDIRIZZO LOCALE di npm run dev di Vite del Progetto Vue -->
                </li>
                <!-- Link di autenticazione -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name ?? Auth::user()->email }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Esci') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
