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


@section('title', 'EMPRESAS')
@section('apartado', 'EMPRESAS')

@section('breadcumb')

    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#!">EMPRESAS</a></li>

@endsection



@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3>Administración de empresas</h3>
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
                        <th style="width:60px;">Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>

            </table>

        </div>

    </div>



    <!-- modals -->

        <!-- Modal -->
        <div class="modal fade" id="md-registro" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
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
                                    <label for="">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control">
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

        $("#btn-add").on('click', function(){
            limpiarFormulario();
            $('.modal-title').text('Nuevo Registro')
            $('#md-registro').modal('toggle')
        });


        $('#frm').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: "{{route('empresas.save')}}",
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
            url: "{{route('empresas.eliminar')}}",
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
        $.ajax({
            method: "GET",
            url: "{{route('empresas.listar')}}",
            success: function (res) {
                data = res;
                if(tabla!=null||tabla!=undefined){
                    tabla.destroy()                    
                }
                let html="";
                $.each(data, function (i, val) { 
                     html+=`<tr>
                                <td>${(i+1)}</td>
                                <td>${val.Nombre}</td>
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
    }
</script>

    
@endpush