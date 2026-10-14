<!DOCTYPE html>
<html class="dark" lang="es">
<head>
  <!-- DECLARACIÓN DEL TIPO DE DOCUMENTO Y CONFIGURACIÓN DEL IDIOMA ESPAÑOL -->
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Gestión de Usuarios - Proyecto SMART</title>
  
  <!-- CARGA DE LA LIBRERÍA CSS DE TAILWIND Y LOS ICONOS DE GOOGLE -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- CONFIGURACIÓN DE LA PALETA DE COLORES Y FUENTES PARA TAILWIND -->
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            'smart-bg': '#000000',
            'smart-red': '#c03c3c',
            'smart-card': '#121212',
            'smart-input-bg': '#1a1a1a',
            'smart-border': '#2a2a2a',
            'smart-border-hover': '#404040',
            'smart-text-muted': '#9ca3af', /* Corregido para evitar texto totalmente blanco ilegible en textos secundarios */
          },
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
          },
          boxShadow: {
            'smart-card': '0 10px 30px -10px rgba(0,0,0,0.8)',
          }
        }
      }
    }
  </script>

  <!-- ESTILOS CSS PERSONALIZADOS GENERALES -->
  <style data-purpose="custom-styles">
    /* APLICA LA FUENTE PRINCIPAL AL CUERPO */
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ESTILO DE LA BARRA DE DESPLAZAMIENTO */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    ::-webkit-scrollbar-track {
      background: #000000;
    }
    ::-webkit-scrollbar-thumb {
      background: #2a2a2a;
      border-radius: 9999px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #c03c3c;
    }

    /* CLASE PARA TRANSICIONES SUAVES */
    .smart-transition {
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ESTILOS PERSONALIZADOS PARA LOS INPUTS */
    .input-smart-custom {
      background-color: #1a1a1a !important;
      border: 1px solid #2a2a2a !important;
      color: #ffffff !important;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    .input-smart-custom:focus {
      border-color: #c03c3c !important;
      box-shadow: 0 0 0 2px rgba(192, 60, 60, 0.25) !important;
      outline: none !important;
    }

    /* ESTILOS PARA LOS BOTONES PRINCIPALES */
    .btn-smart-primary {
      background-color: #ffffff;
      color: #000000;
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-smart-primary:hover {
      background-color: #c03c3c;
      color: #ffffff;
      box-shadow: 0 0 20px rgba(192, 60, 60, 0.4);
      transform: translateY(-1px);
    }
    .btn-smart-primary:active {
      transform: translateY(0);
    }

    /* CONFIGURACIÓN PARA LOS ICONOS DE GOOGLE */
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>

<!-- CUERPO PRINCIPAL DE LA PÁGINA -->
<body class="bg-smart-bg text-white min-h-screen p-4 sm:p-6 md:p-8 flex justify-center items-start selection:bg-smart-red selection:text-white">

  <!-- CONTENEDOR PRINCIPAL DE LA VISTA -->
  <div class="bg-smart-card w-full max-w-6xl rounded-2xl shadow-smart-card p-5 sm:p-8 md:p-10 my-4 sm:my-6 border border-smart-border relative overflow-hidden">
    
    <!-- EFECTO VISUAL DE ILUMINACIÓN DE FONDO -->
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-full max-w-2xl h-48 bg-smart-red/10 blur-[100px] pointer-events-none rounded-full"></div>

    <!-- CABECERA CON TÍTULO Y BOTONES DE NAVEGACIÓN -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 sm:mb-8 gap-4 border-b border-smart-border/60 pb-5 sm:pb-6 relative z-10">
      <div>
        <!-- ENLACE CON EL LOGOTIPO HACIA EL DASHBOARD -->
        <a class="flex items-center gap-2.5 mb-2" href="<?= base_url('/dashboard') ?>">
          <svg class="w-6 h-6 text-smart-red flex-shrink-0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" x2="22" y1="12" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
            <path d="M12 2v20"></path>
          </svg>
          <span class="text-xs font-extrabold tracking-wider text-smart-red uppercase leading-none">PROYECTO SMART</span>
        </a>

        <!-- TÍTULO DE LA SECCIÓN -->
        <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold tracking-tight uppercase text-white">Administración de Usuarios</h1>
      </div>
      
      <!-- CONTENEDOR DE BOTONES SUPERIORES -->
      <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
        <!-- BOTÓN PARA REGRESAR AL PANEL ANTERIOR -->
        <a href="<?= base_url('panelinicial') ?>" class="px-3.5 py-2 rounded-lg bg-smart-input-bg border border-smart-border text-xs text-smart-text-muted hover:text-white hover:border-smart-border-hover smart-transition font-semibold flex items-center gap-1.5">
          <span class="material-symbols-outlined text-base">arrow_back</span>
          <span>Volver al Panel</span>
        </a>
        <!-- BOTÓN PARA IR AL FORMULARIO DE NUEVO REGISTRO -->
        <a href="<?= base_url('usuarios/nuevo') ?>" class="btn-smart-primary font-bold py-2 px-4 rounded-lg text-xs inline-flex items-center gap-2 shadow-sm">
          <span class="material-symbols-outlined text-base">person_add</span>
          <span>Registrar Nuevo Usuario</span>
        </a>
      </div>
    </header>

    <!-- SECCIÓN DEL BUSCADOR Y CONTADOR DE REGISTROS -->
    <section class="mb-6 flex flex-col sm:flex-row gap-4 justify-between items-center relative z-10">
      <!-- INPUT DE BÚSQUEDA POR CURP -->
      <div class="relative w-full sm:w-80">
        <input type="text" id="searchInput" placeholder="Buscar por CURP..." class="input-smart-custom w-full rounded-lg py-2.5 px-4 pl-10 text-xs font-medium">
        <span class="material-symbols-outlined text-smart-text-muted absolute left-3 top-2.5 text-lg">search</span>
      </div>
      <!-- CONTADOR TOTAL DE USUARIOS DINÁMICO -->
      <div class="text-xs text-smart-text-muted bg-smart-input-bg/60 border border-smart-border px-3 py-1.5 rounded-md self-end sm:self-auto">
        Total: <strong class="text-white font-bold"><?= !empty($usuarios) ? count($usuarios) : 0 ?></strong> usuarios
      </div>
    </section>

    <!-- CONTENEDOR PRINCIPAL DE LA TABLA -->
    <main class="w-full overflow-x-auto rounded-xl border border-smart-border bg-smart-bg relative z-10">
      <table class="w-full text-left border-collapse" id="tablaUsuarios">
        <!-- CABECERA DE LA TABLA -->
        <thead>
          <tr class="bg-smart-input-bg text-white border-b border-smart-border text-[11px] uppercase tracking-wider font-extrabold">
            <th class="py-3.5 px-6">ID</th>
            <th class="py-3.5 px-6">CURP</th>
            <th class="py-3.5 px-6">Rol</th>
            <th class="py-3.5 px-6">Puesto</th>
            <th class="py-3.5 px-6 text-center">Acciones</th>
          </tr>
        </thead>
        <!-- CUERPO DE LA TABLA CON DATOS DINÁMICOS -->
        <tbody class="divide-y divide-smart-border text-xs">
          <!-- VALIDA SI EXISTEN REGISTROS DE USUARIOS PARA MOSTRARLOS -->
          <?php if(!empty($usuarios) && is_array($usuarios)): ?>
            <?php foreach($usuarios as $user): ?>
              <tr class="hover:bg-smart-input-bg/40 smart-transition">
                <!-- CELDA PARA EL ID DEL USUARIO -->
                <td class="py-3.5 px-6 text-smart-text-muted font-mono text-[11px]">#<?= $user['ID_usuario'] ?></td>
                <!-- CELDA PARA LA CURP DEL USUARIO -->
                <td class="py-3.5 px-6 font-bold tracking-wide text-white font-mono text-xs"><?= htmlspecialchars($user['curp']) ?></td>
                <!-- CELDA PARA EL ROL ASIGNADO -->
                <td class="py-3.5 px-6 text-smart-text-muted font-semibold"><?= htmlspecialchars($user['Tipo_rol'] ?? 'Sin Rol') ?></td>
                <!-- CELDA PARA EL PUESTO ASIGNADO -->
                <td class="py-3.5 px-6 text-smart-text-muted font-semibold"><?= htmlspecialchars($user['Nombre_puesto'] ?? 'Sin Puesto') ?></td>
                <!-- CELDA DE BOTONES DE ACCIÓN POR FILA -->
                <td class="py-3.5 px-6 text-center">
                  <div class="flex items-center justify-center gap-2">
                    <!-- BOTÓN PARA ABRIR EL MODAL DE DETALLES CON DATOS -->
                    <button type="button" onclick="abrirModal('<?= addslashes($user['curp']) ?>', '<?= addslashes($user['Tipo_rol'] ?? '') ?>', '<?= addslashes($user['Nombre_puesto'] ?? '') ?>')" class="bg-smart-input-bg border border-smart-border hover:border-smart-border-hover text-white font-bold py-1.5 px-3 rounded-lg text-[11px] flex items-center gap-1.5 smart-transition">
                      <span class="material-symbols-outlined text-sm">visibility</span>
                      <span>Detalles</span>
                    </button>
                    <!-- BOTÓN PARA ELIMINAR EL REGISTRO CON CONFIRMACIÓN -->
                    <a href="<?= base_url('usuarios/eliminar/'.$user['ID_usuario']) ?>" class="bg-smart-red/10 border border-smart-red/30 text-smart-red hover:bg-smart-red hover:text-white font-bold py-1.5 px-3 rounded-lg text-[11px] flex items-center gap-1.5 smart-transition" onclick="return confirm('¿Deseas eliminar este usuario?')">
                      <span class="material-symbols-outlined text-sm">delete</span>
                      <span>Eliminar</span>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <!-- MENSAJE MOSTRADO SI NO HAY REGISTROS DISPONIBLES -->
            <tr>
              <td colspan="5" class="py-12 text-center text-smart-text-muted font-medium">No hay usuarios registrados.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </main>
  </div>

  <!-- VENTANA MODAL FLOTANTE PARA MOSTRAR DETALLES -->
  <div id="modalDetalles" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden items-center justify-center p-4 z-50">
    <div class="bg-smart-card border border-smart-border w-full max-w-sm rounded-2xl p-6 relative shadow-smart-card">
      <!-- BOTÓN PARA CERRAR LA VENTANA MODAL -->
      <button onclick="cerrarModal()" class="absolute top-4 right-4 text-smart-text-muted hover:text-white transition-colors">
        <span class="material-symbols-outlined text-xl">close</span>
      </button>
      
      <!-- CABECERA DEL MODAL -->
      <div class="flex items-center gap-2 mb-4 border-b border-smart-border pb-3">
        <span class="material-symbols-outlined text-smart-red">account_circle</span>
        <h3 class="text-sm font-extrabold text-white uppercase tracking-wider">Detalles del Usuario</h3>
      </div>

      <!-- CONTENEDOR DE LA INFORMACIÓN DETALLADA -->
      <div class="space-y-3 text-xs">
        <!-- BLOQUE PARA MOSTRAR LA CURP -->
        <div class="bg-smart-bg p-3 rounded-xl border border-smart-border">
          <span class="text-[10px] text-smart-text-muted block font-extrabold uppercase tracking-wider">CURP</span>
          <span id="modalCurp" class="font-mono text-smart-red font-bold text-sm"></span>
        </div>
        <!-- BLOQUE PARA MOSTRAR LA FECHA DE NACIMIENTO CALCULADA -->
        <div class="bg-smart-bg p-3 rounded-xl border border-smart-border">
          <span class="text-[10px] text-smart-text-muted block font-extrabold uppercase tracking-wider">Fecha Nacimiento (Calculada)</span>
          <span id="modalFecha" class="text-white font-medium"></span>
        </div>
        <!-- BLOQUE PARA MOSTRAR EL ROL Y PUESTO -->
        <div class="bg-smart-bg p-3 rounded-xl border border-smart-border">
          <span class="text-[10px] text-smart-text-muted block font-extrabold uppercase tracking-wider">Rol / Puesto</span>
          <span id="modalRolPuesto" class="text-white font-medium"></span>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPTS DE JAVASCRIPT -->
  <script>
    /* FUNCIÓN PARA CALCULAR LA FECHA DE NACIMIENTO A PARTIR DE LA CURP */
    function obtenerFechaDesdeCURP(curp) {
      if (!curp || curp.length < 10) return 'CURP no válida';
      let anio = curp.substring(4, 6);
      let mes = curp.substring(6, 8);
      let dia = curp.substring(8, 10);
      let siglo = '19';
      if (curp.length >= 17 && isNaN(curp.charAt(16))) {
        siglo = '20';
      }
      return `${dia}/${mes}/${siglo}${anio}`;
    }

    /* FUNCIÓN PARA ABRIR Y RELLENAR EL MODAL CON DATOS */
    function abrirModal(curp, rol, puesto) {
      document.getElementById('modalCurp').innerText = curp;
      document.getElementById('modalFecha').innerText = obtenerFechaDesdeCURP(curp);
      document.getElementById('modalRolPuesto').innerText = `${rol} | ${puesto}`;
      const modal = document.getElementById('modalDetalles');
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    /* FUNCIÓN PARA CERRAR EL MODAL */
    function cerrarModal() {
      const modal = document.getElementById('modalDetalles');
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }

    /* FILTRO DINÁMICO EN TIEMPO REAL PARA LA TABLA */
    document.getElementById('searchInput').addEventListener('keyup', function() {
      const filter = this.value.toUpperCase();
      const rows = document.querySelectorAll('#tablaUsuarios tbody tr');
      rows.forEach(row => {
        const curpCell = row.querySelectorAll('td')[1];
        if (curpCell) {
          row.style.display = curpCell.textContent.toUpperCase().includes(filter) ? '' : 'none';
        }
      });
    });
  </script>
</body>
</html>