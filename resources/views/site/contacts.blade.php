@extends('site.pageLayout')


@section('header')
    <title>Контакты</title>
@stop

@section('pageContent')

<div class="courses-title"><h1>КОНТАКТЫ</h1></div>


<div class="container">

	<div class="row">
		<div class="col-md-4">

			<div class="contacts-form">
				<h4>Обратная связь</h4>
				<form method="POST" action="add-feedback">
					{{csrf_field()}}
					<div class="contacts-form-input mt10">
						<input type="text" name="name" placeholder="Имя">
					</div>
					<div class="contacts-form-input mt10">
						<input type="text" name="email" placeholder="Email">
					</div>
					<div class="contacts-form-input mt10">
						<textarea placeholder="Сообщение" name="text"></textarea>
					</div>

					<div class="row">
						<div class="contacts-form-submit bit-form-submit col-md-6 col-md-offset-6">
							<input type="submit" value="Отправить">
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-7 col-md-offset-1">

			<div class="row contacts-info">
				<div class="col-md-2 col-xs-12">
					<img src="{{ url('/site_images/icon-mail.png') }}" alt="">
				</div>
				<div class="col-md-3 col-xs-12 contacts-text">
					<div>
						dbuzikova@gmail.com
					</div>
				</div>

				<div class="col-md-2 col-md-offset-1  col-xs-12">
					<img src="{{ url('/site_images/icon-skype.png') }}" alt="">
				</div>
				<div class="col-md-3 col-xs-12 contacts-text">
					<div>
						idbuzikova
					</div>
				</div>
			</div>

			<div class="row contacts-page-text mt20">
				<div class="contacts-logo col-md-4">
					<img src="{{ url('/site_images/logo-copy.png') }}" alt="">
				</div>
				<div class="contacts-text-block col-md-8">
					{!!$contactsText!!}
				</div>
			</div>
		</div>
	</div>
</div>


@stop