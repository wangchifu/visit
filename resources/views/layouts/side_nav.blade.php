<div class="list-group mt-lg-3 feature-box">
    @auth
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
    @endauth
    <a href="{{ route('map') }}" class="list-group-item list-group-item-action feature-box-kikyo">
        <div class="feature-box-icon"><i class="fas fa-map"></i></div>參訪體驗地圖
    </a>
    <a href="{{ route('searches.vendor',"8") }}" class="list-group-item list-group-item-action feature-box-grass">
        <div class="feature-box-icon"><i class="fas fa-school"></i></div>高職科系查詢
    </a>
    <a href="{{ route('searches.vendor',"16") }}" class="list-group-item list-group-item-action feature-box-pink">
        <div class="feature-box-icon"><i class="fas fa-building"></i></div>企業參訪查詢
    </a>
    <a href="{{ route('searches.vendor',"32") }}" class="list-group-item list-group-item-action feature-box-gold">
        <div class="feature-box-icon"><i class="fas fa-male"></i></div>職場達人查詢
    </a>
    <a href="{{ route('ztans.index') }}" class="list-group-item list-group-item-action feature-box-teal">
        <div class="feature-box-icon"><i class="fas fa-align-center"></i></div>職探課程查詢
    </a>
    <a href="{{ route('skills.index') }}" class="list-group-item list-group-item-action feature-box-kikyo">
        <div class="feature-box-icon"><i class="fas fa-map"></i></div>國中技藝教育
    </a>
    <a href="{{ route('experience.guest_index') }}" class="list-group-item list-group-item-action feature-box-pink">
        <div class="feature-box-icon"><i class="fas fa-hand-holding-heart"></i></div>參訪體驗心得
    </a>

</div>
