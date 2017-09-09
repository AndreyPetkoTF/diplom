	@extends('admin.layout')


	@section('content')

	<section class="content-header">
		<h1>
			Добавить урок
		</h1>
	</section>

	<section class="content">
		<div class="row">

			<div class="col-md-12">

				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Форма добавления урока</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form method="POST" action="" enctype="multipart/form-data">
							{{csrf_field()}}
							<input type="hidden" name="course_id" value="{{$lesson->course_id}}"></input>

							<div class="form-group">
								<label for="name">Название</label>
								<input type="text" placeholder="Введите название урока" class="form-control" name="name" id="name" value="{{ $lesson->name}}"/>
							</div>
							<div class="form-group">
								<label for="video_link">Ссылка на видео:</label>
								<input type="text" placeholder="Введите ссылку на видеоурок" class="form-control" name="video_link" id="video_link"  value="{{$lesson->video_link}}"/>
							</div>

							<div class="form-group">
								<label for="text">Текст урока:</label>
								<textarea name="text" id="text" class="form-control"  rows="10">{{$lesson->text}}</textarea>
							</div>

							<div class="form-group">
								<label for="text">Текст домашнего задания:</label>
								<textarea name="home_text" id="text" class="form-control" rows="10">{{$lesson->home_text}}</textarea>
							</div>

							<div class="form-group">
								<label for="text">Дополнительная информация:</label>
								<textarea name="more_info" class="form-control" rows="10">{{$lesson->more_info}}</textarea>
							</div>

							<div class="form-group">
								<label for="video_link">Номер урока:</label>
								<input type="text" placeholder="Введите номер урока" class="form-control" name="position"  value="{{$lesson->position}}"/>
							</div>


							<div class="form-group">
								<div class="row">
									<div class="col-md-3">
										<button type="submit" class="btn btn-block btn-primary btn-flat">Создать</button>
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