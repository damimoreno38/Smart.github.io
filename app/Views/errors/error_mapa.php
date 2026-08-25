<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error en Mapa</title>
    <style>
        body{
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #c03c3c 0%, #c03c3c 100%) !important;
        }

        header{
            background: linear-gradient(135deg, #c03c3c 0%, #c03c3c 100%);
            color: white;
            text-align: center;
            padding: 20px 20px 15px 15px;
        }

        header h1 {
            margin: 0;
            font-weight: 15000;
            letter-spacing: -0.5px;
            font-size: 50px;
        }

        header h2{
            margin: 0;
            font-size: 30;
            font-weight: 15000;
        }

        .welcome-card {
            background: #1b1a1a;
            border-radius: 50px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25) !important;
            padding:5px 50px 100px;
        }

        .welcome-card {
            margin-top: 30px;
        }

        .imagen-error {
           width: 300px;
           display: block;
           margin: 0 auto 20px auto;
        }

        #map{
            height:600px;
            width:100%;
        }

    </style>
</head>
<body>

<header>
    <h1>ERROR MAPA</h1>
     <div>
    <a href="<?= base_url('panelinicial') ?>" style="margin: 30px;">
                <button>Panel Inicial</button>
            </a>

    <div class="welcome-card">

    <img src="data:image/png;base64,<?= base64_encode(file_get_contents(APPPATH . 'Views/errors/soy el mapa.png')) ?>"
         alt="Error en el mapa"
         class="imagen-error">

    <div>
        <h2 class="h3 mb-1">
            Lo sentimos, tenemos problemas con el contenido del mapa
        </h2>

        <p class="mb-0">
            Estamos trabajando para que este apartado funcione nuevamente
        </p>
    </div>


</header>


<script>
    
    
</script>

</body>
</html>