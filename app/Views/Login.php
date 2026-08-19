<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { 
            background: linear-gradient(135deg, #c03c3c 0%, #7d2525 100%) !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-custom {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25) !important;
            padding: 2.5rem !important;
        }

        /* Título del proyecto */
        .card-custom h3 {
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

        /* Enlace secundario (¿Olvidaste tu contraseña?) */
        a.small {
            color: #222120;
            font-weight: 500;
            transition: color 0.2s;
        }

        a.small:hover {
            color: #c03c3c;
        }

        /* Botón principal de Ingresar */
        .btn-primary {
            background-color: #222120;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #c03c3c;
            transform: translateY(-1px);
        }


        .btn-primary:focus, .btn-primary:active {
            background-color: #c03c3c !important;
            border-color: transparent !important;
            box-shadow: none !important;
        }

        /* Botón personalizado de Registro */
        .btn-custom-register {
            display: block;
            width: 100%;
            margin-top: 15px;
            padding: 12px;
            text-align: center;
            font-weight: 600;
            color: #ffffff;
            background-color: #222120;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-custom-register:hover {
            background-color: #c03c3c;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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
    <div class="card shadow card-custom">
        <h3 class="text-center mb-4">Proyecto SMART</h3>

        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger text-center"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <?php if(session()->getFlashdata('success')):?>
            <div class="alert alert-success text-center"><?= session()->getFlashdata('success') ?></div>
        <?php endif;?>

        <form action="<?= base_url('/login/auth') ?>" method="post">
            <div class="mb-3">
                <label for="curp" class="form-label">CURP</label>
                <input type="text" name="curp" class="form-control" id="curp" required placeholder="Ingresa tu CURP" maxlength="18">
            </div>
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label mb-0">Contraseña</label>
                    <a href="<?= base_url('login/forgot-password') ?>" class="text-decoration-none small">¿Olvidaste tu contraseña?</a>
                </div>
                <input type="password" name="password" class="form-control" id="password" required placeholder="Ingresa tu contraseña">
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            
            <a href="<?= base_url('/usuarios/nuevo') ?>" class="btn-custom-register">¿No tienes cuenta? Regístrate aquí</a>
        </form>
    </div>
</body>
</html>