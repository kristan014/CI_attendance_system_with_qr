$(function () {
	$.ajax({
		url: baseURL + "DepartmentController/get_all_department",
		type: "GET",
		dataType: "json",
		// headers: {
		//   Accept: "application/json",
		//   Authorization: "Bearer " + localStorage.getItem("TOKEN"),
		//   ContentType: "application/x-www-form-urlencoded",
		// },
		success: function (responseData) {
			console.log(responseData);
		},
		error: function ({ responseJSON }) {},
	});

    loadTable();

});

loadTable = () => {

	// $.ajaxSetup({
	//   headers: {
	//     Accept: "application/json",
	//     Authorization: "Bearer " + localStorage.getItem("TOKEN"),
	//     ContentType: "application/x-www-form-urlencoded",
	//   },
	// });
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
		type: "GET",
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

					buttons += "</div></div>";
					return buttons; // same class in i element removed it from a element
				},
			},
		],
	});
};
