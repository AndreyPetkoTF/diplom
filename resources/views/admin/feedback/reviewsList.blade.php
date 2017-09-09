@extends('admin.layout')



@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Обратная связь
    <!-- <small>13 new messages</small> -->
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <!-- <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Compose</a> -->

      @include('admin.components.feedbackNav')

    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Заявки на урок</h3>

          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">

          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <thead>
                <th>Имя пользователя</th>
                <th>Курс</th>
                <th>Количество звезд</th>
                <th>Дата</th>
                <th>Текст</th>
                <th>Удалить</th>
              </thead>
              <tbody>
                <tr>
                  @foreach($reviews as $review)
                  <td class="mailbox-name"><a href="/admin/feedback/review-edit/{{$review->id}}">{{$review->userName}}</a></td>
                  <td class="mailbox-name"><a href="/course/{{$review->url}}">{!!$review->courseName!!}</a></td>
                  <td class="mailbox-name">{{$review->stars}}</td>
                  <td class="mailbox-date">{{$review->created_at->format('h:i:s - d/m')}}</td>
                  <td class="mailbox-name">{!!$review->review!!}</td>
                  <td><a href="/admin/feedback/review-delete/{{$review->id}}">Удалить</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->


        <?php echo $reviews->render(); ?>

      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@stop