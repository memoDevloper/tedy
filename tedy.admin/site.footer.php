<div id="upload-tarnslated-file-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Upload Translated File</h4>
			</div>
			<form class="form upload-translated-file-form">
				<input type="hidden" name="actionName" value="UPLOAD_TRANSLATED_FILE" />
				<div class="modal-body">
					<div class="form-group">
						<input type="file" id="input-file-now" name="file" class="dropify upload-translated-file" />
					</div>
					<div class="form-group translated-file-id">
						<input type="hidden" class="form-control" name="file-id" id="file-code">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>



<?php
if($user->type !== 3){
	?>
	<div id="signing-out-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="DIM Modal" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
                <div class="modal-header">
                    <h4>Login Session Ends in: <span id="ms_timer" ></span></h4>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-danger" id="stopBtnhms" data-dismiss="modal" aria-hidden="true" >Click to continue the session</button>
                </div>
			</div>
		</div>
	</div>
	<?php
}
?>

<div id="search-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Search</h3>
            </div>
            <form class="form" autocomplete="off" >
                <div class="modal-body">
                        <input type="hidden" name="actionName" value="SEARCH">
                        <div class="form-group">
                            <div class="row" >
                                <div class="col-md-12">
                                    <input type="text" name="query" class="form-control form-control-line query" id="query" placeholder="Search Query" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table width="100%" >
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="search-type" value="all" class="custom-control-input" id="search_all">
                                                    <label for="search_all" >
                                                        All
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="search-type" value="jobs" class="custom-control-input" id="search_jobs">
                                                    <label for="search_jobs" >
                                                        Jobs
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="search-type" value="file_inquiry" class="custom-control-input" id="search_inquiry">
                                                    <label for="search_inquiry" >
                                                        File Inquiry
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="search-type" value="laws" class="custom-control-input" id="search_laws">
                                                    <label for="search_laws" >
                                                        Laws
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="search-type" value="references" class="custom-control-input" id="search_references">
                                                    <label for="search_references" >
                                                        References
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="search-type" value="samples" class="custom-control-input" id="search_samples">
                                                    <label for="search_samples" >
                                                        Samples
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="search-type" value="name_list_en" class="custom-control-input" id="search_name_list_en">
                                                    <label for="search_name_list_en" >
                                                        Name List - En
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="search-type" value="name_list_ar" class="custom-control-input" id="search_name_list_ar">
                                                    <label for="search_name_list_ar" >
                                                        Name List - Ar
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="modal-footer" >
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="dim-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="DIM Modal" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" style="width: 1200px">
		<div class="modal-content"></div>
	</div>
</div>

<form class="upload-photo-form hidden">
    <input type="hidden" name="actionName" value="UPLOAD_PHOTO" />
    <input type="hidden" name="actionType" class="actionType" value="" />
    <input type="hidden" name="id" class="id" value="" />
    <input type="hidden" name="container" class="container" value="" />
    <input type="file" name="photos[]" multiple class="photos" />
</form>

<div class="modal fade" id="image-crop-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image Before Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="image-crop" alt="" class="img-responsive" />
            </div>
            <div class="modal-footer">
                <button type="button" id="crop" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>