window.onload = function () {
	document.getElementById("submit").addEventListener("click", comment);
}

function comment() {
	var comment = document.getElementById("comment").value;
	var id = document.getElementById("post_id").value;
	var user = document.getElementById("user_id").value;
	var forum_id = document.getElementById("forum_id").value;
	var data = {
		"content": comment,
		"post_id": id,
		"user_id": user,
		"forum_id": forum_id
	};
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		}
	});
	$.ajax({
		type: "POST",
		url: "/comment",
		data: data,
		success: function (response) {
			if (response.success) {
				alert(response.success);
				location.reload();
			} else {
				alert(response.error);
			}
		},
		error: function (response) {
			alert(response.error);
		}
	});
}