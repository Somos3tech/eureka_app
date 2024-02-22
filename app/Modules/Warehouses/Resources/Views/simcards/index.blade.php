@extends('layouts.compact-master')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('/assets/styles/vendor/datatables.min.css') }}">
    @toastr_css
    <style>
        th,
        td {
            font-size: 13px;
        }

        .btn {
            border: none;
        }
    </style>
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
                    <div class="col-md-12">
                        <center>
                            @can('simcards.create')
                                <div class="btn-group btn-sm pull-center">
                                    <button type="button" class="btn btn-sm btn-warning" style="color:white;">Filtro
                                        Almacén</button>
                                    <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown"
                                        style="color:white;"></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <div id="companies-button"></div>
                                    </ul>
                                </div>
                            @endcan

                            <div class="btn-group btn-sm">
                                <button type="button" class="btn btn-sm btn-warning" style="color:white;">Filtro
                                    Status</button>
                                <button type="button" class="btn btn-sm btn-warning dropdown-toggle" data-toggle="dropdown"
                                    style="color:white;">
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a id="available" class="btn btn-sm btn-default filter">Disponible</a></li>
                                    <li><a id="assigned" class="btn btn-sm btn-default filter">Asignado</a></li>
                                    <li><a id="delivered" class="btn btn-sm btn-default filter">Entregado</a></li>
                                    <li><a id="inactive" class="btn btn-sm btn-default filter">Desactivado</a></li>
                                </ul>
                            </div>
                    </div>
                    </center>
                    <div class="col-md-12 row">
                        <div class="col-md-3">
                            @can('simcards.create')
                                <div class="btn-group btn-sm">
                                    <button type="button" class="btn btn-sm btn-dark">Gestión Equipos</button>
                                    <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a id="create" class="btn btn-sm btn-default filter"
                                                href="{{ route('simcards.create') }}" style="color:black;">Registrar</a></li>
                                        <li><a id="create-company" class="btn btn-sm btn-default filter"
                                                href="{{ route('simcards.assign.company') }}" style="color:black;"> Asignar x
                                                Almacén</a></li>
                                        <li><a id="assign" class="btn btn-sm btn-default filter"
                                                href="{{ route('simcards.assign') }}" style="color:black;">Asignar</a></li>
                                        <li><a id="reassign" class="btn btn-sm btn-default filter"
                                                href="{{ route('simcards.reassign') }}" style="color:black;">Reasignar</a></li>
                                    </ul>
                                </div>
                            @endcan
                        </div>
                        <div class="col-md-8">
                            &nbsp;
                        </div>
                        <div class="col-md-1">
                            <div class="btn-group pull-right" align="left">
                                <a id="reset" class="btn btn-sm btn-warning" style="color: white;" title="Actualizar"><i
                                        class="fa fa-rotate-left"></i> Actualizar</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="simcards" style="display:block;" class="box-body table-responsive">
                        <table id="simcards-table" class="table table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        <center>Operador</center>
                                    </th>
                                    <th>
                                        <center>APN</center>
                                    </th>
                                    <th>
                                        <center>Serial SIM</center>
                                    </th>
                                    <th>
                                        <center>Almacén Asignado</center>
                                    </th>
                                    <th>
                                        <center>Nombre Comercio</center>
                                    </th>
                                    <th>
                                        <center>Fecha Asignación</center>
                                    </th>
                                    <th>
                                        <center>Asignado A</center>
                                    </th>
                                    <th>
                                        <center>Estado</center>
                                    </th>
                                    <th>
                                        <center>Acciones</center>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content-->
@endsection

@include('warehouses::simcards.delete')
@include('warehouses::simcards.restore')

@section('page-js')
    <script src="{{ asset('/assets/js/vendor/datatables.min.js') }}"></script>
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function() {
            $('#simcards').show();
            var status = 'Disponible';
            listsimcard(status);
        });
        var listsimcard = function(status) {
            table = $('#simcards-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/simcards/datatable?status=" + status,
                columns: [{
                        data: "operator",
                        "className": "text-center"
                    },
                    {
                        data: "apn",
                        "className": "text-center"
                    },
                    {
                        data: "serial_sim",
                        "className": "text-center"
                    },
                    {
                        data: "company",
                        "className": "text-center"
                    },
                    {
                        data: "business_name",
                        "className": "text-center"
                    },
                    {
                        data: "assignated",
                        "className": "text-center"
                    },
                    {
                        data: "user",
                        "className": "text-center"
                    },
                    {
                        data: "status",
                        "className": "text-center"
                    },
                    {
                        data: "actions"
                    },
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                buttons: [],
                "order": [
                    [3, "asc"],
                    [0, "asc"],
                    [1, "asc"]
                ]
            });

            $('#available').on('click', function() {
                table.destroy();
                listsimcard('Disponible');
            });

            $('#assigned').on('click', function() {
                table.destroy();
                listsimcard('Asignado');
            });

            $('#delivered').on('click', function() {
                table.destroy();
                listsimcard('Entregado');
            });

            $('#desactived').on('click', function() {
                table.destroy();
                listsimcard('Desactivado');
            });

            $('#inactive').on('click', function() {
                table.destroy();
                listsimcard('Inactivo');
            });

            $('#reset').on('click', function() {
                $('#simcards-table').DataTable().ajax.reload();
            });

            /******************************************************************************/
            $.get('/companies/select', function(data) {
                $('#companies-button').empty();
                Object.keys(data).forEach(function(key) {
                    $('<li><a id="' + key + '" class="btn btn-sm btn-default filter">' + data[key]
                        .description + '</a></li>').prependTo('#companies-button');
                    $('#' + key).on('click', function() {
                        table.search('').columns().search('').draw();
                        table.columns(3).search(data[key].description).draw();
                    });
                });
            });
        }

        var simcardsDelete = function(btn) {
            $("#id").val(btn.value);
        }

        $("#delete").click(function() {
            var id = $("#id").val();
            var route = "{{ url('simcards') }}/" + id + "";
            var token = $("#token").val();

            $.ajax({
                url: route,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                type: 'DELETE',
                dataType: 'json',
                success: function(data) {
                    $("#simcardsDelete").modal("hide");
                    $('#simcards-table').DataTable().ajax.reload();
                    toastr.info(data.message)
                },
                error: function(data) {
                    $("#simcardsDelete").modal("hide");
                    toastr.error(data.message)
                }
            });
        });

        var SimcardRestore = function(btn) {
            $("#id").val(btn.value);
        }

        $("#restore").click(function() {
            var id = $("#id").val();
            var route = "/simcards/restore/" + id + "";
            var token = $("#token").val();

            $.ajax({
                url: route,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                type: 'PUT',
                dataType: 'json',
                success: function(data) {
                    $("#restoreSimcard").modal("hide");
                    $('#simcards-table').DataTable().ajax.reload();
                    toastr.info(data.message)
                },
                error: function(data) {
                    $("#restoreSimcard").modal("hide");
                    toastr.error(data.message)
                }
            });
        });
    </script>
@endsection
