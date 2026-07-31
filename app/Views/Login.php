<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Proyecto SMART</h3>

        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <form action="<?= base_url('/login/auth') ?>" method="post">
            <div class="mb-3">
                <label for="curp" class="form-label font-weight-bold">CURP</label>
                <input type="text" name="curp" class="form-control text-uppercase" id="curp" required placeholder="Ingresa tu CURP" maxlength="18">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label font-weight-bold">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" required placeholder="Ingresa tu contraseña">
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-3">Ingresar</button>
        </form>

        <hr>

        <div class="text-center">
            <a href="<?= base_url('usuarios') ?>" class="btn btn-outline-secondary w-100">
                Gestión de Usuarios
            </a>
        </div>
    </div>
</body>
</html>