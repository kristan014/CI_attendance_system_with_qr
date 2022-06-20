<script src="<?= base_url('assets') ?>/vendor/qrcode/html5-qrcode.min.js"></script>

<div class="container">

  <div class="row">
    <div class="col-lg-5">
      <div id="reader" class="w-100"></div>
    </div>
    <div class="col-7">
      <h4>SCAN RESULT</h4>
      <div id="result">Result Here</div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <img src="https://avatars.dicebear.com/api/bottts/smile.svg" alt="" class="rounded avatar-lg img-thumbnail" style="height:150px; width:150px;" id="photo_path_placeholder" name="photo_path_placeholder">
          </div>
        </div>
        <input type="text" class="form-control" id="employee_id" name="employee_id" readonly>

        <div class="col-md-6">
        <label class="form-label"><strong>Employee no</strong></label>
        <input type="text" class="form-control" id="employee_no" name="employee_no" readonly>
        </div>

      </div>

      <div class="row">
        <div class="col-md-3 form-group">
          <div class="mb-2"><label class="form-label">First Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="first_name" name="first_name" readonly>
          </div>
        </div>
        <div class="col-md-3 form-group">
          <div class="mb-2"><label class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name" readonly>
          </div>
        </div>
        <div class="col-md-3 form-group">
          <div class="mb-2"><label class="form-label">Last Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="last_name" name="last_name" readonly>
          </div>
        </div>

        <div class="col-md-3 form-group">
          <div class="mb-2"><label class="form-label">Extension Name</label>
            <input type="text" class="form-control" id="extension_name" name="extension_name" readonly>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets') ?>/js/attendance_scanner/time_out.js"></script>