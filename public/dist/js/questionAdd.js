$(document).ready(function(){



	$('#add-answer').click(function(){
		item = $('#answer-item').html();
		$('#newItems').append(item);
		return false;
	});


	$('body').on('click', '.right-checkbox' ,function(){
		$('.right-checkbox').prop('checked', false);
		$('.old-right-checkbox').prop('checked', false);
		$(this).prop('checked', true);
		$('#rightId').val(0);

		index = $('.right-checkbox').index($(this));

		item = index - 1;
		$('#right').val(item);
	});


	$('body').on('click', '.delete-answer', function(){
		$(this).parent().prev().remove();
		$(this).parent().remove();

		id = $(this).prev().data('id');
		$.get('/admin/ajax/answer-delete/' + id);
		return false;
	});

});