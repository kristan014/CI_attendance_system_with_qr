$(function () {
	loadTable();
	formReset("hide");

	// function to save/update record
	$("#form_id")
		.on("submit", function (e) {
			e.preventDefault();
			trimInputFields();
		})
		.validate({
			rules: {
				first_name: {
					required: true,
				},
				last_name: {
					required: true,
				},

				email: {
					required: true,
				},
				cellphone_no: {
					required: true,
				},
				nationality: {
					required: true,
				},
				gender: {
					required: true,
				},
				birth_date: {
					required: true,
				},
				date_hired: {
					required: true,
				},
				job_title_id: {
					required: true,
				},

				address: {
					required: true,
				},
			},
			messages: {
				first_name: {
					required: "Please provide first name",
				},

				last_name: {
					required: "Please choose last name",
				},

				email: {
					required: "Please provide email",
				},
				cellphone_no: {
					required: "Please provide cellphone number",
				},

				nationality: {
					required: "Please provide nationality",
				},

				gender: {
					required: "Please choose gender",
				},
				birth_date: {
					required: "Please provide birthdate",
				},

				date_hired: {
					required: "Please provide date hired",
				},

				job_title_id: {
					required: "Please choose job title",
				},
				address: {
					required: "Please provide address",
				},
			},
			errorElement: "span",
			errorPlacement: function (error, element) {
				error.addClass("invalid-feedback");
				element.closest(".form-group").append(error);
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass("is-invalid");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).removeClass("is-invalid");
				$(element).addClass("is-valid");
			},
			submitHandler: function () {
				var form_data = new FormData(document.getElementById("form_id"));

				if ($("#uuid").val() == "") {
					if ($("#photo").val() == "") {
						notification("error", "Error!", "Please Provide a Photo");
					} else {
						// add record
						$.ajax({
							url: baseURL + "EmployeeController/create_employee",
							type: "POST",
							data: form_data,
							contentType: false,
							processData: false,

							cache: false,

							success: function (data) {
								console.log(data);
								notification(
									"success",
									"Success!",
									"Employee Successfuly Created"
								);
								formReset("hide");

								loadTable();
							},
							error: function (responseJSON) {
								console.log(responseJSON);
								notification("error", "Error!", "Error in Creating Employee");
							},
						});
					}
				} else {
					// update record
					$.ajax({
						url:
							baseURL +
							"EmployeeController/update_employee/" +
							$("#uuid").val(),
						type: "POST",
						data: form_data,
						contentType: false,
						processData: false,
						cache: false,
						success: function (data) {
							notification(
								"success",
								"Success!",
								"Employee Successfuly Updated"
							);
							formReset("hide");

							loadTable();
						},
						error: function ({ responseJSON }) {
							notification("error", "Error!", "Error in Updating Employee");
						},
					});
				}
			},
		});
	$("#photo").change(function () {
		readURL(this);
	});
});

// function to load departments
loadJobTitle = () => {
	$.ajax({
		url: baseURL + "JobTitleController/get_all_job_title",
		type: "GET",
		dataType: "json",
		success: function (responseData) {
			if (responseData) {
				$("#job_title_id").empty();
				$.each(responseData, function (i, dataOptions) {
					var options = "";

					options =
						"<option value='" +
						dataOptions.job_title_id +
						"'>" +
						dataOptions.job_title_name +
						"</option>";

					$("#job_title_id").append(options);
				});
			} else {
				notification("error", "Error!", "Error in loading job titles");
			}
		},
		error: function ({ responseJSON }) {},
	});
};

loadJobTitle();

loadTable = () => {
	$("#data-table").dataTable().fnClearTable();
	$("#data-table").dataTable().fnDraw();
	$("#data-table").dataTable().fnDestroy();
	$("#data-table").DataTable({
		ajax: {
			url: baseURL + "EmployeeController/get_all_employee",
			dataSrc: "",
		},
		aLengthMenu: [5, 10, 20, 30, 50, 100],
		responsive: true,
		serverSide: false,
		dataType: "json",
		// type: "GET",
		columns: [
			{
				data: "first_name",
				name: "first_name",
				searchable: true,
				width: "10%",
			},

			{
				data: "job_title_name",
				name: "job_title_name",
				searchable: true,
				width: "30%",
			},

			{
				data: "gender",
				name: "gender",
				searchable: true,
				width: "10%",
			},

			{
				data: "birth_date",
				name: "birth_date",
				searchable: true,
				width: "10%",
			},

			{
				data: "status",
				name: "status",
				searchable: true,
				width: "10%",
			},

			{
				data: null,
				width: "2%",
				render: function (aData, type, row) {
					let buttons = "";
					buttons +=
						'<div class="text center dropdown"><div class="btn btn-sm btn-default" data-toggle="dropdown" role="button">' +
						'<i class="fas fa-ellipsis-v"></i></div><div class="dropdown-menu dropdown-menu-right">';
					//view
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return editData(\'' +
						aData["employee_id"] +
						"',0)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-eye mr-1"></i></div>' +
						"<div> View</div></div>";

					//edit
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return editData(\'' +
						aData["employee_id"] +
						"',1)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-edit mr-1"></i></div>' +
						"<div> Edit</div></div>";

					//delete
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return deleteData(\'' +
						aData["employee_id"] +
						"',0)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-trash mr-1"></i></div>' +
						"<div> Delete</div></div>";

					buttons += "</div></div>";
					return buttons; // same class in i element removed it from a element
				},
			},
		],
	});
};

// function to show details for viewing/updating
editData = (id, type) => {
	$.ajax({
		url: baseURL + "EmployeeController/get_one_employee/" + id,
		// type: "POST",
		dataType: "json",
		success: function (data) {
			formReset("show");
			console.log(data)
			$("#uuid").val(data[0].employee_id);
			$("#photo_path_placeholder").attr(
				"src",
				"assets/uploads/" + data[0].photo
			);
			$("#first_name").val(data[0].first_name);
			$("#middle_name").val(data[0].middle_name);
			$("#last_name").val(data[0].last_name);
			$("#extension_name").val(data[0].extension_name);
			$("#email").val(data[0].email);
			$("#cellphone_no").val(data[0].cellphone_no);
			$("#nationality").val(data[0].nationality);
			$("#gender").val(data[0].gender);
			$("#birth_date").val(data[0].birth_date);
			$("#date_hired").val(data[0].date_hired);
			$("#address").val(data[0].address);

			$("#job_title_id").val(data[0].job_title_id).trigger("change");

			// if data is for viewing only
			if (type == 0) {
				$("#form_id input, select, textarea").prop("disabled", true);
				$("#form_id button").prop("disabled", false);
				$(".submit").hide();
			}
		},
		error: function (data) {},
	});
};

// function to delete data
deleteData = (id) => {
	Swal.fire({
		title: "Are you sure you want to delete this record?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: !0,
		confirmButtonColor: "#34c38f",
		cancelButtonColor: "#f46a6a",
		confirmButtonText: "Yes, delete it!",
	}).then(function (t) {
		// if user clickes yes, delete it.
		if (t.value) {
			$.ajax({
				url: baseURL + "EmployeeController/delete_employee/" + id,
				// type: "DELETE",
				// dataType: "json",
				success: function (data) {
					notification(
						"success",
						"Success!",
						"Employee Successfully Deactivated"
					);
					loadTable();
				},
				error: function ({ responseJSON }) {},
			});
		}
	});
};

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
