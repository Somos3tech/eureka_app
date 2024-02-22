<!-- modal content -->
<div id="generateFileAdomiciliation" name="generateFileAdomiciliation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="generateFileDomiciliationLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      {!!Form::open(['id'=>'form-generate'])!!}
        <div class="modal-header">
          <h4 class="mt-0 m-b-30 header-title"><b>Generar Archivo Afiliación Bancaría</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>

        <div class="modal-body">
          <div class="col-sm-12">
            <label for="bank_id" class="col-sm-12 col-form-label"><b>Banco*</b></label>
            {!!Form::select('bank_id',[''=>'Seleccione Banco...'],null,['id'=>'bank_id','class'=>'form-control bank_id']) !!}
          </div>
        </div>

        <div class="modal-footer">
          <div class="col-sm-12">
            <center><a href="#" class='btn btn-sm btn-dark' id="generate" name="generate">Generar Archivo</a></center>
          </div>
        </div>
      {!!Form::close()!!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
