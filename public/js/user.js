var toastElList = document.querySelectorAll('.toast');
var toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
var toast = toastList[0];
var toastError = toastList[1];

//Get the volunteers and organization divs for showing and hiding them
var volunteer1 = document.getElementById("volunteer1");
var volunteer2 = document.getElementById("volunteer2");
var volunteer3 = document.getElementById("volunteer3");
var volunteer4 = document.getElementById("volunteer4");
var volunteer5 = document.getElementById("volunteer5");

var organization = document.getElementById("organization");

var fadeDownVolunteers = function() {
	volunteer1.classList.remove("fade-up-users");
	volunteer2.classList.remove("fade-up-users");
	volunteer3.classList.remove("fade-up-users");
	volunteer4.classList.remove("fade-up-users");
	volunteer5.classList.remove("fade-up-users");
}

var fadeDownOrganization = organization.classList.remove("fade-up-users");


window.onload = function() {
	/**
	 * Function to save the user through ajax
	 * 
	 */
	document.getElementById("save").addEventListener("click", function() {
		document.getElementById("save").disabled = true;
		document.getElementById("save").innerHTML = "Saving ...";
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
				sending: $("#sending").val(),
				organization: $("#organization_name").val()
			},
			success: function(result) {
				toast.show();
				setTimeout(function() {
					window.location.reload();
				}, 1500);
			},
			error: function(result) {
				toastError.show();
				document.getElementById("save").disabled = false;
				document.getElementById("save").innerHTML = "Save";
			}
		});
	});
	//If the user is a volunteer, show the volunteer divs
	if ($("#role").val() == 1) {
		volunteer1.style.display = "block";
		volunteer1.classList.toggle("fade-down-users");
		volunteer2.style.display = "block";
		volunteer2.classList.toggle("fade-down-users");
		volunteer3.style.display = "block";
		volunteer3.classList.toggle("fade-down-users");
		volunteer4.style.display = "block";
		volunteer4.classList.toggle("fade-down-users");
		volunteer5.style.display = "block";
		volunteer5.classList.toggle("fade-down-users");
	} 
	//If the user is an organization, show the organization div
	else if ($("#role").val() == 3) {
		organization.style.display = "block";
		organization.classList.toggle("fade-down-users");
	}
	
	//When changing the role, show the divs of the new role and hide the divs of the old role
	document.getElementById("role").addEventListener("change", function() {
		if ($("#role").val() == 1) {
			if (organization.style.display == "block") {
				let promiseTimeOutOrganization = new Promise((resolve, reject) => {
					organization.classList.add("fade-up-users");
					//Wait for the animation to finish
					setTimeout(() => resolve(), 700);
					return;
				});
				promiseTimeOutOrganization.then(() => {
					volunteer1.classList.remove("fade-up-users");
					volunteer1.style.display = "block";
					volunteer1.classList.add("fade-down-users");
					volunteer2.classList.remove("fade-up-users");
					volunteer2.style.display = "block";
					volunteer2.classList.add("fade-down-users");
					volunteer3.classList.remove("fade-up-users");
					volunteer3.style.display = "block";
					volunteer3.classList.add("fade-down-users");
					volunteer4.classList.remove("fade-up-users");
					volunteer4.style.display = "block";
					volunteer4.classList.add("fade-down-users");
					volunteer5.classList.remove("fade-up-users");
					volunteer5.style.display = "block";
					volunteer5.classList.add("fade-down-users");
					organization.style.display = "none";
				});
			} else {
				volunteer1.classList.remove("fade-up-users");
				volunteer1.style.display = "block";
				volunteer1.classList.add("fade-down-users");
				volunteer2.classList.remove("fade-up-users");
				volunteer2.style.display = "block";
				volunteer2.classList.add("fade-down-users");
				volunteer3.classList.remove("fade-up-users");
				volunteer3.style.display = "block";
				volunteer3.classList.add("fade-down-users");
				volunteer4.classList.remove("fade-up-users");
				volunteer4.style.display = "block";
				volunteer4.classList.add("fade-down-users");
				volunteer5.classList.remove("fade-up-users");
				volunteer5.style.display = "block";
				volunteer5.classList.add("fade-down-users");
				organization.style.display = "none";
			}
		} else if($("#role").val() == 3) {
			if (volunteer1.style.display == "block") {
				let promiseTimeOutVolunteers = new Promise((resolve, reject) => {
					volunteer1.classList.add("fade-up-users");
					volunteer2.classList.add("fade-up-users");
					volunteer3.classList.add("fade-up-users");
					volunteer4.classList.add("fade-up-users");
					volunteer5.classList.add("fade-up-users");
					setTimeout(() => resolve(), 700);
					return;
				});
				promiseTimeOutVolunteers.then(() => {
					volunteer1.style.display = "none";
					volunteer2.style.display = "none";
					volunteer3.style.display = "none";
					volunteer4.style.display = "none";
					volunteer5.style.display = "none";
					volunteer1.classList.remove("fade-down-users");
					volunteer2.classList.remove("fade-down-users");
					volunteer3.classList.remove("fade-down-users");
					volunteer4.classList.remove("fade-down-users");
					volunteer5.classList.remove("fade-down-users");
					organization.classList.remove("fade-up-users");
					organization.style.display = "block";
					organization.classList.add("fade-down-users");
				});
			} else {
				organization.classList.remove("fade-up-users");
				organization.style.display = "block";
				organization.classList.add("fade-down-users");
			}
		} else {
			if (volunteer1.style.display == "block") {
				let promiseTimeOutVolunteers = new Promise((resolve, reject) => {
					volunteer1.classList.add("fade-up-users");
					volunteer2.classList.add("fade-up-users");
					volunteer3.classList.add("fade-up-users");
					volunteer4.classList.add("fade-up-users");
					volunteer5.classList.add("fade-up-users");
					setTimeout(() => resolve(), 700);
					return;
				});
				promiseTimeOutVolunteers.then(() => {
					volunteer1.classList.remove("fade-down-users");
					volunteer1.style.display = "none";
					volunteer2.classList.remove("fade-down-users");
					volunteer2.style.display = "none";
					volunteer3.classList.remove("fade-down-users");
					volunteer3.style.display = "none";
					volunteer4.classList.remove("fade-down-users");
					volunteer4.style.display = "none";
					volunteer5.classList.remove("fade-down-users");
					volunteer5.style.display = "none";
				});
			} else if (organization.style.display == "block") {
				let promiseTimeOutOrganization = new Promise((resolve, reject) => {
					organization.classList.add("fade-up-users");
					//Wait for the animation to finish
					setTimeout(() => resolve(), 700);
					return;
				});
				promiseTimeOutOrganization.then(() => {
					organization.classList.remove("fade-down-users");
					organization.style.display = "none";
				});
			}
		}
	},);
};





