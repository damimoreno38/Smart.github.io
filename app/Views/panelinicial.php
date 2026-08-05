<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL INICIAL</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Segoe UI, Arial, sans-serif;
            background: #626367;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Contenedor de las tarjetas */
        .wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 90%;
            max-width: 600px;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,.1);
            text-align: center;
        }

        h1 {
            color: #eb2525;
            margin-bottom: 15px;
        }

        p {
            color: #555;
            margin-bottom: 25px;
        }

        .btn {
            display: inline-block;
            background: #eb2c25;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            margin: 5px;
        }

        .btn:hover {
            background: #d82d1d;
        }
    </style>
</head>
<body>

    <div class="wrapper">

        <!-- Tarjeta principal -->
        <div class="container">
            <h1>Panel Inicial</h1>
            <p>Bienvenido a Smart</p>
        </div>

        <!-- Segunda tarjeta -->
        <div class="container">
            <h2>OPCIONES</h2>
            <p>Seleccione una acción</p>

            <a href="<?= base_url('usuarios') ?>" style="margin: 5px;">
                <button>Gestión de Usuarios</button>
            </a>
            <a href="<?= base_url('mapa') ?>" style="margin: 5px;">
                <button>Visualizar mapa</button>
            </a>
        </div>
    </div>

</body>
</html>