
<?php $this->load->view('be/modal/modal_add_edit_article_category_view');?>
    <div class="">
        <h1>Article CMS</h1>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <button type="button" id="btn-add" class="btn btn-primary" data-toggle="modal" data-target="#article-category-modal">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create
                    </button>
                </div>
                <div class="col-md-9">
                    <?php echo form_open('be/Article/searchCategory'); ?>
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
            <th>Category</th>
            <th>Image</th>
            <th>Last Modified(Year Month Date)</th>
            <th>Option</th>
            </thead>
            <tbody>
            <?php foreach($categories as $row){ ?>
                <tr>
                    <td class="col-name"><?=$row['category']?></td>
                    <td class="col-img"><img class="img-responsive" width="30" height="30" src="<?=base_url()?>/img/category/<?=$row['categoryImgLink']?>"></td>
                    <td><?=$row['lastUpdated']?></td>
                    <td>
                        <button type="button" class="btn btn-edit btn-primary"
                                data-id="<?=$row['categoryID']?>" data-toggle="modal" data-target="#article-category-modal">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                        <button type="button" data-id="<?=$row['categoryID']?>" class="btn btn-delete btn-danger">
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
            $(".modal-title").html("Add New Category");

            //$("#color-code").val("");
            $('#form-category')[0].reset();
            $('#preview-img').attr('src', "");

            $("#btn-save").show();
            $("#btn-update").hide();

        });

        //Add Edit click : for Update Selected Data
        $(".btn-edit").click(function() {
            //show hide button
            $(".modal-title").html("Edit Category");
            $("#btn-save").hide();
            $("#btn-update").show();

            //get value from selected row from table
            var row = $(this).closest("tr");
            var col_name =  row.find(".col-name").text();
            var col_img =  row.find(".col-img").children("img").prop('src');
            var id = $(this).data("id");

            //set data to Modal
            $('#form-category')[0].reset();
            $("#category-name").val(col_name);
            $('#preview-img').attr('src', col_img);
            $("#category-id").val(id);
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
        $('body').on('change', '#category-img-file', function(e){
            readURL(this);
        });

        //validate data before save
        function validateInputAdd(){
            var name = $('#category-name').val();
            var img = $('#category-img-file').val();
            var err=0;
            //var required = $("<span>", {class: "label label-danger"}).text("required");

            if(name == "" || name == null){
                $("input#category-name").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-category-name");
                err++;
            }else{
                $("input#category-name").css("border-color","black");
                $('#err-category-name').html("");
            }

            if(img == null || img == ""){
                $("#category-img-file").css("border-color","#fc5d32");
                $('<span class="label label-danger">No Image Choose !</span>').appendTo("#err-category-file");
                err++;
            }else{
                $("#category-img-file").css("border-color","black");
                $('#err-category-file').html("");
            }

            if(err==0){
                return true;
            }else{
                return false;
            }
        }

        // validate data before update
        function validateFormEdit(){
            var name = $('#category-name').val();
            var err=0;
            //var required = $("<span>", {class: "label label-danger"}).text("required");

            if(name == "" || name == null){
                $("input#category-name").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-category-name");
                err++;
            }else{
                $("input#category-name").css("border-color","black");
                $('#err-category-name').html("");
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
                var img=$('#category-img-file')[0].files[0];
                var name = $('#category-name').val();

                var dataForm = new FormData();
                dataForm.append("categoryName",name );
                dataForm.append("img",img );

                $.ajax({
                    url: "<?php echo site_url("be/article/createCategory");?>",
                    data: dataForm,
                    dataType: 'json',
                    type : "POST",
                    contentType: false,
                    processData: false,
                    success: function (data, status) {
                        if (data.status != 'error') {
                            alertify.success(data.msg);
                            $('#form-category')[0].reset();
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
                var id = $("#category-id").val();
                var img=$('#category-img-file')[0].files[0];
                var name = $('#category-name').val();
                var isUpdate = 0;
                var dataForm = new FormData();

                if(img!=null){
                    isUpdate=1;
                    dataForm.append("img",img );
                }

                dataForm.append("categoryName",name );
                dataForm.append("isUpdateImg",isUpdate );

                $.ajax({
                    url: "<?php echo site_url("be/article/updateCategory");?>/" + id,
                    data: dataForm,
                    dataType: 'json',
                    type : "POST",
                    contentType: false,
                    processData: false,
                    success: function (data, status) {
                        if (data.status != 'error') {
                            alertify.success(data.msg);
                            $('#form-category')[0].reset();
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
            var category_name =  row.find(".col-name").text();

            var msg = "Do you want to delete "+category_name+" category ?";
            // confirm dialog
            alertify.confirm(msg, function (e) {
                if (e) {
                    $.ajax({
                        url: "<?php echo site_url("be/article/deleteCategory");?>/"+id, //goto controller
                        data: "",
                        dataType : 'json',
                        type: "POST",
                        success: function(data){
                            if(data.status != "error"){
                                alertify.success(data.msg);
                                $('#form-category')[0].reset();
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