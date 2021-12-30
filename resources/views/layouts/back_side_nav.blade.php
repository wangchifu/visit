<div class="list-group mt-lg-3 feature-box">
    <span>
        @if(auth()->user()->group_id == 2)
            學校：{{ auth()->user()->school_data->school_name }}
            <br>
        @endif
        @if(auth()->user()->group_id >=8)
            單位：{{ auth()->user()->vendor_data->vendor_name }}
            <br>
        @endif
            承辦：{{ auth()->user()->name }} 你好
    </span>
    <a href="{{ route('users.info') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-user"></i></div>個人資料編修
    </a>
    @if(auth()->user()->group_id == 1)
    <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-users"></i></div>全部帳號管理
    </a>
    <a href="{{ route('visits.admin') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-handshake"></i></div>廠商行程審核
    </a>
    <a href="{{ route('skills.admin') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="far fa-hand-rock"></i></div>國中技藝管理
    </a>
    <a href="{{ route('matchmaking_all') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-handshake"></i></div>全站媒合查看
    </a>
    <a href="{{ route('experience_all') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-heart"></i></div>全站心得查看
    </a>
    @endif

    @if(auth()->user()->group_id==2)
    <a href="{{ route('visits.my_visit') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-plane"></i></div>我的參訪行程
    </a>
    <a href="{{ route('matchmakings.ztans_index') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-user-md"></i></div>我的職探課程
    </a>
    <?php
    //檢查是否為技藝班自辦學校
        $check = check_skill(auth()->user()->school_data->school_code);
    ?>
    @if($check)
        <a href="{{ route('skills.my_skill') }}" class="list-group-item list-group-item-action feature-box-grass">
            <div class="feature-box-icon"><i class="far fa-hand-rock"></i></div>國中技藝教育
        </a>
    @endif

    @endif
    @if(auth()->user()->group_id==4)
        <a href="{{ route('courses.index') }}" class="list-group-item list-group-item-action feature-box-grass">
            <div class="feature-box-icon"><i class="fas fa-book"></i></div>職探課程管理
        </a>
    @endif

    @if(auth()->user()->group_id >=8 )
    <a href="{{ route('vendor_datas.show') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-hand-holding-heart"></i></div>綜合資訊編修
    </a>
    <a href="{{ route('visits.index') }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-hand-holding-heart"></i></div>參訪行程維護
    </a>
    @endif
    @if(auth()->user()->group_id ==8)
        <a href="{{ route('skills.high_school') }}" class="list-group-item list-group-item-action feature-box-grass">
            <div class="feature-box-icon"><i class="fas fa-hand-holding-heart"></i></div>國中技藝管理
        </a>
    @endif

</div>