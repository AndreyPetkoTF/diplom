$(document).ready(function(){




	$( "#name" ).keyup(function() {
		val = $(this).val();
		val=val.replace(new RegExp(" ",'g'),'-');
		$("#url").val(transliterate(val));
	});





	$('#user-slider-checkbox').change(function(){
		var userId = $('#userId').val();
		var checked = 0;

		if($(this).is(':checked')) {
			checked = 1;
		}

		$.get('/ajax/change-user-slider?checked=' + checked + '&userId=' + userId);
	});

		//Если с английского на русский, то передаём вторым параметром true.
		transliterate = (
			function() {
				var
				rus = "щ   ш  ч  ц  ю  я  ё  ж  ъ  ы  э  а б в г д е з и й к л м н о п р с т у ф х ь /".split(/ +/g),
				eng = "shh sh ch cz yu ya yo zh b y e a b v g d e z i j k l m n o p r s t u f x b -".split(/ +/g)
				;
				return function(text, engToRus) {
					var x;
					for(x = 0; x < rus.length; x++) {
						text = text.split(engToRus ? eng[x] : rus[x]).join(engToRus ? rus[x] : eng[x]);
						text = text.split(engToRus ? eng[x].toUpperCase() : rus[x].toUpperCase()).join(engToRus ? rus[x].toUpperCase() : eng[x].toUpperCase()); 
					}
					return text;
				}
			}
			)();



});


