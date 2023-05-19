@include('layouts.alert')
@include('layouts.bootbox')
<div class="form-group">
    <label for="visit_name" class="control-label"><strong class="text-danger">參訪體驗行程(科系)名稱*</strong></label>
    {{ Form::text('visit_name',null,['id'=>'visit_name','class' => 'form-control','required'=>'required']) }}
</div>

@if($user->group_id == "8")
    <div class="form-group">
        <label for="about" class="control-label"><strong class="text-danger">科系學習內容*</strong></label>
        {{ Form::textarea('about',null,['id'=>'about','class' => 'form-control',"rows"=>"3",'required'=>'required']) }}
    </div>

    <div class="form-group">
        <label for="graduate" class="control-label"><strong class="text-danger">該科系畢業出路*</strong></label>
        {{ Form::textarea('graduate',null,['id'=>'graduate','class' => 'form-control',"rows"=>"3"]) }}
    </div>
@else
    <div class="form-group">
        <label for="visit_careers" class="control-label"><strong class="text-danger">相關類別及職群*</strong></label>
        {{ Form::select('visit_careers',$visit_careers,null,['id'=>'visit_careers','class' => 'form-control','required'=>'required']) }}
    </div>
    <div class="form-group">
        <label for="about" class="control-label"><strong class="text-danger">課程簡介*</strong></label>
        {{ Form::textarea('about',null,['id'=>'about','class' => 'form-control',"rows"=>"3",'required'=>'required']) }}
    </div>
    <div class="form-group">
        <label for="docx" class="control-label">上傳學習單(只能一個檔)</label>
        @if(!empty($docx))
            <?php $path = asset('storage/visits_docx').'/'.$visit->id.'/'.$docx[0]; ?>
            <span class="text-danger">目前已上傳：</span><a href="{{ $path }}"><i class="fas fa-download"></i></a>
            @if($user->group_id == "1")
                <a href="{{ url('visits/'.$visit->id.'/'.$page.'/admin_docx_del/'.$docx[0]) }}" onclick="return confirm('確定刪除這個檔案？')"><i class="fas fa-times-circle text-danger"></i></a>
            @else
                <a href="{{ url('visits/'.$visit->id.'/docx_del/'.$docx[0]) }}" onclick="return confirm('確定刪除這個檔案？')"><i class="fas fa-times-circle text-danger"></i></a>
            @endif
            <br>
        @endif
        {{ Form::file('docx',['class' => 'form-control']) }}
    </div>
@endif

<div class="form-group" id="tabs_all">
    <p>
        @foreach($tabs as $k=>$v)
            <?php $j = $k+1; ?>
            <label for="tabs[]" class="control-label"><strong class="text-danger">搜尋標籤{{ $j }}*</strong></label>
            {{ Form::text('tabs[]',$v,['id'=>'tabs'.$j,'class' => 'form-control','required'=>'required']) }}
        @endforeach
        <i class='fas fa-plus-circle text-success' onclick="add()"></i>增
    </p>
</div>
@if(!empty($files))
    <div class="card">
        <div class="card-header">
            已上傳照片
        </div>
        <div class="card-body">
            @foreach($files as $k=>$v)
                <?php
                $file = "visits/".$visit->id."/".$v;
                $file = str_replace('/','&',$file);
                ?>
                <div style="float:left;padding: 10px;">
                    <img src="{{ url('img/'.$file) }}" width="100">
                    @if($user->group_id == "1")
                        <a href="{{ url('visits/'.$visit->id.'/'.$page.'/admin_file_del/'.$v) }}" onclick="return confirm('上面的更動應該先存檔喔！確定刪除這張照片？')"><i class="fas fa-times-circle text-danger"></i></a>
                    @else
                        <a href="{{ url('visits/'.$visit->id.'/file_del/'.$v) }}" onclick="return confirm('上面的更動應該先存檔喔！確定刪除這張照片？')"><i class="fas fa-times-circle text-danger"></i></a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif

<div class="form-group">
    <label for="name" class="control-label"><strong class="text-danger">照片集*</strong><small>多選</small></label>
    {{ Form::file('files[]',['class' => 'form-control','multiple'=>'multiple']) }}
</div>

<div class="form-group">
    <button class="btn btn-secondary" onclick="history.back()"><i class="fas fa-chevron-circle-left"></i> 返回</button>
    <button type="submit" class="btn btn-primary" onclick="return confirm('確定儲存嗎？須經審核後，才會公開！')">
        <i class="fas fa-save"></i> 儲存設定
    </button>
</div>

<script>
    var c = {{ $n }};

    function add() {
        var content;
        c++;
        content = "<p>" +
            "<label for='tabs[]' class='control-label'><strong class='text-danger'>搜尋標籤"+c+"*</strong></label>"+
            "<input type='text' name='tabs[]' id='tabs"+c+"' class='form-control' required>"+
            "<i class='fas fa-times-circle text-warning' onclick='remove(this)'></i>刪"+
            "</p>";

        $("#tabs_all").append(content);
    }

    function remove(obj) {
        $(obj).parent().remove();
        c--;
    }

</script>