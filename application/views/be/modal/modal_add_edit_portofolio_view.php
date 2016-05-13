<!--Modal-->
<div class="modal fade" id="portofolio-modal" tabindex="-1" role="dialog" aria-labelledby="portofolio-modal" aria-hidden="true">
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
                <form id="form-portofolio">
                    <input type="hidden" class="form-control" id="portofolio-id">
                    <div class="form-group">
                        <label for="img" class="control-label">Portofolio Image : </label>
                        <label>(Max file size : 5Mb, allowed file : jpg or png)</label>
                        <span id="err-portofolio-file"></span>
                        <input type="file" name="portofolio-img-file" id="portofolio-img-file">
                    </div>
                    <img src="#" class="img-responsive" id="preview-img"/>
                    <div class="form-group">
                        <label for="portofolio-desc" class="control-label">Portofolio Desc :</label>
                        <span id="err-portofolio-desc"></span>
                        <input type="text" class="form-control" id="portofolio-desc"">
                    </div>
                    <div class="form-group">
                        <label for="portofolio-type" class="control-label">Portofolio Type :</label>
                        <span id="err-portofolio-type"></span>
                        <select class="form-control" id="portofolio-type">
                          <option value="1">Application</option>
                          <option value="2">Multimedia</option>
                          <option value="3">Networking</option>
                        </select>
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