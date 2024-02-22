<div id="atcsManagement" name="atcsManagement" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="atcsManagementLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-atc-management" name="form-atc-management">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel"><b>Iniciar Gestión ATC No. &nbsp;&nbsp;&nbsp; </b>
                    </h5><span class="atc_id_view view"></span> &nbsp;&nbsp;|&nbsp;&nbsp; <span
                        class="status_view view"></span><button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>

                <div class="modal-body row">
                    {!! Form::hidden('atc_management_id', null, ['id' => 'atc_management_id', 'class' => 'atc_id']) !!}
                    <div class="col-sm-6 user">
                        <label for="customer_view" class="col-sm-12"><b>Código</b><br>
                            <center><span class="customer_view view"></span></center>
                        </label>
                    </div>

                    <div class="col-sm-6 user">
                        <label for="rif_view" class="col-sm-12"><b>RIF</b><br>
                            <span class="rif_view view"></span></label>
                    </div>

                    <div class="col-sm-12 user">
                        <label for="business_name_view" class="col-sm-12"><b>Nombre Comercio / Usuario</b><br>
                            <span class="business_name_view view"></span></label>
                    </div>

                    <div class="col-sm-6 user">
                        <label for="telephone_view" class="col-sm-12"><b>Teléfono</b><br>
                            <span class="telephone_view view"></span></label>
                    </div>

                    <div class="col-sm-6 user">
                        <label for="mobile_view" class="col-sm-12"><b>Movíl</b><br>
                            <span class="mobile_view view"></span></label>
                    </div>

                    <div class="col-sm-12 user">
                        <label for="email_view" class="col-sm-12"><b>Email</b><br>
                            <span class="email_view view"></span></label>
                    </div>

                    <div class="col-sm-6 internaluser">
                        <label for="business_name_view" class="col-sm-12"><b>Usuario</b><br>
                            <span class="business_name_view view"></span></label>
                    </div>

                    <div class="col-sm-6 internaluser">
                        <label for="email_view" class="col-sm-12"><b>Email</b><br>
                            <span class="email_view view"></span></label>
                    </div>

                    <div class="col-sm-6">
                        <label for="channel_view" class="col-sm-12"><b>Canal</b><br>
                            <span class="channel_view view"></span></label>
                    </div>

                    <div class="col-sm-6">
                        <label for="managementtype_view" class="col-sm-12"><b>Tipo Operación</b><br>
                            <span class="managementtype_view view"></span></label>
                    </div>

                    <div class="col-sm-12">
                        <label for="mtypeitem_view" class="col-sm-12"><b>Item Tipo Operación</b><br>
                            <span class="mtypeitem_view view"></span></label>
                    </div>

                    <div class="col-sm-12">
                        <label for="observation_view" class="col-sm-12"><b>Observación Inicial*</b><br>
                            <span class="observation_view view"></span></label>
                    </div>

                    {{-- <div class="col-sm-12">
                        <label for="observation_manager_view" class="col-sm-12"><b>Observación Gestión*</b><br>
                            <span class="observation_manager_view view"></span></label>
                    </div> --}}

                    <div class="col-sm-6">
                        <label for="created_view" class="col-sm-12"><b>Generado</b><br>
                            <span class="created_view view"></span></label>
                    </div>

                    <div class="col-sm-6">
                        <label for="managementtype_view" class="col-sm-12"><b>Generado Por</b><br>
                            <span class="created_name_view view"></span></label>
                    </div>

                    <div class="col-sm-6">
                        <label for="updated_view" class="col-sm-12"><b>Procesado</b><br>
                            <span class="updated_view view"></span></label>
                    </div>

                    <div class="col-sm-6">
                        <label for="updated_name_view" class="col-sm-12"><b>Procesado Por</b><br>
                            <span class="updated_name_view view"></span></label>
                    </div>

                    <div class="col-sm-12">
                        <label for="observation_manager" class="col-sm-12 col-form-label"><b>Observación
                                Gestión<small>*</small></b></label>
                        {!! Form::textarea('observation_manager', null, [
                            'id' => 'observation_manager',
                            'class' => 'form-control outlinenone',
                            'placeholder' => 'Ingrese Observación',
                            'rows' => 2,
                        ]) !!}
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="col-sm-12">
                        <center>
                            <a href="#" title="Gestionar Ticket" id="management" name="management"
                                class="btn bt-sm btn-info">Gestionar</a>
                        </center>
                    </div>
                </div>
        </div>

        </form>
    </div>
</div>
