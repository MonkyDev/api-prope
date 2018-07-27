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
                <th>Perfil</th>
                <th>DNI</th>
                <th class="text-center">Ver</i></th>                
              </tr>
            </thead>
            <tbody>
              @if( isset($prestador) && !is_null($prestador))
                @foreach( $prestador AS $presta )
                  <tr>
                    <td> {{ $presta->tipo_dni }} </td>
                    <td> {{ $presta->dni }} </td>
                    <td class="text-center">
                      <button class="btn btn-default" title="ver el historial del registro">
                        <a href="{{ route('requestsearch',['id'=>$presta->id]) }}"><i class="glyphicon glyphicon-new-window"></i></a>
                      </button>                     
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