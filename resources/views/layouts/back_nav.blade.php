<header>
    <div class="container navbar-custom pb-1">
        <nav class="navbar navbar-expand-lg">
            <div>
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('template/images/Logo.png') }}" width="295" height="54" class="d-inline-block align-top rounded" alt="青年夢想方舟-職業探索向下扎根">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-list-ul text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav feature-box ml-auto">
                    <li><a href="{{ route('index') }}" class="mr-1 btn btn-round btn-kikyo"><i class="fas fa-angle-double-left"></i>
                            返回前台</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>