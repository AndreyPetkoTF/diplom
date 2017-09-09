$(document).ready(function(){

	$('#program').hide();

	$('#description-tab').click(function(){
		$('#program').hide();
		$('#description').show();
	});


	$('#program-tab').click(function(){
		$('#program').show();
		$('#description').hide();
	});
});