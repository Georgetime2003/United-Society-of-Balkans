window.onload = function() {
	//Add event listener to the table rows to redirect to the user page
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
			event.stopPropagation();
			deleteUser(document.getElementsByTagName("tr")[i].id);
		});
		document.getElementsByClassName("actions")[i - 1].appendChild(deleteButton);
	}
}

//Function to delete a user
function deleteUser(id) {
	if(confirm("Are you sure you want to delete this user?")) {
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
			}
		});
		$.ajax({
			url: "/user/delete/" + id,
			type: "POST",
			success: function(result) {
				//Reload site
				window.location.reload();
			}
		});
	}
}