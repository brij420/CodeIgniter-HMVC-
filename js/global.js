
$(document).ready(function() {

    $('#product_name_err').text("");
    $('#username_err').text("");
    $('#password_err').text("");
    $('#confirm_password_err').text("");
    $('#fname_err').text("");
    $('#lname_err').text("");
    $('#mname_err').text("");
    $('#email_err').text("");
    $('#subject_err').text("");
    $('#description_err').text("");




    $('#registration').submit(function(e) {
        e.preventDefault();
        if (($('#username').val() == '') || (!isAlphanumericCharachter($('#username').val())))
            $('#username_err').text("Please enter valid username!");
        else
            $('#username_err').text("");

        if (($('#fname').val() == '') || (!isAlphanumericCharachter($('#fname').val())))
            $('#fname_err').text("Please enter valid first name!");
        else
            $('#fname_err').text("");

        if ($('#mname').val() == '') {
            if (!isAlphanumericCharachter($('#mname').val()))
                $('#mname_err').text("Please enter valid middle name!");
            else
                $('#mname_err').text("");
        }

        if (($('#lname').val() == '') || (!isAlphanumericCharachter($('#lname').val())))
            $('#lname_err').text("Please enter valid last name!");
        else
            $('#lname_err').text("");

        if (($('#email').val() == '') || (!isEmail($('#email').val())))
            $('#email_err').text("Please enter valid email!");
        else
            $('#email_err').text("");

        if (($('#password').val()).length < 8)
            $('#password_err').text("Please enter valid password!");
        else
            $('#password_err').text("");

        if ($('#password').val() !== $('#confirm_password').val())
            $('#confirm_password_err').text("confirm password does not match!");
        else
            $('#confirm_password_err').text("");

//alert((isAlphanumericCharachter($('#username').val())) +' '+ (isAlphanumericCharachter($('#fname').val()))  +' '+   (isAlphanumericCharachter($('#lname').val())  +' '+ (isEmail($('#email').val())))  +' '+  ($('#password').val() == $('#confirm_password').val())  +' '+  (($('#password').val()).length >= 8));
        if ((isAlphanumericCharachter($('#username').val())) && (isAlphanumericCharachter($('#fname').val())) && (isAlphanumericCharachter($('#lname').val()) && (isEmail($('#email').val()))) && ($('#password').val() == $('#confirm_password').val()) && (($('#password').val()).length >= 8)) {
            $.ajax({
                url: get_base_url() + 'index.php/user/registration',
                type: "POST",
                dataType: "json",
                data: {userinfo: {
                        username: $('#username').val(),
                        fname: $('#fname').val(),
                        lname: $('#lname').val(),
                        mname: $('#mname').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        gender: $('#gender').val()
                    }
                },
                success: function(data) {
                    $('#registration').resetForm(); // reset form

                    if (data.addUser.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/user/index';
                        return false;
                    }
                    if (data.addUser.successCode != "000") {
                        $('#msg').html(data.addUser.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });




    $('#signin').submit(function(e) {
        e.preventDefault();
        if (($('#username').val() == '') || (!isAlphanumericCharachter($('#username').val())))
            $('#username_err').text("Please enter valid username!");
        else
            $('#username_err').text("");


        if (($('#password').val()).length < 8)
            $('#password_err').text("Please enter valid password!");
        else
            $('#password_err').text("");



        if ((isAlphanumericCharachter($('#username').val())) && (($('#password').val()).length >= 8)) {
            $.ajax({
                url: get_base_url() + 'index.php/user/login',
                type: "POST",
                dataType: "json",
                data: {signin: {
                        username: $('#username').val(),
                        password: $('#password').val()
                    }
                },
                success: function(data) {


                    if (data.signin.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/user/index';
                        return false;
                    }
                    if (data.signin.successCode != "000") {
                        $('#msg').text(data.signin.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });

    $('#forgotpassword').submit(function(e) {
        e.preventDefault();
        if (($('#email').val() == '') || (!isEmail($('#email').val())))
            $('#email_err').text("Please enter valid email!");
        else
            $('#email_err').text("");

        if (isEmail($('#email').val())) {
            $.ajax({
                url: get_base_url() + 'index.php/user/forgotpassword',
                type: "POST",
                dataType: "json",
                data: {forgotpassword: {
                        email: $('#email').val()
                    }
                },
                success: function(data) {
                    $('#forgotpassword').resetForm(); // reset form

                    if (data.forgotPassword.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/user/index';
                        return false;
                    }
                    if (data.forgotPassword.successCode != "000") {
                        $('#msg').html(data.forgotPassword.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });

    $('#comment_box').submit(function(e) {
        e.preventDefault();
        if ($('#subject').val() == '')
            $('#subject_err').text("Please enter subject field!");
        else
            $('#subject_err').text("");

        if ($('#description').val() == '')
            $('#description_err').text("Please enter description field!");
        else
            $('#description_err').text("");

        if (($('#subject').val() != '') && ($('#description').val() != '')) {
            $.ajax({
                url: get_base_url() + 'index.php/comment/add_comment',
                type: "POST",
                dataType: "json",
                data: {comment: {
                        subject: $('#subject').val(),
                        description: $('#description').val(),
                        photo_id: $('#photo_id').val()
                    }
                },
                success: function(data) {
                    // $('#comment_box').resetForm(); // reset form

                    if (data.comment.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/image/image_info?id=' + $('#photo_id').val();
                        return false;
                    }
                    if (data.comment.successCode != "000") {
                        $('#msg').html(data.comment.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });

    $('#cancel').click(function() {
        window.location.href = get_base_url() + 'index.php/user/index';
        return false;
    });

    $('#forgot').click(function() {
        window.location.href = get_base_url() + 'index.php/user/forgotpassword';
        return false;
    });
});

function isAlphanumericCharachter(str) {
    var valid = str.match(/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/);
    if (valid) {
        return true;
    } else {
        return false;
    }
}

function isEmail(str) {
    var valid = str.match(/^([a-z0-9][-a-z0-9_\+\.]*[a-z0-9])@([a-z0-9][-a-z0-9\.]*[a-z0-9]\.(arpa|root|aero|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|([0-9]{1,3}\.{3}[0-9]{1,3}))$/);
    if (valid) {
        return true;
    } else {
        return false;
    }
}

