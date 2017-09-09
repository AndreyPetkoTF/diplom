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

              <!-- /.box-tools
            </div> -->
            <!-- /.box-header -->
            <div class="box-body no-padding">

              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                <thead>
                  <th>Имя</th>
                  <th>Email</th>
                  <th>Дата</th>
                </thead>
                  <tbody>
                  <tr>
                  @foreach($bids as $bid)
                    <!-- <td><input type="checkbox"></td> -->
                    <!-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td> -->
                    <td class="mailbox-name">{{$bid->name}}</td>
                    <td class="mailbox-subject">{{$bid->email}}
                    </td>
                    <!-- <td class="mailbox-attachment"></td> -->
                    <td class="mailbox-date">{{$bid->created_at->format('h:i:s - d/m')}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->

<?php echo $bids->render(); ?>

          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@stop