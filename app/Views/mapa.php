<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa StreetMap</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #c03c3c 0%, #c03c3c 100%) !important;
        }

        header {
            background: linear-gradient(135deg, #c03c3c 0%, #c03c3c 100%);
            color: white;
            text-align: center;
            padding: 15px 15px 5px 15px;
        }

        header h1 {
            margin: 0;
            font-weight: 700;
            letter-spacing: -0.5px;
            font-size: 24px;
        }

        header button {
            margin-top: 8px;
            padding: 5px 12px;
            border: none;
            border-radius: 6px;
            background-color: #222120;
            color: white;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        header button:hover {
            background-color: #c03c3c;
            transform: translateY(-1px);
        }

        .container {
            display: flex;
            padding: 20px;
            gap: 15px;
            align-items: flex-start;
        }

        .sidebar {
            width: 170px;
            background: transparent;
            padding: 0;
            box-shadow: none;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .sidebar h3 {
            text-align: left;
            margin-top: 0;
            margin-bottom: 20px;
            color: white;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding-left: 2px;
        }

        .sidebar button {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            position: relative;
            background-color: #222120;
            transition: all 0.3s ease;
            text-align: left;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar button:hover {
            background-color: #a02e2e;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.3);
        }

        #map {
            height: 650px;
            flex: 1;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .leaflet-tile {
            filter: brightness(1.4);
        }

        .badge {
            position: absolute;
            top: 50%;
            right: 8px;
            transform: translateY(-50%);
            background: #c03c3c;
            color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            line-height: 16px;
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .sidebar button:hover .badge {
            background: #222120;
        }

       
        .leaflet-popup-content button {
            padding: 4px 10px;
            margin: 2px 0;
            font-size: 11px;
            border: none;
            border-radius: 6px;
            background-color: #222120;
            color: white;
            cursor: pointer;
            transition: background 0.2s;
        }

        .leaflet-popup-content button:hover {
            background-color: #c03c3c;
        }
    </style>
</head>
<body>

    <header>
        <h1>SMART WEB</h1>
        <button onclick="location.href='/panelinicial'">
            Regresar al Panel Inicial
        </button>
    </header>

    <div class="container">

        <div class="sidebar">
            <h3><center>Opciones</center></h3>

            <button class="atendidos" onclick="mostrarAtendidos()">
                Problemas Atendidos
                <span id="badgeAtendidos" class="badge">0</span>
            </button>

            <button class="sin-atender" onclick="mostrarSinAtender()">
                Problemas Sin Atender
                <span id="badgeSinAtender" class="badge">0</span>
            </button>

            <button class="pendientes" onclick="mostrarPendientes()">
                Problemas Pendientes 
                <span id="badgePendientes" class="badge">0</span>
            </button>
        </div>

        <div id="map"></div>

    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        const map = L.map('map').setView([19.40061, -99.01483], 14);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            maxZoom: 30,
            attribution: '&copy; OpenStreetMap &copy; CARTO'
        }).addTo(map);

        function guardarEstado(punto, color) {
            localStorage.setItem(punto, color);
        }

        function cargarEstado(punto, marcador) {
            const colorGuardado = localStorage.getItem(punto);

            if (colorGuardado) {
                marcador.setStyle({
                    color: colorGuardado,
                    fillColor: colorGuardado
                });
            }
        }

        function contarProblemas(color) {
            let contador = 0;

            for (let i = 1; i <= 6; i++) {
                const estado = localStorage.getItem("punto" + i);

                if (estado === color) {
                    contador++;
                }
            }
            return contador;
        }

        function actualizarBurbujas() {
            document.getElementById("badgeAtendidos").textContent =
            contarProblemas("green");

            document.getElementById("badgeSinAtender").textContent =
            contarProblemas("red");

            document.getElementById("badgePendientes").textContent =
            contarProblemas("yellow");
        }
        actualizarBurbujas();

        const punto1 = L.circleMarker([19.4059, -99.0315], {
            radius: 4,
            fillColor: "red",
            color: "red",
            weight: 2,
            fillOpacity: 0.4
        }).addTo(map)
        punto1.bindPopup(`
        <b>Drenaje en mal estado</b><br><br>
        <button onclick="atenderReporte1()">
        Atender
        </button>
        <button onclick="ponerPendiente1()">
        Pendiente
        </button>
        <button onclick="noatendido1()">
        No Atendido
        </button>
        `);

        cargarEstado("punto1", punto1);

        function atenderReporte1(){
            punto1.setStyle({
                color: "green",
                fillColor: "green"
            });
            guardarEstado("punto1", "green");
        }

        function ponerPendiente1(){
            punto1.setStyle({
                color: "yellow",
                fillColor: "yellow"
            });
            guardarEstado("punto1", "yellow");
        }

        function noatendido1(){
            punto1.setStyle({
                color: "red",
                fillColor: "red"
            });
            guardarEstado("punto1", "red");
        }

        const punto2 = L.circleMarker([19.3997, -99.0362], {
            radius: 4,
            fillcolor: "red",
            color: "red",
            weight: 2,
            fillOpacity: 0.4
        }).addTo(map)
        punto2.bindPopup(`
        <b>Falla de luz</b><br><br>
        <button onclick="atenderReporte2()">
        Atender
        </button>
        <button onclick="ponerPendiente2()">
        Pendiente
        </button>
        <button onclick="noatendido2()">
        No Atendido
        </button>
        `);

        cargarEstado("punto2", punto2);

        function atenderReporte2(){
            punto2.setStyle({
                color: "green",
                fillcolor: "green"
            });

            guardarEstado("punto2", "green");
        }

        function ponerPendiente2(){
            punto2.setStyle({
                color: "yellow",
                fillcolor: "yellow"
            });

            guardarEstado("punto2", "yellow");
        }

        function noatendido2(){
            punto2.setStyle({
                color: "red",
                fillcolor: "red"
            });

            guardarEstado("punto2", "red");
        }

        const punto3 = L.circleMarker([19.4103, -99.0138], {
            radius: 4,
            fillcolor: "red",
            color: "red",
            weight: 2,
            fillOpacity: 0.4
        }).addTo(map)
        punto3.bindPopup(`
        <b>Inundacion detectada</b><br><br>
        <button onclick="atenderReporte3()">
        Atender
        </button>
        <button onclick="ponerPendiente3()">
        Pendiente
        </button>
        <button onclick="noatendido3()">
        No Atendido
        </button>
        `);

        cargarEstado("punto3", punto3);

        function atenderReporte3(){
            punto3.setStyle({
                color: "green",
                fillcolor: "green"
            });

            guardarEstado("punto3", "green");
        }

        function ponerPendiente3(){
            punto3.setStyle({
                color: "yellow",
                fillcolor: "yellow"
            });

            guardarEstado("punto3", "yellow");
        }

        function noatendido3(){
            punto3.setStyle({
                color: "red",
                fillcolor: "red"
            });

            guardarEstado("punto3", "red");
        }

        const punto4 = L.circleMarker([19.4017, -99.0228], {
            radius: 4,
            fillcolor: "red",
            color: "red",
            weight: 2,
            fillOpacity: 0.4
        }).addTo(map)
        punto4.bindPopup(`
        <b>Tope en mal estado</b><br><br>
        <button onclick="atenderReporte4()">
        Atender
        </button>
        <button onclick="ponerPendiente4()">
        Pendiente
        </button>
        <button onclick="noatendido4()">
        No Atendido
        </button>
        `);

        cargarEstado("punto4", punto4);

        function atenderReporte4(){
            punto4.setStyle({
                color: "green",
                fillcolor: "green"
            });

            guardarEstado("punto4", "green");
        }

        function ponerPendiente4(){
            punto4.setStyle({
                color: "yellow",
                fillcolor: "yellow"
            });

            guardarEstado("punto4", "yellow");
        }

        function noatendido4(){
            punto4.setStyle({
                color: "red",
                fillcolor: "red"
            });

            guardarEstado("punto4", "red");
        }

        const punto5 = L.circleMarker([19.4037, -99.0088], {
            radius: 4,
            fillcolor: "red",
            color: "red",
            weight: 2,
            fillOpacity: 0.4
        }).addTo(map)
        punto5.bindPopup(`
        <b>Poste descompuesto</b><br><br>
        <button onclick="atenderReporte5()">
        Atender
        </button>
        <button onclick="ponerPendiente5()">
        Pendiente
        </button>
        <button onclick="noatendido5()">
        No Atendido
        </button>
        `);

        cargarEstado("punto5", punto5);

        function atenderReporte5(){
            punto5.setStyle({
                color: "green",
                fillcolor: "green"
            });

            guardarEstado("punto5", "green");
        }

        function ponerPendiente5(){
            punto5.setStyle({
                color: "yellow",
                fillcolor: "yellow"
            });

            guardarEstado("punto5", "yellow");
        }

        function noatendido5(){
            punto5.setStyle({
                color: "red",
                fillcolor: "red"
            });

            guardarEstado("punto5", "red");
        }

        const punto6 = L.circleMarker([19.4120, -99.0230], {
            radius: 4,
            fillcolor: "red",
            color: "red",
            weight: 2,
            fillOpacity: 0.4
        }).addTo(map)
        punto6.bindPopup(`
        <b>Banqueta en mal estado</b><br><br>
        <button onclick="atenderReporte6()">
        Atender
        </button>
        <button onclick="ponerPendiente6()">
        Pendiente
        </button>
        <button onclick="noatendido6()">
        No Atendido
        </button>
        `);

        cargarEstado("punto6", punto6);

        function atenderReporte6(){
            punto6.setStyle({
                color: "green",
                fillcolor: "green"
            });

            guardarEstado("punto6", "green");
        }

        function ponerPendiente6(){
            punto6.setStyle({
                color: "yellow",
                fillcolor: "yellow"
            });

            guardarEstado("punto6", "yellow");
        }

        function noatendido6(){
            punto6.setStyle({
                color: "red",
                fillcolor: "red"
            });

            guardarEstado("punto6", "red");
        }

        L.marker([19.40061, -99.01483])
            .addTo(map)
            .bindPopup('Nezayork')
            .openPopup();
    </script>

</body>
</html>