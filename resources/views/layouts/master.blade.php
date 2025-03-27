 <!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta http-equiv="Content-Security-Policy" content="default-src 'none';img-src 'self' data:;style-src 'self';script-src 'self' 'unsafe-inline';font-src 'self';">           
    <!-- CSRF Token -->
    <meta name="csrf-token" content="zT4I5RGHuU2IyB3D4dEsFST0lOL0xdZefBw40Kyb">

    <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>
    @include('layouts.header')
</head>

<body class="body-bg1" data-feedly-mini="yes" cz-shortcut-listen="true">

<!-- Header -->
@include('layouts.nav')

<!-- Main -->
<main>
    <div class="container main-wrap">
        <div class="row">
            <div class="col-md-3 col-xs-12 sidebar side-bg">

                @include('layouts.side_nav')

            </div>

            <div class="col-md-9 col-xs-12">
                <div class="row">
                    <div class="inner-map innermap-bg simple">
                        <div class="col-12">
                            <div class="content-info">
                                @yield('content')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<!-- 記得要把按鈕放到網頁上, 否則它不會出現 -->
<a href="#" id="gotop">
    <i class="fa fa-angle-up"></i>
</a>
@include('layouts.footer')
</body>

</html>