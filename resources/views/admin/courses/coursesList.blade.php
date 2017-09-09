@extends('admin.layout')


@section('content')

    <section class="content-header">
        <h1>
            Курсы
        </h1>

    </section>

    <section class="content-header">
        <div class="row">
            <div class="col-md-3">
                <a href="/admin/course/add">
                    <button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Добавить курс
                    </button>
                </a>
            </div>
            <div class="col-md-3">
                <a href="/admin/course/directions">
                    <button type="button" class="btn btn-block btn-primary btn-flat add-product-button">Список
                        направлений
                    </button>
                </a>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Список курсов</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>Название</th>
                                <th>Количество уроков</th>
                                <th>Направление</th>
                                <th>Уроки</th>
                                <th>Удалить</th>
                            </tr>
                            @foreach($courses as $course)
                                <tr>
                                    <td><a href="/admin/course/edit/{{$course->id}}">{{$course->name}}</a></td>
                                    <td>{{$course->lessonsCount}}</td>
                                    <td>@if($course->directionName){{$course->directionName}}@elseНаправление не
                                        указано@endif</td>
                                    <td>
                                        <a href="/admin/course/lessons/{{$course->id}}">
                                            <button type="button"
                                                    class="btn btn-block btn-primary btn-flat add-product-button">Уроки
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="/admin/course/delete" method="POST"
                                              onsubmit="return confirm('Вы точно хотите удалить товар: {{$course->name}} ?')">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="course_id" value="{{$course->id}}">
                                            <button type="submit" class="btn btn-block btn-danger btn-flat">Удалить
                                            </button>
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