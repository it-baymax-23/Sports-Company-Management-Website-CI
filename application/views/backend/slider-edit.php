<?php if ($user[0]['user_group'] != 1 && $user[0]['user_group'] != 2) { return redirect('backend'); } else { ?>
<div id="content-wrapper">
  <div class="container-fluid">
    <div class="card card-register mx-auto mt-5 mb-3">
      <div class="card-header">Edit slider</div>
      <div class="card-body">
        <form class="edit-slider-form">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="form-group thumbnail">
                <label for="primary-image" class="upload-btn"><p><i class="fa fa-image"></i> Upload Slider Image</p><div class="p-image-preview" style="background-image: url('<?php echo base_url() . $edit_slider[0]['slider_url']; ?>');"></div></label>
                <input id="primary-image" type="file" name="photo" class="d-done" style="display: none;">
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="editSliderTitle" class="form-control" placeholder="Slider title" autofocus="autofocus" value="<?php echo $edit_slider[0]['slider_title']; ?>">
                  <label for="editSliderTitle">Slider Title</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="editSliderComment" class="form-control" placeholder="Slider comment" autofocus="autofocus" row="3" value="<?php echo $edit_slider[0]['slider_content']; ?>">
                  <label for="editSliderComment">Slider Comment</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <p> Select Slider Status: </p>
                  <select class="form-control" id="editSliderStatus" style="font-size: 23px">
                    <option value="0" <?php  echo ($edit_slider[0]['slider_status'] == '0' ) ? "selected": " " ?>>Disable</option>
                    <option value="1" <?php  echo ($edit_slider[0]['slider_status'] == '1' ) ? "selected": " " ?>>Enable</option>
                  </select>
                </div>
              </div>
              <br/>
              <button class="btn btn-primary btn-block" id="update_slider_btn" attr-id="<?php echo $edit_slider[0]['id']; ?>" type="submit">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>