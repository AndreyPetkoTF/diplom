	@extends('admin.layout')


	@section('content')

	<section class="content-header">
		<h1>
			Обновить новость
		</h1>
	</section>

	<section class="content">
		<div class="row">

			<div class="col-md-12">

				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Форма редактирования новости</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form method="POST" action="" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="form-group">
								<label for="name">Название</label>
								<input type="text" placeholder="Введите название курса" class="form-control" name="name" id="name" value="{{ $newItem->name }}"/>
							</div>

							<div class="form-group">
								<label for="url">url</label>
								<input type="text"  class="form-control" name="url" id="url" value="{{ $newItem->url}}"/>
							</div>


							<div class="form-group">
								<label for="price">Короткое описание:</label>
								<input type="text" placeholder="Введите короткое описание новости" class="form-control" name="description" id="description" value="{{ $newItem->description }}"/>
							</div>

							<div class="form-group">
								<label for="description">Текст:</label>
								<textarea name="text" id="text" class="form-control" rows="10">{{$newItem->text}}</textarea>
							</div>

							<div class="form-group">
								<label>Изображение</label>
								<input type="file" name="image"></input>
							</div>

							@if($newItem->image)
							<div class="form-group">
								<div class="form-img">
									<img src="{{ url('news_images/' . $newItem->image) }}">
								</div>
							</div>
							@endif

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