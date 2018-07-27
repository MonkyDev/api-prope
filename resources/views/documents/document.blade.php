@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading"><b>{{$title}} registro.</b></div>
        
        <form method="POST" action="{{ isset($docto) ? route('documents.update',['id'=>$docto->id]) : route('documents.store') }}">
          <input type="hidden" name="_method" value="PUT" {{ !isset($docto->id) ? 'disabled=disabled' : '' }}>
          @csrf
          <div class="panel-body">
            <div class="form-group col-md-offset-2">
              <label class="col-md-3">{{ 'Nombre del documento' }}</label>
              <div class="col-md-5">
                <input id="nomb_doc" type="text" class="form-control{{ $errors->has('nomb_doc') ? ' is-invalid' : '' }}" name="nomb_doc" value="{{ isset($docto) ? html_entity_decode($docto->nomb_doc) : old('nomb_doc')}}" required autofocus>

                @if ($errors->has('nomb_doc'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('nomb_doc') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>
          <div class="panel-footer">
            <button type="submit" class="btn btn-success"><b>Guardar</b></button>
          </div>
        </form>          
      </div>{{-- end panel-default --}}
    </div>
  </div>
</div>
@endsection
