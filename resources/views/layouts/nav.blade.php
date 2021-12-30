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
                <i class="fas fa-list-ul"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav feature-box ml-auto">
                    @guest
                    <li class="feature-box-kikyo">
                        <a href="https://gsuite.chc.edu.tw" target="_blank">
                            <div class="feature-box-icon"><i class="fas fa-school"></i></div>國中小申請帳號
                        </a>
                    </li>
                    <li class="feature-box-pink">
                        <a href="{{ route('register') }}" onclick="history.back()">
                            <div class="feature-box-icon"><i class="fas fa-address-card"></i></div>廠商申請帳號
                        </a>
                    </li>
                    <li class="line">｜</li>
                    <li><a href="{{ route('gsuite.login') }}" class="mr-1 btn btn-outline btn-round btn-kikyo"><i class="fas fa-school"></i>
                            國中小登入</a></li>
                    <li><a href="{{ route('login') }}" class="mr-1 btn btn-round btn-kikyo"><i class="fas fa-sign-in-alt"></i>
                            本機登入</a></li>
                    @endguest
                    @auth
                    <li><a href="{{ route('back.index') }}" class="mr-1 btn btn-round btn-kikyo"><i class="fas fa-cogs"></i>
                            後台管理</a></li>
                    <li><a href="{{ route('logout') }}" class="mr-1 btn btn-round btn-danger" onclick="if(confirm('您確定要登出嗎?'))  javascript:location.href='{{ route('logout') }}';else return false"><i class="fas fa-sign-out-alt"></i>
                            登出系統</a></li>
                    @endauth
                    @impersonating($guard = null)
                    <li><a href="{{ route('sims.impersonate_leave') }}" class="mr-1 btn btn-round btn-secondary" onclick="return confirm('結束模擬？')"><i class="fas fa-sign-out-alt"></i>
                            結束模擬</a></li>
                    @endImpersonating
                </ul>
            </div>
        </nav>
    </div>
</header>
