<style>
.userImgLink img
{
    width:120px;    
}
</style>

<script src="<?php echo base_url(); ?>js/ajaxfileupload.js"></script>
<script type="text/javascript">
    
     $(function() {
        
        $(document).on('click',"ul.pagination li a",function(e){
             var url = $(this).attr("href");
             $.ajax({
                 type: "POST",
                 data: "ajax=1",
                 url: url,
                 beforeSend: function() {
                     $("#page-wrapper").html("");
                 },
                 success: function(msg) {
                     $("#page-wrapper").html(msg);
                     //applyPagination();
                 }
             });
             e.preventDefault();
             return false;
         });
        
        //Add Button click : for Add New Data
         $("#btn-add").click(function() {
             $(".modal-title").html("Add New User");  
             
             $('#form-user')[0].reset();
             $(".new_password").css("display","none");                          
             $("input[type='radio']:checked").removeAttr("checked");
             $(".pass_input").removeAttr("disabled");
             $(".btn-change-password").css("display","none");
             $("#is-change-password").val(0);
             $('#preview-img').attr('src', "");
             
             $(".btn-change-password").parent().parent().removeClass("input-group");
             $("#btn-save").show();
             $("#btn-update").hide();           
         });

        //Edit Button click : for Update Selected Data
        $(".btn-edit").click(function() {
            $(".modal-title").html("Edit User");
            $("#btn-save").hide();
            $("#btn-update").show();
            
             $(".btn-change-password").parent().parent().addClass("input-group");
             $(".pass_input").attr("disabled","disabled");
             $(".btn-change-password").css("display","inline");
             $("#is-change-password").val(0);
             $(".new_password").css("display","none");                          
             $(".btn-change-password").parent().parent().addClass("input-group");

            var row = $(this).closest("tr");  
            var username = row.find(".username").text();
            var userlevel = row.find(".level").text();
            var name = row.find(".name").text();
            var email = row.find(".email").text();
            var id = $(this).data("id");
            var col_img =  row.find(".col-img").children("img").prop('src');
            
            $('#form-user')[0].reset();                        
            $("#user-id").val(id);
            $("#username").val(username);
            $(":radio[value="+userlevel+"]").attr("checked","checked");
            $("#name").val(name);
            $("#email").val(email);
            $('#preview-img').attr('src', col_img);

        });                                          
         
         //For confirmation to delete user item
         function deleteConfirmation(id)
         {
            alertify.confirm("Apakah anda yakin ingin menghapus item ini ["+id+"] ?", function(e){
                if (e)
                {
                    alertify.success("Berhasil menghapus item");
                    location.href = "<?= site_url("be/user/deleteUser")?>"+"/"+id;                                
                }    
            });            
         }
         
         //Delete Button click : for delete (isActive = 0)
         $(".btn-delete").click(function(){
            
            var id = $(this).data("id");
            $("#user-id").val(id);
            deleteConfirmation(id);
            
         });
                  
         //Button Save click : for save new data
         $('#btn-save').click(function(e) {
    		e.preventDefault();
            $('.label-danger').remove();
            var data_post =
            {
                saveType : "save",
                //userID : $("#user-item-id").val(),
                username : $("#username").val(),                
                old_password : $("#old_password").val(),
                isChangePassword : $("#is-change-password").val(),
                level : $("#level").val()
            };
            if(validateProfileForm1())
            {
                $.ajax({
                    url: "<?= site_url('be/user/validateUsernamePassword') ?>",
                    data: data_post,
                    type: "POST",
                    dataType: 'json',
                    success: function(data){
                        if(data.msgUsername == 'error')
                        {
                            $("input#username").css("border-color","#fc5d32");
                            $('<span class="label label-danger">The Username already taken</span>').appendTo("#err_username");
                        }
                        else
                        {
                            $("input#username").css("border-color","#bdc3c7");
                            $('#err_username').html("");
                        }
                        
                        if(data.msgUsername == 'success' )
                        {
                            doAddEditUser("add");
                        }
                    },
                    error:function(msgPassword)
                    {
                        alertify.error("There is something wrong with the server");
                    }
                });
            }
	   });
       
       $('#btn-update').click(function(e) {
            e.preventDefault();
            $('.label-danger').remove();
            var data_post =
            {
                saveType : "edit",
                userID : $("#user-id").val(),
                username : $("#username").val(),
                isChangePassword : $("#is-change-password").val(),                                
                old_password : $("#old_password").val(),                
            };
            if(validateProfileForm2())
            {
                $.ajax({
                    url: "<?= site_url('be/user/validateUsernamePassword') ?>",
                    data: data_post,
                    type: "POST",
                    dataType: 'json',
                    success: function(data){
                        if(data.msgUsername == 'error')
                        {
                            $("input#username").css("border-color","#fc5d32");
                            $('<span class="label label-danger">The Username already taken</span>').appendTo("#err_username");                                                        
                        }
                        else
                        {
                            $("input#username").css("border-color","#bdc3c7");
                            $('#err_username').html("");
                        }
                        if(data.msgPassword == 'error')
                        {
                            $("input#old_password").css("border-color","#fc5d32");
                            $('<span class="label label-danger">The Password doesn\'t match with database</span>').appendTo("#err_old_password");                                                        
                        }
                        else
                        {
                            $("input#old_password").css("border-color","#bdc3c7");
                            $('#err_old_password').html("");
                        }
                        
                        if(data.msgUsername == 'success' && data.msgPassword == 'success')
                        {
                            doAddEditUser("edit");                            
                        }                        
                    },
                    error:function(msgPassword)
                    {
                        alertify.error("There is something wrong with the server");
                    }
                });
            }
            return false;
        });
        
        $("#search-btn").click(function(){
           alert("asdas");
           
           //e.preventDefault();
           //return false;
        });
        
        function doAddEditUser(action)
        {
            
            if(action == "add")
            {                
                $.ajaxFileUpload({
                    url             :"<?php echo site_url('be/user/addUser');?>", 
                    secureuri       :false,
                    fileElementId   :'userImageLink',
                    dataType        : 'json',
                    data            : {
                        'username' : $("#username").val(),
                        'isChangePassword' : $("#is-change-password").val(),                
                        'password' : $("#old_password").val(),
                        'userLevel' : $("input[type='radio']:checked").val(),                        
                    },
                    success : function (data, status)
                    {
                        if(data.status != 'error')
                        {
                            alertify.success(data.msg);
                            window.location.reload();
                        }
                        else
                        {
                            alertify.error(data.msg);
                        }
                        
                    },
                    error : function (data, status)
                    {
                        alertify.error(data.msg);
                    }
                });
                
            }
            else
            {
                var isUpdate = 0;
                var user_img_file = $('#userImageLink').val();
                if(user_img_file != ""){
                    isUpdate=1;
                }

                $.ajaxFileUpload({
                    url             :"<?php echo site_url('be/user/updateUser');?>", 
                    secureuri       :false,
                    fileElementId   :'userImageLink',
                    dataType        : 'json',
                    data            : {
                        'userID' : $("#user-id").val(),
                        'username' : $("#username").val(),
                        'isChangePassword' : $("#is-change-password").val(),                
                        'password' : $("#new_password").val(),
                        'userLevel' : $("input[type='radio']:checked").val(),
                        'isUpdate' : isUpdate                        
                    },
                    success : function (data, status)
                    {
                        if(data.status != 'error')
                        {
                            alertify.success(data.msg);
                            window.location.reload();
                        }
                        else
                        {
                            alertify.error(data.msg);
                        }
                        
                    },
                    error : function (data, status)
                    {
                        alertify.error(data.msg);
                    }
                });
            }
            
        }
        function validateProfileForm1()
        {
            
            var username = $("#username").val().trim();            
            var old_password = $("#old_password").val().trim();                        
            var userLevel = $("input[type='radio']:checked").val();            
            var err = 0;
            
            if(username == null || username == "")
            {
                $("input#username").css("border-color","#fc5d32");
                $('<span class="label label-danger">Please fill Username</span>').appendTo("#err_username");
                err++;
            }
            else
            {
                $("input#username").css("border-color","#bdc3c7");
                $('#err_username').html("");
            }
            if(old_password == null || old_password == "")
            {
                $("input#old_password").css("border-color","#fc5d32");
                $('<span class="label label-danger">Please fill Password</span>').appendTo("#err_old_password");
                err++;
            }
            else
            {
                $("input#old_password").css("border-color","#bdc3c7");
                $('#err_old_password').html("");
            }
            if(userLevel == null || userLevel == "")
            {
                $("input.level").css("border-color","#fc5d32");
                $('<span class="label label-danger">Please pick User Level</span>').appendTo("#err_level");
                err++;
            }
            else
            {
                $("input.level").css("border-color","#bdc3c7");
                $('#err_level').html("");    
            }
            
            if(err==0){
                return true;
            }else{
                return false;
            }
        }
        
        function validateProfileForm2()
        {
            
            var username = $("#username").val().trim();
            var isChangePassword = $("#is-change-password").val();
            var old_password = $("#old_password").val().trim();
            var new_password = $("#new_password").val().trim();
            var conf_password = $("#conf_password").val().trim();
            var userLevel = $("input[type='radio']:checked").val();            
            var err = 0;
            
            if(username == null || username == "")
            {
                $("input#username").css("border-color","#fc5d32");
                $('<span class="label label-danger">Please fill Username</span>').appendTo("#err_username");
                err++;
            }
            else
            {
                $("input#username").css("border-color","#bdc3c7");
                $('#err_username').html("");
            }
            if(isChangePassword == 1)
            {
                if(old_password == null || old_password == "")
                {
                    $("input#old_password").css("border-color","#fc5d32");
                    $('<span class="label label-danger">Please fill Old Password</span>').appendTo("#err_old_password");
                    err++;
                }
                else
                {
                    $("input#old_password").css("border-color","#bdc3c7");
                    $('#err_old_password').html("");
                }
                if(new_password == null || new_password == "")
                {
                    $("input#new_password").css("border-color","#fc5d32");
                    $('<span class="label label-danger">Please fill New Password</span>').appendTo("#err_new_password");
                    err++;
                }
                else
                {
                    $("input#new_password").css("border-color","#bdc3c7");
                    $('#err_new_password').html("");
                }
                if(conf_password == null || conf_password == "")
                {
                    $("input#conf_password").css("border-color","#fc5d32");
                    $('<span class="label label-danger">Please fill Confirm New Password</span>').appendTo("#err_conf_password");
                    err++;
                }                
                else if(new_password != conf_password)
                {
                    $("input#conf_password").css("border-color","#fc5d32");
                    $('<span class="label label-danger">Please fill Confirm New Password with same value with New Password</span>').appendTo("#err_conf_password");
                    err++;    
                }
                else
                {
                    
                    $("input#conf_password").css("border-color","#bdc3c7");
                    $('#err_conf_password').html("");
                }
            }
            else
            {
                $("input#old_password").css("border-color","#bdc3c7");
                $('#err_old_password').html("");
                $("input#new_password").css("border-color","#bdc3c7");
                $('#err_new_password').html("");
                $("input#conf_password").css("border-color","#bdc3c7");
                $('#err_conf_password').html("");
            }
            if(userLevel == null || userLevel == "")
            {
                $("input.level").css("border-color","#fc5d32");
                $('<span class="label label-danger">Please pick User Level</span>').appendTo("#err_level");
                err++;
            }
            else
            {
                $("input.level").css("border-color","#bdc3c7");
                $('#err_level').html("");    
            }
            
            if(err==0){
                return true;
            }else{
                return false;
            }
        }
        
        function IsEmail(email)
        {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }        
        function IsNotNumber(notnumber)
        {
            var regex = /^([^0-9]*)$/;
            return regex.test(notnumber);
        }
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // This will work for dynamically created element
        $('body').on('change', '#userImageLink', function(e){
            readURL(this);
        });
    }); 
</script>

<?php $this->load->view('be/modal/modal_add_edit_user_view');?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">User List Data</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                User's Data
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="well">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="button" id="btn-add" class="btn btn-primary" data-toggle="modal" data-target="#user-modal">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Data
                            </button>
                        </div><!-- /.col-lg-6 -->
                        <!--div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                  </span>
                            </div><!-- /input-group -->
                        <!--></div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div><!-- /.well -->

                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <!--<th>Password</th>-->
                            <th>User Level</th>
							<th>User Image</th>
                            <th>Action(s)</th>                           
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach($data as $row)
                        { 
                        ?>
                        <tr>
                            <td><?=$row['userID']?></td>
                            <td class="username"><?=$row['username']?></td>
                            <!--<td class="password"><?=$row['password']?></td>-->
							<td class="level"><?=$row['level']?></td>
                            <td class="userImgLink col-img">
                                <img src="<?=base_url()?>img/user/<?=$row['userImgLink']?>" alt="<?=$row['userImgLink']?>" /> <br>
                                <?=$row['userImgLink']?>
                            </td>
                            <td class="center">
                                <button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#user-modal" data-id="<?=$row['userID']?>">Edit</button>
                                <button type="button" class="btn btn-danger btn-delete" data-id="<?=$row['userID']?>" >Delete</button>
                            </td>
                        </tr>
                        <?php 
                        } 
                        ?>
                        </tbody>
                    </table>                   
                </div>                
            <?=$pages?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->