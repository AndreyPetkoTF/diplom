@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Подписчики
	</h1>

</section>

<section class="content-header">
	<form method="POST" action="{{ url('/admin/email/add') }}">
		{{csrf_field()}}
		<div class="row">
			<div class="col-md-3">
				<input type="" class="form-control" placeholder="Email" name="email">
			</div>
			<div class="col-md-3">
			<button type="submit" class="btn btn-block btn-primary btn-flat add-product-button">Добавить подписчика</button>
			</div>
		</div>
	</form>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список курсов</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Email</th>
							<th>Удалить</th>
						</tr>
						@foreach($subs as $sub)
						<tr>
							<td>{{$sub->email}}</td>
							<td>
								<form action="/admin/email/delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить email: {{$sub->email}} ?')">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="sub_id" value="{{$sub->id}}">
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
</section>


@stop