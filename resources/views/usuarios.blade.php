@extends('layouts.layout')


@push('css')
    <style>
        .botonera{
            width:100%;
            display:flex;
            justify-content:end;
            padding: 1rem 0;
        }

        .err_msj{
            font-size: 11px;
            font-weight: 600;
        }
    </style>
@endpush


@section('title', 'USUARIOS')
@section('apartado', 'USUARIOS')

@section('breadcumb')

    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item"><a href="#!">USUARIOS</a></li>

@endsection



@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3>Administración de usuarios</h3>
        </div>

        <div class="card-body">

            <div class="botonera">
                <button id="btn-add" class="btn btn-primary">Nuevo registro</button>
            </div>

            <table id="tb-registros" class="table table-bordered table-hover" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:30px;">No.</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Estado</th>
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
                                    <label for="">Empleado:</label>
                                    <input type="text" name="empleadoId" id="empleadoId" placeholder="Seleccione un empleado" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Usuario:</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                </div>

                                
                                <div class="form-row">
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="">Contraseña:</label>
                                        <input name="contrasena" id="contrasena" type="password" class="form-control validacionPass">
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label for="">Confirmar contraseña:</label>
                                        <input name="repass" id="repass" type="password" class="form-control validacionPass">
                                        <span class="err_msj" id="msj_repass"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Rol:</label>
                                    <input type="text" name="rolId" id="rolId" placeholder="Seleccione un empleado" class="form-control">
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
    let msjErrorVal = null;

    $(document).ready(function () {
        console.log("running...")

        listar();        

        $("#btn-add").on('click', function(){
            limpiarFormulario();
            $('.modal-title').text('Nuevo Registro')
            $('#md-registro').modal('toggle')
        });

        $('.validacionPass').on('keyup', function(e){
            
            if($('#repass').val().normalize()!==$('#contrasena').val().normalize()){
                ValidacionControles('repass', 'Las contraseñas no coinciden.', 'warning')
            }else{
                ValidacionControles('repass')
            }
        })


        $('#frm').on('submit', function(e){
            e.preventDefault();

            if(msjErrorVal!=null){
                swal("Advertencia", "Verifique su información: "+msjErrorVal, "warning")
                return;
            }


            let data =  new FormData(this)       
            $.ajax({
                method: "POST",
                url: "{{route('usuarios.save')}}",
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
        $("#apaterno").val(null)
        $("#amaterno").val(null)       
        $("#fechaNac").val(null)      
        $("#fechaIng").val(null)   
        $("#empresa").val(null)
    }
    function cargarRegistro(id){
        limpiarFormulario();
        const obj = data.find(el => el.Id == id)
        console.log(obj)
        $("#nombre").val(obj.name)
        $("#rolId").val(obj.ROLESId).trigger('change') 
        $("#empleadoId").val(obj.EMPLEADOSId).trigger('change') 

        $("#id").val(obj.Id)
        $('.modal-title').text('Modificar registro')
        $("#md-registro").modal("toggle")
    }
    function eliminar(id, opc){
        let data = new FormData();
        data.append('id', id)
        data.append('baja', opc)

        $.ajax({
            method: "POST",
            url: "{{route('usuarios.baja')}}",
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

        /*listar usuarios */
        $.ajax({
            method: "GET",
            url: "{{route('usuarios.listar')}}",
            success: function (res) {
                data = res;
                if(tabla!=null||tabla!=undefined){
                    tabla.destroy()                    
                }
                let html="";
                $.each(data, function (i, val) { 
                    console.log(val)
                     html+=`<tr>
                                <td>${(i+1)}</td>
                                <td>${val.name}</td>
                                <td>${val.Rol}</td>
                                <td>${val.Estado}</td>
                                <td>
                                    <button class="btn btn-icon btn-warning" onclick="cargarRegistro(${val.Id})"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-icon btn-${(val.Baja!=1?"danger":"primary")}" onclick="eliminar(${val.Id}, ${(val.Baja==1?0:1)})"><i class="feather icon-${(val.Baja==1?"check":"x")}"></i></button>
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
            SelectRoles();
            SelectEmpleados();
       
    }

    function SelectRoles(){
        $.ajax({
            type: "GET",
            url: "{{route('roles.listarselect')}}",
            success: function (res) {
                const dataP = res;

                $('#rolId').select2({
                    placeholder:{id:-1, text:"Seleccione un puesto"},
                    dropdownParent: $("#md-registro"),
                    data:dataP
                });
                $("#rolId").val(-1).trigger('change')        
                
            }
        });
    }


    function SelectEmpleados(){
        $.ajax({
            type: "GET",
            url: "{{route('empleados.listarselect')}}",
            success: function (res) {
                const dataP = res;

                $('#empleadoId').select2({
                    placeholder:{id:-1, text:"Seleccione un empleado"},
                    dropdownParent: $("#md-registro"),
                    data:dataP
                });
                $("#empleadoId").val(-1).trigger('change') 
                
            }
        });
    }

    function ValidacionControles(tagIdctrl, msj=null, type=null){
        console.log(type)
        switch(type){
            case "primary":
            case "warning":
            case "danger":
                let color = "";
                if(type==="primary"){
                    color = "#a5d6a7";
                }else if(type==="warning"){
                    color = "#ffcc80";
                }else if(type==="danger"){
                    color = "#e57373";
                }
                $("#"+tagIdctrl).css({'border': '2px solid '+color})
                $("#msj_"+tagIdctrl).text(msj)
                msjErrorVal = msj;
                break;
          
            default:
                $("#"+tagIdctrl).css({'border': '1px solid #ced4da'})
                $("#msj_"+tagIdctrl).text(null)
                msjErrorVal = null;
                break;
        }
    }




    
    
</script>

    
@endpush