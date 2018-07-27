@extends('layouts.app')

@section('content')
<div class="panel panel-default col-md-5 col-md-offset-3">
  <div class="panel-heading"><b>{{ 'Identifiquese' }}</b></div>

  <div class="panel-body">
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="form-group row">
        <label for="name" class="col-md-3">{{ 'Usuario' }}</label>

        <div class="col-md-9">
          <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

          @if ($errors->has('name'))
              <span class="invalid-feedback">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
        </div>
    </div>

    <div class="form-group row">
      <label for="password" class="col-md-3">{{ 'Contraseña' }}</label>
      <div class="col-md-9">
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        @if ($errors->has('password'))
          <span class="invalid-feedback">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
      </div>
    </div>

    <div class="form-group text-center">
      <button type="submit" class="btn btn-primary">
        <b>{{ 'Aceptar' }}</b>
      </button>
    </div>

    </form>
  </div>
</div>
@endsection