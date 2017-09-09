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

          <!-- <div class="box-tools pull-right">
            <div class="has-order">
              <input type="text" class="form-control input-sm" placeholder="Search Mail">
              <span class="glyphicon glyphicon-search form-control-order"></span>
            </div>
          </div> -->
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">

          <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <thead>
                <th>Имя</th>
                <th>skype</th>
                <th>Обшая стоимость</th>
                <th>Дата</th>
                <th>Статус</th>
                <th>Подробнее</th>
                <th>Удалить</th>
              </thead>
              <tbody>
                @foreach($orders as $order)
                <tr>
                  <td class="mailbox-name">{{$order->name}}</td>
                  <td class="mailbox-subject">{{$order->skype}}</td>
                  <td class="mailbox-subject">{{$order->totalprice}}р</td>
                  <td class="mailbox-date">{{$order->created_at->format('H:i:s - d/m')}}</td>
                  <td>
                    @if($order->paid == 0)
                    <a href="/admin/feedback/set-order-paid/{{$order->id}}"><button type="button" class="btn btn-block btn-success btn-flat">Активировать</button></a>
                    @else 
                    Активирована
                    @endif
                  </td>
                  <td>
                  <a href="/admin/feedback/single-order/{{$order->id}}">
                      Подробнее
                    </a>
                  </td>
                  <td>
                    <form action="/admin/feedback/order-delete" method="POST" onsubmit="return confirm('Вы точно хотите удалить товар: {{$order->name}} ?')">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="order_id" value="{{$order->id}}">
                      <button type="submit" class="btn btn-block btn-danger btn-flat">Удалить</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <!-- /.box-body -->



        <ul class="pagination">



          @for ($i = 1; $i <= $count; $i++)
          @if($i == $page)
          <li class="active">
            <span>
              {{$i}}
            </span>
          </li>
          @else
          <li>
            <a href="/admin/feedback?page={{$i}}">
              {{$i}}
            </a>
          </li>
          @endif
          @endfor



        </ul>



      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@stop