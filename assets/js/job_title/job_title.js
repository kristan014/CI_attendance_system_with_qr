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
				job_title_name: {
					required: true,
				},
				department_id: {
					required: true,
				},

				job_title_description: {
					required: true,
				},
			},
			messages: {
				job_title_name: {
					required: "Please provide job title",
				},

				department_id: {
					required: "Please choose department",
				},

				job_title_description: {
					required: "Please provide job description",
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
				// var form_data = new FormData(document.getElementById("form_id"));

				if ($("#uuid").val() == "") {
					// add record
					$.ajax({
						url: baseURL + "JobTitleController/create_job_title",
						type: "POST",
						data: {
							job_title_name: $("#job_title_name").val(),
							department_id: $("#department_id").val(),
							job_title_description: $("#job_title_description").val(),
						},
						cache: false,

						success: function (data) {
							console.log(data);
							if (data.status_code != 404) {
								notification("success", "Success!", data.message);
							} else {
								notification("error", "Error!", data.message);
							}
							
							formReset("hide");

							loadTable();
						},
						error: function (responseJSON) {
							notification("error", "Error!", "Error in Creating Job Title");
						},
					});
				} else {
					// update record
					$.ajax({
						url:
							baseURL +
							"JobTitleController/update_job_title/" +
							$("#uuid").val(),
						type: "POST",
						data: {
                            job_title_name: $("#job_title_name").val(),
							department_id: $("#department_id").val(),
							job_title_description: $("#job_title_description").val(),
						},
	
						cache: false,
						success: function (data) {
							if (data.status_code != 404) {
								notification("success", "Success!", data.message);
							} else {
								notification("error", "Error!", data.message);
							}

							formReset("hide");

							loadTable();
						},
						error: function ({ responseJSON }) {
							notification("error", "Error!", "Error in Updating Job Title");
						},
					});
				}
			},
		});
});


// function to load departments
loadDepartments = () => {
	$.ajax({
		url: baseURL + "DepartmentController/get_all_department",
		type: "GET",
		dataType: "json",
		success: function (responseData) {
			if (responseData) {
				$("#department_id").empty();
				$.each(responseData, function (i, dataOptions) {
					var options = "";

					options =
						"<option value='" +
						dataOptions.department_id +
						"'>" +
						dataOptions.department_name +
						"</option>";

					$("#department_id").append(options);
				});
			} else {
				notification("error", "Error!", "Error in loading departments");
			}
		},
		error: function ({ responseJSON }) {},
	});
};

loadDepartments();


loadTable = () => {
	$("#data-table").dataTable().fnClearTable();
	$("#data-table").dataTable().fnDraw();
	$("#data-table").dataTable().fnDestroy();
	$("#data-table").DataTable({
		ajax: {
			url: baseURL + "JobTitleController/get_all_job_title",
			dataSrc: "",
		},
		aLengthMenu: [5, 10, 20, 30, 50, 100],
		responsive: true,
		serverSide: false,
		dataType: "json",
		// type: "GET",
		columns: [
			{
				data: "job_title_name",
				name: "job_title_name",
				searchable: true,
				width: "10%",
			},

			{
				data: "job_title_description",
				name: "job_title_description",
				searchable: true,
				width: "30%",
			},

			{
				data: "department_name",
				name: "department_name",
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
				data: "created_at",
				name: "created_at",
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
						aData["job_title_id"] +
						"',0)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-eye mr-1"></i></div>' +
						"<div> View</div></div>";

					//edit
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return editData(\'' +
						aData["job_title_id"] +
						"',1)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-edit mr-1"></i></div>' +
						"<div> Edit</div></div>";

					//delete
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return deleteData(\'' +
						aData["job_title_id"] +
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
		url: baseURL + "JobTitleController/get_one_job_title/" + id,
		// type: "POST",
		dataType: "json",
		success: function (data) {
			formReset("show");
			// console.log(data)
			$("#uuid").val(data[0].job_title_id);
			$("#job_title_name").val(data[0].job_title_name);
			$("#job_title_description").val(data[0].job_title_description);
			$("#department_id").val(data[0].department_id).trigger("change");

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
				url: baseURL + "JobTitleController/delete_job_title/" + id,
				// type: "DELETE",
				// dataType: "json",
				success: function (data) {
					notification(
						"success",
						"Success!",
						"Job Title Successfully Deactivated"
					);
					loadTable();
				},
				error: function ({ responseJSON }) {},
			});
		}
	});
};
