<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center">
    <form action="{{route('login.ingresar')}}" method="post">
        @csrf
        <div class="container p-3">
            <h1 class="text-center mb-3">Colegio - Maria de Bertero</h1>

            <div class="email d-flex justify-content-between">
                <label for="">
                    <i class="bi bi-envelope fw-bold fs-4 text-success"></i>
                    <small class="fs-5 fw-bold">Correo: </small>
                </label>
                <br>
                <div class="d-flex flex-column w-50">
                    <input 
                        class="p-1"
                        type="text"
                        name="email"
                        placeholder="Ingrese su correo: "
                        value="{{old('email')}}"
                    >
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
            </div>

            <div class="password d-flex justify-content-between mt-3">
                <label for="">
                    <i class="bi bi-lock fw-bold fs-4 text-success"></i>
                    <small class="fs-5 fw-bold">Contraseña: </small>
                </label>
                <div class="d-flex flex-column w-50">
                    <input
                        class="p-1"
                        type="password"
                        name="password"
                        placeholder="Ingrese su contraseña"
                    >
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex justify-content-center mt-2">
                <label for="" class="fs-6 me-2 fw-bold">Recuerdame</label>
                <input type="checkbox" name="remember">
            </div>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
        </div>
    </form>
</body>
</html>