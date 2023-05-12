import { createPicker } from 'https://unpkg.com/picmo@latest/dist/index.js';

const container = document.querySelector('.emoji-picker');
const picker = createPicker({
  rootElement: container
});

window.onload = function (){
	document.getElementById('emogiKeyboard').addEventListener('click', function() {
		//Unhide the emoji picker
		// document.getElementById('pickerKeyboard').setAttribute('hidden', false);
		//Position the emoji picker under the button
		container.style.top = this.offsetTop + this.offsetHeight + 'px';
		container.style.left = this.offsetLeft + 'px';
		container.style.display = 'block';
		//Hide the emoji picker when a click is made outside of it
		document.addEventListener('click', function(e) {
			if (!container.contains(e.target)) {
				container.style.display = 'none';
			}
		});
		picker.on('emoji', emoji => {
			document.getElementById('forumTitle').value += emoji;
		});
	});
}