<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-3">Recuperar Contraseña</h4>
        <p class="text-muted small text-center mb-4">Ingresa tu CURP y correo para enviarte un enlace de restablecimiento.</p>

        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <form action="<?= base_url('login/send-reset-link') ?>" method="post">
            <div class="mb-3">
                <label for="curp" class="form-label">CURP</label>
                <input type="text" name="curp" class="form-control text-uppercase" id="curp" required placeholder="Ingresa tu CURP" maxlength="18">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" id="email" required placeholder="ejemplo@correo.com">
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-3">Enviar Enlace</button>
            <a href="<?= base_url('login') ?>" class="btn btn-link w-100 text-center text-secondary">Volver al Iniciar Sesión</a>
        </form>
    </div>
</body>
</html>