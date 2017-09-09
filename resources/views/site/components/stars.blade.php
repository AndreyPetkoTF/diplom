@if($stars >= 1)
<img src="{{ url('site_images/stars.png') }}">
@else
<img src="{{ url('site_images/star-empty.png') }}">
@endif

@if($stars >= 2)
<img src="{{ url('site_images/stars.png') }}">
@else
<img src="{{ url('site_images/star-empty.png') }}">
@endif

@if($stars >= 3)
<img src="{{ url('site_images/stars.png') }}">
@else
<img src="{{ url('site_images/star-empty.png') }}">
@endif

@if($stars >= 4)
<img src="{{ url('site_images/stars.png') }}">
@else
<img src="{{ url('site_images/star-empty.png') }}">
@endif

@if($stars >= 5)
<img src="{{ url('site_images/stars.png') }}">
@else
<img src="{{ url('site_images/star-empty.png') }}">
@endif