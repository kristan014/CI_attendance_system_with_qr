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
				attendance_name: {
					required: true,
				},
				attendance_contact_no: {
					required: true,
				},

				attendance_head: {
					required: true,
				},
			},
			messages: {
				attendance_name: {
					required: "Please provide attendance name",
				},

				attendance_contact_no: {
					required: "Please provide contact No",
				},

				attendance_head: {
					required: "Please provide attendance head",
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
						url: baseURL + "AttendanceController/create_attendance",
						type: "POST",
						data: {
							attendance_name: $("#attendance_name").val(),
							attendance_contact_no: $("#attendance_contact_no").val(),
							attendance_head: $("#attendance_head").val(),
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
							notification("error", "Error!", "Error in Creating Attendance");
							// console.log(responseJSON);
							// console.log(responseJSON.responseText)
						},
					});
				} else {
					// update record
					$.ajax({
						url:
							baseURL +
							"AttendanceController/update_attendance/" +
							$("#uuid").val(),
						type: "POST",
						data: {
							attendance_name: $("#attendance_name").val(),
							attendance_contact_no: $("#attendance_contact_no").val(),
							attendance_head: $("#attendance_head").val(),
						},
						cache: false,
						success: function (data) {
							console.log(data)
							if (data.status_code != 404) {
								notification("success", "Success!", data.message);
							} else {
								notification("error", "Error!", data.message);
							}

							formReset("hide");

							loadTable();
						},
						error: function ({ responseJSON }) {
							notification("error", "Error!", "Error in Updating Attendance");
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
			url: baseURL + "AttendanceController/get_all_attendance",
			dataSrc: "",
		},
		aLengthMenu: [5, 10, 20, 30, 50, 100],
		responsive: true,
		serverSide: false,
		dataType: "json",
		// type: "GET",
        columnDefs: [{
            targets: '_all',
            defaultContent: ""
        }],
		columns: [
			{
				data: "attendance_date",
				name: "attendance_date",
				searchable: true,
				width: "10%",
			},
            {
				data: null,
				name: null,
				searchable: true,
				width: "10%",
				render: function (aData, type, row) {
                return aData.first_name + " " + aData.last_name
                }
			},


			{
				data: "time_in",
				name: "time_in",
				searchable: true,
				width: "10%",
			},

			{
				data: "time_out",
				name: "time_out",
				searchable: true,
				width: "10%",
			},
			{
				data: "over_time_hours",
				name: "over_time_hours",
				searchable: true,
				width: "10%",
			},
            {
				data: "total_hours_worked",
				name: "total_hours_worked",
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
						aData["attendance_id"] +
						"',0)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-eye mr-1"></i></div>' +
						"<div> View</div></div>";

					//edit
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return editData(\'' +
						aData["attendance_id"] +
						"',1)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-edit mr-1"></i></div>' +
						"<div> Edit</div></div>";

					//delete
					// buttons +=
					// 	'<div class="dropdown-item d-flex role="button" onClick="return deleteData(\'' +
					// 	aData["attendance_id"] +
					// 	"',0)\">" +
					// 	'<div style="width: 2rem"> <i class= "fas fa-trash mr-1"></i></div>' +
					// 	"<div> Delete</div></div>";

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
		url: baseURL + "AttendanceController/get_one_attendance/" + id,
		// type: "POST",
		dataType: "json",
		success: function (data) {
			formReset("show");
			// console.log(data)
			$("#uuid").val(data[0].attendance_id);
			$("#attendance_name").val(data[0].attendance_name);
			$("#attendance_contact_no").val(data[0].attendance_contact_no);
			$("#attendance_head").val(data[0].attendance_head);

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
				url: baseURL + "AttendanceController/delete_attendance/" + id,
				// type: "DELETE",
				// dataType: "json",
				success: function (data) {
					notification(
						"success",
						"Success!",
						"Attendance Successfully Deactivated"
					);
					loadTable();
				},
				error: function ({ responseJSON }) {},
			});
		}
	});
};
