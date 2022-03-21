const apiURL = "http://localhost:8000/api/v1/";
const baseURL = "http://localhost/payroll/";

// type = error, warning, success, info
// title = string
// message = string
const notification = (type, title, message) => {
	return toastr[type](message, title);
};

// get token
const token = localStorage.getItem("TOKEN");
let button = document.querySelector(".submit");

// append headers to ajax attributes
$.ajaxSetup({
	headers: {
		Accept: "application/json",
		Authorization: "Bearer " + token,
	},
});

// when ajax has started
$(document).ajaxStart(function () {
	button != undefined ? (button.disabled = true) : null;
});

// when ajax has sent the request
$(document).ajaxSend(function (e, xhr, opt) {
	button != undefined ? (button.disabled = true) : null;
});

// ajax received a response
$(document).ajaxComplete(function () {
	button != undefined ? (button.disabled = false) : null;
});

// ajax has error
$(document).ajaxError(function () {
	button != undefined ? (button.disabled = false) : null;
});

// @param:
// 		action = show, hide
formReset = (action = "hide") => {
	$("html, body").animate({ scrollTop: 0 }, "slow");

	if (action == "hide") {
		// hide and clear form
		$("#form_id")[0].reset();
		$("#div_form").hide();
		$("#btn_add").show();
	} else if (action == "show") {
		// show
		$("#div_form").show();
		$("#btn_add").hide();
		$(".submit").show();
		$("#form_id input, select, textarea").prop("disabled", false);
		$("#form_id button").prop("disabled", false);
		$("#photo_path_placeholder").attr(
			"src",
			"https://avatars.dicebear.com/api/bottts/smile.svg"
		);
	}
};

// trim the input fields except file, select, textarea
trimInputFields = () => {
	var allInputs = $("input:not(:file())");
	allInputs.each(function () {
		$(this).val($.trim($(this).val()));
	});
};

$.fn.formToJson = function () {
	form = $(this);
	var formArray = form.serializeArray();
	var jsonOutput = {};

	$.each(formArray, function (i, element) {
		var elemNameSplit = element["name"].split("[");
		var elemObjName = "jsonOutput";

		$.each(elemNameSplit, function (nameKey, value) {
			if (nameKey != elemNameSplit.length - 1) {
				if (value.slice(value.length - 1) == "]") {
					if (value === "]") {
						elemObjName =
							elemObjName + "[" + Object.keys(eval(elemObjName)).length + "]";
					} else {
						elemObjName = elemObjName + "[" + value;
					}
				} else {
					elemObjName = elemObjName + "." + value;
				}

				if (typeof eval(elemObjName) == "undefined")
					eval(elemObjName + " = {};");
			} else {
				if (value.slice(value.length - 1) == "]") {
					if (value === "]") {
						eval(
							elemObjName +
								"[" +
								Object.keys(eval(elemObjName)).length +
								"] = '" +
								element["value"].replace("'", "\\'") +
								"';"
						);
					} else {
						eval(
							elemObjName +
								"[" +
								value +
								" = '" +
								element["value"].replace("'", "\\'") +
								"';"
						);
					}
				} else {
					eval(
						elemObjName +
							"." +
							value +
							" = '" +
							element["value"].replace("'", "\\'") +
							"';"
					);
				}
			}
		});
	});
	return jsonOutput;
};

