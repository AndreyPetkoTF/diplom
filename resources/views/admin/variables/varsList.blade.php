@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Переменные
	</h1>

</section>



<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список переменных</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Название</th>
						</tr>
						@foreach($vars as $varItem)
						<tr>
							<td><a href="/admin/variables/edit/{{$varItem->key}}">{{$varItem->key}}</a></td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-3">
			<a href="/admin/variables/page-add"><button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Добавить страницу</button></a>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список страниц</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Название</th>
							<th>Удалить</th>
						</tr>
						@foreach($pages as $page)
						<tr>
							<td><a href="/admin/variables/page-edit/{{$page->id}}">{{$page->title}}</a></td>
							<td class="small-delete">
								<form action="/admin/variables/page-delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить страницу: {{$page->title}} ?')">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="page_id" value="{{$page->id}}">
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