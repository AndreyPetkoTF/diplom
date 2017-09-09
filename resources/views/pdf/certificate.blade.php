<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta charset="UTF-8">
	<title>Document</title>
	<title> Сертификат</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,500&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
</head>
<body>
	<style type="text/css">
		html{
			font-family: Roboto;
			/*-webkit-transform: scale(0.5,0.5); /* Для Safari, Chrome, iOS */*/
			/*margin-left: -50%;*/
			/*margin-top: -50%;*/
		}
		#outside{
			
			width: 2480px;
			padding-bottom: 100px;
			overflow: auto;

		}
		#inside{
			
			width: 100%;
			text-align: center;


		}
		h2{
			font-size: 150px;
			color: #436D52;
			font-weight: normal;
			text-transform: uppercase;
			line-height: 100px;

		}
		#name{

		}
		p{
			color: #444873;
			font-size: 90px;
			margin-top: 150px;
			text-align: left;
			width: 40%;
			float: left;
			margin-left: 250px;
		}
		#uspeh{
			font-size: 60px;
			margin-left: 250px;
			text-align: left;
			margin-top: 200px;
		}
		#date{
			font-size: 50px;
			margin-top: 150px;
			text-align: left;
			margin-left: 250px;
			float: left;
		}
		#left{
			float: left;
			margin-top: -11px;
		}
		#sov{
			float: left;
			margin-top: 50px;	
		}
		#podpis{
			float: left;
			/*margin-top: 150px;*/
		}
		#right{
			float: left;
			margin-top: -11px;
		}
		#center{
			float: left;
			width: 1954px;
		}

	</style>
	<div id="outside">
		<img src="{{ url('/site_images/sertificat-top.jpg')}}">
		<div id="inside">
			<div id="left"><img src="{{ url('/site_images/sertificat-left.jpg')}}"></div>
			<div id="center">
				<div id="name">
					<h2>Иванов</h2>
					<h2>Иван</h2>
				</div>
				<div id="uspeh">успешно прошел курс по программе</div>
				<p>Microsoft Word - 
					текстовый редактор</p>
					<div id="sov"><img src="{{ url('/site_images/sertificat-sova.jpg')}}"></div>
					<div id="date">10.11.2016</div>
					<div id="podpis"><img src="{{ url('/site_images/sertificat-podpis.jpg')}}"></div>
				</div>
				<div id="right"><img src="{{ url('/site_images/sertificat-right.jpg')}}"></div>
			</div>
		</div>

	</body>
	</html>