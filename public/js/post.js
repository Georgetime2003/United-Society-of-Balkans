var fonts = ['Arial'];
var Font = Quill.import('formats/font');
Font.whitelist = fonts;
var editor = Quill.register(Font, true);

var container = document.getElementById('editor');
var options = {
	bounds: '#full-container .editor',
	modules: {
	  'syntax': true,
	  'toolbar': [
		[{ 'font': fonts }, { 'size': [] }],
		[ 'bold', 'italic', 'underline', 'strike' ],
		[{ 'color': [] }, { 'background': [] }],
		[{ 'script': 'super' }, { 'script': 'sub' }],
		[{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
		[{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
		[ {'direction': 'rtl'}, { 'align': [] }],
		[ 'link', 'image', 'video', 'formula' ],
		[ 'clean' ]
	  ],
	},
	theme: 'snow'
  };
var editor = new Quill(container, options);

document.getElementById('submit').addEventListener('click', function() {
	var post = editor.root.innerHTML;
	var title = document.getElementById('title').value;
	var forum_id = document.getElementById('forum_id').value;
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		}
	});
	$.ajax({
		url: '/forum/' + forum_id + '/post',
		type: 'POST',
		data: {
			title: title,
			content: post,
			forum_id: forum_id
		},
		success: function(data) {
			// location.reload();
			if (data.success) {
				window.location.href = '/forum/' + forum_id;
			} else {
				alert(data.error);
			}
		},
		error: function(data) {
			console.log(data);
		}
	});
});
