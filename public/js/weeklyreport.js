const userid = document.getElementById('userid').value;
const reportid = document.getElementById('reportid').value;

var toastElList = document.querySelectorAll('.toast');
var toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
var toast = toastList[0];

/**
 * Function to send the update through ajax
 */
window.onload = function() {
	document.getElementById("monday4").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("monday_4", value);
	});
	document.getElementById("monday2").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("monday_2", value);
	});
	document.getElementById("tuesday4").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("tuesday_4", value);
	});
	document.getElementById("tuesday2").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("tuesday_2", value);
	});
	document.getElementById("wednesday4").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("wednesday_4", value);
	});
	document.getElementById("wednesday2").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("wednesday_2", value);
	});
	document.getElementById("thursday4").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("thursday_4", value);
	});
	document.getElementById("thursday2").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("thursday_2", value);
	});
	document.getElementById("friday4").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("friday_4", value);
	});
	document.getElementById("friday2").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("friday_2", value);
	});
	document.getElementById("extra").addEventListener("focusout", function() {
		var value = this.innerText;
		sendUpdate("extra", value);
	});
};

/**
 * Function to send the update through ajax
 * @param {string} day The day of the week that is being updated
 * @param {string} value The value that is being updated
 */
function sendUpdate(day, value){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		}
	});
	$.ajax({
		url: '/weeklyreport/update',
		type: 'POST',
		data: {
			userid: userid,
			reportid: reportid,
			day: day,
			value: value,
		},
		success: function(data) {
			toast.show();
			console.log(data);
		},
		error: function(data) {
			console.log(data);
		}
	});
}