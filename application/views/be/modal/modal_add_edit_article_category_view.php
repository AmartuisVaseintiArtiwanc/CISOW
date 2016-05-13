<!--Modal-->
<div class="modal fade" id="article-category-modal" tabindex="-1" role="dialog" aria-labelledby="article-modal" aria-hidden="true">
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
                <form id="form-category">
                    <input type="hidden" class="form-control" id="category-id">
                    <div class="form-group">
                        <label for="category-name" class="control-label">Category Name :</label>
                        <span id="err-category-name"></span>
                        <input type="text" class="form-control" id="category-name">
                    </div>
                    <div class="form-group">
                        <label for="img" class="control-label">Category Icon : </label>
                        <label>(Max file size : 5Mb, allowed file : jpg or png)</label>
                        <span id="err-category-file"></span>
                        <input type="file" name="category-img-file" id="category-img-file">
                    </div>
                    <img src="#" class="img-responsive" id="preview-img"/>
                </form>
            </div><!--modal body-->

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save</button>
                <button type="button" class="btn btn-primary" id="btn-update">Edit</button>
            </div><!--modal footer-->

        </div><!--modal content-->
    </div><!--modal dialog-->
</div>