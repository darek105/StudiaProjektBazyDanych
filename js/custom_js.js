$('.li-drop ul').hide();
$('.li-drop-2 ul').hide();
$('.li-drop-3 ul').hide();
$('.tab-produkt div').hide();
$('#content-id-produkt').hide();
$('.box-right').hide();
$('.btn-content-produkty span').hide();
$('.tab-produkt-model').hide();
$('#details-paczki-form').hide();
$('#team').hide();
$('#profil').hide();
$('.team-details').hide();
$('.content').children().hide();
$('#home').show();
$('#profil-admin').hide();

$(document).ready(function() {



    var width = $(window).width() - 210;
    $('.content').css('width', width);

    $('li').eq(0).on('click', (arguments) => {
        $('#home').show();
        $('#home').siblings().hide();
    });

    $('li').eq(1).on('click', (arguments) => {
        $('#id_produkt').show();
        $('#id_produkt').siblings().hide();
    });

    $('li').eq(2).on('click', (arguments) => {
        $('#profil-admin-produkt').show();
        $('#profil-admin-produkt').siblings().hide();
    });


    $('li').eq(3).on('click', (arguments) => {
        $('#id_paczki').show();
        $('#id_paczki').siblings().hide();
    });

    $('li').eq(5).on('click', (arguments) => {
        $('#team').show();
        $('#team').siblings().hide();
    });

    $('li').eq(7).on('click', (arguments) => {
        $('#profil').show();
        $('#profil').siblings().hide();
    });

    $('li').eq(6).on('click', (arguments) => {
        $('#profil-admin').show();
        $('#profil-admin').siblings().hide();
    });

    // $('li').on('click', (arguments) => {
    //     $('#profil-admin').show();
    //     $('#profil-admin').siblings().hide();
    // });

    $('.li-drop').on('click', (arguments) => {
        $('.li-drop ul').toggle(function() {
            $('.li-drop ul li').each(function(index, el) {
                $(this).delay(100 * index).slideUp('fast');
            });
        }, function() {
            $('.li-drop ul li').each(function(index, el) {
                if (index > 1) {
                    $(this).slideDown('fast');
                } else {
                    $(this).delay(100 * index).slideDown('fast');
                }
            });
        });
    });

    $('.li-drop-2').on('click', (arguments) => {
        $('.li-drop-2 ul').toggle(function() {
            $('.li-drop-2 ul li').each(function(index, el) {
                $(this).delay(100 * index).slideUp('fast');
            });
        }, function() {
            $('.li-drop-2 ul li').each(function(index, el) {
                if (index > 1) {
                    $(this).slideDown('fast');
                } else {
                    $(this).delay(100 * index).slideDown('fast');
                }
            });
        });
    });

    $('.li-drop-3 a').on('click', (arguments) => {
        $('.li-drop-3 ul').toggle(function() {
            $('.li-drop-3 ul li').slideDown();
          }, function() {
            $('.li-drop-3 ul li').slideDown('fast');
        });
    });

    if (!checkPreson()) {
      $('li').eq(2).hide();
      $('li').eq(4).hide();
      $('li').eq(6).hide();
    }

    $('#zapas-form input').on('click', (arguments) => {
        arguments.preventDefault();
        $('#model-tab tr').each(function(index, el) {
            $(this).children().each(function(index1, el1) {
                var count = $(this).text();
                var kolor = $("#id_produkt2").val();
                var rozmiar = $("#id_produkt3").val();
                // console.log(count);
                // console.log(id_produktu);
                if (count == kolor) {
                    count1 = $(this).next().text();
                    // console.log("KOLOR" + count1);
                    if (count1 == rozmiar) {
                        // console.log(index);
                        $('#model-tab tr').eq(index).children().css('font-weight', '800');
                        $('#model-tab tr').eq(index).children().css('color', '#60a2e5');
                    }
                }
            });

        });
    });

    $(".PokazFormDoZmiany").on('click', (arguments) => {
      $(".PokazFormDoZmiany").css('display', 'none');
      $(".zmien-dane select").css('display', 'flex');
      $(".zmien-dane form").css('display', 'flex');
    });

    $('.dane').change(function(event) {
      /* Act on the event */
      var selectChangeValue = $(this).val().toLowerCase();
      $('#formToChangeDane input').eq(0).attr('name', selectChangeValue);
    });

    function showMore() {


        if (checkPreson()) {
            // $('#profil-admin').show();
            $('.error-team').hide();
        } else {
            $('#team-tab tr').each(function(index, el) {
                $(this).children().eq(2).hide();
                $(this).children().eq(3).hide();
            });
        }

    }
    showMore();

    $.validator.addMethod('regex', function(value, element, regexpr) {
        if (value != "") {
            return regexpr.test(value);
        }
    }, "Login nie poprawny");
    $("#form-to-search").validate({
        rules: {
            indeks: {
                required: true,
                // regex: /^[A-Z]{2}[0-9]{3}$/,
                minlength: 5

            },
            kolor: {
                minlength: 3,
                required: false,
                // regex: /^[0-9]{2}[A-Z]{1}$/

            },
            rozmiar: {
                minlength: 1,
                required: false,
                // regex: /^[A-Z]+$/
            },
        },
        messages: {
            indeks: {
                required: "Wpisz indeks",
                regex: "Indeks nie poprawny",
                minlength: "Indeks za krotki"

            },
            kolor: {
                // required: "Wpisz kolor",
                regex: "Kolor nie poprawny",
                minlength: "Kolor za krotki"
            },
            rozmiar: {
                // required: "Wpisz rozmiar",
                regex: "rozmiar nie poprawny",
                minlength: "Rozmiar za krotki"
            },
        },
        submitHandler: submitFormSearch
    });
    /* Act on the event */




    function submitFormSearch() {
        var id_produktu = "";
        $('#content-id-produkt').slideDown('fast');
        // $("#id_produkt1").blur(function(event) {
        //   /* Act on the event */
        //   var id_produktu = "";
        //   id_produktu = $("#id_produkt1").text();
        // });
        // console.log(id_produktu);
        // $("#id_produkt4").html(id_produktu);
        if ($("#id_produkt3").val() != "" & $("#id_produkt2").val() != "") {
            id_produktu = $("#id_produkt1").val();
            id_produktu += $("#id_produkt2").val();
            id_produktu += $("#id_produkt3").val();
            $("#id_produkt4").val(id_produktu);
            $('.btn-content-produkty input').show();
            $('.btn-content-produkty span').hide();
        } else {
            $('.btn-content-produkty input').hide();
            $('.btn-content-produkty span').show();
        }
        var data = $("#form-to-search").serialize();

        $.ajax({

            type: 'POST',
            url: 'login_process.php',
            data: data,
            // beforeSend: function() {
            //     $("#error").fadeOut();
            //     $("#submit").html('<span class=""></span> &nbsp; sending ...');
            // },
            success: function(response) {

                $('.tab-produkt div').each(function(index, el) {
                    $(this).delay(index * 300).slideDown(400);
                });

                var obj = JSON.parse(response);
                if (obj.indeks != "") {
                    $(".idxp").html(obj.indeks);
                    $(".nza").html(obj.nazwa);
                    $(".money").html(obj.cena + "zł");
                    $(".money_rodzaj").html(obj.rodzaj);
                    // $('.box-right').slideDown('slow');
                    if (obj.ilosc != "brak") {
                        $('.box-right').slideDown('slow');
                        $(".ilosc-produkt .ilosc_pro").html(obj.ilosc);
                    }

                } else {

                    // $("#content-id-produkt").fadeIn(1000, function() {
                    //     $("#content-id-produkt").html('<div style="color:red; margin-top:20px;">' + response + ' !</div>');
                    // $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    // });
                }

            }
        });
        return false;
    }

    // $('.tab-produkt-model').on('submit', (arguments) => {
    //   event.preventDefault();
    //   $(this).slideDown('fast');
    //   modelShow();
    // });


    $("#model-form").validate({
        submitHandler: modelShow
    });

    function modelShow() {
        var id_produktu = "";
        $('.tab-produkt-model').slideDown('fast');
        // $("#id_produkt1").blur(function(event) {
        //   /* Act on the event */
        //   var id_produktu = "";
        //   id_produktu = $("#id_produkt1").text();
        // });
        // console.log(id_produktu);
        // $("#id_produkt4").html(id_produktu);
        id_produktu = $("#id_produkt1").val();
        $("#id_produkt5").val($("#id_produkt1").val());
        id_produktu += $("#id_produkt2").val();
        $("#id_produkt6").val($("#id_produkt2").val());
        id_produktu += $("#id_produkt3").val();
        $("#id_produkt7").val($("#id_produkt3").val());
        $("#id_produkt8").val(id_produktu);


        var data = $("#model-form").serialize();

        $.ajax({

            type: 'POST',
            url: 'login_process.php',
            data: data,
            // beforeSend: function() {
            //     $("#error").fadeOut();
            //     $("#submit").html('<span class=""></span> &nbsp; sending ...');
            // },
            success: function(response) {

                var obj = JSON.parse(response);
                if (obj.indeks != "") {
                    for (var n in obj) {
                        if (obj.hasOwnProperty(n)) {
                            $('#model-tab').append('<tr><td>' + obj[n].indeks + '</td><td>' + obj[n].kolor + '</td><td>' + obj[n].rozmiar + '</td><td>' + obj[n].ilosc + '</td><td>' + obj[n].gdzie + '</td></tr>');

                        }
                    }
                    // $('#model-tab').append('<tr><td>' +  obj.indeks + '</td></tr><td>' +  obj.kolor + '</td><td>' +  obj.rozmiar + '</td><td>' +  obj.ilosc + '</td></tr>')

                } else {

                    // $("#content-id-produkt").fadeIn(1000, function() {
                    //     $("#content-id-produkt").html('<div style="color:red; margin-top:20px;">' + response + ' !</div>');
                    // $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    // });
                }
            }
        });
        return false;
    }

    $("#paczki-form").validate({
        submitHandler: packShow
    });

    function packShow() {
        $('.paczki').slideDown('fast');
        $('#details-paczki-form').show();
        $('#paczki-tab tr').each(function(index, el) {
            if (index > 0) $(this).remove();
        });

        var data = $("#paczki-form").serialize();

        $.ajax({

            type: 'POST',
            url: 'login_process.php',
            data: data,
            // beforeSend: function() {
            //     $("#error").fadeOut();
            //     $("#submit").html('<span class=""></span> &nbsp; sending ...');
            // },
            success: function(response) {

                var obj = JSON.parse(response);
                if (obj.indeks != "") {
                    for (var n in obj) {
                        if (obj.hasOwnProperty(n)) {
                            $('#paczki-tab').append('<tr><td>' + obj[n].id_paczki + '</td><td>' + obj[n].data_w + '</td><td>' + obj[n].data_p + '</td><td>' + obj[n].departament + '</td><td>' + obj[n].ilosc_pro + '</td></tr>');
                        }
                    }
                    // $('#model-tab').append('<tr><td>' +  obj.indeks + '</td></tr><td>' +  obj.kolor + '</td><td>' +  obj.rozmiar + '</td><td>' +  obj.ilosc + '</td></tr>')

                } else {

                    // $("#content-id-produkt").fadeIn(1000, function() {
                    //     $("#content-id-produkt").html('<div style="color:red; margin-top:20px;">' + response + ' !</div>');
                    // $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    // });
                }
            }
        });
        return false;
    }

    $("#details-paczki-form").validate({
        submitHandler: packDetailsShow
    });

    function packDetailsShow() {
        $('.paczki-details').slideDown('fast');

        $('#paczki-tab-details tr').each(function(index, el) {
            if (index > 0) $(this).remove();
        });

        var data = $("#details-paczki-form").serialize();

        $.ajax({

            type: 'POST',
            url: 'login_process.php',
            data: data,
            // beforeSend: function() {
            //     $("#error").fadeOut();
            //     $("#submit").html('<span class=""></span> &nbsp; sending ...');
            // },
            success: function(response) {

                var obj = JSON.parse(response);
                if (obj.indeks != "") {
                    for (var n in obj) {
                        if (obj.hasOwnProperty(n)) {
                            $('#paczki-tab-details').append('<tr><td>' + obj[n].idpaczki + '</td><td>' + obj[n].idproduktu + '</td><td>' + obj[n].ilosc_pro + '</td></tr>');
                        }
                    }
                    // $('#model-tab').append('<tr><td>' +  obj.indeks + '</td></tr><td>' +  obj.kolor + '</td><td>' +  obj.rozmiar + '</td><td>' +  obj.ilosc + '</td></tr>')

                } else {

                    // $("#content-id-produkt").fadeIn(1000, function() {
                    //     $("#content-id-produkt").html('<div style="color:red; margin-top:20px;">' + response + ' !</div>');
                    // $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    // });
                }
            }
        });
        return false;
    }


    $("#team-form").validate({
        submitHandler: teamShow
    });

    function teamShow() {
        $('.team-details').slideDown('fast');

        $('#team-tab tr').each(function(index, el) {
            if (index > 0) $(this).remove();
        });

        var data = $("#team-form").serialize();

        $.ajax({

            type: 'POST',
            url: 'login_process.php',
            data: data,
            // beforeSend: function() {
            //     $("#error").fadeOut();
            //     $("#submit").html('<span class=""></span> &nbsp; sending ...');
            // },
            success: function(response) {

                var obj = JSON.parse(response);
                if (obj.indeks != "") {
                    for (var n in obj) {
                        if (obj.hasOwnProperty(n)) {
                            $('#team-tab').append('<tr><td>' + obj[n].imie + '</td><td>' + obj[n].nazwisko + '</td><td>' + obj[n].pesel + '</td><td>' + obj[n].stanowisko + '</td><td>' + obj[n].telefon + '</td><td>' + obj[n].idoddzialu + '</td></tr>');
                        }
                    }
                    // $('#model-tab').append('<tr><td>' +  obj.indeks + '</td></tr><td>' +  obj.kolor + '</td><td>' +  obj.rozmiar + '</td><td>' +  obj.ilosc + '</td></tr>')

                } else {

                    // $("#content-id-produkt").fadeIn(1000, function() {
                    //     $("#content-id-produkt").html('<div style="color:red; margin-top:20px;">' + response + ' !</div>');
                    // $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    // });
                }
                showMore();
            }
        });
        return false;
    }


    $("#formToChangeDane").validate({
        submitHandler: changeDane
    });

    function changeDane() {

        var data = $("#formToChangeDane").serialize();

        $.ajax({

            type: 'POST',
            url: 'login_process.php',
            data: data,
            // beforeSend: function() {
            //     $("#error").fadeOut();
            //     $("#submit").html('<span class=""></span> &nbsp; sending ...');
            // },
            success: function(response) {

                var obj = JSON.parse(response);
                if (obj.indeks != "") {
                            $('.imie-profil').children().eq(1).html(obj.imie);
                            $('.user h1').html(obj.imie);
                            $('.nazwisko-profil').children().eq(1).html(obj.nazwisko);
                            $('.stanowisko-profil').children().eq(1).html(obj.stanowisko);
                            $('.telefon-profil').children().eq(1).html(obj.telefon);
                            $('.haslo-profil').children().eq(1).html(obj.haslo);

                    $('#okChange').html('Zmiana przebiegła pomyślnie !!!')
                    // $('#model-tab').append('<tr><td>' +  obj.indeks + '</td></tr><td>' +  obj.kolor + '</td><td>' +  obj.rozmiar + '</td><td>' +  obj.ilosc + '</td></tr>')

                } else {

                    // $("#content-id-produkt").fadeIn(1000, function() {
                    //     $("#content-id-produkt").html('<div style="color:red; margin-top:20px;">' + response + ' !</div>');
                    // $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    // });
                }
                // showMore();
            }
        });
        return false;
    }

    $("#addPresonAdmin").validate({
        submitHandler: addPresonAdmin
    });

    function addPresonAdmin() {
      var data = $('#addPresonAdmin').serialize();

      $.ajax({
        type: 'POST',
        url: 'login_process.php',
        data: data,

        success: function (response) {

          if (response == "OK") {
                $('#okAddPreson').html('Dodano pracownika :)');
          } else {
            $('#okAddPreson').html('Coś poszło nie tak :(');
          }
        }
      });


    }

    $("#addProductAdmin").validate({
        submitHandler: addProductAdmin
    });

    function addProductAdmin() {
      var data = $('#addProductAdmin').serialize();

      $.ajax({
        type: 'POST',
        url: 'login_process.php',
        data: data,

        success: function (response) {

          if (response == "OK") {
                $('#okAddProduct').html('Dodano produkt :)');
          } else {
            $('#okAddProduct').html('Coś poszło nie tak :(');
          }
        }
      });


    }



}); //koniec ready
