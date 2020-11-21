// Get the modals
var modal;
// Get the button that opens the modals
var btn;
// Get the <span> element that closes the modal
var span;

var calendar;

function sendToPlanning() {
  location.replace("planning.php?modal=set")
}

function initModal(str1, str2, i) {

    modal = document.getElementById(str1);
    btn = document.getElementById(str2);
    span = document.getElementsByClassName('close')[i];

    if(document.getElementById('fullCalendar_dashboard')) {
        calendar = document.getElementById('fullCalendar_dashboard');
    }


    let toggle = function () {
        modal.classList.toggle('active'); // toggle class for animation
    }

    toggle();

    if( calendar ) {
        var toggleCalendar = function() {
            calendar.classList.toggle('toggleVisibility');
        }

        toggleCalendar();
    
        var toggleCalendarAfterModal = function() {
            setTimeout(function(){ toggleCalendar();}, 100);
            toggle();
            clearTimeout();
            return;
        }
    
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        if( calendar ) {
            toggleCalendarAfterModal();
            return;
        }
        toggle();
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            if(calendar) {
                toggleCalendarAfterModal();
                return;
            }

            toggle();
        }
    }

}