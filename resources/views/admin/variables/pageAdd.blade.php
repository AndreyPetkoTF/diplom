	@extends('admin.layout')


	@section('content')

	<section class="content-header">
		<h1>
			Добавление новой страницы
		</h1>
	</section>

	<section class="content">
		<div class="row">

			<div class="col-md-12">

				<div class="box box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Форма добавления страницы</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form method="POST" action="" enctype="multipart/form-data">
							{{csrf_field()}}

							<div class="form-group">
								<label for="description">Заголовок:</label>
								<input name="title" class="form-control" id="name"></input>
							</div>

							<div class="form-group">
								<label for="description">Url:</label>
								<input name="url" id="url" class="form-control"></input>
							</div>


							<div class="form-group">
								<label for="description">Текст:</label>
								<textarea name="text" class="form-control"></textarea>
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