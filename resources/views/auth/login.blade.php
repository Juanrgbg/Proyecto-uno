<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("./css/bootstrap.min.css") }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    
    
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Iniciar sesión</h4>
                </div>
                
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                        @endif
                        
                        <form action="{{ route('login.authenticate') }}"
                        method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email"
                            class="form-label">
                            Correo electrónico
                        </label>
                        
                        <input type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password"
                        class="form-label">
                        Contraseña
                    </label>
                    
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                
                <button type="submit"
                class="btn btn-success w-100">
                Iniciar sesión
            </button>
            <a href="#"></a><button type="" class="btn bg-body-tertiary w-100"> Registrarse</button>
        </form>
    </div>
</div>
</div>
</div>
</div>



</body>
</html>