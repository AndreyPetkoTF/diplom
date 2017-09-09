		<div class="news">
			<div class="container">
				<div class="row lead-title"><h2>НОВОСТИ</h2></div>
				<div class="row">
					@foreach($news as $newItem)
					<div class="col-md-3 col-sm-6">
						<a href="/novelty/{{$newItem->url}}">
							<div class="image-news" style="background-image: url(../../news_images/{{$newItem->image}});"></div>
							<div class="title-bg"><div class="title-bg-inside">{{$newItem->name}}</div></div>
						</a>
						<p>
							{{$newItem->description}}
						</p>
						<div class="more-info"><a href="/novelty/{{$newItem->url}}">Узнать больше</a></div>
					</div>
					@endforeach

				</div>
				<div class="row"><a href="/news-list"><div class="button-to-all">Все новости</div></a></div>

			</div>
		</div>