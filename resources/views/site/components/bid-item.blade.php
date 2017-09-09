				<div class="col-md-4">
					<div class="bid-course-item">
						<div class="bid-course-logo">
							<img src="{{ url('/images/' . $course->logo) }}" alt="">
						</div>
					</div>
					<div class="bid-course-name">
						{{$course->name}}
					</div>
					<div class="bid-course-delete">
						<div class="bid-price-button">
							{{--{{$course->price}}р--}}
						</div>
						<div class="bid-delete-button" data-courseid="{{$course->id}}">
							Удалить
						</div>
					</div>
				</div>