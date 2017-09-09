<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="top">
		<img src="{{ url('/site_images/sertificat-top.jpg')}}">
	</div>

	<div class="next-block">
		<div id="left"><img src="{{ url('/site_images/sertificat-left.jpg')}}"></div>
		<div id="center">
			<div id="name" style="font-family:Arial">
				Иванов <br> Иван
			</div>
			<div id="pass" style="font-family:Arial">
				успешно прошел курс про программе: 
			</div>

			<div class="row-name-sov">
				<div class="course-name" style="font-family:Arial">
					Microsoft Excel - редактор электронных таблиц
				</div>
				<div class="sov">
					<img src="{{ url('/site_images/sertificat-sova.jpg') }}">
				</div>
			</div>


			<div class="signature">
				<img src="{{ url('/site_images/sertificat-podpis.jpg')}}">
			</div>
			<div id="date" style="font-family:Arial">
			11.22.1963
			</div>
		</div>
		<div id="right"><img src="{{ url('/site_images/sertificat-right.jpg')}}"></div>
	</div>
</body>
</html>