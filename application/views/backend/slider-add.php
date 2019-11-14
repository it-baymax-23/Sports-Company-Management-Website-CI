<?php if ($user[0]['user_group'] != 1 && $user[0]['user_group'] != 2) { return redirect('backend'); } else { ?>
<div id="content-wrapper">
  <div class="container-fluid">
    <div class="card card-register mx-auto mt-5 mb-3">
      <div class="card-header">Add slider</div>
      <div class="card-body">
        <form class="add-slider-form">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="form-group thumbnail">
                <label for="primary-image" class="upload-btn"><p><i class="fa fa-image"></i> Upload Slider Image</p><div class="p-image-preview"></div></label>
                <input id="primary-image" type="file" name="photo" class="d-done" style="display: none;">
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="inputSliderTitle" class="form-control" placeholder="Slider title" autofocus="autofocus">
                  <label for="inputSliderTitle">Slider Title</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="inputSliderComment" class="form-control" placeholder="Slider comment" autofocus="autofocus" row="3">
                  <label for="inputSliderComment">Slider Comment</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <p> Select Slider Status: </p>
                  <select class="form-control" id="inputSliderStatus" style="font-size: 23px">
                    <option value="0">Disable</option>
                    <option value="1">Enable</option>
                  </select>
                </div>
              </div>
              <br/>
              <button class="btn btn-primary btn-block" id="add_slider_btn" type="submit">Publish</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>