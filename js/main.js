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

.on("submit", "form.js-addflight", function(event) {
    event.preventDefault();

    var _form = $(this);

    var _error = $(".js-error", _form);

    var data = {
        flight_date: $("#flight_date").val(),
        reg_number: $("#reg_number").val(),
        pilot: $("#pilot").val(),
        instructor: $("#instructor").val(),
        dep_place: $("#dep_place").val(),
        arr_place: $("#arr_place").val(),
        flight_time: $("#flight_time").val(),
        flights: $("#flights").val(),
    }

    console.log(data);

    $.ajax ({
        type: 'POST',
        url: 'ajax/addflight.php',
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
        console.log('failed');
    })
    .always(function ajaxAlwaysDoThis(data) {
        console.log('Always');
    })


    return false;

})

.on("submit", "form.js-search", function(event) {
    
    
    event.preventDefault();

    var _form = $(this);

    var _error = $(".js-error", _form);

    var data = {
        from: $("#from").val(),
        to: $("#to").val(),
    }

    console.log(data);

    $.ajax ({
        type: 'POST',
        url: "ajax/myflights.php",
        data: data,
        dataType: 'json',
    })
    .done(function ajaxDone(data) {
        if(data.redirect !== undefined) {
            window.location = data.redirect;
            $('#table1').show();
        } else if(data.error !== undefined) {
            _error.html(data.error).show();
        }
    })
    .fail(function ajaxFailed(e) {
        console.log('failed');
    })
    .always(function ajaxAlwaysDoThis(data) {
        console.log('Always');
    })


    return false;

})

.on("submit", "form.js-add_doc", function(event) {
    event.preventDefault();

    var _form = $(this);

    var _error = $(".js-error", _form);

    var data = {
        type: $("#type").val(),
        descr: $("#descr").val(),
        file1: $("#file1").val(),
        file2: $("#file2").val(),
    }

    console.log(data);

    $.ajax ({
        type: 'POST',
        url: 'ajax/add_doc.php',
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
        console.log('failed');
    })
    .always(function ajaxAlwaysDoThis(data) {
        console.log('Always');
    })


    return false;

})

.ready(function() { 
    $('#type').on('change', do_something); 
}); 
 
function do_something() { 
    var selected = $('#type').val(); 
    console.log(selected);
    $.ajax({ 
        type:       'POST', 
        dataType:   'json', 
        data:       { value: selected }, 
        async:      true    
    }); 
} 


