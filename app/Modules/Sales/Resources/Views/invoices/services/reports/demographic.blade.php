@extends('layouts.compact-master')

@section('page-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
                    {!! Form::open(['route' => 'services.report.demographic.export', 'method' => 'POST']) !!}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-3">
                            <label><b>Fecha Rango</b></label>
                            <div>
                                <div class="input-group">
                                    <input type="text" id="date_range" name="date_range" class="form-control daterange"
                                        placeholder="yyyy-mm-dd | yyyy-mm-dd" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-12" align="center">
                            <label><b>Necesita más Campos?</b></label>
                            <center>
                                <button class="btn btn-sm btn-default waves-effect waves-light" type="button"
                                    id="btnAdd" value="+" /><b>+</b></button>
                                <button class="btn btn-sm btn-default waves-effect waves-light" type="button"
                                    id="btnDel" value="-" /><b>-</b></button>
                            </center>
                        </div>
                        <div id="input1" class="col-sm-12 clonedInput">
                            <div class="row" id="item1">
                                <div class="col-sm-4">
                                    <select id="field[]" name="field[]" class="form-control"
                                        placeholder="Seleccione Campo">
                                        <option selected="selected" value>Seleccionar Campo...</option>
                                        <option value="rif">Identificación Comercio</option>
                                        <option value="business_name">Nombre Comercio</option>
                                    </select>
                                </div>

                                <div class="col-sm-2">
                                    <select id="operator[]" name="operator[]" class="form-control">
                                        <option selected="selected" value>Seleccionar...</option>
                                        <option value="="> = </option>
                                        <option value="!="> != </option>
                                        <option value=">"> > </option>
                                        <option value="<">
                                            < </option>
                                        <option value=">="> >=
                                        </option>
                                        <option value="<=">
                                            <= </option>
                                        <option value="LIKE"> LIKE
                                        </option>
                                        <option value="NOT LIKE"> NOT LIKE </option>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="query[]" name="query[]"
                                        placeholder="Consulta" minlength="1" maxlength="30" />
                                </div>
                                <div class="col-sm-2">
                                    <select id="conditional[]" name="conditional[]" class="form-control">
                                        <option selected="selected" value>...</option>
                                        <option value="AND"> AND </option>
                                        <option value="OR"> OR </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div></br>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <center><button type="submit" class="btn btn-sm btn-info"><i class="dripicons-search"></i>
                                Consultar</button></center>
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
    <script type="text/javascript">
        flatpickr(".daterange", {
            mode: "range",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                instance.element.value = dateStr.replace('to', '|');
            },
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                    ],
                },
            },
        });
        /******************************************************************************/

        $('#btnDel').attr('disabled', 'disabled');
        $('#btnAdd').click(function() {
            var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
            var newNum = new Number(num + 1); // the numeric ID of the new input field being added

            // create the new element via clone(), and manipulate it's ID using newNum value
            var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);

            // manipulate the name/id values of the input inside the new element
            // Añadir caja de texto.

            newElem.children(':last').attr('id', 'item' + newNum).attr('name', 'item' + newNum);

            // insert the new element after the last "duplicatable" input field
            $('#input' + num).after(newElem);


            // enable the "remove" button
            $('#btnDel').attr('disabled', false);

            // business rule: you can only add 10 names
            if (newNum == 20)
                $('#btnAdd').attr('disabled', 'disabled');
        });

        $('#btnDel').click(function() {
            var num = $('.clonedInput').length; // how many "duplicatable" input fields we currently have
            $('#input' + num).remove(); // remove the last element

            // enable the "add" button
            $('#btnAdd').attr('disabled', false);

            // if only one element remains, disable the "remove" button
            if (num - 1 == 1)
                $('#btnDel').attr('disabled', 'disabled');
        });

        $('#month').on('change', function(e) {
            var month = e.target.value;

            if (month != '') {
                document.getElementById("year").disabled = false;
                $('#year').attr('required', 'required');
            } else {
                $('#year').attr('disabled', true);
                $('#year').empty();
                $('#year').append("<option selected='selected' value>Seleccione Año Venta...</option>");
                var array = ["2020", "2021", "2022", "2023", "2024", "2025", "2026", "2027", "2028", "2029", "2030",
                    "2031", "2032", "2033"
                ];

                for (var i = 0; i < array.length; i++) {
                    var option = document.createElement("option"); //Creas el elemento opción
                    $(option).html(array[i]); //Escribes en él el nombre de la provincia
                    $(option).appendTo("#year"); //Lo metes en el select con id provincias
                }
                $('#year').attr('required', false);

            }
        });
    </script>
@endsection
