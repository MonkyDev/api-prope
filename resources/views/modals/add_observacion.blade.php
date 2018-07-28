<div id="modal-add-obsv{{$id_modal}}" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar nueva observación</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['route'=>['observation','id'=>0], 'method' => 'POST', 'id' => $id_modal, 'class' => 'form_observaciones']) !!}
          {!! Form::hidden('routing', null, ['id' => 'routing']) !!}
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