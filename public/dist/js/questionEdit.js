$(document).ready(function(){


	$('.old-right-checkbox').click(function(){
		$('.right-checkbox').prop('checked', false);
		$('.old-right-checkbox').prop('checked', false);
		$(this).prop('checked', true);

		id = $(this).data('id');

		$('#rightId').val(id);
	});

});