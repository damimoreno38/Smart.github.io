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
            background: linear-gradient(135deg, #161515 0%, #161515 100%) !important;
        }

        header {
            background: linear-gradient(135deg, #161515 0%, #161515 100%);
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
            background-color: #807c79;
            color: black;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        header button:hover {
            background-color: #bdb2b2;
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
            color: black;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            position: relative;
            background-color: #776b6b;
            transition: all 0.3s ease;
            text-align: left;
            box-shadow: 0 4px 10px #776b6b(226, 211, 211, 0.92);
        }

        .sidebar button:hover {
            background-color: #d6c3c3;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(184, 172, 172, 0.3);
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
            background: #151416;
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
            background: #83828a;
        }

       
        .leaflet-popup-content button {
            padding: 4px 10px;
            margin: 2px 0;
            font-size: 11px;
            border: none;
            border-radius: 6px;
            background-color: #161616;
            color: white;
            cursor: pointer;
            transition: background 0.2s;
        }

        .alerta-lateral {
           margin-left: 190px !important;
           margin-top: 80px !important;
        }

        .leaflet-popup-content button:hover {
            background-color: #534e4e;
        }

        #tablaAtendidos {
           flex: 1;
           background: #363636;
           border-radius: 18px;
           padding: 28px;
           box-sizing: border-box;
           color: #363636;
           box-shadow: 0 12px 35px rgba(22, 22, 22, 0.2);
           min-width: 0;
        }
        
        .table-title {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 22px;
        }

        .table-title h2 {
          margin: 0;
          color: #3a3838;
          font-size: 24px;
          font-weight: 700;
          text-transform: uppercase;
        }

        #tablaAtendidos table {
          width: 100%;
          border-collapse: collapse;
        }

        #tablaAtendidos th,
        #tablaAtendidos td {
          border: 1px solid #6f7572;
          padding: 12px;
          text-align: center;
        }

        #tablaAtendidos th {
         background-color: #5e5959;
         color: white;
        }

        #tablaAtendidos td:hover {
         background-color: #141414;
         color: white;
         transition: background-color 0.2s ease;
       }

       #tablaAtendidos tbody td {
         transition: background-color 0.2s ease, color 0.2s ease;
        }

       #tablaAtendidos tbody tr:hover td {
         background-color: #3a3737;
         color: white;
        }

        .contenedor-buscador{
            marguin-bottom: 15xp;
        }

        #buscadorTabla {
            width: 300px;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
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

            <button onclick="volverMapa()">
                Volver al mapa
            </button>
        </div>

        <div id="map"></div>
    
    <div id="tablaAtendidos" style="display:none; flex:1;">
    <h2 style="color:white;">TABLA DE DETALLES</h2>

    <div class="contenedor-buscador">
        <input
             type="text"
             id="buscadorTabla"
             placeholder="Buscar por ID, problema, ubicación o estado..."
            >
        </div>
            Mostrar más líneas

    <table id="tablaDetalles" style="width:100%; background:white; border-collapse:collapse;">
    <thead>
    <tr>

     <th>ID</th>
     <th>Problema</th>
     <th>Ubicación</th>
     <th>Estado</th>

     </tr>
     </thead>
     <tbody id="contenidoTabla">

    </tbody>
    </table>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        const map = L.map('map').setView([19.40061, -99.01483], 14);

        L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
            maxZoom: 30,
            attribution: '&copy; OpenStreetMap &copy; CARTO'
        }).addTo(map);

        let vistaActual = "";

        function guardarEstado(punto, color) {
            localStorage.setItem(punto, color);
            actualizarBurbujas();
        }

        function volverMapa() {
            document.getElementById("tablaAtendidos").style.display = "none";
            document.getElementById("map").style.display = "block";
            map.invalidateSize();
        }

        const buscador = document.getElementById("buscadorTabla");
        buscador.addEventListener("keyup", function(){

            let texto = this.value.toLowerCase();
            let filas = document.querySelectorAll("#tablaDetalles tbody tr");

            filas.forEach(fila => {
                let contenido = fila.textContent.toLowerCase();
                if(contenido.includes(texto)){
                    fila.style.display = "";
                }else {
                    fila.style.display = "none";
                }
            });
        })

        const reportes = [
            {
                id: 1,
                nombre: "Drenaje en mal estado",
                ubicacion: "Alcalcerio y Quinta Avenida"
            },
            {
                id: 2,
                nombre: "Falla de luz",
                ubicacion: "Ixtapan y Coatepec"
            },
            {
                id: 3,
                nombre: "Inundacion detectada",
                ubicacion: "Ixtapan y Coatepec"
            },
            {
                id: 4,
                nombre: "Tope en mal estado",
                ubicacion: "Basilica de Guadalupe"
            },
            {
                id: 5,
                nombre: "Poste descompuesto",
                ubicacion: "Flores Mexicanas"
            },
            {
                id: 6,
                nombre: "Banqueta en mal estado",
                ubicacion: "Glorieta de Colon"
            }
        ];

        function mostrarAtendidos() {
            vistaActual = "green";
            actualizaTabla();
        }

        function mostrarSinAtender() {
            vistaActual = "red";
            actualizaTabla();
        }

        function mostrarPendientes() {
            vistaActual = "yellow";
            actualizaTabla();
        }

        function actualizaTabla() {

            document.getElementById("map").style.display = "none";
            document.getElementById("tablaAtendidos").style.display = "block";
            
            let html = "";
            reportes.forEach(reporte => {
                const estado = localStorage.getItem("punto" + reporte.id);

                if (estado === vistaActual) {

                let textoEstado = "";
                let colorTexto = "";

                if (estado === "green") {
                   textoEstado = "Atendido";
                   colorTexto = "green";
                }

                if (estado === "red") {
                   textoEstado = "No Atendido";
                   colorTexto = "red";
                }

                if (estado === "yellow") {
                   textoEstado = "Pendiente";
                   colorTexto = "#d4a000";
                }

                html += `
                <tr>
                <td>${reporte.id}</td>
                <td>${reporte.nombre}</td>
                <td>${reporte.ubicacion}</td>
                <td style="color:${colorTexto}">
                ${textoEstado}
                </td>
                </tr>
                `;
            }   
            });

                document.getElementById("contenidoTabla").innerHTML = html;

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
        
        <button onclick="atenderReporte1()">
        Atender
        </button>
        <button onclick="ponerPendiente1()">
        Pendiente
        </button>
        <button onclick="noatendido1()">
        No Atendido
        </button>
        <button onclick="iconoalerta1()">
        📋
        </button>
        `);

        cargarEstado("punto1", punto1);

        function iconoalerta1(){

        const reporte = reportes.find(r => r.id === 1);

            Swal.fire({
            title: reporte.nombre,
            text: reporte.ubicacion,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image"
        });
        }

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
        
        <button onclick="atenderReporte2()">
        Atender
        </button>
        <button onclick="ponerPendiente2()">
        Pendiente
        </button>
        <button onclick="noatendido2()">
        No Atendido
        </button>
        <button onclick="iconoalerta2()">
        📋
        </button>
        `);

        cargarEstado("punto2", punto2);

        function iconoalerta2(){

        const reporte = reportes.find(r => r.id === 2);
        
            Swal.fire({
            title: reporte.nombre,
            text: reporte.ubicacion,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image"
        });
        }

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

        <button onclick="atenderReporte3()">
        Atender
        </button>
        <button onclick="ponerPendiente3()">
        Pendiente
        </button>
        <button onclick="noatendido3()">
        No Atendido
        </button>
        <button onclick="iconoalerta3()">
        📋
        </button>
        `);

        cargarEstado("punto3", punto3);

        function iconoalerta3(){

        const reporte = reportes.find(r => r.id === 3);

            Swal.fire({
            title: reporte.nombre,
            text: reporte.ubicacion,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image"
        });
        }

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
        
        <button onclick="atenderReporte4()">
        Atender
        </button>
        <button onclick="ponerPendiente4()">
        Pendiente
        </button>
        <button onclick="noatendido4()">
        No Atendido
        </button>
        <button onclick="iconoalerta4()">
        📋
        </button>
        `);

        cargarEstado("punto4", punto4);

        function iconoalerta4(){

        const reporte = reportes.find(r => r.id === 4);

            Swal.fire({
            title: reporte.nombre,
            text: reporte.ubicacion,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image"
        });
        }

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
        
        <button onclick="atenderReporte5()">
        Atender
        </button>
        <button onclick="ponerPendiente5()">
        Pendiente
        </button>
        <button onclick="noatendido5()">
        No Atendido
        </button>
        <button onclick="iconoalerta5()">
        📋
        </button>
        `);

        cargarEstado("punto5", punto5);

        function iconoalerta5(){

        const reporte = reportes.find(r => r.id === 5);   

            Swal.fire({
            title: reporte.nombre,
            text: reporte.ubicacion,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image"
        });
        }

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
        
        <button onclick="atenderReporte6()">
        Atender
        </button>
        <button onclick="ponerPendiente6()">
        Pendiente
        </button>
        <button onclick="noatendido6()">
        No Atendido
        </button>
        <button onclick="iconoalerta6()">
        📋
        </button>
        `);

        cargarEstado("punto6", punto6);

        function iconoalerta6(){

        const reporte = reportes.find(r => r.id === 6);

            Swal.fire({
            title: reporte.nombre,
            text: reporte.ubicacion,
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: "Custom image"
        });
        }

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