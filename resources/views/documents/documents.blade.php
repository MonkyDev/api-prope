@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Documentos</b>
                    <a href="{{ route('documents.show', ['id'=>'null']) }}" class="pull-right text-success">Agregar documento</a>
                </div>

                <div class="panel-body">
                  <table class='table table-striped TableAdvanced'>
                    <thead>
                      <tr>
                        <th>Clave</th>
                        <th>Descripción</th>
                        <th style="text-align:center">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if( count($doctos)>0 )
                        @foreach($doctos AS $doc)
                          <tr>
                            <td>{{$doc->id}}</td>
                            <td>{{html_entity_decode($doc->nomb_doc)}}</td>
                            <td style="text-align:center">
                              <a class="btn-group btn-group-xs" role="group" href="{{ route('documents.show', ['id'=>$doc->id]) }}">
                                <button type="button" class="btn btn-primary">Editar</button>
                              </a>
                              <a class="btn-group btn-group-xs" role="group"
                                 href="{{ route('documents.destroy', ['id'=>$doc->id]) }}"
                                 onclick="event.preventDefault(); document.getElementById('delete-form{{$doc->id}}').submit();">
                                <button type="button" class="btn btn-danger">Borrar</button>
                                <form id="delete-form{{$doc->id}}" action="{{ route('documents.destroy', ['id'=>$doc->id]) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                              </a>
                            </td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
                {{-- <div class="panel-footer">
                  <a target="_blank" href="{{ route('codes')}}">
                    <button type="button" class="btn btn-primary">Códigos de barras</button>
                  </a>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
