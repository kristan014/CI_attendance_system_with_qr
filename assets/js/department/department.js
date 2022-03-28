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
				department_name: {
					required: true,
				},
				department_contact_no: {
					required: true,
				},

				department_head: {
					required: true,
				},
			},
			messages: {
				department_name: {
					required: "Please provide department name",
				},

				department_contact_no: {
					required: "Please provide contact No",
				},

				department_head: {
					required: "Please provide department head",
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
				if ($("#uuid").val() == "") {
					// add record
					$.ajax({
						url: baseURL + "DepartmentController/create_department",
						type: "POST",
						data: {
							department_name: $("#department_name").val(),
							department_contact_no: $("#department_contact_no").val(),
							department_head: $("#department_head").val(),
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
							notification("error", "Error!", "Error in Creating Department");
							// console.log(responseJSON);
							// console.log(responseJSON.responseText)
						},
					});
				} else {
					// update record
					$.ajax({
						url:
							baseURL +
							"DepartmentController/update_department/" +
							$("#uuid").val(),
						type: "POST",
						data: {
							department_name: $("#department_name").val(),
							department_contact_no: $("#department_contact_no").val(),
							department_head: $("#department_head").val(),
						},
						cache: false,
						success: function (data) {
							notification(
								"success",
								"Success!",
								"Department Successfuly Updated"
							);
							formReset("hide");

							loadTable();
						},
						error: function ({ responseJSON }) {
							notification("error", "Error!", "Error in Updating Department");
						},
					});
				}
			},
		});
});

loadTable = () => {
	$("#data-table").dataTable().fnClearTable();
	$("#data-table").dataTable().fnDraw();
	$("#data-table").dataTable().fnDestroy();
	$("#data-table").DataTable({
		ajax: {
			url: baseURL + "DepartmentController/get_all_department",
			dataSrc: "",
		},
		aLengthMenu: [5, 10, 20, 30, 50, 100],
		responsive: true,
		serverSide: false,
		dataType: "json",
		// type: "GET",
		columns: [
			{
				data: "department_name",
				name: "department_name",
				searchable: true,
				width: "10%",
			},

			{
				data: "department_head",
				name: "department_head",
				searchable: true,
				width: "10%",
			},

			{
				data: "department_contact_no",
				name: "department_contact_no",
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
						aData["department_id"] +
						"',0)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-eye mr-1"></i></div>' +
						"<div> View</div></div>";

					//edit
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return editData(\'' +
						aData["department_id"] +
						"',1)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-edit mr-1"></i></div>' +
						"<div> Edit</div></div>";

					//delete
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return deleteData(\'' +
						aData["department_id"] +
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
		url: baseURL + "DepartmentController/get_one_department/" + id,
		// type: "POST",
		dataType: "json",
		success: function (data) {
			formReset("show");
			// console.log(data)
			$("#uuid").val(data[0].department_id);
			$("#department_name").val(data[0].department_name);
			$("#department_contact_no").val(data[0].department_contact_no);
			$("#department_head").val(data[0].department_head);

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
				url: baseURL + "DepartmentController/delete_department/" + id,
				// type: "DELETE",
				// dataType: "json",
				success: function (data) {
					notification(
						"success",
						"Success!",
						"Department Successfully Deactivated"
					);
					loadTable();
				},
				error: function ({ responseJSON }) {},
			});
		}
	});
};
