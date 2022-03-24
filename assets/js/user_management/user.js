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
				email: {
					required: true,
				},
				password: {
					required: true,
				},

				employee_id: {
					required: true,
				},
			},
			messages: {
				email: {
					required: "Please provide an email",
				},

				password: {
					required: "Please provide a password",
				},

				employee_id: {
					required: "Please choose employee",
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
						url: baseURL + "UserController/create_user",
						type: "POST",
						data: {
							email: $("#email").val(),
							password: $("#password").val(),
							employee_id: $("#employee_id").val(),
						},
						cache: false,

						success: function (data) {
							console.log(data);
							notification(
								"success",
								"Success!",
								"User Successfuly Created"
							);
							formReset("hide");

							loadTable();
						},
						error: function (responseJSON) {
							notification("error", "Error!", "Error in Creating User");
						},
					});
				} else {
					// update record
					$.ajax({
						url:
							baseURL +
							"UserController/update_user/" +
							$("#uuid").val(),
						type: "POST",
						data: {
                            email: $("#email").val(),
							password: $("#password").val(),
							employee_id: $("#employee_id").val(),
						},
	
						cache: false,
						success: function (data) {
							notification(
								"success",
								"Success!",
								"User Successfuly Updated"
							);
							formReset("hide");

							loadTable();
						},
						error: function ({ responseJSON }) {
							notification("error", "Error!", "Error in Updating User");
						},
					});
				}
			},
		});
});


// function to load departments
loadEmployees = () => {
	$.ajax({
		url: baseURL + "EmployeeController/get_all_employee",
		type: "GET",
		dataType: "json",
		success: function (responseData) {
			if (responseData) {
				$("#employee_id").empty();
				$.each(responseData, function (i, dataOptions) {
					var options = "";

					options =
						"<option value='" +
						dataOptions.employee_id +
						"'>" +
						dataOptions.first_name +" "+dataOptions.last_name
						"</option>";

					$("#employee_id").append(options);
				});
			} else {
				notification("error", "Error!", "Error in loading employees");
			}
		},
		error: function ({ responseJSON }) {},
	});
};

loadEmployees();


loadTable = () => {
	$("#data-table").dataTable().fnClearTable();
	$("#data-table").dataTable().fnDraw();
	$("#data-table").dataTable().fnDestroy();
	$("#data-table").DataTable({
		ajax: {
			url: baseURL + "UserController/get_all_user",
			dataSrc: "",
		},
		aLengthMenu: [5, 10, 20, 30, 50, 100],
		responsive: true,
		serverSide: false,
		dataType: "json",
		// type: "GET",
		columns: [
			{
				data: "employee_id",
				name: "employee_id",
				searchable: true,
				width: "10%",
			},

			{
				data: "email",
				name: "email",
				searchable: true,
				width: "30%",
			},

			{
				data: "created_by",
				name: "created_by",
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
						aData["user_id"] +
						"',0)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-eye mr-1"></i></div>' +
						"<div> View</div></div>";

					//edit
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return editData(\'' +
						aData["user_id"] +
						"',1)\">" +
						'<div style="width: 2rem"> <i class= "fas fa-edit mr-1"></i></div>' +
						"<div> Edit</div></div>";

					//delete
					buttons +=
						'<div class="dropdown-item d-flex role="button" onClick="return deleteData(\'' +
						aData["user_id"] +
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
		url: baseURL + "UserController/get_one_user/" + id,
		// type: "POST",
		dataType: "json",
		success: function (data) {
			formReset("show");
			// console.log(data)
			$("#uuid").val(data[0].user_id);
			$("#email").val(data[0].email);
			$("#password").val(data[0].password);
			$("#employee_id").val(data[0].employee_id).trigger("change");

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
				url: baseURL + "UserController/delete_user/" + id,
				// type: "DELETE",
				// dataType: "json",
				success: function (data) {
					notification(
						"success",
						"Success!",
						"User Successfully Deactivated"
					);
					loadTable();
				},
				error: function ({ responseJSON }) {},
			});
		}
	});
};
