<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Administración de Usuarios</h2>
            <div>
                <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary me-2">Volver al Login</a>
                <a href="<?= base_url('usuarios/crear') ?>" class="btn btn-success">+ Registrar Nuevo Usuario</a>
            </div>
            <a href="<?= base_url('/usuarios/crear') ?>" class="btn btn-success">+ Registrar Nuevo Usuario</a>
        </div>

        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-info"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
<<<<<<< HEAD
                    <th>CURP</th>
                    <th>ID Puesto</th>
                    <th>ID Rol</th>
=======
                    <th>Nombre de Usuario</th>
                    <th>Correo</th>
                    <th>Puesto ID</th>
                    <th>Rol ID</th>
>>>>>>> 1f9686f8832d9a1eba68d1c5124c451138d9b421
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($usuarios) && is_array($usuarios)): ?>
                    <?php foreach($usuarios as $user): ?>
                        <tr>
<<<<<<< HEAD
                            <td><?= $user['ID_usuario'] ?? '' ?></td>
                            <td><?= $user['curp'] ?? '' ?></td>
                            <td><?= $user['PUESTO_ID_puesto'] ?? '' ?></td>
                            <td><?= $user['ROLES_ID_roles'] ?? '' ?></td>
                            <td>
                                <a href="<?= base_url('usuarios/eliminar/'.($user['ID_usuario'] ?? '')) ?>" 
=======
                            <td><?= $user['ID_usuario'] ?></td>
                            <td><?= $user['Nombre_usuario'] ?></td>
                            <td><?= $user['Correo'] ?></td>
                            <td><?= $user['PUESTO_ID_puesto'] ?></td>
                            <td><?= $user['ROLES_ID_roles'] ?></td>
                            <td>
                                <a href="<?= base_url('/usuarios/eliminar/'.$user['ID_usuario']) ?>" 
>>>>>>> 1f9686f8832d9a1eba68d1c5124c451138d9b421
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('¿Deseas eliminar este usuario?')">
                                   Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
<<<<<<< HEAD
                        <td colspan="5" class="text-center">No hay usuarios registrados.</td>
=======
                        <td colspan="6" class="text-center">No hay usuarios registrados.</td>
>>>>>>> 1f9686f8832d9a1eba68d1c5124c451138d9b421
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>