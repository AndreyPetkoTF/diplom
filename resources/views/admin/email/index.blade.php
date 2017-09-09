	@extends('admin.layout')


	@section('content')

	<section class="content-header">
		<h1>
			Отправить письмо
		</h1>
	</section>

	<section class="content">
		<div class="row">

			<div class="col-md-12">

				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Форма отправки письма</h3>
					</div>

					<!-- /.box-header -->
					<div class="box-body">

						<form method="POST" action="" enctype="multipart/form-data">
							{{csrf_field()}}
						<!-- 	<div class="form-group">
								<label for="name">Тема</label>
								<input type="text" placeholder="Введите название направление" class="form-control" name="name" id="name" value="{{old('name')}}"/>
							</div> -->



							<div class="form-group">
								<label for="description">Сообщение:</label>
								<textarea name="message"></textarea>
							</div>

							@foreach($emails as $key => $email)
							<div class="email-item">
								<input type="checkbox" name="emails[{{$key}}][on]" checked name="">
								<input name="emails[{{$key}}][email]" type="hidden" value="{{$email->email}}">
								{{$email->email}}
							</div>
							@endforeach

							<div class="clear"></div>
							<div class="mt20"></div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<button type="submit" class="btn btn-block btn-primary btn-flat">Добавить</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</section>

	@stop