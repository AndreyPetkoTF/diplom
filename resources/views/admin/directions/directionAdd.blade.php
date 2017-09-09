	@extends('admin.layout')


	@section('content')

	<section class="content-header">
		<h1>
			Добавить направление
		</h1>
	</section>

	<section class="content">
		<div class="row">

			<div class="col-md-12">

				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Форма добавления направления</h3>
					</div>

					<!-- /.box-header -->
					<div class="box-body">
						@if(count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach($errors->all() as $error)
								<li>{{$error}}</li>
								@endforeach
							</ul>
						</div>
						@endif
						<form method="POST" action="" enctype="multipart/form-data">
							{{csrf_field()}}
							<div class="form-group">
								<label for="name">Название</label>
								<input type="text" placeholder="Введите название направление" class="form-control" name="name" id="name" value="{{old('name')}}"/>
							</div>

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