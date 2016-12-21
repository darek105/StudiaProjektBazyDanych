$('document').ready(function() {
    /* validation */
    $.validator.addMethod('regex', function (value, element, regexpr) {
      return regexpr.test(value);
    }, "Login nie poprawny");
    $("#login-form").validate({
        rules: {
            password: {
                required: true,
            },
            login: {
                minlength: 11,
                regex: /^[0-9]+$/,
                required: true
            },
        },
        messages: {
            password: {
                required: "Wpisz hasło"
            },
            login: {
              required: "Wpisz login",
              minlength : "Login za krotki"
            }
        },
        submitHandler: submitForm
    });
    /* validation */


    /* login submit */
    function submitForm() {
        var data = $("#login-form").serialize();

        $.ajax({

            type: 'POST',
            url: 'login_process.php',
            data: data,
            beforeSend: function() {
                $("#error").fadeOut();
                $("#submit input").hide();
                $("#submit").append('<span class="">&nbsp; sending ...</span>');
            },
            success: function(response) {
                if (response == "ok") {
                    $("#submit span").show();
                    $("#submit").html('<img style="margin-top:20px;" src="img/btn-ajax-loader.gif" />');
                    setTimeout(' window.location.href = "home.php"; ', 3000);
                } else {
                    $("#submit span").hide();
                    $("#submit input").show();
                    $("#error").fadeIn(1, function() {
                        $("#error").html('<div style="color:red; margin-top:20px;">' + response + ' !</div>');
                        // $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    });
                }
            }
        });
        return false;
    }
    /* login submit */
});
