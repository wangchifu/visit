<!-- Footer -->
<footer class="py-3 ">
    <div class="container">
        <p class="m-0 text-center">Copyright &copy; 青年夢想方舟-職業探索向下扎根 彰化縣教育處</p>
        <p class="m-0 text-center">程式問題反應： wangchifu@gmail.com</p>
    </div>
    <!-- /.container -->
</footer>
<script>
    function bbconfirm_Form(id, title) {
        bootbox.confirm({
            title: '請你確定一下',
            message: title,
            buttons: {
                confirm: {
                    label: '我很確定',
                    className: 'btn-success'
                },
                cancel: {
                    label: '我按錯了',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    document.getElementById(id).submit();
                }
                console.log('This was logged in the callback: ' + result);
            }
        });
    }

    function bbconfirm_Link(id, title) {
        link = document.getElementById(id).href;
        document.getElementById(id).href = '#';
        bootbox.confirm({
            title: '請你確定一下',
            message: title,
            buttons: {
                confirm: {
                    label: '我很確定',
                    className: 'btn-success'
                },
                cancel: {
                    label: '我按錯了',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    location.href = link;
                } else {
                    document.getElementById(id).href = link;
                }

                console.log('This was logged in the callback: ' + result);
            }
        });
    }

    function bbconfirm_FileForm(id, title) {
        bootbox.confirm({
            title: '請你確定一下',
            message: title,
            buttons: {
                confirm: {
                    label: '我很確定',
                    className: 'btn-success'
                },
                cancel: {
                    label: '我按錯了',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {

                    var dialog = bootbox.dialog({
                        title: '請稍後，不要亂按！重新整理F5都會造成錯誤！',
                        message: '<p><i class="fa fa-spin fa-spinner"></i> 儲存中...</p>'
                    });

                    document.getElementById(id).submit();

                    dialog.init(function () {
                        setTimeout(function () {
                            dialog.find('.bootbox-body').html('請等待畫面跳轉後，即完成！!');
                        }, 3000);
                    });
                } else {
                    $("#b_submit").show();
                }
                console.log('This was logged in the callback: ' + result);
            }
        });
    }


    function bbalert(word) {
        bootbox.alert(word);
    }

    function set_mouse_over(num) {
        document.getElementById('mapHover').src = '{{asset('template')}}/images/map/' + num + '.svg';
        document.getElementById('mapHover').style.display = 'block';
    }

    function set_mouse_out(num) {
        document.getElementById('mapHover').style.display = 'none';
    }
</script>
<script src="{{ asset('js/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('template/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(function () {
        /* 按下GoTop按鈕時的事件 */
        $('#gotop').click(function () {
            $('html,body').animate({
                scrollTop: 0
            }, 'slow'); /* 返回到最頂上 */
            return false;
        });

        /* 偵測卷軸滑動時，往下滑超過100px就讓GoTop按鈕出現 */
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#gotop').fadeIn();
            } else {
                $('#gotop').fadeOut();
            }
        });
    });
</script>
