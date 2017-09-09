
var sova = document.getElementById('sova');
if(sova) {
	sovClick = 0;
	sova.addEventListener('click', function () {
		if(sovClick == 0){
			var sovPos = this.getBoundingClientRect();
			// sovLeftNew = sovPos.left - 160;
			sovLeftNew = -140;
			sovTopNew = -50;
			this.insertAdjacentHTML("beforebegin",'<div id="sovInput"><span>Задать вопрос</span> <div id="closeSov">x</div><input type="text" id="email" placeholder="Email" /><textarea id="textSov" placeholder="Текст"></textarea><input id="submitSov" value="Отправить" type="submit"></div>');
			var sovInput = document.getElementById('sovInput');
			sovInput.style.cssText = "background-image:url(http://it-school.ap.org.ua/profile_images/sov/sova-text.png); padding-top: 10px; position:absolute; background-size: 100%; background-repeat:no-repeat; width: 200px; height: 170px; left:" + sovLeftNew  + "px;" + "top:" + sovTopNew + "px;";
			var closeSov = document.getElementById('closeSov');
			document.querySelector("#sovInput textarea").style.cssText = "background-color: transparent; border: 1px solid grey; height: 50px; margin-left: 10px; text-indent: 5px; outline: none; width:80%; resize: none; margin-top:2px;";
			document.querySelector("#sovInput input").style.cssText = "background-color: transparent; border: 1px solid grey; padding: 1px 5px; margin-left: 10px; width: 80%;";
			document.querySelector("#submitSov").style.cssText = "background-color: transparent; border: 1px solid grey; padding: 1px 5px; margin-left: 10px; width: 80%;";
			document.querySelector("#sovInput span").style.cssText = "font-size:14px; margin-left:10px;";
			closeSov.style.cssText = "float:right; cursor:pointer; font-size:16px; margin-right:20px;";
			closeSov.addEventListener('click', function(){
				sovInput.parentNode.removeChild(sovInput);
				sovClick--;
			});

			$('#submitSov').click(function(){

				token = $('#token').val();
				text = $('#textSov').val();
				email = $('#email').val();

				$.ajax({
					type: "POST",
					url: '/ajax/feedback-add',
					data: {
						'text': text,
						'email': email,
						'_token' : token
					},
					success: function(data){
						$('#email').hide();
						$('#textSov').hide();
						$('#submitSov').hide();
						$('#sovInput span').html('Ваш вопрос отправлен');
					}
				});

			});

			sovClick++;
		};
	});
}
