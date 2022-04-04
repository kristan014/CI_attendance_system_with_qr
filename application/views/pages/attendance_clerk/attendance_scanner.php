
<h1>How to generate QR Code using Codeigniter</h1>
<form action="<?php echo base_url();?>QrController/qrcodeGenerator" method="post">
<input type="text" name="qrcode_text">
<button>Submit</button>
</form>
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

  //   $.ajax({
	// 					url: baseURL + "UserController/create_user",
	// 					type: "POST",
	// 					data: {
	// 						email: $("#email").val(),
	// 						password: $("#password").val(),
	// 						employee_id: $("#employee_id").val(),
	// 					},
	// 					cache: false,

	// 					success: function (data) {
	// 					$.ajax({
  //         url: baseURL + "EmployeeController/get_all_employee",
  //         type: "GET",
  //         dataType: "json",
  //         success: function (responseData) {
  //           if (responseData) {
	// 			$("#employee_id").empty();
	// 			$.each(responseData, function (i, dataOptions) {
	// 				var options = "";

	// 				options =
	// 					"<option value='" +
	// 					dataOptions.employee_id +
	// 					"'>" +
	// 					dataOptions.first_name +
	// 					" " +
	// 					dataOptions.last_name;
	// 				("</option>");

	// 				$("#employee_id").append(options);
	// 			});
	// 		} else {
	// 			notification("error", "Error!", "Error in loading employees");
	// 		}
	// 	},
	// 	error: function ({ responseJSON }) {},
	// });
	// 					},
	// 					error: function (responseJSON) {
	// 						notification("error", "Error!", "Error in Creating User");
	// 					},
	// 				});
}
function onScanError(errorMessage) {
  //handle scan error
}
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 20, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>  
