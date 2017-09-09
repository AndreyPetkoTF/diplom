	@extends('admin.layout')


	@section('content')

	<section class="content-header">
		<h1>
			Добавить курс
		</h1>
	</section>

	<section class="content">
		<div class="row">

			<div class="col-md-12">

				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Форма добавления курса</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form method="POST" action="" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="form-group">
								<label for="name">Название</label>
								<input type="text" placeholder="Введите название курса" class="form-control" name="name" id="name" value="{{old('name')}}"/>
							</div>

							<div class="form-group">
								<label for="name">Url</label>
								<input type="text" placeholder="Введите url курса" class="form-control" name="url" id="url" value="{{old('url')}}"/>
							</div>

							<div class="form-group">
								<label>Выберите направление</label>
								<select name="direction_id" class="form-control">
									@foreach($directions as $direction)
									<option value="{{$direction->id}}">{{$direction->name}}</option>
									@endforeach
								</select>
							</div>


							<div class="form-group">
								<label for="price">Цена:</label>
								<input type="text" placeholder="Введите цену курса" class="form-control" name="price" id="price" value="{{old('price')}}"/>
							</div>

							<div class="form-group">
								<label for="description">Короткое описание курса:</label>
								<textarea name="description" id="description" class="form-control" rows="10"></textarea>
							</div>

							<div class="form-group">
								<label for="description">Полное описание курса:</label>
								<textarea name="fullDescription" class="form-control" rows="10"></textarea>
							</div>


							<div class="form-group">
								<label for="description">Программа курса:</label>
								<textarea name="program" class="form-control" rows="10"></textarea>
							</div>

							<div class="form-group">
								<label>Изображение</label>
								<input type="file" name="logo"></input>
							</div>


							<div class="form-group">
								<label>Отображать в списке "Топ курсов"</label>
								<input type="checkbox"  name="premium" ></input>
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