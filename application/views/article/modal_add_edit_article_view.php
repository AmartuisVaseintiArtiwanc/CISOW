<!--Modal-->
<div class="modal fade" id="article-modal" tabindex="-1" role="dialog" aria-labelledby="article-modal" aria-hidden="true">
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
                <form id="form-article">
                    <input type="hidden" class="form-control" id="color-id">
                    <div class="form-group">
                        <label for="article-title" class="control-label">Title :</label>
                        <span id="err-color-code"></span>
                        <input type="text" class="form-control" id="article-title">
                    </div>
                    <div class="form-group">
                        <label for="img" class="control-label">Article Image : </label>
                        <label>(Max file size : 5Mb, allowed file : jpg or png)</label>
                        <span id="err-color-file"></span>
                        <input type="file" name="article-img-file" id="article-img-file">
                    </div>
                    <img src="#" class="img-responsive" id="preview-img"/>

                    <div class="form-group">
                        <label for="content" class="control-label">Article Content : </label>
                        <label>(Max file size : 5Mb, allowed file : html or txt)</label>
                        <span id="err-color-file"></span>
                        <input type="file" name="article-content-file" id="article-content-file">
                    </div>

                    <div class="form-group">
                        <label for="article-desc" class="control-label">Article Desc :</label>
                        <span id="err-event-desc"></span>
                        <textarea class="form-control" rows="3" id="article-desc"></textarea>
                    </div>
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