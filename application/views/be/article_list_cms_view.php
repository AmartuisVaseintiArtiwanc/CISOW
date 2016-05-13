
    <div class="">
        <h1>Article CMS</h1>
        <div class="well">
            <div class="row">
                <div class="col-md-3">
                    <a href="<?=site_url('be/article/getArticleAddView')?>">
                        <button type="button" id="btn-add" class="btn btn-primary">Create</button>
                    </a>
                </div>

                <div class="col-md-9">
                    <form class="form-inline" action="<?=site_url('be/Article/searchArticle')?>" method="POST">
                        <div class="form-group">
                            <label class="sr-only">Title</label>
                            <input type="text" class="form-control" name="search-title" value="<?php $search_text?>" placeholder="Search Title...">
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Category</label>
                            <select class="form-control" name="search-category">
                                <option value="0">Search Category ...</option>
                                <?php foreach($category as $row){?>
                                    <option value="<?=$row['categoryID']?>"><?=$row['category']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Author</label>
                            <input type="text" class="form-control" name="search-author" value="<?php $search_text?>" placeholder="Search Author...">
                        </div>
                        <button class="btn btn-default" type="submit">Go!</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <th>Article Title</th>
                <th>Category</th>
                <th>View</th>
                <th>Created</th>
                <th>Author</th>
                <th>Option</th>
            </thead>
            <tbody>
                <?php foreach($articles as $row){ ?>
                    <tr>
                        <td class="col-title"><?=$row['title']?></td>
                        <td class="col-category" data-category="<?=$row['categoryID']?>"><?=$row['category']?></td>
                        <td><?=$row['view']?></td>
                        <td><?php $date = date_create($row['created']); echo date_format($date, 'M d, Y' );?></td>
                        <td><?=$row['username']?></td>
                        <td>
                            <a href="<?=site_url('be/article/getArticleEditView/'.$row['articleID'])?>">
                                <button type="button" class="btn btn-edit btn-primary">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                </button>
                            </a>
                            <button type="button" class="btn btn-delete btn-danger" data-id="<?=$row['articleID']?>">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
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
        // btn delete when clicked
        $(".btn-delete").click(function(){
            var id = $(this).data("id");
            var row = $(this).closest("tr");
            var title =  row.find(".col-title").text();

            var data_post={
              articleID:id
            };

            var msg = "Do you want to delete <b><i>"+title+"</i></b> article ?";
            // confirm dialog
            alertify.confirm(msg, function (e) {
                if (e) {
                    $.ajax({
                        url: "<?php echo site_url("be/article/deleteArticle");?>", //goto controller
                        data: data_post,
                        dataType : 'json',
                        type: "POST",
                        success: function(data){
                            if(data.status != "error"){
                                alertify.success(data.msg);
                                $("#category-name").val("");
                                $("#category-desc").val("");
                                window.location.reload();
                            }else{
                                alertify.error(data.msg);
                            }
                        },
                        error: function(data) {
                            alertify.error('Failed to Save Data!');
                        }
                    });
                } else {
                    // user clicked "cancel"
                }
            });
        });
    });
</script>