@extends('site.layout')


@section('content')


<div id="main-header-sm">
    <div class="container">
        {{--<div class="row">--}}

            {{--<div class="col-lg-5 col-md-4 main-title">--}}
                {{--<img src="{{ url('site_images/logo-white.png') }}">--}}
                {{--<h1>IT-ШКОЛА</h1>--}}
                {{--<h2>ИРИНЫ БУЗИКОВОЙ</h2>--}}
            {{--</div>--}}
            {{--<div class="col-lg-7 irina-Buzikova-sm col-md-8 hidden-sm hidden-xs">--}}
                {{--<img src="{{ url('site_images/irina-buzikova2.png') }}">--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>

@yield('pageContent')

@stop