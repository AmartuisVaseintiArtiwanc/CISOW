<html>

<head>

    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>cms_resource/dist/css/sb-admin-2.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.js" type="text/javascript"></script>
    <style>
    .container-login{
        margin: auto;
        margin-top:200px;
        border:3px solid black;
        border-radius:15px;
        padding: 10px;
        width:450px;
    }
        .label-danger{
            font-size:12px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="username" type="username" id="username" autofocus>
                                <span id="error-username" class="label label-danger"></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" id="password" value="">
                                <span id="error-password" class="label label-danger"></span>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" id="btn-submit" class="btn btn-lg btn-success btn-block" value="Login">
                        </fieldset>
                    </form>
                    <span id="error-login" class="label label-danger"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$( document ).ready(function(){
    
    function validate(){
        var username = $("#username").val();
        var password = $("#password").val();
        var error = 0;
        if (username == null || username == "")
        {
            error++;
            $("#error-username").text("Username Harus Diisi");
            
        }else{
            $("#error-username").text("");
        }
        if (password == null || password == "")
        {
            error++;
            $("#error-password").text("Password Harus Diisi");
        }else{
            $("#error-password").text("");
        }
        if(error > 0)
        {
            return false;
        }else{
            return true;
        }
    }
    
    $("#btn-submit").click(function(){
        
        if(validate()){
            var datapost = {
                "username": $("#username").val(),
                "password": $("#password").val()
            };
            $.ajax({
                url: "<?php echo site_url('be/login/doLogin');?>",
                dataType:"json",
                type:"post", 
                data:datapost,
                success:
                function(result){                    
                    if(result.status == "error"){
                        $("#error-login").text(result.msg);
                        //alertify.error(result.msg);
                        
                    }
                    else{
                        //redirect page sudah sukses
                        //alertify.sucess("Berhasil Login !");
                        window.location.reload();
                    }
                },
                error:
                function(data)
                {
                    console.log(data.responseText);
                    $("#error-login").text("Username dan Password yang dimasukkan salah goblok");
                    //alertify.error(result.msg);
                }
            });    
        }
        return false;
        
        
        
    });
});
</script>
</body>
</html>