$(document).ready(function(){
	$('.smile-item').click(function(){
		index = $(this).index();
		sov = index + 1;

		sovStr = ' :sov' + sov + ': ';
		textval = $('#discussionText').val();
		CKEDITOR.instances.discussionText.insertText(sovStr);
	});
});