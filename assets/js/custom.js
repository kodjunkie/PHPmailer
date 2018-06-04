$(document).ready(function () {

    $('input#send_to_group').click(function () {
        if ($(this)[0].checked) {
            $('input#email_to_list').attr('required', 'required').slideDown('slow');
            $('input#to').removeAttr('required').slideUp('slow');
        }
        else {
            $('input#email_to_list').removeAttr('required').slideUp('slow');
            $('input#to').attr('required', 'required').slideDown('slow');
        }
    });

});
