@extends('admin.layout')


@section('js')
<script src="{{ url('dist/js/smiles-admin.js')}} "></script>
@stop

@section('content')

<section class="content-header">
	<h1>
		Файлы по домашнему заданию к уроку
	</h1>
</section>



<section class="content">
	<form method="post" action="/admin/homework/set-mark">
		{{csrf_field()}}
		<input type="hidden" name="userLessonId" value="{{$userLessonsId}}"></input>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<select name="mark" class="form-control">
						<option value="0">Выберите оценку</option>
						<option value="1" @if($mark == 1) selected @endif>1</option>
						<option value="2" @if($mark == 2) selected @endif>2</option>
						<option value="3" @if($mark == 3) selected @endif>3</option>
						<option value="4" @if($mark == 4) selected @endif>4</option>
						<option value="5" @if($mark == 5) selected @endif>5</option>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-block btn-primary btn-flat add-product-button">Сохранить</button>
			</div>
		</form>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список ответов</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Скачать файл</th>
							<th>Комментарий</th>
							<th>Удалить</th>
						</tr>
						@foreach($homeworks as $homework)
						<tr>
							<td><a href="/admin/homework/download/{{$homework->id}}">Скачать файл</a></td>
							<td>@if(!$homework->comment)Без комментариев@else{{$homework->comment}}@endif</td>
							<td>
								<form action="/admin/homework/homework-delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить файл: {{$homework->comment}} ?')">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="homework_id" value="{{$homework->id}}">
									<button type="submit" class="btn btn-block btn-danger btn-flat">Удалить</button>
								</form>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Добавить ответ</h3>
				</div>
				<form method="POST" action="/admin/homework/message-add">
					{{csrf_field()}}
					<input type="hidden" name="userLessonId" value="{{$userLessonsId}}"></input>
					<div class="form-group">
						<label for="name"></label>
						<textarea name="message" id="discussionText" class="form-control" rows="10"></textarea>
					</div>
					<div class="row smiles">
						<div class="row">
						<div class="col-md-8 col-md-offset-2">
								<div class="row">
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s1.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s2.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s3.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s4.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s5.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s6.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s7.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s8.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s9.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s10.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s11.png') }}"></div>
									<div class="col-md-2 smile-item"><img src="{{ url('/smiles/s12.png') }}"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Отправить</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Переписка по данному уроку</h3>
				</div>
				<div class="row">
					<div class="col-lg-12">
						@foreach($messages as $message)
						<div class="post clearfix">
							<div class="user-block">
								<span class="username">
									<a href="#">{{$message->name}}</a>
								</span>
								<span class="description">{{$message->created_at}}</span>
							</div>
							<p>
								{!!$message->message!!}
							</p>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<?php echo $messages->render(); ?>
		</div>
	</div>
</section>


@stop