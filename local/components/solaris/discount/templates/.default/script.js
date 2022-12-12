$(document).ready(function() {
    $("#get-discount").click(function oneclick () {
        $('.overlay-preloader').show();
        $("#get-discount-error").hide();
        $.ajax({
            url: "",
            type: "POST",
            data: {action: 'get-discount'},
            dataType: "json",
            success: function (data) {
                $('.overlay-preloader').hide();
                $("#get-discount-value").html(data.value + '%');
                $("#get-discount-code").html(data.code);
                if (data.error) {
                    $("#get-discount-error").html('Ошибка получения скидки');
                    $("#get-discount-error").show();
                }
            },
            error: function (html) {
                $('.overlay-preloader').hide();
                $("#get-discount-error").html('Ошибка получения скидки');
                $("#get-discount-error").show();
            },
        });
    });

    $("#check-discount").click(function oneclick () {
        $('.overlay-preloader').show();
        $("#check-discount-error").hide();
        $(".check-discount-value-block").hide();
        let code = $('#check-discount-input').val();
        $.ajax({
            url: "",
            type: "POST",
            data: {action: 'check-discount', code: code,},
            dataType: "json",
            success: function (data) {
                $('.overlay-preloader').hide();
                if (data.success) {
                    $("#check-discount-value").html(data.value + '%');
                    $(".check-discount-value-block").show();
                }
                if (data.error) {
                    $("#check-discount-error").html(data.message);
                    $("#check-discount-error").show();
                }
            },
            error: function (html) {
                $('.overlay-preloader').hide();
                $("#check-discount-error").html('Ошибка проверки скидки');
                $("#check-discount-error").show();
            },
        });
    });

    //остановка отправки формы по нажатию кнопки ентер
    $('.check-discount-form').keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});





