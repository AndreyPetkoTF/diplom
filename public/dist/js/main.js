document.addEventListener("DOMContentLoaded",function(){

	// document.getElementById('student').addEventListener('click', function(){
	// 	document.getElementById('auth-block').style.display = 'block';
	// });


	// document.getElementById('auth-close').addEventListener('click', function(){
	// 	console.log(document.getElementById('auth-block'));
	// 	document.getElementById('auth-block').style.display = 'none';
	// });



// --------------nav mobile--------------
var mobMenu = document.getElementById('mobile-menu');
mobMenu.style.height = "0px"
document.getElementById('mobile-button').addEventListener('click', function(){
	// alert(mobMenu.style.height);

	if(mobMenu.style.height == "0px") {
		mobMenu.style.height = "261px"
	}
	else{
		mobMenu.style.height = "0px"
	}
});
// --------------nav mobile--------------

// --------------sub nav mobile--------------
var subMenu = document.getElementById('subMenu');
var subMenuButton = document.getElementById('subMenuButton');
var subMenuA = document.getElementsByClassName('subMenuA');
var ulList = document.getElementsByClassName('ulList');

subMenuButton.addEventListener('mouseover', function(){
	subMenu.style.display = 'block';
});
subMenuButton.addEventListener('mouseout', function(){
	subMenu.style.display = 'none';
});
subMenu.addEventListener('mouseover', function(){
	subMenu.style.display = 'block';
});
subMenu.addEventListener('mouseout', function(){
	subMenu.style.display = 'none';
});

for (i=0; i<subMenuA.length; i++){

	subMenuA[i].addEventListener('mouseover', function(){
		if(this.previousSibling.previousSibling && this.previousSibling.previousSibling.className == 'ulList'){
			var ulListItem = this.previousSibling.previousSibling;
			ulListItem.style.display = 'block';
			ulListItem.addEventListener('mouseover', function(){
				ulListItem.style.display = 'block';
			})


		};
	});
	subMenuA[i].addEventListener('mouseout', function(){
		if(this.previousSibling.previousSibling && this.previousSibling.previousSibling.className == 'ulList'){
			var ulListItem = this.previousSibling.previousSibling;
			ulListItem.style.display = 'none';
			ulListItem.addEventListener('mouseout', function(){
				ulListItem.style.display = 'none';
			})

		}
	});

};







// --------------sub nav mobile--------------



// --------------zayavka menu--------------
var courseListItem = document.getElementsByClassName("course-list-item")
if(courseListItem){
	function clear(){
		var clearList = document.getElementsByClassName("course-list-item2");
		for(i=0; i < clearList.length; i++){
			clearList[i].style.cssText = "height:0px; margin-top:0px; border:none;";
		};
		for(i=0; i < courseListItem.length; i++){
			courseListItem[i].style.cssText = "background-color: #ebebeb;";
		}

	}
	for(i=0; i < courseListItem.length; i++){
		courseListItem[i].addEventListener("click", function(){
			var courseSubmenu = this.nextSibling.nextSibling.childNodes;



			for (var i = courseSubmenu.length - 1; i >= 0; i--) {
				if(courseSubmenu[i].tagName == 'DIV') {
					block = courseSubmenu[i];
					break;
				}
			}


			str = block.style.height;
			height = str.substring(0, str.length - 2);

			clear();

			if(height == '50') {
				return false;
			}

			for(i=0; i < courseSubmenu.length; i++) {
				if (courseSubmenu[i].tagName == 'DIV') {
					courseSubmenu[i].style.cssText = "height:50px; margin-top:5px; border: 2px solid white;";
				}
			}
			this.style.cssText = "background-color: #d7d7d7;";


		})

	}

}
// --------------zayavka menu--------------

// --------------slider courses--------------
var arrows = document.getElementsByClassName("arrows");

if(arrows[0]){


	var arrowLeft = document.getElementById('arrow-slider-left');
	var arrowRigth = document.getElementById('arrow-slider-rigth');
	var divSlider = document.getElementById('slider-inside');

	var items = document.getElementsByClassName('course-item-slider');
	length = items.length;

	// alert(length);

	clicks = 0;

	maxClicks = length - 3;

	arrowLeft.style.cssText = "cursor:default; fill:#a9b3dc";

	if(maxClicks > 0 ) {
		arrowRigth.addEventListener('click', function(){
			if(clicks == maxClicks) {
				return false;
			}

			if(clicks == maxClicks -1) {
				arrowRigth.style.cssText = "cursor:default; fill:#a9b3dc";
			}

			marginNow = divSlider.style.marginLeft;

			margin = 400*(clicks + 1);

			divSlider.style.cssText = "margin-left:-" + margin + "px;";


			arrowLeft.style.cssText = "cursor:pointer; fill:#4D5897";
			clicks++;
		});
		arrowLeft.addEventListener('click', function(){
			if(clicks == 0) {
				return false;
			}

			if(clicks == 1) {
				arrowLeft.style.cssText = "cursor:default; fill:#a9b3dc";
			}

			margin = 400*(clicks - 1);


			divSlider.style.cssText = "  margin-left:-" + margin + "px;";
			
			arrowRigth.style.cssText = "cursor:pointer; fill:#4D5897";
			clicks--;
		});
	} else {
		arrowRigth.style.display = 'none';
		arrowLeft.style.display = 'none';
	}


}
// --------------slider courses--------------
// --------------arrow up start--------------



var arrowUp = document.getElementById("arrow-up");

window.onscroll = function() {

	var pageY = window.pageYOffset || document.documentElement.scrollTop;
	if (pageY > 500) {
		arrowUp.style.display ="block";
		// if(irina !== 'undefined') {
			if (typeof(irina) != 'undefined') {
				irina.style.opacity = "100";
			}
		}
		else{
			arrowUp.style.display ="none";
		};

	}


	arrowUp.addEventListener('click', function(){
		// $('body').scrollTop(0);
		var body = $("html, body");
		body.stop().animate({scrollTop:0}, '500', 'swing');
	})


	// --------------arrow up end--------------
});




windowClose = document.getElementById('close-window');



if(windowClose) {
	windowClose.addEventListener('click', function(){
		document.getElementById('window').style.display = 'none';
	});
}


// --------------slider student--------------
var arrows = document.getElementsByClassName("arrows");

if(arrows[0]){


	var arrowLeftStudent = document.getElementById('arrow-student-left');
	var arrowRigthStudent = document.getElementById('arrow-student-rigth');
	var divSliderStudent = document.getElementById('student-slider-inside');

	var itemsStudent = document.getElementsByClassName('course-item-slider');
	lengthStudent = itemsStudent.length;

	clicksStudent = 0;
	maxClicksStudent = lengthStudent - 3;
	arrowLeftStudent.style.cssText = "cursor:default; fill:#a9b3dc";

	if(maxClicksStudent > 0 ) {
		arrowRigthStudent.addEventListener('click', function(){
			if(clicksStudent == maxClicksStudent) {
				return false;
			}

			if(clicksStudent == maxClicksStudent - 1) {
				arrowRigthStudent.style.cssText = "cursor:default; fill:#a9b3dc";
			}

			marginNow = divSliderStudent.style.marginLeft;

			margin = 235*(clicksStudent + 1);

			divSliderStudent.style.cssText = "margin-left:-" + margin + "px;";


			arrowLeftStudent.style.cssText = "cursor:pointer; fill:#4D5897";
			clicksStudent++;
		});
		arrowLeftStudent.addEventListener('click', function(){
			if(clicksStudent == 0) {
				return false;
			}

			if(clicksStudent == 1) {
				arrowLeftStudent.style.cssText = "cursor:default; fill:#a9b3dc";
			}

			margin = 235*(clicksStudent - 1);


			divSliderStudent.style.cssText = "  margin-left:-" + margin + "px;";
			
			arrowRigthStudent.style.cssText = "cursor:pointer; fill:#4D5897";
			clicksStudent--;
		});
	} else {
		arrowRigthStudent.style.display = 'none';
		arrowLeftStudent.style.display = 'none';
	}


}
// --------------slider student--------------


