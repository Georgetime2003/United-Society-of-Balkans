window.onload = function() {
	for (let i = 1; i < document.getElementsByTagName("tr").length; i++) {
		document.getElementsByTagName("tr")[i].addEventListener("click", function() {
			window.location.href = "/user/" + document.getElementsByTagName("tr")[i].id;
		});
		//Show the cursor as a pointer when hovering over a row
		document.getElementsByTagName("tr")[i].style.cursor = "pointer";
		//Add delete button
		let deleteButton = document.createElement("a");
		deleteButton.innerHTML = "<i class='fas fa-trash-alt'></i>";
		deleteButton.className = "btn btn-outline-danger";
		deleteButton.addEventListener("click", function() {
			deleteUser(document.getElementsByTagName("tr")[i].id);
		});
		document.getElementsByClassName("actions")[i - 1].appendChild(deleteButton);
	}
}

function deleteUser(id) {
	if(confirm("Are you sure you want to delete this user?")) {
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
			}
		});
		$.ajax({
			url: "/user/" + id,
			type: "DELETE",
			success: function(result) {
				//Reload site
				window.location.reload();
			}
		});
	}
}