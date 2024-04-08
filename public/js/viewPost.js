const contador = document.getElementById("upvotes");
let likes = document.getElementById("upvotes").innerHTML;

window.onload = function () {
	document.getElementById("submit").addEventListener("click", comment);
	document.getElementById("delete").addEventListener("click", deletePost);
	document.getElementById("noupvote").addEventListener("click", delupvote);
	document.getElementById("yesupvote").addEventListener("click", upvote);
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

function deletePost(){
	if (confirm("Are you sure you want to delete the post?")){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			}
		});
		$.ajax({
			type: "POST",
			url: "/post/delete",
			data: {
				"post_id": document.getElementById("post_id").value,
				"forum_id": document.getElementById("forum_id").value
			},
			success: function (response) {
				if (response.success) {
					alert(response.success);
					location.href = "/forum/" + document.getElementById("forum_id").value;
				} else {
					alert(response.error);
				}
			}
		});
	}
}

function upvote(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		}
	});
	$.ajax({
		type: "POST",
		url: "/post/upvote",
		data: {
			"post_id": document.getElementById("post_id").value,
			"user_id": document.getElementById("user_id").value,
		},
		success: function (response) {
			if (response.success) {
				document.getElementById("yesupvote").style.display = "none";
				document.getElementById("noupvote").style.display = "block";
				likes++;
				contador.innerHTML = likes;
				contador.classList.add("contador");
				setTimeout(() => {
					contador.classList.remove("contador");
				}, 500);
			} else {
				alert(response.error);
			}
		}
	});
}

function delupvote(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		}
	});
	$.ajax({
		type: "POST",
		url: "/post/delupvote",
		data: {
			"post_id": document.getElementById("post_id").value,
			"user_id": document.getElementById("user_id").value,
		},
		success: function (response) {
			if (response.success) {
				document.getElementById("yesupvote").style.display = "block";
				document.getElementById("noupvote").style.display = "none";
				likes--;
				contador.innerHTML = likes;
				contador.classList.add("contador");
				setTimeout(() => {
					contador.classList.remove("contador");
				}, 500);
			} else {
				alert(response.error);
			}
		}
	});
}