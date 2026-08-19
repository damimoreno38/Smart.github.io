<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal - SMART</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { 
            background: linear-gradient(135deg, #c03c3c 0%, #7d2525 100%) !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .dashboard-container {
            width: 100%;
            max-width: 800px;
        }

        /* Tarjeta de Bienvenida Superior */
        .welcome-card {
            background: #ffffff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25) !important;
            padding: 2rem !important;
        }

        .welcome-card h1 {
            color: #222120;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .welcome-card p {
            color: #626367;
            font-size: 1rem;
        }

        /* Tarjetas de Opciones (Grid interactivo) */
        .option-card {
            background: #ffffff;
            border-radius: 16px;
            border: none;
            padding: 1.8rem;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            height: 100%;
        }

        .option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
            background-color: #fafafa;
        }

        .option-icon {
            font-size: 2.5rem;
            color: #c03c3c;
            margin-bottom: 1rem;
            background: rgba(192, 60, 60, 0.1);
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .option-card:hover .option-icon {
            background: #c03c3c;
            color: #ffffff;
        }

        .option-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #222120;
            margin-bottom: 0.5rem;
        }

        .option-card p {
            font-size: 0.85rem;
            color: #626367;
            margin-bottom: 0;
        }

        /* Botón de Cerrar Sesión VISIBLE y destacado */
        .btn-logout {
            background-color: #222120;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .btn-logout:hover {
            background-color: #c03c3c;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body class="d-flex flex-column justify-content-center align-items-center py-5">

    <div class="dashboard-container d-flex flex-column gap-4 px-3">

        <!-- Header / Tarjeta de Bienvenida -->
        <div class="welcome-card d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="h3 mb-1">Panel Principal</h1>
                <p class="mb-0">Bienvenido al sistema, <strong>Smart User</strong></p>
            </div>
            <!-- Botón de Cerrar Sesión corregido con fondo sólido -->
            <a href="<?= base_url('login') ?>" class="btn-logout">
                <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
            </a>
        </div>

        <!-- Sección de Módulos (Grid de Opciones) -->
        <div class="row g-3">
            <!-- Opción 1: Gestión de Usuarios -->
            <div class="col-md-6">
                <a href="<?= base_url('usuarios') ?>" class="option-card">
                    <div class="option-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3>Gestión de Usuarios</h3>
                    <p>Administra permisos, cuentas y perfiles del sistema.</p>
                </a>
            </div>

            <!-- Opción 2: Visualizar Mapa -->
            <div class="col-md-6">
                <a href="<?= base_url('mapa') ?>" class="option-card">
                    <div class="option-icon">
                        <i class="bi bi-map-fill"></i>
                    </div>
                    <h3>Visualizar Mapa</h3>
                    <p>Monitorea y consulta las ubicaciones en tiempo real.</p>
                </a>
            </div>
        </div>

    </div>

</body>
</html>