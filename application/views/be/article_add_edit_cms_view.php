<style>
    #preview-img{
        margin-bottom: 10px;
    }
    .container{
        padding-bottom: 50px;
    }
    #preview-tab{
        padding-top: 25px;
    }
</style>
<?php $this->load->helper('HTML');
    // Combobox Chosen
    echo link_tag('css/chosen.css');
?>
<script src="<?php echo base_url(); ?>js/ckeditor.js"></script>
<div class="container">

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#form-tab" aria-controls="form-tab" role="tab" data-toggle="tab">Form</a></li>
        <li role="presentation"><a href="#preview-tab" aria-controls="preview-tab" role="tab" data-toggle="tab" id="preview-btn">Preview Content</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="form-tab">
            <h1>Article Add Edit CMS
                <a href="<?=site_url("be/article/getArticleListCms")?>"><button type="button" class="btn btn-primary">Back to List</button></a>
            </h1>
            <div class="progress progress-striped active">
                <div class="progress-bar" id="progress-bar" style="width: 0%"></div>
            </div>
            <form id="form-article" class="col-sm-10">
                <input type="hidden" class="form-control" id="article-id" value="<?php if($article!=null){ echo $article->articleID; }?>">
                <div class="form-group">
                    <label for="article-title" class="control-label">Title :</label>
                    <span id="err-article-title"></span>
                    <input type="text" class="form-control" id="article-title"
                           value="<?php if($article!=null){ echo $article->title; }?>" >
                </div>
                <div class="form-group">
                    <label for="article-category" class="control-label">Category :</label>
                    <span id="err-category"></span>
                    <select class="form-control" id="category-combo" name="category">
                        <option value="0">---Select Category---</option>
                        <?php foreach($category as $row) { ?>
                            <option value="<?=$row['categoryID']?>"
                                <?php
                                $category_edit=0;
                                if($article!=null){
                                    $category_edit = $article->categoryID;
                                }
                                if($row['categoryID'] == $category_edit) {
                                    echo "selected='selected'";
                                }
                                ?>
                                >
                                <?=$row['category']?>
                            </option>
                        <?php } ?>
                    </select>
                </div><!-- /input-group -->
                <div class="form-group">
                    <label for="img" class="control-label">Article Image : </label>
                    <label>(Max file size : 5Mb, allowed file : jpg or png)</label>
                    <span id="err-article-img"></span>
                    <input type="file" name="article-img-file" id="article-img-file">
                </div>
                <img src="<?php if($article!=null){ echo base_url().'img/article/'.$article->articleID.'/'.$article->articleImgLink; }?>"
                     class="img-responsive" width="400" id="preview-img"/>

                <div class="form-group">
                    <label for="content" class="control-label">Article Content : </label>
                    <label>(Max file size : 5Mb, allowed file : html )</label>
                    <span id="err-article-content"></span>
                    <!--<input type="file" name="article-content-file" id="article-content-file">-->
                    <textarea name="ckeditor_content" id="ckeditor_content" cols="30" rows="10">
                        <?php if($article!=null){ echo $article->content;}?>
                    </textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'ckeditor_content' );
                    </script>
                    <!--<input type='button' id='btn-load-file' value='Preview'>-->
                </div>

                <div class="form-group">
                    <label for="article-desc" class="control-label">Article Desc :</label>
                    <span id="err-article-desc"></span>
                    <textarea class="form-control" rows="3" id="article-desc"><?php if($article!=null){ echo $article->description;}?></textarea>
                </div>

                <div class="form-group">
                    <label for="article-desc" class="control-label">Tags :</label>
                    <span id="err-article-tag"></span>
                    <select id ="article-tag" data-placeholder="Your Favorite Types of Bear" style="width:350px;" multiple class="chosen-select" tabindex="8">
                        <option value="0"></option>
                        <?php if($article_tags != null || count($article_tags)!=0 ) { ?>
                            <?php foreach($tag as $row){
                                    if(in_array($row['tagID'],$article_tags)){
                                        echo "<option value=".$row['tagID']." selected>".$row['tag']."</option>";
                                    }else{
                                        echo "<option value=".$row['tagID'].">".$row['tag']."</option>";
                                    }
                                }//foreach
                            ?>
                        <?php }else{ //Just for Add?>
                            <?php foreach($tag as $row){ ?>
                                <option value="<?=$row['tagID']?>"><?=$row['tag']?></option>
                            <?php } //foreach tag master ?>
                        <?php } //if else?>
                    </select>
                </div>

                <div class="form-group">
                    <?php if($article!=null){ ?>
                        <button type="button" class="btn btn-primary" id="btn-update">Edit</button>
                    <?php }else {?>
                        <button type="button" class="btn btn-primary" id="btn-save">Save</button>
                    <?php } ?>
                </div>
            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="preview-tab">

        </div>
    </div>

    <div class="">
    </div>
</div>

<script src="<?php echo base_url(); ?>js/chosen.jquery.min.js"></script>
<script>

    $(function(){
        var article_tag_arr = <?=json_encode($article_tags);?>;

        //Combo box tag article
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Tag not found!'},
            '.chosen-select-width'     : {width:"95%"}
        }
        $(".chosen-select").chosen({width: "95%"});

        //validasi Add
        function validateAdd(){
            var name = $("#article-title").val();
            var category = $('#category-combo').val();
            var img = $('#article-img-file').val();
            var content = CKEDITOR.instances.ckeditor_content.getData();
            var desc = $("#article-desc").val();
            var tag = false;
            var err=0;


            if(name == "" || name == null){
                $("input#article-title").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-article-title");
                err++;
            }else{
                $("input#article-title").css("border-color","black");
                $('#err-article-title').html("");
            }

            if(category == '0'){
                $("#category-combo").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must Select Category !</span>').appendTo("#err-category");
                err++;
            }else{
                $("#category-combo").css("border-color","black");
                $('#err-category').html("");
            }

            if(img == null || img == ""){
                $("#article-img-file").css("border-color","#fc5d32");
                $('<span class="label label-danger">No Image Choose !</span>').appendTo("#err-article-img");
                err++;
            }else{
                $("#article-img-file").css("border-color","black");
                $('#err-article-img').html("");
            }

            if(content.trim() == null || content.trim() == ""){
                $("#article-content-file").css("border-color","#fc5d32");
                $('<span class="label label-danger">No File Choose !</span>').appendTo("#err-article-content");
                err++;
            }else{
                $("#article-content-file").css("border-color","black");
                $('#err-article-content').html("");
            }

            if(desc == "" ||desc == null){
                $("textarea#article-desc").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-article-desc");
                err++;
            }else{
                $("textarea#article-desc").css("border-color","black");
                $('#err-article-desc').html("");
            }

            //check empty tag
            $('.chosen-select :selected').each(function(i, selected){
                tag = true;
                return false;
                //alert(foo[i]);
            });

            if(tag==false){
                $("select#article-tag").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-article-tag");
                err++;
            }else{
                $("select#article-tag").css("border-color","black");
                $('#err-article-tag').html("");
            }

            if(err==0){
                return true;
            }else{
                return false;
            }
        }

        //validasi Edit
        function validateEdit(){
            var name = $("#article-title").val();
            var category = $('#category-combo').val();
            var content = CKEDITOR.instances.ckeditor_content.getData();
            var desc = $("#article-desc").val();
            var err=0;
            var tag = false;

            if(name == "" || name == null){
                $("input#article-title").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-article-title");
                err++;
            }else{
                $("input#article-title").css("border-color","black");
                $('#err-article-title').html("");
            }

            if(category == '0'){
                $("#category-combo").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must Select Category !</span>').appendTo("#err-category");
                err++;
            }else{
                $("#category-combo").css("border-color","black");
                $('#err-category').html("");
            }
            if(content.trim() == null || content.trim() == ""){
                $("#article-content-file").css("border-color","#fc5d32");
                $('<span class="label label-danger">No File Choose !</span>').appendTo("#err-article-content");
                err++;
            }else{
                $("#article-content-file").css("border-color","black");
                $('#err-article-content').html("");
            }

            if(desc == "" ||desc == null){
                $("textarea#article-desc").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-article-desc");
                err++;
            }else{
                $("textarea#article-desc").css("border-color","black");
                $('#err-article-desc').html("");
            }

            //check empty tag
            $('.chosen-select :selected').each(function(i, selected){
                tag = true;
                return false;
            });

            if(tag==false){
                $("select#article-tag").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-article-tag");
                err++;
            }else{
                $("select#article-tag").css("border-color","black");
                $('#err-article-tag').html("");
            }

            if(err==0){
                return true;
            }else{
                return false;
            }
        }

        //Preview Img upload
        function readURL(input,preview) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(preview).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Function when upload file img has changed
        $('body').on('change', '#article-img-file', function(e){
            var max_size = 1000*1024*5;
            var size = this.files[0].size;
            var type = this.files[0].type;
            var preview = "#preview-img";
            var error = 0;

            if(type!="image/jpeg" && type!="image/png"){
                alertify.alert("File must be png or jpg");
                $("#article-img-file").val("");
                $(preview).attr('src', "");
            }else if(max_size < size){
                alertify.alert("Maximum file size only 5 Mb allowed ");
                $("#article-img-file").val("");
                $(preview).attr('src', "");
            }else{
                var article_img_file = this;
                var reader = new FileReader();
                //Read the contents of Image File.
                reader.readAsDataURL(this.files[0]);
                readURL(this,'#preview-img');
            }

        });

        $("#btn-load-file").click(function() {
            if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
                alert('The File APIs are not fully supported in this browser.');
                return;
            }

            input = document.getElementById('article-content-file');
            if (!input) {
                alert("Um, couldn't find the fileinput element.");
            }
            else if (!input.files) {
                alert("This browser doesn't seem to support the `files` property of file inputs.");
            }
            else if (!input.files[0]) {
                alert("Please select a file before clicking 'Load'");
            }
            else {
                file = input.files[0];
                fr = new FileReader();
                fr.onload = receivedText;
                fr.readAsText(file);
                //fr.readAsDataURL(file);
            }
        });

        function receivedText() {
            //result = fr.result;
            $('#preview-tab').html("");
            $('#preview-tab').html(fr.result);
            //document.getElementById('preview-tab').appendChild(document.createTextNode(fr.result))
            $('.nav-tabs a[href="#preview-tab"]').tab('show');
        }

        $("#preview-btn").click(function() {
            var content = CKEDITOR.instances.ckeditor_content.getData();
            $("#preview-tab").html(content);
        });

            // Save Data
        $("#btn-save").click(function() {            
            $(".label-danger").remove();
            if (validateAdd()) {
                var name = $("#article-title").val();
                var category = $('#category-combo').val();
                var img = $('#article-img-file')[0].files[0];
                var content = CKEDITOR.instances.ckeditor_content.getData();
                //console.log(content);
                var desc = $("#article-desc").val();
                var article_tags = [];
                $('.chosen-select :selected').each(function(i, selected){
                    //article_tags[i] = $(selected).val();
                    article_tags.push($(selected).val());
                });

                var dataForm = new FormData();
                dataForm.append("title",name );
                dataForm.append("category",category );
                dataForm.append("content",content );
                dataForm.append("img",img );
                dataForm.append("desc",desc );
                dataForm.append("tags",JSON.stringify(article_tags) );

                $.ajax({
                    xhr: function()
                    {
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                //Do something with upload progress
                                var percentage = Math.floor(percentComplete*100);
                                $("#progress-bar").width(percentage + '%');
                                $("#progress-bar").html(percentage +'%');
                            }
                        }, false);
                        return xhr;
                    },
                    url:   "<?php echo site_url("be/article/createArticle");?>",
                    data: dataForm,
                    dataType: 'json',
                    type : "POST",
                    contentType: false,
                    processData: false,
                    success:function(data){
                        if(data.status != 'error') {
                            alertify.success(data.msg);
                            $("#preview-img").attr('src', "");
                            location.href = "<?= site_url("be/article/getArticleListCms")?>";
                        }else{
                            $("#progress-bar").width('0%');
                            $("#progress-bar").html('0%');
                            alertify.error(data.msg);
                        }
                    },
                    error:function(data){
                        $("#progress-bar").width('0%');
                        $("#progress-bar").html('0%');
                        //alertify.alert(data.responseText);
                        alertify.error('Failed to Save Data!');
                    }
                });
            }
            return false;

        });

        //Update Data
        $("#btn-update").click(function() {
            $(".label-danger").remove();
            if (validateEdit()) {
                var articleID = $("#article-id").val();
                var name = $("#article-title").val();
                var category = $('#category-combo').val();
                var img = $('#article-img-file')[0].files[0];
                var content = CKEDITOR.instances.ckeditor_content.getData();
                //console.log(content);
                var desc = $("#article-desc").val();
                var isUpdateImg = 0;

                var article_tags = [];
                $('.chosen-select :selected').each(function(i, selected){
                    var tag_val = $(selected).val();

                    if($.inArray( tag_val, article_tag_arr ) == -1){
                        article_tags.push(tag_val);
                    }else{
                        //remove tag from article tag
                        var index = article_tag_arr.indexOf(tag_val);
                        article_tag_arr.splice(index, 1);
                    }
                    //alert(article_tags[i]);
                });

                var dataForm = new FormData();
                dataForm.append("title",name );
                dataForm.append("category",category );
                dataForm.append("desc",desc );
                if(img != null){
                    isUpdateImg = 1;
                    dataForm.append("img",img );
                }
                dataForm.append("content",content );
                dataForm.append("isUpdateImg",isUpdateImg );
                dataForm.append("newTags",JSON.stringify(article_tags) );
                dataForm.append("delTags",JSON.stringify(article_tag_arr) );

                $.ajax({
                    xhr: function()
                    {
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                //Do something with upload progress
                                var percentage = Math.floor(percentComplete*100);
                                $("#progress-bar").width(percentage + '%');
                                $("#progress-bar").html(percentage +'%');
                            }
                        }, false);
                        return xhr;
                    },
                    url:   "<?php echo site_url("be/article/updateArticle");?>/"+articleID,
                    data: dataForm,
                    dataType: 'json',
                    type : "POST",
                    contentType: false,
                    processData: false,
                    success:function(data){
                        if(data.status != 'error') {
                            alertify.success(data.msg);
                            $("#preview-img").attr('src', "");
                            location.href = "<?= site_url("be/article/getArticleListCms")?>";
                        }else{
                            $("#progress-bar").width('0%');
                            $("#progress-bar").html('0%');
                            alertify.error(data.msg);
                        }
                    },
                    error:function(data){
                        $("#progress-bar").width('0%');
                        $("#progress-bar").html('0%');
                        //alertify.alert(data.responseText);
                        alertify.error('Failed to Save Data!');
                    }
                });
            }
            return false;

        });

    });
</script>
