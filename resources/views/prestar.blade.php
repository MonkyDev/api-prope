@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Datos del prestador</h4></div>
        <form method="POST" id="loan-add-form" action="{{ route('prestamo') }}">
          @csrf
          <div class="panel-body">
            <spam class="row">
              <div class="form-group">
                <label>Clave</label>
                <input id="dni" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ old('dni')}}" required autofocus>
                @if ($errors->has('dni'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('dni') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label>Motivo</label>
                <select id="clave_motivo" name="clave_motivo" class="form-control{{ $errors->has('clave_motivo') ? ' is-invalid' : '' }}" required>
                    <option name="clave_motivo" value="">SELECCIONE</option>
                  @foreach($motivos AS $motivo)
                    <option  value=" {{ $motivo->id }} "> {{ html_entity_decode($motivo->desc_motv) }} </option>
                  @endforeach
                </select>
                @if ($errors->has('clave_motivo'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('clave_motivo') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <label>Anotaciones</label>
                <textarea style="resize: none;" class="form-control{{ $errors->has('anotaciones') ? ' is-invalid' : '' }}" id="anotaciones" name="anotaciones">{{ old('anotaciones')}}-</textarea>
                @if ($errors->has('anotaciones'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('anotaciones') }}</strong>
                    </span>
                @endif
              </div>

            </spam>
          </div>
      </div> {{-- /panel --}}
    </div> {{-- /col --}}

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Documento(s) a solicitud</h4></div>
          <div class="panel-body">
            <div class="form-group">
              <label>Tipo</label>
              <select class="form-control{{ $errors->has('tipo_documento') ? ' is-invalid' : '' }}" id="tipo_documento" name="tipo_documento">
                <option value="original">Original</option>
                <option value="copia">Copia</option>
                <option value="original|copia">Original y copia</option>
              </select>
              @if ($errors->has('tipo_documento'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('tipo_documento') }}</strong>
                </span>
              @endif
            </div>

            <hr>

            <div cla ss="form-group">
             <ol class="list-unstyled">
                @foreach($documentos AS $document)
                  <li><label><input type="checkbox" name="documents[]" value="{{ $document->id }}"> {{ html_entity_decode($document->nomb_doc) }}</label></li>
                @endforeach
             </ol>
            </div>
          </div>

      </div> {{-- /panel --}}
    </div> {{-- /col --}}

    <div class="col-md-12 text-right">
      <hr>
      <button type="submit" class="btn btn-primary"> Guardar</button>
    </div>
    </form>
  </div> {{-- /row --}}
</div> {{-- /container --}}
@endsection


