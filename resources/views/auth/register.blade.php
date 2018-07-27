@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>{{ 'Registrarse' }}</b></div>

                <div class="panel-body">
                    <form id="registerUser" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group name row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ 'Nombre completo' }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" placeholder="Paterno Materno Nombre(s)" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row fullname hidden">
                            <label for="fullname" class="col-md-3 col-form-label text-md-right">{{ 'Nombre completo' }}</label>

                            <div class="col-md-3">
                                <input id="nombres" type="text" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" value="{{ old('nombres') }}" readonly>

                                @if ($errors->has('nombres'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input id="paterno" type="text" class="form-control{{ $errors->has('paterno') ? ' is-invalid' : '' }}" name="paterno" value="{{ old('paterno') }}" readonly>

                                @if ($errors->has('paterno'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('paterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input id="materno" type="text" class="form-control{{ $errors->has('materno') ? ' is-invalid' : '' }}" name="materno" value="{{ old('materno') }}" readonly>

                                @if ($errors->has('materno'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('materno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="clave" class="col-md-4 col-form-label text-md-right">{{ 'Clave Trabajador' }}</label>

                            <div class="col-md-6">
                                <input id="clave" type="text" class="form-control{{ $errors->has('clave') ? ' is-invalid' : '' }}" name="clave" value="{{ old('clave') }}" required autofocus>

                                @if ($errors->has('clave'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('clave') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ 'Usuario' }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ 'Contraseña' }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="ingrese 6 o mas caracteres" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ 'Confirmar contraseña' }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="repita contraseña" required>
                            </div>
                        </div>

                        <div class="alert alert-info hidden" role="alert">Si el patron de tu nombre no corresponde a lo siguiente (Nombres/Paterno/Materno), pulsa la tecla <b>F5.</b></div>

                            @if ($errors->has('name') || $errors->has('clave'))
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    
                                </div>
                            @endif
                        

                        <input id="email" type="hidden" class="form-control" name="email" value="{{ 'usuario@usuario.com' }}" required>

                        <div class="form-group text-center">
                          <button type="submit" class="btn btn-primary">
                              {{ 'Registrarse' }}
                          </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
