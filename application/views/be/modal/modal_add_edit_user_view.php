<style>
.new_password
{
    display: none;
}
#preview-img
{
    width:320px;
}

</style>
<script>
$(function() {
    $(".btn-change-password").click(function(e){
        $('.label-danger').remove();
        $(".new_password").css("display","inline");
        $(".pass_input").removeAttr("disabled");
        $(".btn-change-password").css("display","none");
        $(".btn-change-password").parent().parent().removeClass("input-group");
        $("#is-change-password").val(1);
    });
    $(".btn-cancel-change-password").click(function(e){
        $('.label-danger').remove();
        $(".new_password").css("display","none");
        $(".pass_input").attr("disabled","disabled");
        $(".btn-change-password").css("display","inline");
        $(".btn-change-password").parent().parent().addClass("input-group");
        $("#is-change-password").val(0);
    });
});
</script>
<!--Modal-->
<div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel"></h4>
            </div><!--modal header-->

            <div class="modal-body">
                <div class="alert alert-danger hidden" id="err-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                </div>
                <form enctype="multipart/form-data" id="form-user" class="form-horizontal">
                    <input type="hidden" class="form-control" id="user-id" />
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Username</label>
                        <span id="err_username"></span>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control" id="username" placeholder="Please fill your Username here" />
                        </div>
                    </div>

                    <input type="hidden" id="is-change-password" name="is-change-password" value="0" />
                    <div class="form-group">
                        <label for="old_password" class="col-sm-3 control-label">Password</label>
                        <span id="err_old_password"></span>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="password" name="old_password" id="old_password" class="pass_input form-control" placeholder="Please fill your Password here" disabled="disabled" />
                                <span id="err_old_password"></span>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-change-password" type="button">Change Password</button>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="new_password">
                        <div class="form-group">
                            <label for="new_password" class="col-sm-3 control-label">New Password</label>
                            <span id="err_new_password"></span>
                            <div class="col-sm-8">
                                <input type="password" name="new_password" id="new_password" class="pass_input form-control" placeholder="Please fill your new password here" disabled="disabled" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="conf_password" class="col-sm-3 control-label" >Confirm New Password</label>
                            <span id="err_conf_password"></span>
                            <div class="col-sm-8">
                                <input type="password" name="conf_password" id="conf_password" class="pass_input form-control" placeholder="Please fill your new password here once more" disabled="disabled" />
                            </div>
                            <span class="col-sm-3">
                                <button class="btn btn-danger btn-cancel-change-password" type="button">Cancel Change Password</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="level" class="col-sm-3 control-label">User Level</label>
                        <span id="err_level"></span>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" name="level" id="level" value="admin" /> Super Admins
                            </label>
                            <!--<input type="radio" name="level" id="level" value="admin"  />Admin-->
                            <label class="radio-inline">
                                <input type="radio" name="level" id="level" value="member"  />Admins
                            </label>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" id="user-image-id" />
                    <div class="form-group">

                        <label for="userImageLink" class="col-sm-3 control-label">User Image :</label>
                        <span id="err_user_image"></span>
                        <div class="col-sm-8">
                            <input type="file" id="userImageLink" name="userImageLink" />
                        </div>
                    </div>
                    <img src="#" class="img-responsive" id="preview-img" />
                    
                </form>
            </div><!--modal body-->

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save</button>
                <button type="button" class="btn btn-primary" id="btn-update">Save Modified Data</button>
            </div><!--modal footer-->

        </div><!--modal content-->
    </div><!--modal dialog-->
</div>