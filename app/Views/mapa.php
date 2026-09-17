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

        .swal2-popup{
            background: #2b2b2b !important;
            color: white !important;
        }

        .swal2-title,
        .swal2-html-container{
            color: white !important;
        }

        .swal2-confirm{
            background: #6b6b6b !important;
        }

        .swal2-cancel{
            background: #444 !important;
        }

        .btn-pdf{
        background: #5e5959;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
        font-weight: bold;
        transition: 0.5s;
    }
        .btn-pdf:hover{
        background: #7a7474;
        transform: translateY(-2px);
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

            <button class="pendientes" onclick="generarReporte()">
                Agregar reporte
            </button>

            <button class="pendientes" onclick="mostrarReportes()">
                Reportes
            </button>

            <button onclick="volverMapa()">
                Volver al mapa
            </button>
        </div>

        <div id="registro"></div>

        <div id="map"></div>

    <div id="tablaAtendidos" style="display:none; flex:1;">

    <h2 style="color:white;">TABLA DE DETALLES</h2>

    <button
        id="btnDescargarPDF"
        onclick="descargarPDF()"
        class="btn-pdf"
        style="display:none;">
        📄 Descargar PDF
        </button>
        traca

    <div class="contenedor-buscador">
        <input
             type="text"
             id="buscadorTabla"
             placeholder="Buscar por ID, problema, ubicación o estado..."
            >
        </div>
        traca

    <table id="tablaDetalles" style="width:100%; background:white; border-collapse:collapse;">
    <thead>
    <tr>
        
    <tr id="encabezadoTabla">

     <th>ID</th>
     <th>Problema</th>
     <th>Ubicación</th>
     <th>Estado</th>
     <th>Eliminar</th>

     </tr>
     </thead>
     <tbody id="contenidoTabla">

    </tbody>
    </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
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

            if(vistaActual !== ""){
            actualizaTabla();

        }
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

        function mostrarReportes() {
        document.getElementById("map").style.display = "none";
        document.getElementById("tablaAtendidos").style.display = "block";
        document.getElementById("btnDescargarPDF").style.display = "block";
        document.getElementById("encabezadoTabla").innerHTML = `
        <th>ID</th>
        <th>Problema</th>
        <th>Ubicasion</th>
        <th>Estado</th>
        <th>Hora</th>
        <th>Fecha</th>
        `;

        let html ="";
        const reportesManuales =
        JSON.parse(localStorage.getItem("reportesManuales")) || [];

        reportesManuales.forEach(reporte=>{

            let textoEstado = "No atendido";

            if(reporte.estado == "green"){
                textoEstado = "Atendido";
            }

            if(reporte.estado == "yellow"){
                textoEstado = "Pendiente"
            }

            html +=`
            <tr>
            <td>${reporte.id}</td>
            <td>${reporte.nombre}</td>
            <td>${reporte.ubicacion}</td>
            <td>${textoEstado}</td>
            <td>${reporte.hora||"-"}</td>
            <td>${reporte.fecha||"-"}</td>
            </tr>`;

        });
        document.getElementById("contenidoTabla").innerHTML = html;
    }

    function descargarPDF() {

    const { jsPDF } = window.jspdf;

    const doc = new jsPDF();

    // Título
    doc.setFontSize(18);
    doc.setTextColor(50, 50, 50);

    doc.text("SMART WEB", 105, 20, {
        align: "center"
    });

    doc.setFontSize(14);

    doc.text("Reporte de problemas", 105, 30, {
        align: "center"
    });

    // Obtener reportes
    const reportesManuales =
        JSON.parse(localStorage.getItem("reportesManuales")) || [];

    // Convertir los datos para PDF
    const datos = reportesManuales.map(reporte => {

        let estado = "No atendido";

        if (reporte.estado === "green") {
            estado = "Atendido";
        }

        if (reporte.estado === "yellow") {
            estado = "Pendiente";
        }

        return [
            reporte.id,
            reporte.nombre,
            reporte.ubicacion,
            estado,
            reporte.hora,
            reporte.fecha
        ];
    });

    // Crear tabla
    doc.autoTable({
        head: [
            ["ID", "Problema", "Ubicación", "Estado", "Hora", "Fecha" ]
        ],

        body: datos,

        startY: 40,

        theme: "grid",

        headStyles: {
            fillColor: [94, 89, 89],
            textColor: 255,
            fontStyle: "bold"
        },

        styles: {
            fontSize: 10,
            cellPadding: 4
        },

        alternateRowStyles: {
            fillColor: [240, 240, 240]
        }
    });

    // Fecha
    const fecha = new Date().toLocaleDateString();

    doc.setFontSize(9);

    doc.text(
        "Fecha de generación: " + fecha,
        14,
        doc.lastAutoTable.finalY + 15
    );

    // Descargar
    doc.save("Reporte_SMART_WEB.pdf");
}


        const reportes = [
            {
                id: 1,
                nombre: "Drenaje en mal estado",
                ubicacion: "Alcalcerio y Quinta Avenida"
            },
        ];

        function mostrarAtendidos() {

    document.getElementById("btnDescargarPDF").style.display = "none";
    vistaActual = "green";
    actualizaTabla();
}

        function mostrarSinAtender() {

    document.getElementById("btnDescargarPDF").style.display = "none";
    vistaActual = "red";
    actualizaTabla();
}

        function mostrarPendientes() {

    document.getElementById("btnDescargarPDF").style.display = "none";
    vistaActual = "yellow";
    actualizaTabla();
}

        const puntos = {};

        let modoAgregar = false;

        function generarReporte(){
            modoAgregar = true;

            Swal.fire({
                icon: "info",
                title: "Agregar reporte",
                text: "Haz clic en el mapa para seleccionar la ubicación."
            });
        }

        function cambiarEstadoPunto(punto, id, color) {

        if (!punto) return;

    punto.setStyle({
        color: color,
        fillColor: color
    });
    localStorage.setItem(id + "_estado", color);

    let reportesManuales =
        JSON.parse(localStorage.getItem("reportesManuales")) || [];

    const reporte = reportesManuales.find(r => r.id === id);
    if (reporte) {
        reporte.estado = color;

        localStorage.setItem(
            "reportesManuales",
            JSON.stringify(reportesManuales)
        );
    }

        actualizarBurbujas();
    }

    function crearPopup(punto, reporte) {
    punto.bindPopup(`
        

        <button onclick="
            cambiarEstadoPunto(
            puntos['${reporte.id}'],
            '${reporte.id}',
            'green'
            )
        ">
            Atender
        </button>

        <button onclick="
            cambiarEstadoPunto(
            puntos['${reporte.id}'],
            '${reporte.id}',
            'yellow'
        )
        ">
            Pendiente
        </button>

        <button onclick="
            cambiarEstadoPunto(
            puntos['${reporte.id}'],
            '${reporte.id}',
            'red'
        )
        ">
            No Atendido
        </button>

        <button onclick="mostrarDetalleManual('${reporte.id}')">
            📋
        </button>
    `);
    }

        map.on("click", function(e){

        if (!modoAgregar) return;
        modoAgregar = false;

        Swal.fire({
            title: "Nuevo Reporte",
            html: `
            <input id="nombre" class="swal2-input"
            placeholder="problematica">
            <input id="ubicacion" class="swal2-input"
            placeholder="Ubicacion">
            `,
           showCancelButton: true,
           confirmButtonText: "Agregar",
           cancelButtonText: "Cancelar"

           }).then((result) => {

           if (!result.isConfirmed) return;

        const nombre =
            document.getElementById("nombre").value;

        const ubicacion =
            document.getElementById("ubicacion").value;


        if (!nombre || !ubicacion) {
             Swal.fire({
                icon: "warning",
                title: "Faltan datos",
                text: "Escribe la problemática y la ubicación."
            });

            return;
        }

         const id = "punto_" + Date.now();

         const nuevoPunto = L.circleMarker(
            [e.latlng.lat, e.latlng.lng],
            {
                radius: 4,
                color: "red",
                fillColor: "red",
                weight: 3,
                fillOpacity: 0.4
            }

        ).addTo(map);

        puntos[id] = nuevoPunto;

        crearPopup(nuevoPunto, {
        id: id,
        nombre: nombre,
        ubicacion: ubicacion
    });

        function crearPopup(punto, reporte) {
        punto.bindPopup(`
        <button onclick="

        cambiarEstadoPunto(
        puntos['${reporte.id}'],
        '${reporte.id}',
        'green')">
        Atender

       </button>
       <button onclick="
       cambiarEstadoPunto(
       puntos['${reporte.id}'],
       '${reporte.id}',
       'yellow')">
       Pendiente

       </button>
       <button onclick="
       cambiarEstadoPunto(
       puntos['${reporte.id}'],
       '${reporte.id}',
       'red')">
       No Atendido

       </button>
       <button onclick="mostrarDetalleManual('${reporte.id}')">
       📋
       </button>
    `);
    }

         let reportesManuales =
            JSON.parse(
                localStorage.getItem("reportesManuales")
            ) || [];

             reportesManuales.push({

            id: id,
            nombre: nombre,
            ubicacion: ubicacion,
            lat: e.latlng.lat,
            lng: e.latlng.lng,
            estado: "red",
            fecha: new Date().toLocaleDateString("es-MX"),
            hora: new Date().toLocaleTimeString("es-MX", {
            hour12: false

        })
        });

         localStorage.setItem(
            "reportesManuales",
            JSON.stringify(reportesManuales)
        );

         nuevoPunto.openPopup();


        Swal.fire({
            icon: "success",
            title: "Reporte agregado",
            text: "El reporte se guardó correctamente."
        });

     });

    });

    function cargarReportesManuales() {

    let reportesManuales =
        JSON.parse(localStorage.getItem("reportesManuales")) || [];

    reportesManuales.forEach(reporte => {

        const punto = L.circleMarker(
            [reporte.lat, reporte.lng],
            {
                radius: 4,
                color: reporte.estado,
                fillColor: reporte.estado,
                weight: 3,
                fillOpacity: 0.4
            }
        ).addTo(map);

        puntos[reporte.id] = punto;

        crearPopup(punto, reporte);
    });
}

    function actualizaTabla() {

    const mostrarEliminar = (vistaActual === "green");

    document.getElementById("encabezadoTabla").innerHTML = `
    <th>ID</th>
    <th>Problema</th>
    <th>Ubicación</th>
    <th>Estado</th>
    ${mostrarEliminar ? "<th>Eliminar</th>" : ""}
    `;

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
                <td>${textoEstado}</td>
                ${mostrarEliminar ? `
                <td>
                <button onclick="eliminarReporte('${reporte.id}')">
                🗑️
                </button>
                </td>
                ` : ""}
            </tr>`;
            }
        });

    const reportesManuales =
        JSON.parse(localStorage.getItem("reportesManuales")) || [];

    reportesManuales.forEach(reporte => {

        if (reporte.estado === vistaActual) {

            let textoEstado = "";

            if (reporte.estado === "green")
                textoEstado = "Atendido";

            if (reporte.estado === "red")
                textoEstado = "No Atendido";

            if (reporte.estado === "yellow")
                textoEstado = "Pendiente";

            html += `
            <tr>
                <td>${reporte.id}</td>
                <td>${reporte.nombre}</td>
                <td>${reporte.ubicacion}</td>
                <td>${textoEstado}</td>
                ${mostrarEliminar ? `
            <td>
            <button onclick="eliminarReporte('${reporte.id}')">
            Mandar al papoi 🗑️
            </button>
            </td>
            ` : ""}
        </tr>`;
        }
    });

    document.getElementById("contenidoTabla").innerHTML = html;
}

        function eliminarReporte(id) {
        Swal.fire({

        title: "¿Eliminar reporte?",
        text: "Esta acción no se puede deshacer",
        icon: "Cuidado",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar"

        }).then((result) => {
        if (!result.isConfirmed) return;
        let reportesManuales =
        JSON.parse(localStorage.getItem("reportesManuales")) || [];

        reportesManuales =
        reportesManuales.filter(r => r.id !== id);

        localStorage.setItem(
        "reportesManuales",
        JSON.stringify(reportesManuales)
    );
       location.reload();
    });
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

        function mostrarDetalleManual(id) {

    let reportesManuales =
        JSON.parse(localStorage.getItem("reportesManuales")) || [];

    const reporte = reportesManuales.find(r => r.id === id);

    if (!reporte) return;

    Swal.fire({
        title: reporte.nombre,
        text: reporte.ubicacion,
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Reporte"
    });
}

        function contarProblemas(color) {
            let contador = 0;

            for (let i = 1; i <= 1; i++) {
                const estado = localStorage.getItem("punto" + i);

                if (estado === color) {
                    contador++;
                }
            }
            const reportesManuales =
            JSON.parse(localStorage.getItem("reportesManuales")) || [];
            reportesManuales.forEach(reporte => {
            if(reporte.estado === color){
            contador++;
        }

        });
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

        cargarReportesManuales();

        L.marker([19.40061, -99.01483])
            .addTo(map)
            .bindPopup('Nezayork')
            .openPopup();
    </script>

</body>
</html>