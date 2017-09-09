$(document).ready(function(){

	var today = new Date();
	$.datetimepicker.setLocale('ru');
	$('#datetimepicker').datetimepicker({
		timepicker:false,
		format:'Y/m/d',
		startDate:  new Date(today.getFullYear(), today.getMonth(), today.getDate()),
	});

	$(document).on('click', '.bid-delete-button', function(){
		var id = $(this).data('courseid');
		$(this).parent().parent().hide();
		$.get('/ajax/cur-course-delete/' + id, function(data){
			$('#totalprice').val(data);
			$('.bid-form-totalprice').html('Сумма ' + data + 'р');
		});

	});


	$('.course-list-item2').click(function(){
		var id = $(this).data('courseid');
		$.get('/ajax/cur-course-add/' + id, function(data){
			if(data == 0) {
				return false;
			}

			$('#current-courses-list').append(data);

			$.get('/ajax/current-total', function(data){
				$('#totalprice').val(data);
				$('.bid-form-totalprice').html('Сумма: ' + data + 'р');
			});

		});

	});


	$('#zayavka-form').validate({
		rules: {
			name: {
				required: true
			},
			email: {
				required:true,
				email: true
			}

		},
		messages: {
			name: {
				required: "Вы не указали ваше имя"
			},
			email: {
				required: "Вы не указали email",
				email: "Введите правильный email"
			}
		},
	});
});