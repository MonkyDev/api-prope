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
                      <a href="{{ route('allobsv',['id'=>$prestamo->id_pre]) }}" data-toggle="modal" data-target="#add-obsv" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus text-primary" title="agregar una observación"></i>
                      </a>
                      @include('modals.add_observacion')
                      <button data-toggle="modal" data-target="#modal-show-obsv" id="show-obsv" class="btn btn-default" title="ver observaciones">
                        <a href="{{ route('allobsv',['id'=>$prestamo->id_pre]) }}"><i class="glyphicon glyphicon-eye-open"></i></a>
                      </button>
                      @include('modals.show_observacion')
                    </td>
                    <td class="text-center">
                      <button id="end-seg" class="btn btn-default" title="finalizar seguimiento">
                        <a href="{{ route('finishpre',['id'=>$prestamo->id_pre]) }}"><i class="glyphicon glyphicon-floppy-saved" ></i></a>
                      </button>
                      <button id="show-doc" class="btn btn-default" data-unique="seguimiento" title="ver documentos prestados">
                        <a href="{{ route('alldopre',['id'=>$prestamo->id_pre]) }}"><i class="glyphicon glyphicon-info-sign" ></i></a>
                      </button>
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

{{-- @if(isset($prestamo))
@section('modals')

  @section('modal-cont-title')
    <h4 class="add-obsv" style="display:none;">Agregar nueva observación</h4>
    <h4 class="show-obsv" style="display:none;">Observaciones del prestamo</h4>
    <h4 class="show-doc" style="display:none;">Documentos prestados</h4>
  @endsection
  @section('modal-cont-body')

  <section class="add-obsv" style="display:none;">
    {!! Form::open(['route'=>['observation','id'=>$prestamo->id_pre], 'method' => 'POST', 'id' => 'form_observaciones' ]) !!}
      <div class="form-group">
        {!! Form::label('desc_obsv', 'Observación del prestamo') !!}
        {!! Form::textarea('desc_obsv', null, ['id' => 'desc_obsv', 'class' => 'form-control', 'required', 'style' => 'resize: none', 'maxlength'=>255]) !!}
      </div>
      <div class="form-group text-left">
        {!! Form::submit('Guardar',['id' => 'save', 'class' => 'btn btn-success']); !!}
      </div>
    {!! Form::close() !!}
  </section>

  <section id="part" class="show-obsv" style="display:none;">
    <table class='table table-striped table-responsive'>
      <thead>
        <tr>
          <th>#</th>
          <th>Descripción</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="2"><img src="icons/loading.gif" width="25"/></td></tr>
      </tbody>
    </table>
  </section>

  <section class="show-doc" style="display:none;">
    <table class='table table-striped table-responsive'>
      <thead>
        <tr>
          <th>#</th>
          <th>Descripción</th>
          <th>Tipo</th>
          <th>Anotaciones</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="4"><img src="icons/loading.gif" width="25"/></td></tr>
      </tbody>
    </table>
  </section>

  @endsection

@endsection
@endif --}}

