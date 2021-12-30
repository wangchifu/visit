<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="form-group">
    <label for="datepicker1"><strong class="text-danger">開始報名時間*</strong></label>
    <input id="datepicker1" name="start_date" width="250" value="{{ date('Y-m-d') }}">
    <script>
        $('#datepicker1').datepicker({ format: 'yyyy-mm-dd' });
    </script>
</div>

<div class="form-group">
    <label for="datepicker3"><strong class="text-danger">最後報名時間*</strong></label>
    <input id="datepicker3" name="stop_date" width="250" value="{{ date('Y-m-d') }}">
    <script>
        $('#datepicker3').datepicker({ format: 'yyyy-mm-dd' });
    </script>
</div>

<div class="form-group">
    <label for="datepicker2"><strong class="text-danger">活動時間*</strong></label>
    <input id="datepicker2" name="active_date" width="250" value="{{ date('Y-m-d') }}">
    <script>
        $('#datepicker2').datepicker({ format: 'yyyy-mm-dd' });
    </script>
</div>

<div class="form-group">
    <label for="active_place"><strong class="text-danger">活動地點*</strong></label>
    {{ Form::text('active_place',auth()->user()->name,['id'=>'active_place','class' => 'form-control','required'=>'required']) }}
</div>

<div class="form-group">
    <label for="course_anme"><strong class="text-danger">課程名稱*</strong></label>
    {{ Form::text('course_name',null,['id'=>'course_name','class' => 'form-control','required'=>'required']) }}
</div>

<div class="form-group">
    <label for="about">課程簡介</label>
    {{ Form::textarea('about',null,['id'=>'about','class' => 'form-control','rows'=>'4']) }}
</div>

<div class="form-group">
    <label for="tabs">搜尋標籤<small>(用,分隔)</small></label>
    {{ Form::text('tabs',null,['id'=>'about','class' => 'form-control']) }}
</div>

<div class="form-group">
    <label for="files[]">附件<small>(選填，單檔不大於5MB)</small></label>
    {{ Form::file('files[]', ['class' => 'form-control','multiple'=>'multiple']) }}
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary" onclick="return confirm('確定儲存？')">
        <i class="fas fa-save"></i> 儲存設定
    </button>
</div>