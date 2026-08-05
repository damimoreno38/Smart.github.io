<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h4 class="text-center mb-3">Establecer Nueva Contraseña</h4>

        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <form action="<?= base_url('login/update-password') ?>" method="post">
            <input type="hidden" name="token" value="<?= esc($token) ?>">
            
            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <input type="password" name="password" class="form-control" id="password" required placeholder="Mínimo 6 caracteres" minlength="6">
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-3">Cambiar Contraseña</button>
        </form>
    </div>
</body>
</html>