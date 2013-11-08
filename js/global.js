
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
    $('#user_liked_list').hide();
    $('#category_err').hide();
    $('#subcategory_err').text("");
    $('#select_category_err').text("");
    $('#description_err').text("");
    $('#fees_err').text("");
    $('#start_date_err').text("");
    $('#start_vote_date_err').text("");
    $('#end_date_err').text("");
    $('#start_hour_err').text("");
    $('#end_hour_err').text("");

    $('#fprize_err').text("");
    $('#sprize_err').text("");
    $('#tprize_err').text("");
    $('#four_prize_err').text("");
    $('#fifth_prize_err').text("");
    $('#six_prize_err').text("");
    $('#seven_prize_err').text("");
    $('#eight_prize_err').text("");



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
                        address: $('#address').val(),
                        city: $('#city').val(),
                        country: $('#country').val(),
                        phone: $('#phone').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        image_name: $('#image_name').val(),
                        gender: $('input:radio[name=gender]:checked').val()
                    }
                },
                success: function(data) {

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

    $('#add_images').submit(function(e) {
        is_user_signin();
        e.preventDefault();


//alert((isAlphanumericCharachter($('#username').val())) +' '+ (isAlphanumericCharachter($('#fname').val()))  +' '+   (isAlphanumericCharachter($('#lname').val())  +' '+ (isEmail($('#email').val())))  +' '+  ($('#password').val() == $('#confirm_password').val())  +' '+  (($('#password').val()).length >= 8));


        $.ajax({
            url: get_base_url() + 'index.php/image/add_profile_image',
            type: "POST",
            dataType: "json",
            data: {profile_image: {
                    image_name: $('#image_name').val()
                }
            },
            success: function(data) {

                if (data.saveImage.successCode == "000") {
                    window.location.href = get_base_url() + 'index.php/profile/index';
                    return false;
                }

                if (data.saveImage.successCode != "000") {
                    $('#msg').html(data.addUser.successMessage);
                    return false;
                }

            }
        });
        return false;


    });
    $('#tournaments').click(function(e) {
        is_admin_signin();
        e.preventDefault();


//alert((isAlphanumericCharachter($('#username').val())) +' '+ (isAlphanumericCharachter($('#fname').val()))  +' '+   (isAlphanumericCharachter($('#lname').val())  +' '+ (isEmail($('#email').val())))  +' '+  ($('#password').val() == $('#confirm_password').val())  +' '+  (($('#password').val()).length >= 8));


        $.ajax({
            url: get_base_url() + 'index.php/image/get_tournament_images?id=' + $('#tournaments').val(),
            type: "POST",
            dataType: "json",
            success: function(data) {
                var str = '';
                var is_data = '';
                if (data.imageList.successCode == "000") {
                    str = '<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">';
                    str += '<tr>';

                    str += '<th class="table-header-repeat line-left minwidth-1"><a href="">S.No.</a>	</th>';
                    str += '<th class="table-header-repeat line-left minwidth-1"><a href="">User Name</a>	</th>';
                    str += '<th class="table-header-repeat line-left minwidth-1"><a href="">Images</a></th>';
                    str += '<th class="table-header-repeat line-left minwidth-1"><a href="">is Winner</a></th>';
                    // str += '<th class="table-header-repeat line-left"><a href="">Date</a></th>';
                    str += '<th class="table-header-options line-left"><a href="">Options</a></th>';
                    str += '</tr>';


                    for (var i = 0; i < data.imageList.images.length; i++) {
                        is_data++;
                        str += "<tr id='images'>";

                        str += '<td>' + (i + 1) + '</td>';
                        str += '<td>' + data.imageList.images[i].userName + '</td>';
                        str += '<td><img src="' + get_base_url() + 'uploads/' + data.imageList.images[i].image + '" height="100" width="100" /></td>';
                        if (data.imageList.images[i].is_winner)
                            str += '<td> Yes </td>';
                        else
                            str += '<td> No </td>';

                        str += '<td class="options-width">';
                        str += '<a href="' + get_base_url() + 'index.php/image/delete_tournament_image?id=' + data.imageList.images[i].id + '" title="Delete" class="icon-2 info-tooltip"></a>';
                        str += '<a href="' + get_base_url() + 'index.php/category/winner?image_id=' + data.imageList.images[i].id + '&user_id=' + data.imageList.images[i].user_id + '&sub_cat_id=' + data.imageList.images[i].sub_cat_id + '" title="Winner" class="icon-4 info-tooltip"></a>';
                        // str+='<a href="'+get_base_url()+'"index.php/category/add_subcategory" title="Add" class="icon-1 info-tooltip"></a>';
                        //str+='<a href="'+get_base_url()+'"index.php/category/add_subcategory" title="Add" class="icon-1 info-tooltip"></a>';
                        str += '</td>';
                        str += '</tr>';
                    }

                    str += '</table>';
                    if ((str != '') && (is_data))
                        $('#mainform').html(str);


                }
                if (is_data == '')
                    $('#mainform').html("<h3 style='text-align: center;background-color:grey;'>No image uploaded!</h3>");
                return false;


            }
        });
        return false;


    });
    $('#add_images_tournament').submit(function(e) {
        is_user_signin();
        e.preventDefault();

        $.ajax({
            url: get_base_url() + 'index.php/image/add_photo_tournament',
            type: "POST",
            dataType: "json",
            data: {image: {
                    select_subcategory: $('#subcategory').val(),
                    select_category: $('#category').val(),
                    image_name: $('#image_name').val()
                }
            },
            success: function(data) {

                if (data.saveImage.successCode == "000") {
                    window.location.href = get_base_url() + 'index.php/category/subcategory?id=' + $('#subcategory').val();
                    return false;
                }

                if (data.saveImage.successCode != "000") {
                    $('#msg').html(data.addUser.successMessage);
                    return false;
                }

            }
        });
        return false;

    });

    $('#add_user_form').submit(function(e) {
        is_admin_signin();
        e.preventDefault();
        if (($('#username').val() == '') || (!isAlphanumericCharachter($('#username').val())))
            $('#username_err').text("Please enter valid username!");
        else
            $('#username_err').text("");

        if (($('#address').val() == ''))
            $('#address_err').text("Please enter valid address!");
        else
            $('#address_err').text("");

        if (($('#city').val() == '') || (!isAlphanumericCharachter($('#city').val())))
            $('#city_err').text("Please enter valid city name!");
        else
            $('#city_err').text("");

        if (($('#country').val() == '') || (!isAlphanumericCharachter($('#country').val())))
            $('#country_err').text("Please enter valid country name!");
        else
            $('#country_err').text("");

        if (($('#phone').val() == '') || (!isNumeric($('#phone').val())))
            $('#phone_err').text("Please enter valid Phone number!");
        else
            $('#phone_err').text("");

        if (($('#fname').val() == '') || (!isAlphanumericCharachter($('#fname').val())))
            $('#fname_err').text("Please enter valid first name!");
        else
            $('#fname_err').text("");


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
                url: get_base_url() + 'index.php/administrator/add_user',
                type: "POST",
                dataType: "json",
                data: {userinfo: {
                        username: $('#username').val(),
                        fname: $('#fname').val(),
                        lname: $('#lname').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        is_admin: $('#is_admin').val(),
                        gender: $('input:radio[name=gender]:checked').val(),
                        city: $('#city').val(),
                        country: $('#country').val(),
                        phone: $('#phone').val(),
                        address: $('#address').val()
                    }
                },
                success: function(data) {
                    // $('#registration').resetForm(); // reset form

                    if (data.addUser.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/administrator/user_list';
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

    $('#edit_user_form').submit(function(e) {
        is_admin_signin();
        e.preventDefault();
        if (($('#username').val() == '') || (!isAlphanumericCharachter($('#username').val())))
            $('#username_err').text("Please enter valid username!");
        else
            $('#username_err').text("");

        if (($('#fname').val() == '') || (!isAlphanumericCharachter($('#fname').val())))
            $('#fname_err').text("Please enter valid first name!");
        else
            $('#fname_err').text("");


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
                url: get_base_url() + 'index.php/administrator/edit_user',
                type: "POST",
                dataType: "json",
                data: {userinfo: {
                        id: $('#id').val(),
                        username: $('#username').val(),
                        fname: $('#fname').val(),
                        lname: $('#lname').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        is_admin: $('#is_admin').val(),
                        gender: $('input:radio[name=gender]:checked').val()
                    }
                },
                success: function(data) {
                    // $('#registration').resetForm(); // reset form

                    if (data.editUser.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/administrator/user_list';
                        return false;
                    }

                    if (data.editUser.successCode != "000") {
                        $('#msg').html(data.editUser.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });

    $('#add_category_form').submit(function(e) {
        is_admin_signin();
        e.preventDefault();
        if (($('#category').val() == '') || (!isAlphanumericCharachter($('#category').val())))
            $('#category_err').text("Please enter valid category!");
        else
            $('#category_err').text("");



//alert((isAlphanumericCharachter($('#username').val())) +' '+ (isAlphanumericCharachter($('#fname').val()))  +' '+   (isAlphanumericCharachter($('#lname').val())  +' '+ (isEmail($('#email').val())))  +' '+  ($('#password').val() == $('#confirm_password').val())  +' '+  (($('#password').val()).length >= 8));
        if (isAlphanumericCharachter($('#category').val())) {
            $.ajax({
                url: get_base_url() + 'index.php/category/add_category',
                type: "POST",
                dataType: "json",
                data: {category: {
                        category: $('#category').val()
                    }
                },
                success: function(data) {
                    // $('#registration').resetForm(); // reset form

                    if (data.addCategory.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/category/category_list';
                        return false;
                    }

                    if (data.addCategory.successCode != "000") {
                        $('#msg').html(data.addCategory.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });
    $('#edit_category_form').submit(function(e) {
        is_admin_signin();
        e.preventDefault();
        if (($('#category').val() == '') || (!isAlphanumericCharachter($('#category').val())))
            $('#category_err').text("Please enter valid category!");
        else
            $('#category_err').text("");



//alert((isAlphanumericCharachter($('#username').val())) +' '+ (isAlphanumericCharachter($('#fname').val()))  +' '+   (isAlphanumericCharachter($('#lname').val())  +' '+ (isEmail($('#email').val())))  +' '+  ($('#password').val() == $('#confirm_password').val())  +' '+  (($('#password').val()).length >= 8));
        if (isAlphanumericCharachter($('#category').val())) {
            $.ajax({
                url: get_base_url() + 'index.php/category/edit_category',
                type: "POST",
                dataType: "json",
                data: {category: {
                        category: $('#category').val(),
                        id: $('#id').val()
                    }
                },
                success: function(data) {
                    // $('#registration').resetForm(); // reset form

                    if (data.editCategory.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/category/category_list';
                        return false;
                    }

                    if (data.editCategory.successCode != "000") {
                        $('#msg').html(data.editCategory.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });
    $('#add_subcategory_form').submit(function(e) {
        is_admin_signin();
        e.preventDefault();
        if (($('#subcategory').val() == '') || (!isAlphanumericCharachter($('#subcategory').val())))
            $('#subcategory_err').text("Please enter valid sub-category!");
        else
            $('#subcategory_err').text("");

        if (($('#select_category').val() == '') || (!isNumeric($('#select_category').val())))
            $('#select_category_err').text("Please enter valid category!");
        else
            $('#select_category_err').text("");

        if (($('#description').val() == ''))
            $('#description_err').text("Please enter description!");
        else
            $('#description_err').text("");

        if (($('#fees').val() == '') || (!isNumeric($('#fees').val())))
            $('#fees_err').text("Please enter tournament fees!");
        else
            $('#fees_err').text("");

        if (($('#start_date').val() == ''))
            $('#start_date_err').text("Please enter start date!");
        else
            $('#start_date_err').text("");
        
         if (($('#start_vote_date').val() == ''))
            $('#start_vote_date_err').text("Please enter start vote date!");
        else
            $('#start_vote_date_err').text("");

        if (($('#end_date').val() == ''))
            $('#end_date_err').text("Please enter end date!");
        else
            $('#end_date_err').text("");

        if (($('#start_hour').val() == ''))
            $('#start_hour_err').text("Please enter start hour!");
        else
            $('#start_hour_err').text("");

        if (($('#end_hour').val() == ''))
            $('#end_hour_err').text("Please enter end hour!");
        else
            $('#end_hour_err').text("");


        if (($('#fprize').val() != '')) {
            if ((!isNumeric($('#fprize').val()))) {
                $('#fprize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#fprize_err').text("");
            }
        }
        if (($('#sprize').val() != '')) {
            if ((!isNumeric($('#sprize').val()))) {
                $('#sprize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#sprize_err').text("");
            }
        }
        if (($('#tprize').val() != '')) {

            if ((!isNumeric($('#tprize').val()))) {
                $('#tprize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#tprize_err').text("");
            }
        }
        if (($('#four_prize').val() != '')) {
            if ((!isNumeric($('#four_prize').val()))) {
                $('#four_prize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#four_prize_err').text("");
            }
        }
        if (($('#fifth_prize').val() != '')) {
            if ((!isNumeric($('#fifth_prize').val()))) {
                $('#fifth_prize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#fifth_prize_err').text("");
            }
        }
        if (($('#six_prize').val() != '')) {
            if ((!isNumeric($('#six_prize').val()))) {
                $('#six_prize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#six_prize_err').text("");
            }
        }
        if (($('#seven_prize').val() != '')) {
            if ((!isNumeric($('#seven_prize').val()))) {
                $('#seven_prize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#seven_prize_err').text("");
            }
        }
        if (($('#eight_prize').val() != '')) {
            if ((!isNumeric($('#eight_prize').val()))) {
                $('#eight_prize_err').text("Please enter digit's only!");
                return false;
            }
            else {
                $('#eight_prize_err').text("");
            }

        }
//alert((isAlphanumericCharachter($('#username').val())) +' '+ (isAlphanumericCharachter($('#fname').val()))  +' '+   (isAlphanumericCharachter($('#lname').val())  +' '+ (isEmail($('#email').val())))  +' '+  ($('#password').val() == $('#confirm_password').val())  +' '+  (($('#password').val()).length >= 8));
        if ((isAlphanumericCharachter($('#subcategory').val())) && (isNumeric($('#select_category').val())) && ($('#description').val() != '') && ($('#start_hour').val()) && ($('#end_hour').val())) {
            $.ajax({
                url: get_base_url() + 'index.php/category/add_subcategory',
                type: "POST",
                dataType: "json",
                data: {subcategory: {
                        select_category: $('#select_category').val(),
                        subcategory: $('#subcategory').val(),
                        description: $('#description').val(),
                        fees: $('#fees').val(),
                        start_date: $('#start_date').val(),
                        start_vote_date:$('#start_vote_date').val(),
                        end_date: $('#end_date').val(),
                        start_hour: $('#start_hour').val(),
                        end_hour: $('#end_hour').val(),
                        fprize: $('#fprize').val(),
                        sprize: $('#sprize').val(),
                        tprize: $('#tprize').val(),
                        four_prize: $('#four_prize').val(),
                        fifth_prize: $('#fifth_prize').val(),
                        six_prize: $('#six_prize').val(),
                        seven_prize: $('#seven_prize').val(),
                        eight_prize: $('#eight_prize').val()
                    }
                },
                success: function(data) {
                    // $('#registration').resetForm(); // reset form

                    if (data.addSubCategory.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/category/subcategory_list';
                        return false;
                    }

                    if (data.addSubCategory.successCode != "000") {
                        $('#msg').html(data.addSubCategory.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });
    $('#edit_subcategory_form').submit(function(e) {
        is_admin_signin();
        e.preventDefault();
        if (($('#subcategory').val() == '') || (!isAlphanumericCharachter($('#subcategory').val())))
            $('#subcategory_err').text("Please enter valid sub-category!");
        else
            $('#subcategory_err').text("");

        if (($('#select_category').val() == '') || (!isNumeric($('#select_category').val())))
            $('#select_category_err').text("Please enter valid category!");
        else
            $('#select_category_err').text("");

        if (($('#description').val() == ''))
            $('#description_err').text("Please enter description!");
        else
            $('#description_err').text("");

        if (($('#fees').val() == '') || (!isNumeric($('#fees').val())))
            $('#fees_err').text("Please enter tournament fees!");
        else
            $('#fees_err').text("");

        if (($('#start_date').val() == ''))
            $('#start_date_err').text("Please enter start date!");
        else
            $('#start_date_err').text("");
        
        if (($('#start_vote_date').val() == ''))
            $('#start_vote_date_err').text("Please enter start vote date!");
        else
            $('#start_vote_date_err').text("");

        if (($('#end_date').val() == ''))
            $('#end_date_err').text("Please enter end date!");
        else
            $('#end_date_err').text("");

        if (($('#start_hour').val() == ''))
            $('#start_hour_err').text("Please enter start hour!");
        else
            $('#start_hour_err').text("");

        if (($('#end_hour').val() == ''))
            $('#end_hour_err').text("Please enter end hour!");
        else
            $('#end_hour_err').text("");

        if (($('#fees').val() == '') || (!isNumeric($('#fees').val())))
            $('#fees_err').text("Please enter tournament fees!");
        else
            $('#fees_err').text("");

        if (($('#start_date').val() == ''))
            $('#start_date_err').text("Please enter start date!");
        else
            $('#start_date_err').text("");

        if (($('#end_date').val() == '')) {
            $('#end_date_err').text("Please enter end date!");
        } else {
            $('#end_date_err').text("");
        }


        if (($('#fprize').val() != '')) {
            if ((!isNumeric($('#fprize').val()))) {
                $('#fprize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#fprize_err').text("");
            }
        }
        if (($('#sprize').val() != '')) {
            if ((!isNumeric($('#sprize').val()))) {
                $('#sprize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#sprize_err').text("");
            }
        }
        if (($('#tprize').val() != '')) {

            if ((!isNumeric($('#tprize').val()))) {
                $('#tprize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#tprize_err').text("");
            }
        }
        if (($('#four_prize').val() != '')) {
            if ((!isNumeric($('#four_prize').val()))) {
                $('#four_prize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#four_prize_err').text("");
            }
        }
        if (($('#fifth_prize').val() != '')) {
            if ((!isNumeric($('#fifth_prize').val()))) {
                $('#fifth_prize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#fifth_prize_err').text("");
            }
        }
        if (($('#six_prize').val() != '')) {
            if ((!isNumeric($('#six_prize').val()))) {
                $('#six_prize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#six_prize_err').text("");
            }
        }
        if (($('#seven_prize').val() != '')) {
            if ((!isNumeric($('#seven_prize').val()))) {
                $('#seven_prize_err').text("Please enter digit's only!");
                return false;
            } else {
                $('#seven_prize_err').text("");
            }
        }
        if (($('#eight_prize').val() != '')) {
            if ((!isNumeric($('#eight_prize').val()))) {
                $('#eight_prize_err').text("Please enter digit's only!");
                return false;
            }
            else {
                $('#eight_prize_err').text("");
            }

        }
//alert((isAlphanumericCharachter($('#username').val())) +' '+ (isAlphanumericCharachter($('#fname').val()))  +' '+   (isAlphanumericCharachter($('#lname').val())  +' '+ (isEmail($('#email').val())))  +' '+  ($('#password').val() == $('#confirm_password').val())  +' '+  (($('#password').val()).length >= 8));
        if ((isAlphanumericCharachter($('#subcategory').val())) && (isNumeric($('#select_category').val())) && ($('#description').val() != '') && ($('#start_hour').val()) && ($('#end_hour').val())) {
            $.ajax({
                url: get_base_url() + 'index.php/category/edit_subcategory',
                type: "POST",
                dataType: "json",
                data: {subcategory: {
                        select_category: $('#select_category').val(),
                        subcategory: $('#subcategory').val(),
                        description: $('#description').val(),
                        fees: $('#fees').val(),
                        start_date: $('#start_date').val(),
                        start_vote_date:$('#start_vote_date').val(),
                        end_date: $('#end_date').val(),
                        start_hour: $('#start_hour').val(),
                        end_hour: $('#end_hour').val(),
                        fprize: $('#fprize').val(),
                        sprize: $('#sprize').val(),
                        tprize: $('#tprize').val(),
                        four_prize: $('#four_prize').val(),
                        fifth_prize: $('#fifth_prize').val(),
                        six_prize: $('#six_prize').val(),
                        seven_prize: $('#seven_prize').val(),
                        eight_prize: $('#eight_prize').val(),
                        id: $('#id').val()
                    }
                },
                success: function(data) {
                    // $('#registration').resetForm(); // reset form

                    if (data.editSubCategory.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/category/subcategory_list';
                        return false;
                    }

                    if (data.editSubCategory.successCode != "000") {
                        $('#msg').html(data.editSubCategory.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });
    $('#select_category').click(function(e) {
        $('#select_subcategory').empty();
        $.ajax({
            url: get_base_url() + 'index.php/category/select_child_category?cat_id=' + $('#select_category').val(),
            type: "POST",
            dataType: "json",
            success: function(data) {

                var str = '';

                str += '<option value="select" select= "select" >select</option>';
                for (var i = 0; i < data.subcategory.length; i++) {
                    if ($('#cat_id').val() == data.subcategory[i].id)
                        str += '<option value="' + data.category[i].id + '" selected= "selected">' + data.subcategory[i].name + '</option>';
                    else
                        str += '<option value="' + data.subcategory[i].id + '">' + data.subcategory[i].name + '</option>';
                }
                $('#select_subcategory').html(str);
            }
        });
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
                    //$('#forgotpassword').resetForm(); // reset form

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

    $('#resetpassword').submit(function(e) {
        e.preventDefault();
        if (($('#password').val() == '') && (($('#password').val()).length < 8))
            $('#password_err').text("Please enter valid password of 8-character length!");
        else
            $('#password_err').text("");

        if (($('#confirm_password').val() == '') && ($('#confirm_password').val() != $('#password').val()))
            $('#confirm_password_err').text("Confirm password does not match!");
        else
            $('#confirm_password_err').text("");

        if ((($('#password').val()).length < 8) && ($('#confirm_password').val() == $('#password').val())) {
            $.ajax({
                url: get_base_url() + 'index.php/user/reset_password',
                type: "POST",
                dataType: "json",
                data: {reset_password: {
                        password: $('#password').val(),
                        link: $('#link').val()
                    }
                },
                success: function(data) {
                    //$('#forgotpassword').resetForm(); // reset form

                    if (data.resetPassword.successCode == "000") {
                        window.location.href = get_base_url() + 'index.php/user/index';
                        return false;
                    }
                    if (data.resetPassword.successCode != "000") {
                        $('#msg').html(data.resetPassword.successMessage);
                        return false;
                    }

                }
            });
            return false;
        }
        return false;

    });

    $('#comment_box').submit(function(e) {
        is_user_signin();
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

    $('#likes').click(function(e) {
        is_user_signin();
        e.preventDefault();
        $('#user_liked_list').toggle();

        $.ajax({
            url: get_base_url() + 'index.php/likes/likes_image',
            type: "POST",
            dataType: "json",
            data: {likes: {
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

    });

    $('#cancel').click(function() {
        window.location.href = get_base_url() + 'index.php/user/index';
        return false;
    });
    $('#category_cancel').click(function() {
        window.location.href = get_base_url() + 'index.php/category/category_list';
        return false;
    });

    $('#subcategory_cancel').click(function() {
        window.location.href = get_base_url() + 'index.php/category/subcategory_list';
        return false;
    });
    $('#admin_cancel').click(function() {
        window.location.href = get_base_url() + 'index.php/administrator/index';
        return false;
    });

    $('#forgot').click(function() {
        window.location.href = get_base_url() + 'index.php/user/forgotpassword';
        return false;
    });
});

function isAlphanumericCharachter(str) {
    if (str != null)
        var valid = str.match(/^[a-zA-Z0-9]+[-_,a-zA-Z0-9\s]*$/);
    if (valid) {
        return true;
    } else {
        return false;
    }
}

function isNumeric(str) {
    if (str != null)
        var valid = str.match(/^[0-9]+$/);
    if (valid) {
        return true;
    } else {
        return false;
    }
}
function isEmail(str) {
    if (str != null)
        var valid = str.match(/^([a-z0-9][-a-z0-9_\+\.]*[a-z0-9])@([a-z0-9][-a-z0-9\.]*[a-z0-9]\.(arpa|root|aero|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)|([0-9]{1,3}\.{3}[0-9]{1,3}))$/);
    if (valid) {
        return true;
    } else {
        return false;
    }
}

function is_user_signin() {
    $(document).ready(function() {
        $.ajax({
            url: get_base_url() + 'index.php/user/is_signin',
            type: "POST",
            dataType: "json",
            success: function(data) {
                if (data.isSignin.successCode != "000") {
                    alert(data.isSignin.successMessage);
                    window.location.href = get_base_url() + 'index.php/user/login';
                    return false;
                }

            }
        });
    });

}

function is_admin_signin() {
    $(document).ready(function() {
        $.ajax({
            url: get_base_url() + 'index.php/administrator/isadmin_signin',
            type: "POST",
            dataType: "json",
            success: function(data) {
                if (data.isAdminSignin.successCode != "000") {
                    alert(data.isAdminSignin.successMessage);
                    window.location.href = get_base_url() + 'index.php/administrator/index';
                    return false;
                }
                return false;
            }
        });
    });
    return false;
}

