
<?php $this->load->view('be/modal/modal_add_edit_tag_view');?>
<div class="container">
    <div class="">
        <h1>Tag CMS</h1>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <button type="button" id="btn-add" class="btn btn-primary" data-toggle="modal" data-target="#tag-modal">Create</button>
                </div>
                <div class="col-md-9">
                    <?php echo form_open('be/Tag/searchTag'); ?>
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
            <th>Tag Name</th>
            <th>Last Modified(Year Month Date)</th>
            <th>Option</th>
            </thead>
            <tbody>
            <?php foreach($tag as $row){ ?>
                <tr>
                    <td class="col-name"><?=$row['tag']?></td>
                    <td><?=$row['lastUpdated']?></td>
                    <td>
                        <button type="button" class="btn btn-edit btn-primary"
                                data-id="<?=$row['tagID']?>" data-toggle="modal" data-target="#tag-modal">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                        </button>
                        <button type="button" data-id="<?=$row['tagID']?>" class="btn btn-delete btn-danger">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>Delete
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?=$pages?>
    </div>
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
            $(".modal-title").html("Add New Tag");

            //$("#color-code").val("");
            $('#form-tag')[0].reset();

            $("#btn-save").show();
            $("#btn-update").hide();

        });

        //Add Edit click : for Update Selected Data
        $(".btn-edit").click(function() {
            //show hide button
            $(".modal-title").html("Edit Tag");
            $("#btn-save").hide();
            $("#btn-update").show();

            //get value from selected row from table
            var row = $(this).closest("tr");
            var col_name =  row.find(".col-name").text();
            var id = $(this).data("id");

            //set data to Modal
            $('#form-tag')[0].reset();
            $("#tag-name").val(col_name);
            $("#tag-id").val(id);
        });


        //validate data before save
        function validateInputAdd(){
            var name = $('#tag-name').val();
            var err=0;
            //var required = $("<span>", {class: "label label-danger"}).text("required");

            if(name == "" || name == null){
                $("input#tag-name").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-tag-name");
                err++;
            }else{
                $("input#tag-name").css("border-color","black");
                $('#err-tag-name').html("");
            }

            if(err==0){
                return true;
            }else{
                return false;
            }
        }

        // validate data before update
        function validateFormEdit(){
            var name = $('#tag-name').val();
            var err=0;
            //var required = $("<span>", {class: "label label-danger"}).text("required");

            if(name == "" || name == null){
                $("input#tag-name").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-tag-name");
                err++;
            }else{
                $("input#tag-name").css("border-color","black");
                $('#err-tag-name').html("");
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
                var name = $('#tag-name').val();

                $.ajax({
                    url: "<?php echo site_url("be/tag/createTag");?>",
                    data: {"tagName":name},
                    dataType: 'json',
                    type : "POST",
                    success: function (data, status) {
                        if (data.status != 'error') {
                            alertify.success(data.msg);
                            $('#form-tag')[0].reset();
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
                var id = $("#tag-id").val();
                var name = $('#tag-name').val();
                var isUpdate = 0;

                $.ajax({
                    url: "<?php echo site_url("be/tag/updateTag");?>/" + id,
                    data: {"tagName":name},
                    dataType: 'json',
                    type : "POST",
                    success: function (data, status) {
                        if (data.status != 'error') {
                            alertify.success(data.msg);
                            $('#form-tag')[0].reset();
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
            var tag_name =  row.find(".col-name").text();

            var msg = "Do you want to delete "+tag_name+" Tag ?";
            // confirm dialog
            alertify.confirm(msg, function (e) {
                if (e) {
                    $.ajax({
                        url: "<?php echo site_url("be/tag/deleteTag");?>/"+id, //goto controller
                        data: "",
                        dataType : 'json',
                        type: "POST",
                        success: function(data){
                            if(data.status != "error"){
                                alertify.success(data.msg);
                                $('#form-tag')[0].reset();
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

</body>
</html>