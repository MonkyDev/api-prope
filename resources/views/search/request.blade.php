@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <b>{{ $title }}</b>   
        </div>

        <div class="panel-body">
          <table class='table table-striped table-responsive TableAdvanced'>
            <thead>
              <tr>
                <th>Motivo</th>
                <th><i class="glyphicon glyphicon-calendar text-info"></i>Prestamo</th>
                <th>Autoriza</th>
                <th><i class="glyphicon glyphicon-calendar text-info"></i>Entrega</th>
                <th>Autoriza</th>                
                <th>Estatus</th>
                <th class="text-center"><i class="glyphicon glyphicon-folder-open text-info"></i></th>
                <th class="text-center"><i class="glyphicon glyphicon-list-alt text-info"></i></th>
                
              </tr>
            </thead>
            <tbody>
              @if( isset($prestamos) && !is_null($prestamos))
                @foreach( $prestamos AS $prestamo )                
                  <tr>
                    <td> {{ html_entity_decode($prestamo->desc_motv) }} </td>
                    <td> {{ \FormatDate::DateDMA($prestamo->salida,1,'') }} </td>
                    <td> {{ $prestamo->TrabajadorEntrega }} </td>
                    <td> {{ \FormatDate::DateDMA( !empty($prestamo->regresa)?$prestamo->regresa:'0000-00-00',1,'') }} </td>
                    <td> {{ !empty($prestamo->TrabajadorRecibe)?$prestamo->TrabajadorRecibe:'-' }} </td>
                    <td> <b>{{ $prestamo->desc_stats }} </b></td>
                    <td class="text-center">
                      <button id="show-obsv" class="btn btn-default" data-unique="seguimiento" title="ver observaciones">
                        <a href="{{ route('allobsv',['id'=>$prestamo->id_pre]) }}"><i class="glyphicon glyphicon-eye-open"></i></a>
                      </button>
                      
                    </td>
                    <td class="text-center">
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

@if(isset($prestamo))
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
        <tr><td colspan="2"><img src="{{ asset('icons/loading.gif') }}" width="25"/></td></tr>        
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
        <tr><td colspan="4"><img src="{{ asset('icons/loading.gif') }}" width="25"/></td></tr>        
      </tbody>
    </table>
  </section>
      
  @endsection

@endsection
@endif