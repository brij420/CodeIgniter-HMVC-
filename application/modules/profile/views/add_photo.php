<?php
echo Modules::run('template/profile_home');
echo Modules::run('template/profile_leftsidepanel');
?>
<link class="cssdeck" rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" class="cssdeck">
<script type="text/javascript" src="<?php echo base_url(); ?>js/global.js"></script>

<div class="modal-header" style="margin-left: 30%;">

    <h3>Add Photos</h3>
</div>
<div class="modal-body" style="max-height:700px;margin-left: 30%;">
    <div class="tab-pane active in" id="create">
        <span id="msg" class="err" ></span>
        <form id="add_images" method="" action="" enctype="multipart/form-data">
            <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
                <tr>
                    <th valign="top">Category:</th>
                    <td>	
                        <select  id="select_category" name="select_category" >
                            <option value="">select</option>                                                        
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th valign="top">Sub-Category Name:</th>
                    <td> <select  id="select_subcategory" name="select_sub_category" >
                            <option value="">select</option>                                                        
                        </select>
                    </td>

                </tr> 
                <tr> <th valign="top">Upload File</th>
                    <td>
                        <input type="button" id="upload" value="click here to upload image" /><span id="status"></span>
                        <input type="hidden" id="image_name" name="image_name" value=""/>
                        <ul id="files" ></ul>
                    </td>
                </tr>
                <tr>
                    <th valign="top"><button class="btn btn-primary" >Add Category</button></th>
                    <td> <button class="btn btn-primary" id="subcategory_cancel" >cancel</button></td>

                </tr>



            </table>

        </form>
    </div>


</div>


<script class="cssdeck" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

<?php
echo Modules::run('template/footer');
?>