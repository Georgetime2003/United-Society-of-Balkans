window.onload = function() {
    for (let i = 1; i < document.getElementsByTagName("tr").length; i++) {
		document.getElementsByTagName("tr")[i].addEventListener("click", function() {
			window.location.href = "/organization/" + document.getElementById("organizationId").innerHTML + "/" + document.getElementsByTagName("tr")[i].id;
		});
		//Show the cursor as a pointer when hovering over a row
		document.getElementsByTagName("tr")[i].style.cursor = "pointer";
	}
};