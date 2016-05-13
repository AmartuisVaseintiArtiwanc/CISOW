
<?php $this->load->view('be/modal/modal_add_edit_portofolio_view');?>
    <div class="">
        <h1>Portofolio CMS</h1>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <button type="button" id="btn-add" class="btn btn-primary" data-toggle="modal" data-target="#portofolio-modal">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create
                    </button>
                </div>
                <div class="col-md-9">
                    <?php echo form_open('be/Portofolio/searchPortofolio'); ?>
                    <div class="input-group">
                        <input type="text" class="form-control" name="search-text" value="<?php $search_text?>" placeholder="Search for...">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Go!</button>
                              </span>
                    </div><!-- /input-group -->
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
            <th>PortofolioID</th>
            <th>Image</th>
            <th>description</th>
            <th>Type</th>
            <th>Last Modified(Year Month Date)</th>
            <th>Option</th>
            </thead>
            <tbody>
            <?php foreach($portofolio as $row){ ?>
                <tr>
                    <td class="col-id"><?=$row['portofolioID']?></td>
                    <td class="col-img"><img class="img-responsive" width="200px" height="200px" src="<?=base_url()?>img/portofolio/<?=$row['portofolioImgLink']?>"></td>
                    <td class="col-desc"><?=$row['description']?></td>
                    <td class="col-type"><?=$row['type']?></td>
                    <td class="col-lastUpdate"><?=$row['lastUpdated']?></td>
                    <td>
                        <button type="button" class="btn btn-edit btn-primary"
                                data-id="<?=$row['portofolioID']?>" data-toggle="modal" data-target="#portofolio-modal">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        <button type="button" data-id="<?=$row['portofolioID']?>" class="btn btn-delete btn-danger">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?=$pages?>
    </div>

<script>

    $(function(){

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

        $("#btn-add").click(function() {
            $(".modal-title").html("Add New Portofolio");

            //$("#color-code").val("");
            $('#form-portofolio')[0].reset();
            $('#preview-img').attr('src', "");

            $("#btn-save").show();
            $("#btn-update").hide();

        });

        //Add Edit click : for Update Selected Data
        $(".btn-edit").click(function() {
            //show hide button
            $(".modal-title").html("Edit portofolio");
            $("#btn-save").hide();
            $("#btn-update").show();

            //get value from selected row from table
            var row = $(this).closest("tr");
            var id = row.find(".col-id").text();
            var col_img =  row.find(".col-img").children("img").prop('src');
            var col_desc =  row.find(".col-desc").text();
            var col_type =  row.find(".col-type").text();

            //set data to Modal
            $('#form-portofolio')[0].reset();
            $('#preview-img').attr('src', col_img);
            $("#portofolio-desc").val(col_desc);
            $("#portofolio-type").val(col_type);
            $("#portofolio-id").val(id);
        });

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
        $('body').on('change', '#portofolio-img-file', function(e){
            readURL(this);
        });

        //validate data before save
        function validateInputAdd(){
            var desc = $('#portofolio-desc').val();
            var type = $('#portofolio-type').val();
            var img = $('#portofolio-img-file').val();
            var err=0;
            //var required = $("<span>", {class: "label label-danger"}).text("required");
            if(desc == "" || desc == null){
                $("input#portofolio-desc").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-portofolio-desc");
                err++;
            }else{
                $("input#portofolio-desc").css("border-color","black");
                $('#err-portofolio-desc').html("");
            }
            if(img == null || img == ""){
                $("#portofolio-img-file").css("border-color","#fc5d32");
                $('<span class="label label-danger">No Image Choose !</span>').appendTo("#err-portofolio-file");
                err++;
            }else{
                $("#portofolio-img-file").css("border-color","black");
                $('#err-portofolio-file').html("");
            }
            if(type == null || type == ""){
                $("input#portofolio-type").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-portofolio-type");
                err++;
            }else{
                $("input#portofolio-type").css("border-color","black");
                $('#err-portofolio-type').html("");
            }
            if(err==0){
                return true;
            }else{
                return false;
            }
        }
        // validate data before update
        function validateFormEdit(){
            var desc = $('#portofolio-desc').val();
            var type = $('#portofolio-type').val();
            var err=0;
            //var required = $("<span>", {class: "label label-danger"}).text("required");

            if(desc == "" || desc == null){
                $("input#portofolio-desc").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-portofolio-desc");
                err++;
            }else{
                $("input#portofolio-desc").css("border-color","black");
                $('#err-portofolio-desc').html("");
            }
            if(err==0){
                return true;
            }else{
                return false;
            }
        }

        $('#btn-save').click(function(e) {
            $(".label-danger").remove();
            e.preventDefault();
            if(validateInputAdd()) {
                var img=$('#portofolio-img-file')[0].files[0];
                var desc = $('#portofolio-desc').val();
                var type = $('#portofolio-type').val();

                var dataForm = new FormData();
                dataForm.append("portofolioDesc",desc );
                dataForm.append("portofolioType",type );
                dataForm.append("img",img );

                $.ajax({
                    url: "<?php echo site_url("be/portofolio/createPortofolio");?>",
                    data: dataForm,
                    dataType: 'json',
                    type : "POST",
                    contentType: false,
                    processData: false,
                    success: function (data, status) {
                        if (data.status != 'error') {
                            alertify.success(data.msg);
                            $('#form-portofolio')[0].reset();
                            window.location.reload();
                        } else {
                            alertify.error(data.msg);
                        }
                    },
                    error: function (data) {
                        //errBox(data.msg);
                        alertify.error('Failed to Response Server!');
                    }
                });
            }
            return false;
        });

        $('#btn-update').click(function(e) {
            $(".label-danger").remove();
            e.preventDefault();

            if(validateFormEdit()) {
                var id = $("#portofolio-id").val();
                var img =$('#portofolio-img-file')[0].files[0];
                var desc = $('#portofolio-desc').val();
                var type = $('#portofolio-type').val();
                var isUpdate = 0;
                var dataForm = new FormData();

                if(img!=null){
                    isUpdate=1;
                    dataForm.append("img",img );
                }
                
                dataForm.append("id",id);
                dataForm.append("portofolioType",type);
                dataForm.append("portofolioDesc",desc );
                dataForm.append("isUpdateImg",isUpdate );

                $.ajax({
                    url: "<?php echo site_url("be/portofolio/updatePortofolio");?>/" + id,
                    data: dataForm,
                    dataType: 'json',
                    type : "POST",
                    contentType: false,
                    processData: false,
                    success: function (data, status) {
                        if (data.status != 'error') {
                            alertify.success(data.msg);
                            $('#form-portofolio')[0].reset();
                            window.location.reload();
                        } else {
                            alertify.error(data.msg);
                        }
                    },
                    error: function (data) {
                        //errBox(data.msg);
                        alertify.error('Failed to Response Server!');
                    }
                });
            }
            return false;

        });

        // btn delete when clicked
        $(".btn-delete").click(function(){
            var id = $(this).data("id");
            var row = $(this).closest("tr");
            var portofolio_desc =  row.find(".col-desc").text();

            var msg = "Do you want to delete "+portofolio_desc+" category ?";
            // confirm dialog
            alertify.confirm(msg, function (e) {
                if (e) {
                    $.ajax({
                        url: "<?php echo site_url("be/portofolio/deletePortofolio");?>/"+id, //goto controller
                        data: "",
                        dataType : 'json',
                        type: "POST",
                        success: function(data){
                            if(data.status != "error"){
                                alertify.success(data.msg);
                                $('#form-portofolio')[0].reset();
                                window.location.reload();
                            }else{
                                alertify.error(data.msg);
                            }
                        },
                        error: function(data) {
                            alertify.error('Failed to Response Server!');
                        }
                    });
                } else {
                    // user clicked "cancel"
                }
            });
        });

    });
</script>