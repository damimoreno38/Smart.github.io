<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Autenticación - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4 text-center" style="width: 100%; max-width: 400px;">
        <div class="mb-3 text-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>
        </div>

        <h4 class="mb-3">Error de Acceso</h4>

        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger text-center">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger text-center">
                No fue posible validar tus credenciales.
            </div>
        <?php endif;?>

        <div class="d-grid gap-2 mt-3">
            <a href="<?= base_url('login') ?>" class="btn btn-primary">Volver a Intentar</a>
            <a href="<?= base_url('login/forgot-password') ?>" class="btn btn-outline-secondary">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</body>
</html>