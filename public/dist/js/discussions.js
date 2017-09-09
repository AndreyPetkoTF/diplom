$(document).ready(function(){
	$('#course').change(function(){
		$("#lesson").prop('disabled', false);


		$.get('/ajax/course-lessons/' + $(this).val(), function(data){
			$('#lesson').empty();
			if(!data) {
				$('#lesson')
				.append($("<option></option>")
					.attr("value", '0')
					.text('Нет уроков')); 
			}
			$.each(data, function(key, value) {
				$('#lesson')
				.append($("<option></option>")
					.attr("value",key)
					.text(value)); 
			});
		})
	});
});