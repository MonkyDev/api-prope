@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-heading"><b>{{$title}} registro.</b></div>
        
        <form method="POST" action="{{ isset($motivo) ? route('reasons.update',['id'=>$motivo->id]) : route('reasons.store') }}">
          <input type="hidden" name="_method" value="PUT" {{ !isset($motivo->id) ? 'disabled=disabled' : '' }}>
          @csrf
          <div class="panel-body">
            <spam class="row">
              <div class="form-group col-md-4">
                <label>{{ 'Descripción del motivo' }}</label>
                <input id="desc_motv" class="form-control{{ $errors->has('desc_motv') ? ' is-invalid' : '' }}" name="desc_motv" value="{{ isset($motivo) ? html_entity_decode($motivo->desc_motv) : old('desc_motv')}}" required autofocus>
                @if ($errors->has('desc_motv'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('desc_motv') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group col-md-2">
                <label>{{ 'Días permitidos' }}</label>
                <input id="dias" class="form-control{{ $errors->has('dias') ? ' is-invalid' : '' }}" name="dias" value="{{ isset($motivo) ? $motivo->dias : old('dias')}}" required autofocus>
                @if ($errors->has('dias'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('dias') }}</strong>
                    </span>
                @endif
              </div>
            </spam>           

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
