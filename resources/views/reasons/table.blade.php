@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Motivos</b> <a href="{{ route('reasons.show', ['id'=>'null']) }}" class="pull-right text-success">Agregar motivo</a></div>

                <div class="panel-body">
                  <table class='table table-striped TableAdvanced'>
                    <thead>
                      <tr>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th>Dias</th>
                        <th style="text-align:center">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php if( count($motivo) > 0 ): ?>
                        @foreach($motivo AS $mtv)
                          <tr>
                            <td>{{$mtv->id}}</td>
                            <td>{{ html_entity_decode($mtv->desc_motv)}}</td>
                            <td>{{$mtv->dias}}</td>
                            <td style="text-align:center">
                              <a class="btn-group btn-group-xs" role="group" href="{{ route('reasons.show', ['id'=>$mtv->id]) }}">
                                <button type="button" class="btn btn-primary">Editar</button>
                              </a>
                              <a class="btn-group btn-group-xs" role="group"
                                 href="{{ route('reasons.destroy', ['id'=>$mtv->id]) }}"
                                 onclick="event.preventDefault(); document.getElementById('delete-form{{$mtv->id}}').submit();">
                                <button type="button" class="btn btn-danger">Borrar</button>
                                <form id="delete-form{{$mtv->id}}" action="{{ route('reasons.destroy', ['id'=>$mtv->id]) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                              </a>
                            </td>
                          </tr>
                        @endforeach
                      <?php endif ?>
                    </tbody>
                  </table>
                </div>
              {{--   <div class="panel-footer">
                  <a target="_blank" href="{{ route('codes_mov')}}">
                    <button type="button" class="btn btn-primary">Códigos de barras</button>
                  </a>
                </div> --}}
            </div>
        </div>
    </div>
</div><a href="">
@endsection</a>
