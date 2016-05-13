
<?php $this->load->view('be/modal/modal_add_edit_tag_view');?>
<div class="container">
    <div class="">
        <h1>Tag CMS</h1>
        <div class="well">
            <button type="button" id="btn-add" class="btn btn-primary" data-toggle="modal" data-target="#tag-modal">Create</button>

            <?php echo form_open('be/Tag/searchTag'); ?>
            <div class="input-group">
                <input type="text" class="form-control" name="search-text" value="<?php $search_text?>" placeholder="Search for...">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Go!</button>
                                  </span>
            </div><!-- /input-group -->
            <input type="file" name="files" />
            <input type="file" name="files" />
            <?php echo form_close(); ?>
        </div>
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

                var dataForm = new FormData();
                dataForm.append("tagName",name );
                $('input[type="file"]').each(function($i, file){
                    //alert(($(this)[0].files[0].name));
                    dataForm.append("files[]", $(this)[0].files[0]);
                    //imgListFile.push(file);
                    alert("a");
                });

                $.ajax({
                    url: "<?php echo site_url("be/test/createTag");?>",
                    data: dataForm,
                    dataType: 'json',
                    type : "POST",
                    contentType: false,
                    processData: false,
                    success: function (data, status) {
//                        if (data.status != 'error') {
//                            alertify.success(data.msg);
//                            $('#form-tag')[0].reset();
//                            window.location.reload();
//                        } else {
//                            alertify.error(data.msg);
//                        }
                        alertify.alert(status.responseText);
                        alertify.alert(status.responseXML);
                    },
                    error: function (xhr, status, error) {
                        //errBox(data.msg);
                        alertify.alert(xhr.responseText);
                        //alertify.alert(xhr.responseXML);
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
                var dataForm = new FormData();


                dataForm.append("tagName",name );

                $.ajax({
                    url: "<?php echo site_url("be/tag/updateTag");?>/" + id,
                    data: dataForm,
                    dataType: 'json',
                    type : "POST",
                    contentType: false,
                    processData: false,
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