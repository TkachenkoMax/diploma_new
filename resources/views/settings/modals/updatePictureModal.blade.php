<div class="modal fade inmodal" id="update_photo_modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Update Profile Picture</h4>
            </div>
            <div class="modal-body" style="overflow:hidden;">
                <div class="ibox float-e-margins m-b-n">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="image-crop">
                                    <img style="max-width:50%" src="https://pp.userapi.com/c637618/v637618140/4545d/Fef9fusl1o0.jpg">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h4>Preview image</h4>
                                <div class="img-preview img-preview-sm img-circle img-responsive img-responsive-50"></div>
                                <h4>Update tour photo</h4>
                                <p>
                                    You can change your old photo preview or upload new one.
                                </p>
                                <div class="btn-group">
                                    <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                        <input type="file" accept="image/*" name="file" id="inputImage" class="hide">
                                        Upload new image
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <h4 class="text-center">Useful methods</h4>
                                <div class="btn-group">
                                    <button class="btn btn-white" id="zoomIn" type="button">Zoom In</button>
                                    <button class="btn btn-white" id="zoomOut" type="button">Zoom Out</button>
                                    <button class="btn btn-white" id="rotateLeft" type="button">Rotate Left</button>
                                    <button class="btn btn-white" id="rotateRight" type="button">Rotate Right</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <label title="Download image" id="download" class="btn btn-primary">Update</label>
            </div>
        </div>
    </div>
</div>