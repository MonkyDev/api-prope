<div id="add-obsv" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Agregar nueva observación</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['route'=>['observation','id'=>44], 'method' => 'POST', 'id' => 'form_observaciones' ]) !!}
          <div class="form-group col-md-12">
            {!! Form::textarea('desc_obsv', null, ['id' => 'desc_obsv', 'class' => 'form-control', 'required', 'style' => 'resize: none', 'maxlength'=>255]) !!}
          </div>
          <div class="form-group">
            {!! Form::submit('Guardar',['id' => 'save', 'class' => 'btn btn-success']); !!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

{{-- <div class="modal-footer">
  @yield('modal-one-cont-foot')
  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div> --}}