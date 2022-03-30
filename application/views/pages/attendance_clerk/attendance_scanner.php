
<!-- <h1>How to generate QR Code using Codeigniter</h1>
<form action="<?php echo base_url();?>QrController/qrcodeGenerator" method="post">
<input type="text" name="qrcode_text">
<button>Submit</button>
</form> -->
<script src="<?= base_url('assets') ?>/vendor/qrcode/html5-qrcode.min.js"></script>

<div class="container">
<div class="row">
  <div class="col-lg-5">
    <div  id="reader"></div>
  </div>
  <div class="col-7">
    <h4>SCAN RESULT</h4>
    <div id="result">Result Here</div>
  </div>
</div>
</div>

<script type="text/javascript">
function onScanSuccess(qrCodeMessage) {
    document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
}
function onScanError(errorMessage) {
  //handle scan error
}
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 20, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>  
