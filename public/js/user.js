var toastElList = document.querySelectorAll('.toast');
var toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
var toast = toastList[0];

window.onload = function() {
	document.getElementById("save").addEventListener("click", function() {
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
			}
		});
		$.ajax({
			url: "/user",
			type: "POST",
			data: {
				id: $("#id").val(),
				name: $("#name").val(),
				surnames: $("#surnames").val(),
				email: $("#email").val(),
				start_date: $("#starting_date").val(),
				end_date: $("#ending_date").val(),
				volunteer_code: $("#volunteer_code").val(),
				role: $("#role").val(),
				hosting: $("#hosting").val(),
				sending: $("#sending").val()
			},
			success: function(result) {
				//Toast message with update status
				toast.show();
				//Reload site in 5 seconds
				setTimeout(function() {
					window.location.reload();
				}, 1500);
			}
		});
	});
};