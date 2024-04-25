window.onload = function () {
	document.getElementById("delete").addEventListener("click", function () {
		deletePost(this);
	});
}

function upvote(post_id, user_id, i){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		}
	});
	$.ajax({
		type: "POST",
		url: "/post/upvote",
		data: {
			"post_id": post_id,
			"user_id": user_id,
		},
		success: function (response) {
			if (response.success) {
                contador = document.getElementById("upvotes" + i);
                likes = contador.innerHTML;
				document.getElementById("yesupvote" + i).style.display = "none";
				document.getElementById("noupvote" + i).style.display = "block";
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

function delupvote(post_id, user_id, i){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		}
	});
	$.ajax({
		type: "POST",
		url: "/post/delupvote",
		data: {
			"post_id": post_id,
			"user_id": user_id,
		},
		success: function (response) {
			if (response.success) {
                contador = document.getElementById("upvotes" + i);
                likes = contador.innerHTML;
				document.getElementById("yesupvote" + i).style.display = "block";
				document.getElementById("noupvote" + i).style.display = "none";
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

function deletePost(button) {
	if (confirm("Are you sure you want to delete the post?")){
		var postId = button.getAttribute("data-post-id");
		var forumId = button.getAttribute("data-forum-id");
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			}
		});
		$.ajax({
			type: "POST",
			url: "/post/delete",
			data: {
				"post_id": postId,
				"forum_id": forumId
			},
			success: function (response) {
				if (response.success) {
					alert(response.success);
					location.href = "/forum/" + forumId;
				} else {
					alert(response.error);
				}
			}
		});
	}
}