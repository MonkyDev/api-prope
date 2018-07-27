@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Inicio</b></div>

                <div class="panel-body">
                    Bienvenido, esta herramienta te ayudará a solventar los prestamos de documentos que solicitan los alumnos o diferentes áreas, para trámites externos en necesidad al solicitante.
                </div>
            </div>
            @if( isset($code) && Session::has('CheckVencidos') )
                <script>
                    Push.create("Prestamos Vencidos", {
                        body: "{{ 'Código: '.$code.', '.$message }}",
                        icon: 'icons/noty_bell.png',
                        timeout: 8000,
                        onClick: function () {
                            window.focus();
                            this.close();
                        }
                    });
                </script>
            @endif
        </div>
    </div>
</div>
@endsection