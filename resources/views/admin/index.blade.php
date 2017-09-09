@extends('admin.layout')


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Главная
    <small>тут будет общая информация</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Admin</a></li>
    <li class="active">Главная</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row mt">
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$ordersCount}}</h3>

          <p>Не рассмотренные</p>
        </div>
        <div class="icon">
          <i class="fa fa-shopping-cart"></i>
        </div>
        <a href="/admin/feedback" class="small-box-footer">
          Подробнее <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$newMessages}}</h3>

          <p>Новые ответы на домашние задания</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="/admin/homework" class="small-box-footer">
          Подробнее <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$usersCount}}</h3>

          <p>Пользователи</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="/admin/users" class="small-box-footer">
          Подробнее <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

  </div>
</div>

<!-- Your Page Content Here -->

</section>
<!-- /.content -->

@stop