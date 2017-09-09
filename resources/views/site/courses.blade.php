@extends('site.pageLayout')


@section('header')
    <title>Страница курсов</title>
@stop

@section('js')
    <script src="{{ url('dist/js/isetop.js') }}"></script>
    <script src="{{ url('dist/js/direction.js') }}"></script>
@stop

@section('pageContent')
    @if($defaultId)
        <input type="hidden" id="default-id" value="direc-{{$defaultId}}"/>
    @endif
    <!--   content-->
    <div class="container">

        <div class="content">
            <div class="courses-title">
                <h1>КУРСЫ</h1>
            </div>

            <div class="row categories-list">
                <div class="col-md-2 category-list-active col-sm-4 col-xs-6 category-button" id="all">
                    <div>
                        Все категории
                    </div>
                </div>
                @foreach($directions as $direction)
                    <div class="col-md-2 col-sm-4 col-xs-6 category-button" id="direc-{{$direction->id}}">
                        <div>
                            {{$direction->name}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row grid">

                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 grid-item direc-{{$course->direction_id}}">
                        <div class="course-item">
                            <a href="/course/{{$course->url}}">
                                <div class="course-logo">
                                    <img src="{{ url('/images/' . $course->logo) }}" alt="">
                                </div>
                            </a>
                            <div class="row">
                                <div class="course-stars">
                                    @include('site.components.stars', ['stars' => $course->stars])
                                </div>
                            </div>

                            <div class="row">
                                <a href="/course/{{$course->url}}">
                                    <div class="course-title">
                                        {{$course->name}}
                                    </div>
                                </a>
                            </div>

                            <div class="row">
                                <div class="course-text">
                                    {!!$course->description!!}
                                </div>
                            </div>

                            <div class="row course-buttons">
                                <a href="/course/{{$course->url}}">
                                    <div class="course-more">
                                        Подробнее
                                    </div>
                                </a>
                                <a href="{{ url('add-zayavka/' . $course->id) }}">
                                    <div class="course-buy">
                                        Записаться на курс
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                @endforeach


            </div>
        </div>

    </div>
    <!--    /content-->

@stop