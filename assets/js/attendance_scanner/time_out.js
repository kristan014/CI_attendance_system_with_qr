$(function () {
	function onScanSuccess(qrCodeMessage) {
		document.getElementById("result").innerHTML =
			'<span class="result">' + qrCodeMessage + "</span>";

		$.ajax({
			url:
				baseURL +
				"EmployeeController/get_one_employee_by_emp_no/" +
				qrCodeMessage,
			type: "GET",
			dataType: "json",
			success: function (responseData) {
				if (responseData) {
					console.log(responseData);
					$("#photo_path_placeholder").attr(
						"src",
						"assets/uploads/" + responseData[0].photo
					);
					$("#employee_id").val(responseData[0].employee_id);

					$("#employee_no").val(responseData[0].employee_no);
					$("#first_name").val(responseData[0].first_name);
					$("#last_name").val(responseData[0].last_name);
					if (responseData[0].middle_name != "") {
                    $("#middle_name").val(responseData[0].middle_name);
                    }
					if (responseData[0].extension_name != "") {
                        $("#extension_name").val(responseData[0].extension_name);
					}
                    
                    $("#middle_name").val("none");
					$("#extension_name").val("none");

					// record time in
					$.ajax({
						url: baseURL + "TimeOutController/create_time_out",
						type: "POST",
						data: {
							employee_id: $("#employee_id").val(),
						},
						cache: false,

						success: function (data) {
							console.log(data)
							if (data.status_code == 422) {
								notification("warning", "Warning!", data.message);
							} else {
								notification("success", "Success!", data.message);
							}
						},
						error: function (responseJSON) {
							notification("error", "Error!", "Error in logging time in");
						},
					});
				} else {
					notification("error", "Error!", "Error in loading employee");
				}
			},
			error: function ({ responseJSON }) {},
		});
	}
	function onScanError(errorMessage) {
		//handle scan error
	}
	var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
		fps: 5,
		qrbox: 250,
	});

	html5QrcodeScanner.render(onScanSuccess, onScanError);

	readURL = (input) => {
		var url = input.value;
		var ext = url.substring(url.lastIndexOf(".") + 1).toLowerCase();
		if (
			input.files &&
			input.files[0] &&
			(ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")
		) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$("#photo_path_placeholder").attr("src", e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		} else {
			//$("#img").attr("src", "/assets/no_preview.png");
		}
	};
});
