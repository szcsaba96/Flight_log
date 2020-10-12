$(document)
.on("submit", "form.js-register", function(event) {

    event.preventDefault();

    var _form = $(this);

    var _error = $(".js-error", _form);

    var data = {
        first_name: $("#first_name").val(),
        last_name: $("#last_name").val(),
        birthday: $("#birthday").val(),
        address: $("#address").val(),
        tel: $("input[type = 'tel']", _form).val(),
        email: $("input[type = 'email']", _form).val(),
        password: $("input[type = 'password']", _form).val()
    }

    if(data.email.length < 6) {
        _error.text("Please enter a valid email address").show();
        return false;

    } else if (data.password.length < 8) {
        _error.text("Please enter a password that is at least 8 characters long.").show();
        return false;
    }

    _error.hide();


    $.ajax ({
        type: 'POST',
        url: 'ajax/register.php',
        data: data,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(data) {
        if(data.redirect !== undefined) {
            window.location = data.redirect;
        } else if(data.error !== undefined) {
            _error.html(data.error).show();
        }
    })
    .fail(function ajaxFailed(e) {
        console.log('Failed');
    })
    .always(function ajaxAlwaysDoThis(data) {
        console.log('Always');
    })


    return false;

})

//Login
.on("submit", "form.js-login", function(event) {
    event.preventDefault();

    var _form = $(this);

    var _error = $(".js-error", _form);

    var data = {
        email: $("input[type = 'email']", _form).val(),
        password: $("input[type = 'password']", _form).val()
    }

    if(data.email.length < 6) {
        _error.text("Please enter a valid email address").show();
        return false;

    } else if (data.password.length < 8) {
        _error.text("Please enter a password that is at least 8 characters long.").show();
        return false;
    }
    
    _error.hide();


    $.ajax ({
        type: 'POST',
        url: 'ajax/login.php',
        data: data,
        dataType: 'json',
        async: true,
    })
    .done(function ajaxDone(data) {
        if(data.redirect !== undefined) {
            window.location = data.redirect;
        } else if(data.error !== undefined) {
            _error.html(data.error).show();
        }
    })
    .fail(function ajaxFailed(e) {
        //console.log(e);
    })
    .always(function ajaxAlwaysDoThis(data) {
        console.log('Always');
    })


    return false;
})