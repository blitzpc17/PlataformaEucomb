<!DOCTYPE html>
<html lang="en">

<head>
    <title>EUCOMB - Iniciar sesión</title>  
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="CodedThemes" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/animation/css/animate.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <style>
        .logotipo{
            width:100%;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }

        .logotipo h3{
            color: #7bcb04;
            font-size: 20px;
            font-weight:700;
        }

        .logotipo img{
            width:128px;
            height:128px;
        }

    </style>

</head>

<body>
    <div class="auth-wrapper aut-bg-img">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <div class="logotipo">
                            <img id="logo" src="{{asset('assets/images/avion2.png')}}" alt="EUCOMB">
                            <h3>EUCOMB</h3>
                        </div>                       
                    </div>
                    <form method="POST" action="{{route('us.auth')}}" autocomplete="off">
                        @csrf
                        <h3 class="mb-4">BIENVENIDO</h3>
                        <div class="input-group">                       
                            <input type="text" class="form-control" placeholder="Usuario" name="usuario" value="{{old('usuario')}}">                        
                        </div>
                        @error('usuario') 
                            <span>{{$errors->first('usuario')}}</span>
                        @enderror
                        <div class="input-group mt-3">
                            <input type="password" class="form-control" placeholder="Contraseña" name="password" value="{{old('password')}}">                            
                        </div>
                        @error('password') 
                            <span>{{$errors->first('password')}}</span>
                        @enderror
                        <br>
                        <button type="submit" class="btn btn-primary shadow-2 mt-4 mb-4">Iniciar sesión</button>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>

</body>
</html>
