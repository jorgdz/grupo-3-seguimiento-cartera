var msg_to_sent = "";

function emailValidation(form_id, email) {
    jQuery(form_id + ' .has-error').hide();
    var emailExp = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var email_value = email.val();
    if (email_value.match(emailExp)) {
        msg_to_sent += "Email :" + email_value + "\n";
        return true;
    } else {
        email.after('<div class="alert alert-danger has-error">Please Enter Valid Email address</div>');
        return false;
    }
}

function numberValidation(form_id, ph_number) {
    jQuery(form_id + ' .has-error').hide();
    var numbexp = /^[0-9]*$/;
    var pn_value = ph_number.val();
    var f_parent = form_value.parent().parent().children('label').text();
    if (pn_value.match(numbexp)) {
        msg_to_sent +=  f_parent + " : " + pn_value + "\n";
        return true;
    } else {
        ph_number.after('<div class="alert alert-danger has-error">Please Enter Valid Number</div>');
        return false;
    }
}

function urlValidation(form_id, Web_url) {
    jQuery(form_id + ' .has-error').hide();
    var urlexp = /^(?:(ftp|http|https):\/\/)?(?:[\w-]+\.)+[a-z]{3,6}$/;
    var web_url_value = Web_url.val();
    var f_parent = form_value.parent().parent().children('label').text();
    if (web_url_value.match(urlexp)) {
        msg_to_sent +=  f_parent + " : " + web_url_value + "\n";
        return true;
    } else {
        Web_url.after('<div class="alert alert-danger has-error">Please Enter Valid URL</div>');
        return false;
    }
}

function noValidation(form_id, form_value) {
	var f_value = form_value.val();
	var f_parent = form_value.parent().parent().children('label').text();
	 msg_to_sent +=  f_parent + " : " + f_value + "\n";
     return true;
}

function validate(form_id) {
    var notempty = /.+/;
    var result = false;
    jQuery(form_id + " .req_field").html('');
    jQuery(form_id + " input[type=text]").each(function () {
        var valid_input = true;
        var req = jQuery(this).hasClass('required');
        var input_value = jQuery(this).val();
        var inputt = jQuery(this).data('vali');
        if (req) {
            if (input_value.match(notempty)) {
                if (inputt !== 'undefined' || inputt !== "") {
                    if (inputt === 'email') {
                        valid_input = (valid_input && emailValidation(form_id, jQuery(this)));
                    }
                    else if (inputt === 'url') {
                        valid_input = (valid_input && urlValidation(form_id, jQuery(this)));
                    }
                    else if (inputt === 'numeric') {
                        valid_input = (valid_input && numberValidation(form_id, jQuery(this)));
                    }
					else if (inputt === 'novalidation') {
                        valid_input = (valid_input && noValidation(form_id, jQuery(this)));
                    }
                }
                result = valid_input;
                return valid_input;
            }
            else {
                jQuery(form_id + " .req_field").html('<div class="alert alert-danger">Please enter the required field </div>');
                result = false;
                return false;
            }
        }
    });
    return result;
}

jQuery(document).ready(function () {
    jQuery("form").submit(function () {

        var form = $(this).attr('id');
        var form_id = "#" + form;
        jQuery(form_id + ' .success').html('');

        var msg = jQuery(form_id + " .comment").val();
        if (validate(form_id)) {
            var messsage_body = "From \n" + msg_to_sent + " \n Message : " + msg;
            jQuery.ajax({
                type: 'POST',
                url: 'contactform.php',
                data: { 'Message': messsage_body },
                success: function (msg) {
                    if (msg == 'sent') {
                        jQuery(form_id + ' .success').html('<div class="alert alert-success">Message Sent Successfully</div>');
                        jQuery(form_id + ' .has-error').hide();
                        jQuery(form_id + " .req_field").html('');
                        jQuery(form_id).trigger("reset");
                        msg_to_sent = "";
                    } else {
                        jQuery(form_id + ' .success').html('<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>');
                        msg_to_sent = "";
                    }
                }
            });
        }
        return false;

    });

});