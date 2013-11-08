$(document).ready(function() {
    category_list();
});

function category_list() {
        is_admin_signin();
        $('#select_category').empty();
        $.ajax({
            url: get_base_url() + 'index.php/category/get_parent_category',
            type: "POST",
            dataType: "json",
            success: function(data) {

                var str = '';

                if ($('#cat_id').val())
                    str += '<option value="select" >select</option>';
                else
                    str += '<option value="select" select= "select" >select</option>';
                for (var i = 0; i < data.category.length; i++) {
                    if ($('#cat_id').val() == data.category[i].id)
                        str += '<option value="' + data.category[i].id + '" selected= "selected">' + data.category[i].name + '</option>';
                    else
                        str += '<option value="' + data.category[i].id + '">' + data.category[i].name + '</option>';
                }
                $('#select_category').html(str);
            }
        });
        return false;


    }