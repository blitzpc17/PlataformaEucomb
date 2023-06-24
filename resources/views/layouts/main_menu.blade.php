<nav class="pcoded-navbar menu-light brand-lightblue active-lightblue">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="index.html" class="b-brand">
                    <div class="b-bg">
                       
                        <i class=""> <img width="32" src="{{asset('assets/images/icon.png')}}" alt="eucomb" srcset=""></i>
                    </div>
                    <span class="b-title">EUCOMB</span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">

                    <li class="nav-item pcoded-menu-caption">
                        <label>NAVEGACIÓN</label>
                    </li>
                    <li class="nav-item"><a href="{{route('admin')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Inicio</span></a></li>
                  
                    <li class="nav-item pcoded-menu-caption">
                        <label>RECURSOS HUMANOS</label>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">CÁTALOGOS</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('puestos')}}" class="">Puestos</a></li>
                            <li class=""><a href="{{route('empresas')}}" class="">Empresas</a></li>                           
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">EMPLEADOS</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('empleados')}}" class="">Captura y consulta</a></li>                          
                        </ul>
                    </li>

                    <li class="nav-item pcoded-menu-caption">
                        <label>SISTEMA</label>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">CÁTALOGOS</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('roles')}}" class="">Roles</a></li>                          
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">USUARIOS</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="{{route('usuarios')}}" class="">Captura y consulta</a></li>                          
                        </ul>
                    </li>

                  </ul>
            </div>
        </div>
    </nav>