$(document)
//insert to database from modal
.on("submit", "form.js-createBooking", function(event) {

    event.preventDefault();

    var _form = $(this);

    var _error = $(".js-error", _form);

    let arr = $("#time_book").val().split(/[ ,]+/);

    var data = {
        aircraft_reg: $("#aircraft_reg").val(),
        date_book: $("#date_book").val(),
        start: arr[0],
        end: arr[2],
        instructor_book: $("#instructor_book").val(),
        pilot: $("#pilot").val(),
        comm_book: $("#comm_book").val(),
    }

    _error.hide();


    $.ajax ({
        type: 'POST',
        url: 'ajax/book.php',
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

$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        aspectRatio: 2,
        editable: true,
        events: "fullcalendar/fetch-event.php",
        displayEventTime: false,
        fixedWeekCount: false,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,list'
        },
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },

        eventMouseover: function(event, jsEvent) {       

           let start = event.start["_i"].split(" ");
           let end = event.end["_i"].split(" ");

           startFinal = start[1].split(":");
           endFinal = end[1].split(":");

            var tooltip = '<div class="tooltipevent" style="width: auto; min-width: 50px; max-width: 300px; height:100px;' + 
                                                            'background-color: rgba(0, 0, 0, 0.8); box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4); ' +
                                                            'border-radius: 5px;' +
                                                            'color: #FFFFFF; font-size: 14px; content: attr(data-tooltip-text); font-weight: bold;' +
                                                            'margin-bottom: 10px; top: 130%; left: 0; padding: 7px 12px;' +
                                                            'word-wrap: break-word; position: absolute; z-index: 9999;' +
                                                            '">' +
                            "Registration: " + event.title + "<br>" + 
                            "Pilot: " + event.pilot + "<br>" +
                            "Instructor: " + event.instructor + "<br>" +
                            "Time: " + startFinal[0] + ":" + startFinal[1] + " - " + endFinal[0] + ":" + endFinal[1] 
                            '</div>';

            $("body").append(tooltip);
            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $('.tooltipevent').fadeIn('500');
                $('.tooltipevent').fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $('.tooltipevent').css('top', e.pageY + 10);
                $('.tooltipevent').css('left', e.pageX + 20);
            });
        },
        
        eventMouseout: function(event, jsEvent) {
             $(this).css('z-index', 8);
             $('.tooltipevent').remove();
        },

        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "fullcalendar/delete-event.php",
                    data: "&id=" + event.id,
                    success: function (response) {
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        }

    });
});

function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}