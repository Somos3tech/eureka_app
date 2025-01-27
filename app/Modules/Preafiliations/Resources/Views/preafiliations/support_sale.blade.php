<!-- modal content -->
<div id="preafiliationsSupportSale" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="preafiliationsSupportSaleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            {!! Form::open(['id' => 'form-support']) !!}

            <input name="_token" type="hidden" value="{{ csrf_token() }}" id="token">

            <div class="modal-header">
                <h5 class="modal-title mt-0" id="preafiliationsDeleteLabel"><b>Respuesta Solicitud de Ajustes de
                        Documentos</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! form::hidden('id', null, ['id' => 'id']) !!}
                <div class="col-sm-12">
                    <label class="col-sm-12 col-form-label"><b>Observaciones Respuesta Solicitud</b></label>
                </div>
                <div class="col-sm-12">
                    {!! form::textarea('observation_sale', null, [
                        'id' => 'observation_sale',
                        'class' => 'form-control blank',
                        'value' => old('observation_sale'),
                        'placeholder' => 'Ingrese sus Observaciones',
                        'rows' => 2,
                    ]) !!}
                </div>
            </div>
            <div class="modal-footer">
                {!! link_to(
                    '#',
                    $title = 'Responder Solicitud',
                    $attributes = ['id' => 'support-preafiliation', 'class' => 'btn bt-sm btn-warning', 'style' => 'color:white;'],
                ) !!}
            </div>

            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
