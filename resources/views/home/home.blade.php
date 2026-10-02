<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Manejo de Inventario</title>
</head>
<body class="bg-light">

    <div class="container">

        
        <section class="bg-light text-dark py-5 text-center">
            <div class="card text-center">
                <div class="card-header">
                    Inventario App 📜
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pagina Principal Aplicacion Inventario</h5>
                    <p class="card-text"></p>
                    <a href="{{ route('productos.index') }}" class="btn btn-primary">Menu</a>
                </div>
                <div class="card-footer text-body-secondary"></div>
            </div>
        </section>
    </div>
    <footer class="bg-dark text-white text-center py-3 position-fixed bottom-0 w-100">
            <small>&copy; 2026 Inventario --App, Todos los derechos reservados</small>
    </footer>
</body>
</html>