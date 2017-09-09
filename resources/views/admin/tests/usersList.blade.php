@extends('admin.layout')


@section('content')

<section class="content-header">
	<h1>
		Тесты пользователей
	</h1>

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
							<th>Тест</th>
							<th>Пользователь</th>
							<th>Результат</th>
						</tr>
						@foreach($userTests as $userTest)
						<tr>
							<td>{{$userTest->testName}}</td>
							<td>{{$userTest->userName}}</td>
							<td>{{$userTest->mark}}/{{$userTest->current_position - 1}}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<?php echo $userTests->render() ?>
		</div>
	</div>
</section>


@stop