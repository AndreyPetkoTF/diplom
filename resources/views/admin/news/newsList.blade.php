@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Новости
	</h1>

</section>

<section class="content-header">
	<div class="row">
		<div class="col-md-3">
			<a href="/admin/news/add"><button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Добавить новость</button></a>
		</div>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Список новостей</h3>
				</div>
				<div class="box-body">
					<table  class="table table-bordered table-hover">
						<tr>
							<th>Название</th>
							<th>Удалить</th>
						</tr>
						@foreach($news as $newsItem)
						<tr>
							<td><a href="/admin/news/edit/{{$newsItem->id}}">{{$newsItem->name}}</a></td>
							<td>
								<form action="/admin/news/delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить товар: {{$newsItem->name}} ?')">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="news_id" value="{{$newsItem->id}}">
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
			<?php echo $news->render() ?>
		</div>
	</div>
</section>


@stop