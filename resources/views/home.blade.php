@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Contratos Activos</p>
              <h3 class="card-title">{{count($contratos)}}
                @if (count($contratos) >= 2)
                    <small>Contratos</small>
                    @else
                        <small>Contrato</small>
                @endif
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-success">library_books</i>
                <a href="{{route('contratos.index')}}">Ver Contratos</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Revenue</p>
              <h3 class="card-title">$34,245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Fixed Issues</p>
              <h3 class="card-title">75</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from Github
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-twitter"></i>
              </div>
              <p class="card-category">Followers</p>
              <h3 class="card-title">+245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Alerta Baja</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
            @foreach ($multas as $multa)
              <?php
                  $fecha = new DateTime ($multa->fecha_notificacion);
                  $fechahoy = new DateTime(date('Y-m-d'));
                  $diferencia = $fecha->diff($fechahoy);
              ?>
              @if ($diferencia->y == 0 && $diferencia->m == 0 && $diferencia->d <="15" || $diferencia->d >="11")
                <div class="stats">
                    <i class="material-icons text-success">visibility</i>
                    <a href="{{route('contratos.multas.index', [$multa->contrato->id,'diferencia'=>$diferencia->d])}}">Ver multa</a>
                </div>
              @endif
            @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Alerta Mediana</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Alerta Máxima</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Contratos:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#profile" data-toggle="tab">
                        <i class="material-icons">library_books</i> Vigentes 
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                        <i class="material-icons">library_books</i> Termino Anticipado
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#settings" data-toggle="tab">
                        <i class="material-icons">library_books</i> Cerrado
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table">
                  <thead class="text-danger">
                  <th>ID Contrato</th>
                  <th>Convenio</th>
                  <th>Proveedor</th>
                  <th>Referente</th>
                  <th>Acciones</th>
                </thead>
                    <tbody>
                      @foreach ($contratos as $pendientes)
                        @if ($pendientes->estado_contrato == 1)
                          <td>{{$pendientes->id_contrato}}</td>
                          <td>{{$pendientes->convenio->convenio}}</td>
                          <td>{{$pendientes->convenio->proveedor->nombre_proveedor}}</td>
                          <td>{{$pendientes->convenio->user->name}}</td>
                          <td class="td-actions text-right">
                            <a href="{{ route('contratos.show', $pendientes->id) }}" class="btn btn-info"><i class="material-icons">library_books</i></a>
                          </td>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="messages">
                  <table class="table">
                    <tbody>
                    <table class="table">
                  <thead class="text-danger">
                  <th>ID Contrato</th>
                  <th>Convenio</th>
                  <th>Proveedor</th>
                  <th>Referente</th>
                  <th>Acciones</th>
                </thead>
                    <tbody>
                      @foreach ($contratos as $pendientes)
                        @if ($pendientes->estado_contrato == 3)
                          <td>{{$pendientes->id_contrato}}</td>
                          <td>{{$pendientes->convenio->convenio}}</td>
                          <td>{{$pendientes->convenio->proveedor->nombre_proveedor}}</td>
                          <td>{{$pendientes->convenio->user->name}}</td>
                          <td class="td-actions text-right">
                            <a href="{{ route('contratos.show', $pendientes->id) }}" class="btn btn-info"><i class="material-icons">library_books</i></a>
                          </td>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="settings">
                  <table class="table">
                    <tbody>
                    <table class="table">
                  <thead class="text-danger">
                  <th>ID Contrato</th>
                  <th>Convenio</th>
                  <th>Proveedor</th>
                  <th>Referente</th>
                  <th>Acciones</th>
                </thead>
                    <tbody>
                      @foreach ($contratos as $pendientes)
                        @if ($pendientes->estado_contrato == 5)
                          <td>{{$pendientes->id_contrato}}</td>
                          <td>{{$pendientes->convenio->convenio}}</td>
                          <td>{{$pendientes->convenio->proveedor->nombre_proveedor}}</td>
                          <td>{{$pendientes->convenio->user->name}}</td>
                          <td class="td-actions text-right">
                            <a href="{{ route('contratos.show', $pendientes->id) }}" class="btn btn-info"><i class="material-icons">library_books</i></a>
                          </td>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-header card-header-danger">
              <h4 class="card-title">Multas Pendientes</h4>
              <p class="card-category">Multas pendientes de los contratos hasta la fecha</p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-danger">
                  <th>ID Contrato</th>
                  <th>N° Memorándum Informe</th>
                  <th>Fecha Notificación</th>
                  <th>Plazo Días</th>
                  <th>Plazo</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                @if (count($multas)<=0)
                <div class="alert alert-danger" style="text-align:center" role="alert">
                    <h4>No se han encontrato multas</h4>
                </div>
                @endif
                @foreach ( $multas as $multas )
                    <tr>
                      <td>{{$multas->contrato->id_contrato}}</td>
                      <td>{{$multas->nmr_memo_informe}}</td>
                      <td>{{$multas->fecha_notificacion}}</td>
                      <td>{{$multas->plazo_dias_notificacion}}</td>
                      <?php
                        $fecha = new DateTime ($multas->fecha_notificacion);
                        $fechahoy = new DateTime(date('Y-m-d'));
                        $diferencia = $fecha->diff($fechahoy);
                      ?>
                      @if ($diferencia->y == 0 && $diferencia->m == 0 && $diferencia->d <= 15)
                        <td>Quedan {{$diferencia->d}} días</td>
                        @endif

                        <td></td>
                      <td class="td-actions text-right">
                        <a href="{{ route('contratos.show', $multas->contrato->id) }}" class="btn btn-info"><i class="material-icons">library_books</i></a>
                        <a href="{{ route('contratos.multas.show', [$multas->contrato->id,$multas]) }}" class="btn btn-danger"><i class="material-icons">visibility</i></a>
                      </td>
                  </tr>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection



