<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container" style="max-width: 500px;">
        <div class="card shadow p-4">
            <h3 class="mb-4 text-center">Nuevo Usuario</h3>
            <form action="<?= base_url('/usuarios/guardar') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Nombre de Usuario</label>
                    <input type="text" name="nombre_usuario" class="form-control" required placeholder="Ej: ana_moreno">
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control" required placeholder="correo@ejemplo.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required placeholder="Contraseña">
                </div>
                <div class="mb-3">
                    <label class="form-label">ID Puesto</label>
                    <input type="number" name="puesto_id" class="form-control" required value="1">
                </div>
                <div class="mb-3">
                    <label class="form-label">ID Rol</label>
                    <input type="number" name="roles_id" class="form-control" required value="1">
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('/usuarios') ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>