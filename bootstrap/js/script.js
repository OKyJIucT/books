$(document).ready(function () {

    window_size();

    var chat = localStorage.getItem('chat');
    if (chat == null)
        chat = localStorage.setItem('chat', 'show');

    if (chat == 'show')
    {
        $("#wrap_chat").show();
        $("#click").html('Скрыть чат');
    } else {
        $("#wrap_chat").hide();
        $("#click").html('Показать чат');
    }

    // Отстуки об онлайне
    setInterval(function () {
        $("#online").load("/SetOnline");
    }, 30000);

    // отстук при переходе по страницам
    $.ajax({
        url: '/SetOnline',
        type: 'get',
        dataType: 'json'
    });

    // обновление списка онлайн юзеров
    setInterval(function () {
        $(".whoOnline").load("/WhoOnline");
    }, 10000);

    // обновление списка при переходе по страницам
    $.ajax({
        url: '/WhoOnline',
        type: 'get',
        data: 'ajax=1',
        dataType: 'json',
        success: function (data) {
            $.each(data, function () {
                $('.whoOnline').append(
                        this.username + '<br />'
                        );
            });
        }
    });

    // автоподсчет высоты экрана
    setInterval(function () {
        window_size();
    }, 1000);


    // изменение окна браузера
    function window_size() {
        var height = 0;
        var chat = localStorage.getItem('chat');
        if (chat == 'show')
            var new_height = 310;
        else
            var new_height = 90;
        if (self.screen) {
            height = $(window).height() - new_height;
        }
        $(".content").attr('style', 'height: ' + height + 'px!important');
        $(".pers").attr('style', 'height: ' + height + 'px!important');

    }

    // при изменении размеров браузера
    window.onresize = function (e)
    {
        window_size();
    }


    $("#click").click(function () {

        var chat = localStorage.getItem('chat');

        if (chat == 'show')
        {
            localStorage.setItem('chat', 'hide');
            $("#wrap_chat").hide();
            $("#click").html('Показать чат');
        } else {
            localStorage.setItem('chat', 'show');
            $("#wrap_chat").show();
            $("#click").html('Скрыть чат');
        }

        window_size();
    });

    $(".chzn-select").chosen();
    $(".chzn-select-deselect").chosen({allow_single_deselect: true});
});