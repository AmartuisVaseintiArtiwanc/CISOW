<!--Modal-->
<div class="modal fade" id="tag-modal" tabindex="-1" role="dialog" aria-labelledby="article-modal" aria-hidden="true">
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
                <form id="form-tag">
                    <input type="hidden" class="form-control" id="tag-id">
                    <div class="form-group">
                        <label for="tag-name" class="control-label">Tag Name :</label>
                        <span id="err-tag-name"></span>
                        <input type="text" class="form-control" id="tag-name" name="tagName">
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