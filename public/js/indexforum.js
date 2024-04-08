window.onload = function (){
	document.getElementById("create").addEventListener("click", function(event){
		if(document.getElementById('category').value == ''){
			event.preventDefault();
			alert('Please select a category');
		} else if (document.getElementById('title').value == ''){
			event.preventDefault();
			alert('Please enter a title');
		}
	});
}