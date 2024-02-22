@extends('layouts.compact-master')

@section('page-css')
    <link href="/assets/css/select2.min.css" rel="stylesheet" />
    @toastr_css
@endsection

@section('main-content')
    <div class="breadcrumb">
        <h1>{{ $identity ?? 'Dashboard' }}</h1>

    </div>

    <div class="separator-breadcrumb border-top"></div>

    <!-- Content-->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    {!! Form::open(['route' => 'assignments.reassign', 'method' => 'GET']) !!}
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="form-group row">

                                <div class="col-sm-2">
                                    <label for="operator_id" class="col-sm-12">Operador*</label>
                                    {!! form::select('operator_id', ['' => 'Seleccione Operador...'], null, [
                                        'id' => 'operator_id',
                                        'class' => 'form-control search select2',
                                        'required' => 'required',
                                    ]) !!}
                                </div>

                                <div class="col-sm-2">
                                    <label for="company_id" class="col-sm-12">Almacén Origen*</label>
                                    {!! form::hidden('device', 'S', ['id' => 'device']) !!}
                                    {!! form::select('company_id', ['' => 'Seleccione Almacén...'], null, [
                                        'id' => 'company_id',
                                        'class' => 'form-control search select2',
                                        'required' => 'required',
                                    ]) !!}
                                </div>

                                <div class="col-sm-3">
                                    <label for="user_assignated">Programador Origen*</label>
                                    {!! form::select('user_assignated', ['' => 'Seleccione Programador...'], null, [
                                        'id' => 'user_assignated',
                                        'class' => 'form-control search assign assignated select2',
                                        'required' => 'required',
                                    ]) !!}
                                </div>

                                <div class="col-sm-2">
                                    <label for="company_id" class="col-sm-12">Almacén Destino*</label>
                                    {!! form::select('company_assign_id', ['' => 'Seleccione Almacén...'], null, [
                                        'id' => 'company_assign_id',
                                        'class' => 'form-control search assign select2',
                                        'required' => 'required',
                                    ]) !!}
                                </div>

                                <div class="col-sm-3">
                                    <label for="user_assign" class="col-sm-12">Reprogramador Destino</label>
                                    {!! form::select('user_assign', ['' => 'Seleccione Programador...'], null, [
                                        'id' => 'user_assign',
                                        'class' => 'form-control select2',
                                    ]) !!}
                                </div>

                                <div class="col-sm-6">
                                    <div id="asignado" class="col-sm-12"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <select name="origen[]" id="origen" class="form-control origen select2"
                                        multiple="multiple" size="8"></select>
                                </div>

                                <div class="col-sm-2">
                                    <center>
                                        <input type="button" class="pasar izq btn btn-sm btn-info count" value="Pasar »">
                                        <input type="button" class="quitar der btn btn-sm btn-info count"
                                            value="« Quitar"><br />
                                        <input type="button" class="seleccionartodos izq btn btn-sm btn-info count"
                                            value="Seleccionar Todo »">
                                        <input type="button" class="quitartodos der btn btn-sm btn-warning count"
                                            value="« Quitar Todos" style="color:white;">
                                    </center>
                                </div>

                                <div class="col-sm-5">
                                    <select name="destino[]" id="destino" class="form-control multiple"
                                        multiple="multiple" size="8" required></select>
                                    <div class="pull-right" id="count"></div>
                                </div>

                                <div class="col-sm-12">
                                    <label for="name" class="col-sm-12 col-form-label">Observaciones*</label>
                                    {!! form::textarea('observations', null, [
                                        'id' => 'observations',
                                        'class' => 'form-control outlinenone blank',
                                        'rows' => '2',
                                        'placeholder' => 'Ingrese Observaciones',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <center><a href="javascript:window.history.back();" title="Volver"
                                    class="btn btn-sm btn-warning" style="color:white;"><i class="fa fa-rotate-left"></i>
                                    Volver</a>&nbsp;<button type="submit"
                                    class="btn btn-sm btn-info submit">Reasignar</button></center>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Content-->
@endsection

@section('page-js')
    @toastr_js
    @toastr_render

    <script src="/assets/js/select2.min.js"></script>

    <script type="text/javascript">
        $().ready(function() {
            $('.origen').select2();
            $('.pasar').click(function() {
                $('#origen option:selected').remove().appendTo('#destino');
                $("#destino option").each(function() {
                    // Marcamos cada valor como seleccionado
                    $("#destino option[value=" + this.value + "]").prop("selected", true);
                });
                var count = $("#destino :selected").length;
                document.getElementById('count').innerHTML = '';
                $('#count').append("Total: <strong>" + count + "</strong>");
            });
            $('.quitar').click(function() {
                $('#destino option:selected').remove().appendTo('#origen');
                $("#origen option:selected").removeAttr("selected");
                $("#destino option").each(function() {
                    // Marcamos cada valor como seleccionado
                    $("#destino option[value=" + this.value + "]").prop("selected", true);
                });

                var count = $("#destino :selected").length;
                document.getElementById('count').innerHTML = '';
                $('#count').append("Total: <strong>" + count + "</strong>");
            });
            $('.seleccionartodos').click(function() {
                $('#origen option').each(function() {
                    $(this).remove().appendTo('#origen');
                    $("#destino option:selected").removeAttr("selected");
                    $("#origen option").each(function() {
                        // Marcamos cada valor como seleccionado
                        $("#origen option[value=" + this.value + "]").prop("selected",
                            true);
                    });
                });
            });
            $('.quitartodos').click(function() {
                $('#destino option').each(function() {
                    $(this).remove().appendTo('#origen');
                    $("#origen option:selected").removeAttr("selected");
                    $("#destino option").each(function() {
                        // Marcamos cada valor como seleccionado
                        $("#destino option[value=" + this.value + "]").prop("selected",
                            true);
                    });
                });
            });
            $('.submit').click(function() {
                $('#destino option').prop('selected', 'selected');
            });
        });
        /**************************************************************************/
        $.get('/companies/select/zone-valid?slug=store', function(data) {
            $('#company_id').empty();
            if (data.length > 1) {
                $('#company_id').append("<option value=''>Seleccione Almacén...</option>");
            } else {
                $('#company_id').attr('readonly', 'readonly');
                $.each(data, function(index, subZoneObj) {
                    $.get('/users/select/assignment?company_id=' + subZoneObj.id + '&user_id=', function(
                        data) {
                        $('#user_assignated').empty();
                        $('#user_assignated').append(
                            "<option value=''>Seleccione Programador...</option>");
                        $.each(data, function(index, subUserObj) {
                            $('#user_assignated').append("<option value='" + subUserObj.id +
                                "'>" + subUserObj.description + "</option>");
                        });
                    });
                });
            }
            $.each(data, function(index, subCompanyObj) {
                document.getElementById("company_id").disabled = false;
                $('#company_id').append("<option value='" + subCompanyObj.id + "'>" + subCompanyObj
                    .description + "</option>");
            });
            $("#company_id option[value=" + {{ old('company_id') }} + "]").attr("selected", true);
        });
        /**************************************************************************/
        $('#company_id').on('change', function(e) {
            $.get('/companies/select/zone-valid?slug=store', function(data) {
                $('#company_assign_id').empty();
                $('#company_assign_id').append("<option value=''>Seleccione Almacén...</option>");
                $.each(data, function(index, subCompanyObj) {
                    $('#company_assign_id').append("<option value='" + subCompanyObj.id + "'>" +
                        subCompanyObj.description + "</option>");
                });
                $("#company_assign_id option[value=" + {{ old('company_assign_id') }} + "]").attr(
                    "selected", true);
            });
            $("#company_assign_id option[value='']").prop("selected", true);
            var company_id = e.target.value;
            $.get('/users/select/assignment?company_id=' + company_id + '&user_id=', function(data) {
                $('#user_assignated').empty();
                $('#user_assignated').append("<option value=''>Seleccione Programador...</option>");
                $.each(data, function(index, subUserObj) {
                    $('#user_assignated').append("<option value='" + subUserObj.id + "'>" +
                        subUserObj.description + "</option>");
                });
            });
        });
        /**************************************************************************/
        $.get('/companies/select/zone-valid?slug=store', function(data) {
            $('#company_assign_id').empty();
            $('#company_assign_id').append("<option value=''>Seleccione Almacén...</option>");
            $.each(data, function(index, subCompanyObj) {
                $('#company_assign_id').append("<option value='" + subCompanyObj.id + "'>" + subCompanyObj
                    .description + "</option>");
            });
            $("#company_assign_id option[value=" + {{ old('company_assign_id') }} + "]").attr("selected", true);
        });
        /**************************************************************************/
        $.get('/operators/select', function(data) {
            $('#operator_id').empty();
            $('#operator_id').append("<option value=''>Seleccione Operador...</option>");
            $.each(data, function(index, subOperatorlObj) {
                $('#operator_id').append("<option value='" + subOperatorlObj.id + "'>" + subOperatorlObj
                    .description + "</option>");
                $("#operator_id option[value=" + {{ old('operator_id') }} + "]").attr("selected", true);
            });
        });
        /**************************************************************************/
        $('.assignated').on('change', function(e) {
            var user_id = e.target.value;
            $.get('/assignments/select/assigned?count=Y&device=S&user_id=' + user_id, function(data) {
                $("#asignado").attr("style", "display:block");
                document.getElementById('asignado').innerHTML = '';
                $('#asignado').append("<p><strong>Simcard Asignados:</strong></p>");
                $('#asignado').append("<strong>{Operador, Cantidad}</strong> => ");

                $.each(data, function(index, subAssignObj) {
                    $('#asignado').append("<strong>{" + subAssignObj.operator + " ," + subAssignObj
                        .count + "}</strong>");
                });
            });
        });
        /**************************************************************************/
        $('.assign').on('change', function(e) {
            var company_id = document.getElementById("company_assign_id").value;
            var user_id = document.getElementById("user_assignated").value;
            $.get('/users/select/assignment?company_id=' + company_id + '&filter=assign&user_id=' + user_id,
                function(data) {
                    $('#user_assign').empty();
                    $('#user_assign').append("<option value=''>Seleccione Programador...</option>");
                    $.each(data, function(index, subUserObj) {
                        $('#user_assign').append("<option value='" + subUserObj.id + "'>" + subUserObj
                            .description + "</option>");
                    });
                });
        });
        /**************************************************************************/
        $('.search').on('change', function(e) {

            $("#destino option").each(function() {
                // Marcamos cada valor como seleccionado
                $("#destino option[value=" + this.value + "]").prop("selected", true);
            });
            var operator_id = document.getElementById('operator_id').value;
            var user_id = document.getElementById('user_assignated').value;
            let selectElement = document.getElementById('destino');
            let destino = Array.from(selectElement.selectedOptions).map(option => option.value);

            $.get('/assignments/select/assigned?count=&device=S&user_id=' + user_id + '&operator_id=' +
                operator_id + '&destino=' + destino,
                function(data) {
                    $('#origen').empty();
                    $.each(data, function(index, subOperatorObj) {
                        $('#origen').append("<option value='" + subOperatorObj.id + "'>" +
                            subOperatorObj.operator + "</option>");
                    });
                });
        });
        /**************************************************************************/
        $('.assignated').on('change', function(e) {
            var user_id = e.target.value;
            $.get('/assignments/select/assigned?count=Y&device=S&user_id=' + user_id, function(data) {
                $("#asignado").attr("style", "display:block");
                document.getElementById('asignado').innerHTML = '';
                $('#asignado').append("<p><strong>Simcard Asignados:</strong></p>");
                $('#asignado').append("<strong>{Operador, Cantidad}</strong> => ");
                $.each(data, function(index, subAssignObj) {
                    $('#asignado').append("<strong>{" + subAssignObj.operator + " ," + subAssignObj
                        .count + "}</strong>");
                });
            });
        });
    </script>
@endsection
