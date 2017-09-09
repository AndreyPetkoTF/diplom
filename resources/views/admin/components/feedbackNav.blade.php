          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Разделы</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li @if(Request::path() == "admin/feedback") class="active" @endif><a href="/admin/feedback"><i class="fa fa-envelope-o"></i> Заявки на получение курса</a></li>
                <li @if(Request::path() == "admin/feedback/lesson") class="active" @endif><a href="/admin/feedback/lesson"><i class="fa fa-inbox"></i> Заявки на урок </a></li>
                <li @if(Request::path() == "admin/feedback/reviews") class="active" @endif ><a href="/admin/feedback/reviews"><i class="fa fa-file-text-o"></i> Отзывы о курсах</a></li>
                <li @if(Request::path() == "admin/feedback/feedback") class="active" @endif><a href="/admin/feedback/feedback"><i class="fa fa-filter"></i> Обратная связь <!-- <span class="label label-warning pull-right">65</span> --></a>
                  <!-- </li> -->
                  <!-- <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li> -->
                </ul>
              </div>
              <!-- /.box-body -->
            </div>
          <!-- /. box -->