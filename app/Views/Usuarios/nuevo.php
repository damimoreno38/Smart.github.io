<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #c03c3c 0%, #7d2525 100%) !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-card { 
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25) !important;
            padding: 2.5rem !important;
        }

        /* Título de la tarjeta */
        .register-card h3 {
            color: #222120;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .form-label {
            font-weight: 600;
            color: #222120;
            font-size: 0.9rem;
        }

        /* Campos de texto y contraseña */
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1.5px solid #e2e8f0;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #c03c3c;
            box-shadow: 0 0 0 4px rgba(192, 60, 60, 0.15);
        }

        /* Botón principal Registrarse */
        .btn-custom-save { 
            background-color: #222120; 
            color: white; 
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-custom-save:hover { 
            background-color: #c03c3c; 
            color: white; 
            transform: translateY(-1px);
        }

        /* Enlace de volver al */
        .btn-back-login {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            text-align: center;
            font-weight: 500;
            color: #222120;
            background-color: transparent;
            border: none;
            text-decoration: none;
            transition: color 0.2s;
        }

        .btn-back-login:hover {
            color: #c03c3c;
        }

        /* Alertas estéticas */
        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
            border: none;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 register-card shadow">
        <h3 class="mb-4 text-center">Registro Nuevo Usuario</h3>
        
        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <form action="<?= base_url('/usuarios/guardar') ?>" method="post">
            <div class="mb-3">
                <label class="form-label">CURP</label>
                <input type="text" name="curp" value="<?= old('curp') ?>" class="form-control" maxlength="18" required placeholder="Ingresa la CURP">
            </div>
            <div class="mb-4">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required placeholder="Contraseña">
            </div>
            <input type="hidden" name="puesto_id" value="1">
            <input type="hidden" name="roles_id" value="1">
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-custom-save">Registrarse</button>
                <a href="<?= base_url('/') ?>" class="btn-back-login">Volver al Login</a>
            </div>
        </form>
    </div>
</body>
</html>