@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <b>{{ $title }}</b>
        </div>

        <div class="panel-body table-responsive">
          <table class='table table-striped table-hover TableAdvanced'>
            <thead>
              <tr>
                <th>Persona</th>
                <th>clave</th>
                <th>Motivo</th>
                <th>Prestamo</th>
                <th>Entrega</th>
                <th class="text-center">Transcurrido (dias)</th>
                <th>Autoriza</th>
                <th>Estatus</th>
                <th class="text-center">Observaciones</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @if(!is_null($prestamos))
                @foreach( $prestamos AS $prestamo )
                  <?php $dias_transcu = \FormatDate::DiffDiasBetweenTwoDates($prestamo->salida,'');
                    if ($dias_transcu <= $prestamo->dias_permitidos)
                      $color = '<font color=green>';
                    else
                      $color = '<font color=red>';

                    $date_back =  \FormatDate::AlterFecha($prestamo->salida, $prestamo->dias_permitidos, '');
                  ?>
                  <tr>
                    <td> {{ $prestamo->tipo_dni }} </td>
                    <td> {{ $prestamo->dni }} </td>
                    <td> {{ html_entity_decode($prestamo->desc_motv) }} </td>
                    <td> {{ \FormatDate::DateDMA($prestamo->salida,1,'') }} </td>
                    <td> {{ \FormatDate::DateDMA($date_back,'','') }} </td>
                    <td class="text-center"><?=$color;?><b>{{ $dias_transcu }}</b></font></td>
                    <td> {{ $prestamo->nombres }} </td>
                    <td> <?=$color;?><b>{{ $prestamo->desc_stats }}</b></font></td>
                    <td class="text-center">
                      <a href="{{ $prestamo->id_pre }}" id="btn-add-obsv" class="btn btn-default" title="agregar observación">
                        <i class="glyphicon glyphicon-plus text-primary"></i>
                      </a>
                      @include('modals.add_observacion', ['id_modal' => $prestamo->id_pre])
                      <button id="show-obsv" class="btn btn-default seguimiento" title="ver observaciones">
                        <a href="{{ route('allobsv',['id'=>$prestamo->id_pre]) }}"><i class="glyphicon glyphicon-eye-open"></i></a>
                      </button>
                      @include('modals.show_observacion')
                    </td>
                    <td class="text-center">
                      <a href="{{ $prestamo->id_pre }}" id="end-seg" class="btn btn-default" title="finalizar seguimiento">
                        <i class="glyphicon glyphicon-floppy-saved text-primary"></i>
                      </a>
                      <button id="show-doc" class="btn btn-default seguimiento" title="ver documentos prestados">
                        <a href="{{ route('alldopre',['id'=>$prestamo->id_pre]) }}"><i class="glyphicon glyphicon-info-sign" ></i></a>
                      </button>
                      @include('modals.show_documentos')
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

@endsection