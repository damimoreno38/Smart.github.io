<?php

/* la wea de la configuracion de los roles*/ 

$session = session();

/*Leer el rol desde las claves que puede utilizar el sistema*/

$rolSesion = $session->get('role');

if ($rolSesion === null || $rolSesion === '') {
    $rolSesion = $session->get('role_id');
}

if ($rolSesion === null || $rolSesion === '') {
    $rolSesion = $session->get('rol');
}

/* Normalizar el valor para evitar diferencias entre "1" y 1.*/

$rolNormalizado = strtolower(trim((string) ($rolSesion ?? '')));

/*Ajusta estos valores a los que realmente utiliza tu aplicación*/

$esAdmin = in_array(
    $rolNormalizado,['1', 'admin', 'administrador'],
    true
);

$esOperador = in_array(
    $rolNormalizado, ['2', 'operador'],
    true
);

$rol = is_numeric($rolNormalizado)? (int) $rolNormalizado
    : 0;

/* las meras urls que se ocupan */

$urlMapa = site_url('mapa');
$urlCrearReporte = site_url('mapa/crear');
$urlMisReportes = site_url('mapa/mis-reportes');
$urlGestion = site_url('mapa/gestion');
$urlCambiarEstado = site_url('mapa/cambiar-estado');
$urlEliminarReporte = site_url('mapa/eliminar');
$urlReportes = site_url('reportes');
$urlPanel = site_url('panelinicial');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mapa StreetMap - SMART WEB</title>

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css">

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #000;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #000;
            color: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #1a1a1a;
            flex-wrap: wrap;
            gap: 10px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            color: #c03c3c;
            font-size: 38px;
        }

        .logo-title {
            color: #fff;
            font-weight: 800;
            font-size: 16px;
            letter-spacing: .5px;
            line-height: 1.1;
        }

        .logo-subtitle {
            color: #888;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .5px;
            margin-top: 3px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        button {
            cursor: pointer;
            font-family: inherit;
        }

        .header-actions button {
            padding: 9px 14px;
            border: none;
            border-radius: 6px;
            background: #c03c3c;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .header-actions button:hover {
            background: #a82e2e;
            transform: translateY(-1px);
        }

        .btn-desplegable {
            display: none;
            background: #333 !important;
        }

        .container {
            display: flex;
            padding: 20px;
            gap: 20px;
            flex: 1;
            position: relative;
            min-width: 0;
            align-items: flex-start;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .6);
            backdrop-filter: blur(2px);
            z-index: 9998;
        }

        .sidebar-overlay.activo {
            display: block;
        }

        .sidebar {
            width: 220px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: transform .3s ease;
            z-index: 9999;
        }

        .sidebar h3 {
            margin: 0 0 10px;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .sidebar button {
            width: 100%;
            padding: 12px 14px;
            border: none;
            border-radius: 10px;
            color: #e8e5eb;
            font-size: 14px;
            font-weight: 600;
            background: #111;
            transition: .3s;
            text-align: left;
            box-shadow: 0 4px 10px rgba(119, 107, 107, .2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar button:hover {
            background: #c03c3c;
            transform: translateY(-1px);
        }

        .badge {
            background: #333;
            color: #fff;
            border-radius: 50%;
            min-width: 20px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            padding: 0 4px;
        }

        #map {
            height: calc(100vh - 120px);
            min-height: 450px;
            flex: 1;
            min-width: 0;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .4);
            overflow: hidden;
            z-index: 1;
        }

        .leaflet-tile {
            filter: brightness(1.1);
        }

        .leaflet-popup-content-wrapper,
        .leaflet-popup-tip {
            background: #222;
            color: #fff;
        }

        .leaflet-popup-content {
            overflow-wrap: anywhere;
        }

        .leaflet-popup-content button {
            padding: 6px 10px;
            margin: 3px 2px;
            font-size: 12px;
            border: none;
            border-radius: 6px;
            background: #333;
            color: #fff;
        }

        .leaflet-popup-content button:hover {
            background: #a33b3b;
        }

        #tablaAtendidos {
            flex: 1;
            min-width: 0;
            background: #242323;
            border-radius: 18px;
            padding: 24px;
            color: #fff;
            box-shadow: 0 12px 35px rgba(0, 0, 0, .3);
            overflow-x: auto;
        }

        .table-header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .table-header-container h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .contenedor-buscador {
            margin-bottom: 15px;
        }

        #buscadorTabla {
            width: 100%;
            max-width: 380px;
            padding: 10px 15px;
            border: 1px solid #444;
            background: #181818;
            color: #fff;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        #buscadorTabla:focus {
            border-color: #c03c3c;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        #tablaDetalles {
            width: 100%;
            border-collapse: collapse;
            background: #1a1a1a;
        }

        #tablaDetalles th,
        #tablaDetalles td {
            border: 1px solid #3a3a3a;
            padding: 12px;
            text-align: center;
            overflow-wrap: anywhere;
        }

        #tablaDetalles th {
            background: #444040;
            color: #fff;
        }

        #tablaDetalles tbody tr:hover td {
            background: #333;
        }

        .btn-pdf {
            background: #5e5959;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-pdf:hover {
            background: #777;
        }

        .btn-action {
            background: #802e2e;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
        }

        .btn-action:hover {
            background: #a33b3b;
        }
        
        /* lo de el diseño de la responsividad en los dispositivos */

        @media screen and (max-width: 768px) {
            .btn-desplegable {
                display: inline-block;
            }

            .container {
                padding: 10px;
                flex-direction: column;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 260px;
                height: 100vh;
                background: #000;
                padding: 20px;
                box-shadow: 4px 0 15px rgba(0, 0, 0, .5);
                transform: translateX(-100%);
                overflow-y: auto;
            }

            .sidebar.abierto {
                transform: translateX(0);
            }

            #map {
                width: 100%;
                height: 500px;
                min-height: 350px;
            }

            #tablaAtendidos {
                width: 100%;
                padding: 15px;
            }

            #buscadorTabla {
                max-width: 100%;
            }

            #tablaDetalles thead {
                display: none;
            }

            #tablaDetalles,
            #tablaDetalles tbody,
            #tablaDetalles tr,
            #tablaDetalles td {
                display: block;
                width: 100%;
            }

            #tablaDetalles tr {
                margin-bottom: 15px;
                background: #262626;
                border-radius: 10px;
                padding: 10px;
                border: 1px solid #333;
            }

            #tablaDetalles td {
                text-align: right;
                padding-left: 45%;
                position: relative;
                border: none;
                border-bottom: 1px solid #3a3a3a;
                min-height: 40px;
            }

            #tablaDetalles td:last-child {
                border-bottom: none;
            }

            #tablaDetalles td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 40%;
                font-weight: bold;
                text-align: left;
                color: #b0b0b0;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="logo">
        <span class="material-symbols-outlined logo-icon">language</span>

        <div>
            <div class="logo-title">PROYECTO SMART</div>
            <div class="logo-subtitle">DEVELOPERS ANA AND AXEL</div>
        </div>
    </div>

    <div class="header-actions">
        <button class="btn-desplegable"
                type="button"
                onclick="toggleMenu()">
            ☰ Opciones
        </button>

        <button type="button"
                onclick="window.location.href = URL_PANEL">
            Regresar al Panel Inicial
        </button>
    </div>
</header>

<div class="sidebar-overlay"
     id="sidebarOverlay"
     onclick="toggleMenu()"></div>

<div class="container">

    <nav class="sidebar" id="sidebarMenu">
        <h3>MENÚ</h3>

        <?php if ($esAdmin): ?>
            <button type="button" onclick="mostrarAtendidos()">
                <span>Atendidos</span>
                <span id="badgeAtendidos" class="badge">0</span>
            </button>

            <button type="button" onclick="mostrarSinAtender()">
                <span>Sin atender</span>
                <span id="badgeSinAtender" class="badge">0</span>
            </button>

            <button type="button" onclick="mostrarPendientes()">
                <span>Pendientes</span>
                <span id="badgePendientes" class="badge">0</span>
            </button>
        <?php endif; ?>

        <button type="button" onclick="generarReporte()">
            <span>Agregar reporte</span>
        </button>
        <?php if ($esAdmin): ?>
        <button type="button" onclick="mostrarReportes()">
            <span>Reportes</span>
        </button>
        <?php endif; ?>

        <button type="button" onclick="volverMapa()">
            <span>Volver al mapa</span>
        </button>

    </nav>

    <div id="map"></div>

    <?php if ($esAdmin): ?>

        <section id="tablaAtendidos" style="display:none;">

            <div class="table-header-container">
                <h2 id="tituloTabla">Tabla de detalles</h2>

                <button id="btnDescargarPDF"
                        type="button"
                        onclick="descargarPDF()"
                        class="btn-pdf"
                        style="display:none;">
                    📄 Descargar PDF
                </button>
            </div>

            <div class="contenedor-buscador">
                <input type="text"
                       id="buscadorTabla"
                       placeholder="Buscar por ID, problema, ubicación o estado..."
                       autocomplete="off">
            </div>

            <div class="table-wrapper">
                <table id="tablaDetalles">
                    <thead>
                        <tr id="encabezadoTabla">
                            <th>ID</th>
                            <th>Problema</th>
                            <th>Ubicación</th>
                            <th>Estado</th>
                            <th>acciones</th>
                        </tr>
                    </thead>

                    <tbody id="contenidoTabla"></tbody>
                </table>
            </div>
        </section>
    <?php endif; ?>

</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
'use strict';

/* la configuracion */

const URL_MAPA = <?= json_encode($urlMapa) ?>;
const URL_CREAR_REPORTE = <?= json_encode($urlCrearReporte) ?>;
const URL_MIS_REPORTES = <?= json_encode($urlMisReportes) ?>;
const URL_GESTION = <?= json_encode($urlGestion) ?>;
const URL_CAMBIAR_ESTADO = <?= json_encode($urlCambiarEstado) ?>;
const URL_ELIMINAR_REPORTE = <?= json_encode($urlEliminarReporte) ?>;
const URL_REPORTES = <?= json_encode($urlReportes) ?>;
const URL_PANEL = <?= json_encode($urlPanel) ?>;

const ROL_USUARIO = <?= json_encode($rol) ?>;
const ES_ADMIN = <?= json_encode($esAdmin) ?>;

/* cositas del mapa */

const map = L.map('map').setView([19.40061, -99.01483], 14);

        L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap &copy; CARTO'
        }).addTo(map);

let vistaActual = '';
let modoAgregar = false;

const puntos = Object.create(null);

/* Utilidades varias */

function obtenerReportes() {
    try {
        const datos = JSON.parse(
            localStorage.getItem('reportesManuales') || '[]'
        );

        return Array.isArray(datos) ? datos : [];
    } catch (error) {
        console.error('Error al leer los reportes:', error);
        return [];
    }
}

function guardarReportes(reportes) {
    try {
        localStorage.setItem('reportesManuales', JSON.stringify(reportes));
        return true;
    } catch (error) {
        console.error('Error al guardar los reportes:', error);

        Swal.fire(
            'Error',
            'No se pudieron guardar los datos en el navegador. Comprueba el espacio disponible.',
            'error'
        );

        return false;
    }
}

function escaparHTML(valor) {
    return String(valor ?? '').replace(/[&<>"']/g, caracter => ({
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    })[caracter]);
}

function esVistaGestionDisponible() {
    return ES_ADMIN &&
        document.getElementById('tablaAtendidos') !== null;
}

function cerrarMenuMovil() {
    if (window.innerWidth <= 768) {
        document.getElementById('sidebarMenu').classList.remove('abierto');
        document.getElementById('sidebarOverlay').classList.remove('activo');

        setTimeout(() => map.invalidateSize(), 300);
    }
}

function obtenerTextoEstado(estado) {
    switch (estado) {
        case 'green':
            return 'Atendido';
        case 'yellow':
            return 'Pendiente';
        case 'red':
        default:
            return 'No atendido';
    }
}

function obtenerFechaHora() {
    const ahora = new Date();

    return {
        fecha: ahora.toLocaleDateString('es-MX'),
        hora: ahora.toLocaleTimeString('es-MX', {
            hour12: false
        })
    };
}

/* el menu de los dispositivos responsivos */

function toggleMenu() {
    const sidebar = document.getElementById('sidebarMenu');
    const overlay = document.getElementById('sidebarOverlay');

    sidebar.classList.toggle('abierto');
    overlay.classList.toggle('activo');

    setTimeout(() => map.invalidateSize(), 300);
}

document.querySelectorAll('.sidebar button').forEach(boton => {
    boton.addEventListener('click', cerrarMenuMovil);
});

/* esto es para volver al mapa */

function volverMapa() {
    const tabla = document.getElementById('tablaAtendidos');

    if (tabla) {
        tabla.style.display = 'none';
    }

    document.getElementById('map').style.display = 'block';

    setTimeout(() => map.invalidateSize(), 100);
}

function prepararTabla(titulo, mostrarPDF = false) {
    if (!esVistaGestionDisponible()) {
        return false;
    }

    document.getElementById('tituloTabla').textContent = titulo;

    document.getElementById('btnDescargarPDF').style.display =
        mostrarPDF ? 'inline-block' : 'none';

    document.getElementById('map').style.display = 'none';
    document.getElementById('tablaAtendidos').style.display = 'block';

    document.getElementById('buscadorTabla').value = '';

    return true;
}

function mostrarAtendidos() {
    if (!esVistaGestionDisponible()) return;

    vistaActual = 'green';
    prepararTabla('Reportes atendidos');
    actualizaTabla();
}

function mostrarSinAtender() {
    if (!esVistaGestionDisponible()) return;

    vistaActual = 'red';
    prepararTabla('Reportes sin atender');
    actualizaTabla();
}

function mostrarPendientes() {
    if (!esVistaGestionDisponible()) return;

    vistaActual = 'yellow';
    prepararTabla('Reportes pendientes');
    actualizaTabla();
}

/* todo lo general que tiene que ver con los reoportes */

function mostrarReportes() {
    const tabla = document.getElementById('tablaAtendidos');

    if (!tabla) {
        Swal.fire({
            icon: 'info',
            title: 'Reportes',
            text: 'Tu rol no tiene acceso a la tabla de gestión. Puedes consultar el mapa y agregar reportes.'
        });
        return;
    }

    vistaActual = '';

    prepararTabla('Todos los reportes', true);

    document.getElementById('encabezadoTabla').innerHTML = `
        <th>ID</th>
        <th>Problema</th>
        <th>Ubicación</th>
        <th>Estado</th>
        <th>Hora</th>
        <th>Fecha</th>
    `;

    const reportes = obtenerReportes();
    let html = '';

    reportes.forEach(reporte => {
        const id = escaparHTML(reporte.id);
        const nombre = escaparHTML(reporte.nombre);
        const ubicacion = escaparHTML(reporte.ubicacion);
        const estado = escaparHTML(obtenerTextoEstado(reporte.estado));
        const hora = escaparHTML(reporte.hora || '-');
        const fecha = escaparHTML(reporte.fecha || '-');

        html += `
            <tr>
                <td data-label="ID">${id}</td>
                <td data-label="Problema">${nombre}</td>
                <td data-label="Ubicación">${ubicacion}</td>
                <td data-label="Estado">${estado}</td>
                <td data-label="Hora">${hora}</td>
                <td data-label="Fecha">${fecha}</td>

            </td>    
            </tr>
        `;
    });

    const columnas = ES_ADMIN ? 7 : 6;

    document.getElementById('contenidoTabla').innerHTML = html ||
        `<tr><td colspan="${columnas}">No hay reportes registrados.</td></tr>`;

    aplicarBusqueda();
}

/* lo del buscador de las tablaas */

function aplicarBusqueda() {
    const buscador = document.getElementById('buscadorTabla');

    if (!buscador) return;

    const texto = buscador.value.toLowerCase().trim();

    document.querySelectorAll('#tablaDetalles tbody tr').forEach(fila => {
        fila.style.display =
            fila.textContent.toLowerCase().includes(texto) ? '' : 'none';
    });
}

const buscador = document.getElementById('buscadorTabla');

if (buscador) {
    buscador.addEventListener('input', aplicarBusqueda);
}

/* aqui estan las weas del pdf */

function descargarPDF() {
    if (!esVistaGestionDisponible()) return;

    if (!window.jspdf || !window.jspdf.jsPDF) {
        Swal.fire('Error', 'No se pudo cargar la biblioteca PDF.', 'error');
        return;
    }

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(18);
    doc.setTextColor(50, 50, 50);
    doc.text('SMART WEB', 105, 20, { align: 'center' });

    doc.setFontSize(14);
    doc.text('Reporte de Problemas Registrados', 105, 30, {
        align: 'center'
    });

    const reportes = obtenerReportes();

    const datos = reportes.map(reporte => [
        String(reporte.id ?? ''),
        String(reporte.nombre ?? ''),
        String(reporte.ubicacion ?? ''),
        obtenerTextoEstado(reporte.estado),
        String(reporte.hora || '-'),
        String(reporte.fecha || '-')
    ]);

    doc.autoTable({
        head: [['ID', 'Problema', 'Ubicación', 'Estado', 'Hora', 'Fecha']],
        body: datos,
        startY: 40,
        theme: 'grid',
        headStyles: {
            fillColor: [94, 89, 89],
            textColor: 255,
            fontStyle: 'bold'
        },
        styles: {
            fontSize: 9,
            cellPadding: 3,
            overflow: 'linebreak'
        },
        margin: {
            top: 15,
            right: 14,
            bottom: 20,
            left: 14
        }
    });

    const fecha = new Date().toLocaleDateString('es-MX');

    doc.setFontSize(9);

    let posicion = doc.lastAutoTable.finalY + 15;

    if (posicion > doc.internal.pageSize.getHeight() - 15) {
        doc.addPage();
        posicion = 20;
    }

    doc.text('Fecha de generación: ' + fecha, 14, posicion);

    doc.save('Reporte_SMART_WEB.pdf');
}

/* funciones para agregar los reportes */

function generarReporte() {
    modoAgregar = true;

    Swal.fire({
        icon: 'info',
        title: 'Agregar reporte',
        text: 'Haz clic en el mapa para seleccionar la ubicación exacta.',
        confirmButtonText: 'Entendido'
    });
}
/* estas son las canvan para comprimir los pixeles de las imagenes y no pesen tanto para el almacenamiento del sistema */

function comprimirImagen(file, maxWidth = 800, maxHeight = 800, quality = 0.7) {
    return new Promise((resolve, reject) => {
        if (!file) {
            resolve(null);
            return;
        }

        if (!file.type || !file.type.startsWith('image/')) {
            reject(new Error('El archivo seleccionado no es una imagen.'));
            return;
        }

        const reader = new FileReader();

        reader.onload = event => {
            const img = new Image();

            img.onload = () => {
                let width = img.width;
                let height = img.height;

                if (!width || !height) {
                    reject(new Error('La imagen no tiene dimensiones válidas.'));
                    return;
                }

                if (width > maxWidth || height > maxHeight) {
                    const escala = Math.min(
                        maxWidth / width,
                        maxHeight / height
                    );

                    width = Math.round(width * escala);
                    height = Math.round(height * escala);
                }

                const canvas = document.createElement('canvas');

                canvas.width = width;
                canvas.height = height;

                const ctx = canvas.getContext('2d');

                if (!ctx) {
                    reject(new Error('No se pudo procesar la imagen.'));
                    return;
                }

                ctx.drawImage(img, 0, 0, width, height);

                resolve(canvas.toDataURL('image/jpeg', quality));
            };

            img.onerror = () => reject(
                new Error('No se pudo cargar la imagen.')
            );

            img.src = event.target.result;
        };

        reader.onerror = () => reject(
            new Error('No se pudo leer el archivo.')
        );

        reader.readAsDataURL(file);
    });
}

map.on('click', async function(e) {
    if (!modoAgregar) return;

    modoAgregar = false;

    const result = await Swal.fire({
        title: 'Nuevo reporte',
        html: `
            <input id="nombre"
                   class="swal2-input"
                   placeholder="Problemática"
                   maxlength="150">

            <input id="ubicacion"
                   class="swal2-input"
                   placeholder="Ubicación"
                   maxlength="200">

            <div style="margin-top:15px;text-align:left;">
                <label style="font-size:13px;color:#ccc;">
                    Adjuntar imagen (opcional):
                </label>

                <input type="file"
                       id="imagenReporte"
                       accept="image/*"
                       class="swal2-file"
                       style="width:100%;margin-top:5px;">
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Agregar',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,

        preConfirm: async () => {
            const nombre = document.getElementById('nombre').value.trim();
            const ubicacion = document.getElementById('ubicacion').value.trim();
            const fileInput = document.getElementById('imagenReporte');
            const file = fileInput.files[0];

            if (!nombre || !ubicacion) {
                Swal.showValidationMessage(
                    'Escribe la problemática y la ubicación.'
                );
                return false;
            }

            if (file && file.size > 10 * 1024 * 1024) {
                Swal.showValidationMessage(
                    'La imagen no debe superar los 10 MB.'
                );
                return false;
            }

            try {
                const imagen = await comprimirImagen(file);

                return {
                    nombre,
                    ubicacion,
                    imagen
                };
            } catch (error) {
                Swal.showValidationMessage(
                    error.message || 'No se pudo procesar la imagen.'
                );
                return false;
            }
        }
    });

    if (!result.isConfirmed || !result.value) {
        return;
    }

    const { nombre, ubicacion, imagen } = result.value;
    const { fecha, hora } = obtenerFechaHora();

    const reporte = {
        id: 'punto_' + Date.now() + '_' + Math.random().toString(36).slice(2, 7),
        nombre,
        ubicacion,
        imagen,
        lat: e.latlng.lat,
        lng: e.latlng.lng,
        estado: 'red',
        fecha,
        hora
    };

    const reportes = obtenerReportes();
    reportes.push(reporte);

    if (!guardarReportes(reportes)) return;

    agregarPuntoAlMapa(reporte);
    actualizarBurbujas();

    Swal.fire({
        icon: 'success',
        title: 'Reporte agregado',
        text: 'El reporte se guardó en este navegador.'
    });
});

/* cosas de los puntos y sus popos */

function agregarPuntoAlMapa(reporte) {
    const lat = Number(reporte.lat);
    const lng = Number(reporte.lng);

    if (
        !Number.isFinite(lat) ||
        !Number.isFinite(lng) ||
        lat < -90 ||
        lat > 90 ||
        lng < -180 ||
        lng > 180
    ) {
        return;
    }

    if (puntos[String(reporte.id)]) {
        map.removeLayer(puntos[String(reporte.id)]);
        delete puntos[String(reporte.id)];
    }

    const coloresPermitidos = ['green', 'yellow', 'red'];
    const color = coloresPermitidos.includes(reporte.estado)
        ? reporte.estado
        : 'red';

    const punto = L.circleMarker([lat, lng], {
        radius: 4,
        color,
        fillColor: color,
        weight: 2,
        fillOpacity: 0.8
    }).addTo(map);

    puntos[String(reporte.id)] = punto;

    crearPopup(punto, reporte);
}

function crearPopup(punto, reporte) {
    const contenedor = document.createElement('div');
    contenedor.style.display = 'flex';
    contenedor.style.flexWrap = 'row';
    contenedor.style.gap = '5px';

    if (ES_ADMIN) {
        const btnAtender = document.createElement('button');
        btnAtender.type = 'button';
        btnAtender.textContent = 'Atender';
        btnAtender.onclick = () => cambiarEstadoPunto(reporte.id, 'green');
        contenedor.appendChild(btnAtender);

        const btnPendiente = document.createElement('button');
        btnPendiente.type = 'button';
        btnPendiente.textContent = 'Pendiente';
        btnPendiente.onclick = () => cambiarEstadoPunto(reporte.id, 'yellow');
        contenedor.appendChild(btnPendiente);

        const btnNoAtendido = document.createElement('button');
        btnNoAtendido.type = 'button';
        btnNoAtendido.textContent = 'No atendido';
        btnNoAtendido.onclick = () => cambiarEstadoPunto(reporte.id, 'red');
        contenedor.appendChild(btnNoAtendido);
    }

    const btnDetalle = document.createElement('button');
    btnDetalle.type = 'button';
    btnDetalle.textContent = 'Ver detalle';
    btnDetalle.onclick = () => mostrarDetalleManual(reporte.id);
    contenedor.appendChild(btnDetalle);

    punto.bindPopup(contenedor, { maxWidth: 300 });
}


/* finciones para cambiar de color los puntitouuuuus */

function cambiarEstadoPunto(id, color) {
    if (!ES_ADMIN) {
        Swal.fire(
            'Acceso denegado',
            'Tu rol no puede cambiar el estado de los reportes.',
            'warning'
        );
        return;
    }

    if (!['green', 'yellow', 'red'].includes(color)) {
        return;
    }

    const reportes = obtenerReportes();

    const reporte = reportes.find(
        r => String(r.id) === String(id)
    );

    if (!reporte) {
        Swal.fire('Aviso', 'No se encontró el reporte.', 'info');
        return;
    }

    reporte.estado = color;

    if (!guardarReportes(reportes)) return;

    if (puntos[String(id)]) {
        puntos[String(id)].setStyle({
            color,
            fillColor: color
        });

        crearPopup(puntos[String(id)], reporte);
    }

    actualizarBurbujas();

    const tabla = document.getElementById('tablaAtendidos');

    if (tabla && tabla.style.display === 'block') {
        if (vistaActual) {
            actualizaTabla();
        } else {
            mostrarReportes();
        }
    }
}

/* funciones de los detalles de los reportess */

function mostrarDetalleManual(id) {
    const reporte = obtenerReportes().find(
        r => String(r.id) === String(id)
    );

    if (!reporte) {
        Swal.fire('Aviso', 'No se encontró el reporte.', 'info');
        return;
    }

    const htmlImagen = reporte.imagen
        ? `
            <img
                src="${escaparHTML(reporte.imagen)}"
                alt="Imagen del reporte"
                style="width:100%;max-height:250px;object-fit:contain;border-radius:8px;margin-top:10px;">
        `
        : '<p style="color:#888;font-style:italic;">Sin imagen adjunta</p>';

    Swal.fire({
        title: escaparHTML(reporte.nombre),
        html: `
            <p><strong>Ubicación:</strong> ${escaparHTML(reporte.ubicacion)}</p>
            <p><strong>Estado:</strong> ${escaparHTML(obtenerTextoEstado(reporte.estado))}</p>
            <p><strong>Fecha:</strong> ${escaparHTML(reporte.fecha || '-')}</p>
            <p><strong>Hora:</strong> ${escaparHTML(reporte.hora || '-')}</p>
            ${htmlImagen}
        `,
        icon: 'info'
    });
}

/* tabla por estado de problematica */

function actualizaTabla() {
    if (!esVistaGestionDisponible()) return;

    const mostrarEliminar = ES_ADMIN && vistaActual === 'green';

    document.getElementById('map').style.display = 'none';

    const tabla = document.getElementById('tablaAtendidos');
    tabla.style.display = 'block';

    document.getElementById('encabezadoTabla').innerHTML = `
        <th>ID</th>
        <th>Problema</th>
        <th>Ubicación</th>
        <th>Estado</th>
        ${mostrarEliminar ? '<th>Acciones</th>' : ''}
    `;

    const reportes = obtenerReportes();
    const tbody = document.getElementById('contenidoTabla');

    tbody.innerHTML = '';

    const filtrados = reportes.filter(
        reporte => reporte.estado === vistaActual
    );

    if (filtrados.length === 0) {
        const fila = document.createElement('tr');
        const celda = document.createElement('td');

        celda.colSpan = mostrarEliminar ? 5 : 4;
        celda.textContent = 'No hay reportes en esta categoría.';

        fila.appendChild(celda);
        tbody.appendChild(fila);

        aplicarBusqueda();
        return;
    }

    filtrados.forEach(reporte => {
        const fila = document.createElement('tr');

        const valores = [
            ['ID', reporte.id],
            ['Problema', reporte.nombre],
            ['Ubicación', reporte.ubicacion],
            ['Estado', obtenerTextoEstado(reporte.estado)]
        ];

        valores.forEach(([etiqueta, valor]) => {
            const celda = document.createElement('td');

            celda.dataset.label = etiqueta;
            celda.textContent = String(valor ?? '-');

            fila.appendChild(celda);
        });

        if (mostrarEliminar) {
            const celdaAcciones = document.createElement('td');
            celdaAcciones.dataset.label = 'Acciones';

            const boton = document.createElement('button');
            boton.type = 'button';
            boton.className = 'btn-action';
            boton.textContent = '🗑️ Eliminar';

            boton.addEventListener('click', function () {
                eliminarReporte(reporte.id);
            });

            celdaAcciones.appendChild(boton);
            fila.appendChild(celdaAcciones);
        }

        tbody.appendChild(fila);
    });

    aplicarBusqueda();
}

/* funcion que permite eliminar reportes */

async function eliminarReporte(id) {
    if (!ES_ADMIN) {
        Swal.fire(
            'Acceso denegado',
            'Solo el administrador puede eliminar reportes.',
            'warning'
        );
        return;
    }

    const reportes = obtenerReportes();

    const existe = reportes.some(
        reporte => String(reporte.id) === String(id)
    );

    if (!existe) {
        Swal.fire('Aviso', 'No se encontró el reporte.', 'info');
        return;
    }

    const resultado = await Swal.fire({
        title: '¿Eliminar reporte?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#a33b3b'
    });

    if (!resultado.isConfirmed) return;

    const nuevosReportes = reportes.filter(
        reporte => String(reporte.id) !== String(id)
    );

    if (!guardarReportes(nuevosReportes)) return;

    const punto = puntos[String(id)];

    if (punto) {
        map.removeLayer(punto);
        delete puntos[String(id)];
    }

    actualizarBurbujas();

    const tabla = document.getElementById('tablaAtendidos');

    if (tabla && tabla.style.display !== 'none') {
        if (vistaActual) {
            actualizaTabla();
        } else {
            mostrarReportes();
        }
    }

    Swal.fire(
        'Eliminado',
        'El reporte se ha eliminado correctamente.',
        'success'
    );
}

/*contadores de las burbujas*/

function contarProblemas(color) {
    return obtenerReportes().filter(
        reporte => reporte.estado === color
    ).length;
}

function actualizarBurbujas() {
    if (!ES_ADMIN) return;

    const atendidos = document.getElementById('badgeAtendidos');
    const sinAtender = document.getElementById('badgeSinAtender');
    const pendientes = document.getElementById('badgePendientes');

    if (atendidos) {
        atendidos.textContent = contarProblemas('green');
    }

    if (sinAtender) {
        sinAtender.textContent = contarProblemas('red');
    }

    if (pendientes) {
        pendientes.textContent = contarProblemas('yellow');
    }
}

/* la inicializacion*/

function cargarReportesManuales() {
    obtenerReportes().forEach(reporte => {
        agregarPuntoAlMapa(reporte);
    });
}

window.addEventListener('load', function() {
    cargarReportesManuales();
    actualizarBurbujas();

    L.marker([19.40061, -99.01483])
        .addTo(map)
        .bindPopup('<b>Nezahualcóyotl</b>');

    setTimeout(() => map.invalidateSize(), 200);
});


/*renderizado de las pestaña de los apartados*/

window.addEventListener('storage', function(evento) {
    if (evento.key !== 'reportesManuales') return;

    Object.keys(puntos).forEach(id => {
        map.removeLayer(puntos[id]);
        delete puntos[id];
    });

    cargarReportesManuales();
    actualizarBurbujas();

    const tabla = document.getElementById('tablaAtendidos');

    if (tabla && tabla.style.display === 'block') {
        if (vistaActual) {
            actualizaTabla();
        } else {
            mostrarReportes();
        }
    }
});
</script>

</body>
</html>