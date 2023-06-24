@extends('layouts.layout')


@push('css')
    <style>
        .botonera{
            width:100%;
            display:flex;
            justify-content:end;
            padding: 1rem 0;
        }
    </style>
@endpush


@section('title', 'EMPLEADOS')
@section('apartado', 'EMPLEADOS')

@section('breadcumb')

    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#!">EMPLEADOS</a></li>

@endsection



@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3>Administración de empleados</h3>
        </div>

        <div class="card-body">

            <div class="botonera">
                <button id="btn-add" class="btn btn-primary">Nuevo registro</button>
            </div>

            <table id="tb-registros" class="table table-bordered table-hover" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:30px;">No.</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Empresa</th>
                        <th style="width:60px;">Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>

            </table>

        </div>

    </div>



    <!-- modals -->

        <!-- Modal -->
        <div class="modal hide fade" id="md-registro" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form id="frm" autocomplete="off">
                                <input type="hidden" id="id" name="id">  

                                <div class="form-group">
                                    <label for="">Nombres</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="">Apellido Paterno:</label>
                                        <input type="text" name="apaterno" id="apaterno" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="">Apellido Materno:</label>
                                        <input type="text" name="amaterno" id="apaterno" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Fecha Nacimiento:</label>
                                    <input type="text" id="fechaNacimiento" name="fechaNacimiento" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Fotografía:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="feather icon-upload"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="foto" name="foto">
                                            <label class="custom-file-label" for="inputGroupFile01">Elija un archivo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Curriculum Vitae:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="feather icon-upload"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="cv" name="cv">
                                            <label class="custom-file-label" for="inputGroupFile01">Elija un archivo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Fecha de ingreso:</label>
                                    <input type="text" id="fechaIngreso" name="fechaIngreso" class="form-control">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="">Puesto:</label>
                                        <input type="text" name="puesto" id="puesto" placeholder="Seleccione un puesto" class="form-control">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="">Empresa:</label>
                                        <input type="text" name="empresa" id="empresa" placeholder="Seleccione una empresa" class="form-control">
                                    </div>
                                </div>
                                
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection


@push('js')

<script>

    let data;
    let tabla;

    $(document).ready(function () {
        console.log("running...")

        listar();

        $('#fechaNacimiento').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            lang: 'es',
            time:false,
            minDate: moment('01/01/1935'),
            tame: false,
        });

        $('#fechaIngreso').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            lang: 'es',
            time:false,
            minDate: moment().add(-30, 'days'),
            time: false
        });

        $("#btn-add").on('click', function(){
            limpiarFormulario();
            $('.modal-title').text('Nuevo Registro')
            $('#md-registro').modal('toggle')
        });


        $('#frm').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: "{{route('empleados.save')}}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false, 
                dataType: "json",
                success: function (res) {
                    if(res.code==500){
                        swal("Oh oh!", res.msj, "warning");
                    }else{
                        swal("Aviso", res.msj, "success").then(()=>{
                            limpiarFormulario();
                            $('#md-registro').modal('toggle')
                            listar();
                        });
                    }
                }
            });

        });



    });


    function limpiarFormulario(){
        $("#nombre").val(null)
        $("#id").val(null)
    }
    function cargarRegistro(id){
        limpiarFormulario();
        const obj = data.find(el => el.Id == id)
        $("#nombre").val(obj.Nombre)
        $("#id").val(obj.Id)
        $('.modal-title').text('Modificar registro')
        $("#md-registro").modal("toggle")
    }
    function eliminar(id){
        let data = new FormData();
        data.append('id', id)

        $.ajax({
            method: "POST",
            url: "{{route('empleados.eliminar')}}",
            data: data,
            contentType: false,
            cache: false,
            processData:false, 
            dataType: "json",
            success: function (res) {
                if(res.code==500){
                        swal("Oh oh!", res.msj, "warning");
                    }else{
                        swal("Aviso", res.msj, "success").then(()=>{
                            limpiarFormulario();                        
                            listar();
                        });
                    }
            }
        });
    }

    function listar(){

        /*listar empleados */
        $.ajax({
            method: "GET",
            url: "{{route('empleados.listar')}}",
            success: function (res) {
                data = res;
                if(tabla!=null||tabla!=undefined){
                    tabla.destroy()                    
                }
                let html="";
                $.each(data, function (i, val) { 
                     html+=`<tr>
                                <td>${(i+1)}</td>
                                <td>${val.Nombres}</td>
                                <td>${val.Baja}</td>
                                <td>${val.EMPRESASId}</td>
                                <td>
                                    <button class="btn btn-icon btn-warning" onclick="cargarRegistro(${val.Id})"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-icon btn-danger" onclick="eliminar(${val.Id})"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>`; 
                });

                $('#tb-registros tbody').html(html);

                tabla = $('#tb-registros').DataTable({
                    "language": {
                                    "url": "assets/json/dt_spanish.json"
                                },
                })
            }
        });
            /* listar select puestos */
        $.ajax({
            type: "GET",
            url: "{{route('puestos.listarselect')}}",
            success: function (res) {
                const dataP = res;

                $('#puesto').select2({
                    placeholder:"Seleccione un puesto",
                    dropdownParent: $("#md-registro"),
                    data:dataP
                });
                
            }
        });


         /* listar select empresa */
         $.ajax({
            type: "GET",
            url: "{{route('empresas.listarselect')}}",
            success: function (res) {
                const dataP = res;

                $('#empresa').select2({
                    placeholder:"Seleccione una empresa",
                    dropdownParent: $("#md-registro"),
                    data:dataP
                });
                
            }
        });
    }




    
    
</script>

    
@endpush