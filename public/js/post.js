var fonts = ['Arial', 'Courier', 'Garamond', 'Tahoma', 'Times New Roman', 'Verdana', 'Impact', 'Comic Sans MS'];
function getFontName(font) {
	return font.toLowerCase().replace(/\s/g, '-');
}
var fontNames = fonts.map(font => getFontName(font));
var fontStyles = "";
fonts.forEach(function(font) {
	var fontName = getFontName(font);
	fontStyles += ".ql-snow .ql-picker.ql-font .ql-picker-label[data-value=" + fontName + "]::before, .ql-snow .ql-picker.ql-font .ql-picker-item[data-value=" + fontName + "]::before {" +
	"content: '" + font + "';" +
	"font-family: '" + font + "', sans-serif;" +
	"}" +
	".ql-font-" + fontName + "{" +
	" font-family: '" + font + "', sans-serif;" +
	"}";
});
var node = document.createElement('style');
node.innerHTML = fontStyles;
document.body.appendChild(node);

var container = document.getElementById('editor');
var options = {
	bounds: '#full-container .editor',
	modules: {
		'syntax': true,
		'toolbar': [
			[{ 'font': fontNames }, { 'size': [] }],
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

var Font = Quill.import('formats/font');
// We do not add Sans Serif since it is the default
Font.whitelist = fontNames;
Quill.register(Font, true);

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
