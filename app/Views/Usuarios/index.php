<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #c03c3c 0%, #7d2525 100%) !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Contenedor estilo tarjeta flotante */
        .container-card {
            background: #ffffff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25) !important;
            padding: 2.5rem !important;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        /* Títulos */
        h2 {
            color: #222120;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        /* Enlace de volver al panel inicial */
        .link-back {
            color: #222120;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .link-back:hover {
            color: #c03c3c;
        }

        /* Botón principal de registro de usuario */
        .btn-success {
            background-color: #222120;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #c03c3c;
            transform: translateY(-1px);
        }

        
        .btn-success:focus, .btn-success:active, .btn-success.active {
            background-color: #c03c3c !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        /* Tabla */
        .table {
            border-radius: 10px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .table-dark {
            background-color: #222120 !important;
            border-color: #222120 !important;
        }

        .table-dark th {
            background-color: #222120 !important;
            border-color: #222120 !important;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 12px 15px;
        }

        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            color: #334155;
        }

        /* Boton de eliminar en tabla */
        .btn-danger {
            background-color: #fee2e2;
            color: #dc2626;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 6px 12px;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            color: #ffffff;
        }

        .btn-danger:focus, .btn-danger:active {
            background-color: #dc2626 !important;
            color: #ffffff !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        /* Alertas esteticas */
        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
            border: none;
        }
    </style>
</head>
<body class="p-4">
    <div class="container container-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h2>Administración de Usuarios</h2>
            <div class="d-flex align-items-center gap-3">
                <a href="<?= base_url('panelinicial') ?>" class="link-back me-2">Volver al Panel Inicial</a>
                <a href="<?= base_url('usuarios/nuevo') ?>" class="btn btn-success">+ Registrar Nuevo Usuario</a>
            </div>
        </div>

        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-info"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>CURP</th>
                        <th>ID Puesto</th>
                        <th>ID Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($usuarios) && is_array($usuarios)): ?>
                        <?php foreach($usuarios as $user): ?>
                            <tr>
                                <td><?= $user['ID_usuario'] ?? '' ?></td>
                                <td><strong><?= $user['curp'] ?? '' ?></strong></td>
                                <td><?= $user['PUESTO_ID_puesto'] ?? '' ?></td>
                                <td><?= $user['ROLES_ID_roles'] ?? '' ?></td>
                                <td>
                                    <a href="<?= base_url('usuarios/eliminar/'.($user['ID_usuario'] ?? '')) ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('¿Deseas eliminar este usuario?')">
                                       Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>