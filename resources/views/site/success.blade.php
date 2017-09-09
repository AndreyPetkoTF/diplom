@extends('site.layout')


@section('content')


<div class="courses-title">
	<h1>СПАСИБО</h1>
</div>
<div class="container">
	<div class="success">
		<div class="row">
			<div class="course-title">
				Ваша заявка отправлена успешно
			</div>
		</div>



		<div class="row">

			<div class="pay">
				<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
					<input type="hidden" name="ik_co_id" value="575d6ef53c1eaf0e0e8b4567" />
					<input type="hidden" name="ik_pm_no" value="{{$order->id}}" />
					<input type="hidden" name="ik_am" value="{{$order->totalprice}}.00" />
					<input type="hidden" name="ik_cur" value="RUB" />
					<input type="hidden" name="ik_desc" value="Оплата онлайн курсов" />
					<input type="submit" value="Оплатить">
				</form>
			</div>

		</div>
	</div>
</div>

@include('site.components.newsBlock', ['news' => $news])

@stop