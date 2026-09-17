<!-- DECLARACIÓN DEL TIPO DE DOCUMENTO HTML5 -->
<!DOCTYPE html>
<!-- INICIO DEL DOCUMENTO HTML, CONFIGURADO EN MODO OSCURO Y EN IDIOMA ESPAÑOL -->
<html class="dark" lang="es">
<head>
  <!-- DEFINE LA CODIFICACIÓN DE CARACTERES UNIVERSAL UTF-8 PARA EL SITIO WEB -->
  <meta charset="utf-8">
  <!-- CONFIGURA LA VISTA RECEPTIVA (RESPONSIVE) PARA ADAPTAR EL DISEÑO A DISPOSITIVOS MÓVILES -->
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <!-- DEFINE EL TÍTULO QUE SE MUESTRA EN LA PESTAÑA DEL NAVEGADOR -->
  <title>PROYECTO SMART - Mi Perfil</title>

  <!-- CARGA EL FRAMEWORK DE TAILWIND CSS CON SUS PLUGINS DE FORMULARIOS Y CONSULTAS DE CONTENEDOR -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

  <!-- OPTIMIZA LA CONEXIÓN PREVIA HACIA EL SERVIDOR DE FUENTES DE GOOGLE -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <!-- OPTIMIZA LA CONEXIÓN PREVIA AL ORIGEN DE RECURSOS ESTÁTICOS DE GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- IMPORTA EL PAQUETE DE ICONOS VECTORIALES MATERIAL SYMBOLS DE GOOGLE -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
  <!-- IMPORTA LA TIPOGRAFÍA PLUS JAKARTA SANS CON DIVERSOS GROSORES (400 A 800) -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- INICIO DE LA CONFIGURACIÓN PERSONALIZADA DE TAILWIND EN JAVASCRIPT -->
  <script id="tailwind-config">
    // ASIGNA EL OBJETO DE CONFIGURACIÓN GLOBAL DE TAILWIND
    tailwind.config = {
      // ESTABLECE EL MODO OSCURO MEDIANTE LA PRESENCIA DE UNA CLASE CSS EN EL HTML
      darkMode: "class",
      // SECCIÓN DE EXTENSIÓN DE TEMAS PERSONALIZADOS DE TAILWIND
      theme: {
        extend: {
          // DEFINE LA PALETA DE COLORES PERSONALIZADA PARA LA MARCA SMART
          colors: {
            'smart-bg': '#000000', // COLOR DE FONDO PRINCIPAL (NEGRO)
            'smart-red': '#c03c3c', // COLOR ROJO DE ACENTO
            'smart-card': '#121212', // COLOR DE FONDO PARA TARJETAS Y PANELES
            'smart-input-bg': '#1a1a1a', // COLOR DE FONDO PARA CAMPOS DE ENTRADA DE TEXTO
            'smart-border': '#2a2a2a', // COLOR GENERAL DE BORDES
            'smart-border-hover': '#404040', // COLOR DE BORDES EN ESTADO HOVER
            'smart-text-muted': '#9ca3af', // COLOR DE TEXTO SECUNDARIO O ATENUADO
          },
          // DEFINE LA FAMILIA TIPOGRÁFICA PRINCIPAL DEL PROYECTO
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
          },
          // DEFINE SOMBRAS PERSONALIZADAS PARA ELEMENTOS TIPO TARJETA
          boxShadow: {
            'smart-card': '0 10px 30px -10px rgba(0,0,0,0.8)',
          }
        }
      }
    }
  </script>

  <!-- BLOQUE DE ESTILOS CSS PERSONALIZADOS -->
  <style>
    /* APLICA LA FUENTE PRINCIPAL A TODO EL CUERPO DE LA PÁGINA */
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* DEFINE EL ANCHO Y ALTO DE LA BARRA DE DESPLAZAMIENTO (SCROLLBAR) */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    /* DEFINE EL COLOR DE FONDO DEL CANAL DE LA BARRA DE DESPLAZAMIENTO */
    ::-webkit-scrollbar-track {
      background: #000000;
    }
    /* ESTILIZA EL PULGAR O DESLIZADOR DE LA BARRA DE DESPLAZAMIENTO */
    ::-webkit-scrollbar-thumb {
      background: #2a2a2a;
      border-radius: 9999px;
    }
    /* CAMBIA EL COLOR DEL DESLIZADOR AL PASAR EL CURSOR SOBRE ÉL */
    ::-webkit-scrollbar-thumb:hover {
      background: #c03c3c;
    }

    /* CLASE PARA TRANSICIONES SUAVES GENERALES */
    .smart-transition {
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* CLASE DE TRANSICIÓN PARA LOS ELEMENTOS DEL MENÚ DE NAVEGACIÓN */
    .nav-item-smart {
      transition: all 0.2s ease;
    }
    /* ESTILOS INTERACTIVOS (HOVER) PARA LOS BOTONES DE LA BARRA LATERAL */
    .nav-item-smart:hover {
      background-color: #c03c3c !important;
      color: #ffffff !important;
      box-shadow: 0 4px 15px -3px rgba(192, 60, 60, 0.4);
    }
    /* CAMBIA EL COLOR DEL ICONO CUANDO SE PASA EL CURSOR SOBRE EL ELEMENTO DEL MENÚ */
    .nav-item-smart:hover .material-symbols-outlined {
      color: #ffffff !important;
    }

    /* CLASE ESTILO BOTÓN PRINCIPAL CON COLOR BLANCO */
    .btn-smart-primary {
      background-color: #ffffff;
      color: #000000;
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    /* EFECTO HOVER Y ELEVACIÓN EN EL BOTÓN PRINCIPAL */
    .btn-smart-primary:hover {
      background-color: #c03c3c;
      color: #ffffff;
      box-shadow: 0 0 20px rgba(192, 60, 60, 0.4);
      transform: translateY(-1px);
    }

    /* CONFIGURACIÓN MÍNIMA DE REPRESENTACIÓN PARA LOS ICONOS DE MATERIAL SYMBOLS */
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>

<!-- INICIO DEL CUERPO DEL DOCUMENTO CON CLASES DE ESTILIZADO GENERAL EN TAILWIND -->
<body class="bg-smart-bg text-white h-screen flex flex-col font-sans overflow-hidden selection:bg-smart-red selection:text-white">

  <!-- INICIO DEL BLOQUE DE CÓDIGO PHP DE SERVIDOR -->
  <?php
    // ASIGNA LOS DATOS DEL USUARIO O UN ARREGLO VACÍO EN CASO DE NO EXISTIR
    $usr = $usuario ?? [];
    
    // OBTIENE EL NOMBRE DEL USUARIO REVISANDO DIVERSAS CLAVES POSIBLES
    $nombreUsuario = $usr['Nombre'] ?? $usr['nombre'] ?? '';
    // OBTIENE LA CURP DE LA VARIABLE O SESIÓN, ASIGNANDO VALOR POR DEFECTO
    $curpUsuario   = $usr['curp'] ?? session()->get('curp') ?? 'SIN CURP';
    // OBTIENE EL ÁREA O DEPARTAMENTO DEL USUARIO
    $areaUsuario   = $usr['Area'] ?? $usr['area'] ?? '';
    // OBTIENE EL CORREO ELECTRÓNICO REGISTRADO
    $correoUsuario = $usr['Correo'] ?? $usr['correo'] ?? '';
    // OBTIENE EL NOMBRE O RUTA DE LA FOTO DE PERFIL
    $fotoUsuario   = $usr['foto'] ?? '';
    // OBTIENE EL IDENTIFICADOR ÚNICO DE USUARIO BUSCANDO EN VARIAS FUENTES DE DATOS
    $idUsuario     = $usr['ID_usuario'] ?? $usr['id'] ?? session()->get('id') ?? session()->get('id_usuario') ?? 0;

    // DETERMINA QUÉ CADENA SE USARÁ PARA EXTRAER LAS INICIALES DEL AVATAR
    $cadenaIniciales = !empty($nombreUsuario) ? $nombreUsuario : $curpUsuario;
    // EXTRAE LAS PRIMERAS 2 LETRAS Y LAS CONVIERTE A MAYÚSCULAS
    $initials        = strtoupper(substr((string)$cadenaIniciales, 0, 2));

    // CONVIERTE EL ID DE ROL A UN ENTERO (POR DEFECTO ASIGNA ROL 2 = USUARIO)
    $userRole = (int) ($usr['ROLES_ID_roles'] ?? $usr['roles_id'] ?? session()->get('role') ?? 2);

    // GENERA LAS RUTA ABSOLUTAS DE LAS NAVEGACIONES MEDIANTE LA FUNCIÓN DE CODEIGNITER
    $urlPerfil   = base_url('/perfil');
    $urlUsuarios = base_url('/admin/usuarios'); 
    $urlMapa     = base_url('/mapa');
    $urlReportes = base_url('/reportes');
  ?>
  <!-- FIN DEL BLOQUE DE CÓDIGO PHP DE SERVIDOR -->

  <!-- INICIO DE LA BARRA SUPERIOR DE NAVEGACIÓN (HEADER) -->
  <header class="flex justify-between items-center w-full px-4 sm:px-6 md:px-8 h-16 bg-smart-bg/90 backdrop-blur-md border-b border-smart-border flex-shrink-0 z-50">
    
    <!-- CONTENEDOR IZQUIERDO CON LOGOTIPO Y BOTÓN MÓVIL -->
    <div class="flex items-center gap-2 sm:gap-3">
      <!-- BOTÓN PARA DESPLEGAR EL MENÚ EN PANTALLAS PEQUEÑAS (MÓVILES) -->
      <button id="mobile-menu-btn" aria-label="ABRIR MENÚ" class="md:hidden text-smart-text-muted hover:text-white transition-colors focus:outline-none p-1.5 rounded-lg border border-smart-border bg-smart-card">
        <!-- ICONO DE TRES LÍNEAS DE MENÚ -->
        <span class="material-symbols-outlined text-2xl flex items-center justify-center">menu</span>
      </button>

      <!-- ENLACE Y LOGO PRINCIPAL HACIA LA PÁGINA DE INICIO -->
      <a class="flex items-center gap-2.5" href="<?= base_url('/') ?>">
        <!-- LOGO SVG VECTORIAL CON DISEÑO DE MUNDO/RED -->
        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-smart-red flex-shrink-0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="2" x2="22" y1="12" y2="12"></line>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
          <path d="M12 2v20"></path>
        </svg>
        <!-- TEXTOS DEL LOGOTIPO EN LA BARRA SUPERIOR -->
        <div class="flex flex-col">
          <span class="text-xs sm:text-sm font-extrabold tracking-wider uppercase text-white leading-none">PROYECTO SMART</span>
          <span class="text-[9px] sm:text-[10px] text-smart-text-muted font-medium tracking-normal mt-0.5 uppercase">DEVELOPERS ANA AND AXEL</span>
        </div>
      </a>
    </div>

    <!-- CONTENEDOR DERECHO CON BOTÓN PARA SALIR DE LA SESIÓN -->
    <div class="flex items-center gap-2 sm:gap-3">
      <!-- BOTÓN PARA CERRAR LA SESIÓN ACTIVA -->
      <a class="flex items-center gap-1.5 sm:gap-2 btn-smart-primary px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs font-bold shadow-sm uppercase" href="<?= base_url('/logout') ?>">
        <span class="material-symbols-outlined text-sm sm:text-base">logout</span>
        <span>CERRAR SESIÓN</span>
      </a>
    </div>  

  </header>
  <!-- FIN DE LA BARRA SUPERIOR DE NAVEGACIÓN -->

  <!-- CONTENEDOR PRINCIPAL FLEXIBLE QUE DIVIDE BARRA LATERAL Y CONTENIDO -->
  <div class="flex flex-1 overflow-hidden relative w-full">

    <!-- FONDO OSCURECIDO Y DESENFOCADO PARA PANTALLAS MÓVILES CUANDO SE ABRE EL MENÚ -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-30 hidden md:hidden transition-opacity"></div>

    <!-- BARRA LATERAL DE NAVEGACIÓN (SIDEBAR) -->
    <aside id="sidebar" class="absolute md:relative inset-y-0 left-0 w-64 bg-smart-bg border-r border-smart-border flex-shrink-0 flex flex-col justify-between p-4 z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
      
      <!-- CONTENEDOR DE ENLACES Y NAVEGACIÓN DE MÓDULOS -->
      <div class="space-y-4">
        <!-- ENCABEZADO DE LA SECCIÓN DE MÓDULOS -->
        <div class="px-2 pt-2">
          <p class="text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">MÓDULOS</p>
        </div>

        <!-- LISTA DE NAVEGACIÓN DE LOS MÓDULOS DEL SISTEMA -->
        <nav class="space-y-1.5">
          <!-- OPCIÓN DEL MENÚ: PERFIL (ACTIVO) -->
          <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg bg-smart-red text-white font-semibold text-xs tracking-wide uppercase shadow-lg shadow-smart-red/30" href="<?= $urlPerfil ?>">
            <span class="material-symbols-outlined text-xl">person</span>
            <span>PERFIL</span>
          </a>

          <!-- CONDICIONAL PHP PARA MOSTRAR LA GESTIÓN DE USUARIOS SOLO A ADMINISTRADORES (ROL 1) -->
          <?php if ($userRole === 1): ?>
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlUsuarios ?>">
              <span class="material-symbols-outlined text-xl transition-colors">group</span>
              <span>GESTIÓN DE USUARIOS</span>
            </a>
          <?php endif; ?>

          <!-- OPCIÓN DEL MENÚ: VISUALIZACIÓN DE MAPA -->
          <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlMapa ?>">
            <span class="material-symbols-outlined text-xl transition-colors">map</span>
            <span>VISUALIZACIÓN DE MAPA</span>
          </a>

          <!-- OPCIÓN DEL MENÚ: REPORTES -->
          <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlReportes ?>">
            <span class="material-symbols-outlined text-xl transition-colors">description</span>
            <span>REPORTES</span>
          </a>
        </nav>
      </div>

      <!-- TARJETA INFERIOR DE RESUMEN DEL USUARIO CONECTADO EN EL SIDEBAR -->
      <div class="p-3 mt-6 bg-smart-card border border-smart-border rounded-xl flex items-center gap-3">
        <!-- AVATAR CIRCULAR DEL USUARIO (IMAGEN O INICIALES) -->
        <div class="w-8 h-8 rounded-full bg-smart-red/20 border border-smart-red flex items-center justify-center text-smart-red font-bold text-xs flex-shrink-0 uppercase overflow-hidden">
          <!-- EVALÚA SI EL USUARIO TIENE FOTO REGISTRADA -->
          <?php if (!empty($fotoUsuario)): ?>
            <!-- IMPRIME LA IMAGEN DESDE LA RUTA DE CARGA -->
            <img src="<?= base_url('uploads/perfiles/' . $fotoUsuario) ?>" class="w-full h-full object-cover">
          <?php else: ?>
            <!-- SI NO HAY FOTO, IMPRIME LAS INICIALES DEL USUARIO DE MANERA SEGURA CON esc() -->
            <?= esc($initials) ?>
          <?php endif; ?>
        </div>
        <!-- DATOS DEL USUARIO (NOMBRE Y ROL ACTUAL) -->
        <div class="flex flex-col min-w-0">
          <p class="text-xs font-bold text-white truncate uppercase">
            <?= esc(!empty($nombreUsuario) ? $nombreUsuario : $curpUsuario) ?>
          </p>
          <p class="text-[10px] text-smart-text-muted truncate uppercase">
            ROL: <?= $userRole === 1 ? 'ADMINISTRADOR' : 'USUARIO' ?>
          </p>
        </div>
      </div>

    </aside>
    <!-- FIN DE LA BARRA LATERAL -->

    <!-- ÁREA PRINCIPAL DONDE SE CARGA EL CONTENIDO Y FORMULARIO -->
    <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8 relative bg-black flex flex-col">
      
      <!-- EFECTO VISUAL DE RESPLANDOR/LUZ DE FONDO DE COLOR ROJO -->
      <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-64 bg-smart-red/10 blur-[120px] pointer-events-none rounded-full"></div>

      <!-- CONTENEDOR CENTRAL QUE LIMITA EL ANCHO DEL CONTENIDO -->
      <div class="w-full max-w-5xl mx-auto relative z-10 space-y-6">
        
        <!-- MUESTRA MENSAJE DE ÉXITO SI EXISTE EN LA SESIÓN (FLASHDATA) -->
        <?php if (session()->getFlashdata('mensaje')): ?>
          <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold flex items-center gap-3 uppercase">
            <span class="material-symbols-outlined text-lg">check_circle</span>
            <span><?= session()->getFlashdata('mensaje') ?></span>
          </div>
        <?php endif; ?>

        <!-- MUESTRA MENSAJE DE ERROR SI EXISTE EN LA SESIÓN (FLASHDATA) -->
        <?php if (session()->getFlashdata('error')): ?>
          <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold flex items-center gap-3 uppercase">
            <span class="material-symbols-outlined text-lg">error</span>
            <span><?= session()->getFlashdata('error') ?></span>
          </div>
        <?php endif; ?>

        <!-- SEPARADOR CON TÍTULO DE LA SECCIÓN -->
        <div class="pb-2 border-b border-smart-border/50">
          <p class="text-xs text-smart-text-muted font-bold tracking-wider uppercase">INFORMACION PERSONAL</p>
        </div>

        <!-- FORMULARIO DE PERFIL DE USUARIO HABILITADO PARA SUBIR ARCHIVOS (ENCTYPE) -->
        <form action="<?= base_url('/perfil/guardar') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
          <!-- GENERA EL CAMPO OCULTO DE PROTECCIÓN CONTRA ATAQUES CSRF EN CODEIGNITER -->
          <?= csrf_field() ?>

          <!-- TARJETA SUPERIOR DE ENCABEZADO DE PERFIL -->
          <div class="bg-smart-card border border-smart-border rounded-2xl p-5 sm:p-6 shadow-smart-card flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
              
              <!-- SECCIÓN DEL AVATAR CON OPCIÓN DE EDICIÓN Y PREVISUALIZACIÓN -->
              <div class="relative group flex-shrink-0">
                <div class="w-20 h-20 rounded-2xl bg-smart-red/20 border border-smart-red flex items-center justify-center text-smart-red font-extrabold text-2xl uppercase overflow-hidden shadow-inner">
                  <!-- ELEMENTO DE IMAGEN PARA MOSTRAR LA FOTO ACTUAL O PREVIA -->
                  <img id="avatarPreview" src="<?= !empty($fotoUsuario) ? base_url('uploads/perfiles/' . $fotoUsuario) : '' ?>" class="w-full h-full object-cover <?= empty($fotoUsuario) ? 'hidden' : '' ?>">
                  <!-- ELEMENTO PARA MOSTRAR INICIALES CUANDO NO HAY IMAGEN PRESENTE -->
                  <span id="avatarInitials" class="<?= !empty($fotoUsuario) ? 'hidden' : '' ?>"><?= esc($initials) ?></span>
                </div>

                <!-- ETIQUETA / BOTÓN CON ICONO DE CÁMARA PARA SUBIR UNA NUEVA FOTO -->
                <label for="fotoInput" class="absolute -bottom-1 -right-1 p-1.5 bg-smart-red hover:bg-red-700 text-white rounded-lg cursor-pointer shadow-lg transition-transform hover:scale-110 flex items-center justify-center" title="Cambiar foto de perfil">
                  <span class="material-symbols-outlined text-sm">photo_camera</span>
                </label>
                <!-- CAMPO TIPO FILE OCULTO PARA SELECCIONAR LA IMAGEN DESDE EL DISPOSITIVO -->
                <input type="file" id="fotoInput" name="foto" accept="image/*" class="hidden">
              </div>

              <!-- INFORMACIÓN RESUMIDA DEL USUARIO (ETIQUETAS Y SALUDO) -->
              <div class="space-y-1">
                <div class="flex items-center gap-2 flex-wrap">
                  <!-- ETIQUETA QUE INDICA EL ROL ASIGNADO -->
                  <span class="px-2.5 py-0.5 rounded-md bg-smart-red text-white text-[10px] font-extrabold uppercase tracking-wide">
                    <?= $userRole === 1 ? 'ADMINISTRADOR' : 'USUARIO GENERAL' ?>
                  </span>
                  <!-- INDICADOR VISUAL DE ESTADO EN LÍNEA -->
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[10px] font-bold uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    EN LÍNEA
                  </span>
                </div>
                <!-- TITULAR CON EL NOMBRE O SALUDO PREDETERMINADO -->
                <h1 class="text-lg sm:text-xl font-extrabold text-white uppercase tracking-tight">
                  <?= !empty($nombreUsuario) ? esc($nombreUsuario) : '¡HOLA! COMPLETA TU PERFIL A CONTINUACIÓN' ?>
                </h1>
                <!-- DETALLE DE LA CURP DEL USUARIO -->
                <p class="text-xs text-smart-text-muted font-medium uppercase tracking-wider">
                  CURP: <span class="text-white font-mono font-bold"><?= esc($curpUsuario) ?></span>
                </p>
              </div>
            </div>

            <!-- CONTENEDOR CON EL ID ÚNICO DEL USUARIO FORMATEADO CON CEROS A LA IZQUIERDA -->
            <div class="self-end sm:self-center">
              <span class="px-3 py-1.5 rounded-lg bg-smart-input-bg border border-smart-border text-xs text-smart-text-muted font-mono font-bold uppercase">
                ID: #SMART-<?= str_pad((string)$idUsuario, 3, '0', STR_PAD_LEFT) ?>
              </span>
            </div>
          </div>

          <!-- TARJETA CONTENEDORA DEL FORMULARIO DE EDICIÓN DE DATOS -->
          <div class="bg-smart-card border border-smart-border rounded-2xl p-5 sm:p-6 shadow-smart-card space-y-6">
            
            <!-- ENCABEZADO DE LA SECCIÓN DEL FORMULARIO -->
            <div class="pb-4 border-b border-smart-border/60">
              <div class="flex items-center gap-2 text-smart-red">
                <span class="material-symbols-outlined text-xl">edit_note</span>
                <h2 class="text-sm font-extrabold uppercase tracking-wider text-white">COMPLETA / EDITA TU EXPEDIENTE</h2>
              </div>
              <p class="text-[11px] text-smart-text-muted uppercase mt-1">INGRESA TUS DATOS PERSONALES CORRESPONDIENTES.</p>
            </div>

            <!-- QUADRÍCULA RECEPTIVA PARA CAMPOS DE ENTRADA DE DATOS DE 2 COLUMNAS EN PANTALLAS PEQUEÑAS O MAYORES -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                
              <!-- CAMPO DESHABILITADO PARA MOSTRAR LA CURP (NO EDITABLE) -->
              <div class="space-y-1.5">
                <label class="block text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">CURP (SISTEMA)</label>
                <input type="text" value="<?= esc($curpUsuario) ?>" disabled class="w-full px-4 py-2.5 rounded-xl bg-smart-input-bg/50 border border-smart-border text-xs text-gray-400 font-mono focus:outline-none cursor-not-allowed">
              </div>

              <!-- CAMPO OBLIGATORIO PARA EDITAR EL NOMBRE COMPLETO DEL USUARIO -->
              <div class="space-y-1.5">
                <label class="block text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">NOMBRE COMPLETO *</label>
                <input type="text" name="nombre" value="<?= esc($nombreUsuario) ?>" required placeholder="NOMBRE APELLIDO PATERNO Y MATERNO" class="w-full px-4 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-white placeholder-smart-text-muted/50 focus:border-smart-red focus:ring-1 focus:ring-smart-red focus:outline-none uppercase smart-transition">
              </div>

              <!-- CAMPO DE ENTRADA PARA EL ÁREA O DEPARTAMENTO -->
              <div class="space-y-1.5">
                <label class="block text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">ÁREA / DEPARTAMENTO</label>
                <input type="text" name="area" value="<?= esc($areaUsuario) ?>" placeholder="EJ. AREA INFORMATICA" class="w-full px-4 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-white placeholder-smart-text-muted/50 focus:border-smart-red focus:ring-1 focus:ring-smart-red focus:outline-none uppercase smart-transition">
              </div>

              <!-- CAMPO DE ENTRADA PARA EL CORREO ELECTRÓNICO -->
              <div class="space-y-1.5">
                <label class="block text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">CORREO ELECTRÓNICO</label>
                <input type="email" name="correo" value="<?= esc($correoUsuario) ?>" placeholder="EJ. usuario@smart.gob.mx" class="w-full px-4 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-white placeholder-smart-text-muted/50 focus:border-smart-red focus:ring-1 focus:ring-smart-red focus:outline-none uppercase smart-transition">
              </div>

            </div>

            <!-- BOTÓN DE ENVÍO Y GUARDADO DE FORMULARIO -->
            <div class="flex justify-end pt-4 border-t border-smart-border/40">
              <button type="submit" class="w-full sm:w-auto px-6 py-2.5 rounded-xl btn-smart-primary font-bold text-xs flex items-center justify-center gap-2 shadow-lg uppercase">
                <span class="material-symbols-outlined text-base">save</span>
                <span>GUARDAR CAMBIOS</span>
              </button>
            </div>

          </div>
        </form>

      </div>

    </main>
    <!-- FIN DEL ÁREA DE CONTENIDO PRINCIPAL -->
  </div>

  <!-- SCRIPT CLIENTE JAVASCRIPT PARA INTERACTIVIDAD DE LA INTERFAZ -->
  <script>
    // SELECCIONA EL CAMPO DE ENTRADA DE ARCHIVO DE FOTO
    const fotoInput = document.getElementById('fotoInput');
    // SELECCIONA LA ETIQUETA DE IMAGEN DE PREVISUALIZACIÓN DEL AVATAR
    const avatarPreview = document.getElementById('avatarPreview');
    // SELECCIONA EL CONTENEDOR DE LAS INICIALES DEL AVATAR
    const avatarInitials = document.getElementById('avatarInitials');

    // AGREGA UN ESCUCHADOR DE EVENTOS CUANDO EL USUARIO SELECCIONA UN ARCHIVO DE IMAGEN
    fotoInput.addEventListener('change', function(e) {
      // OBTIENE EL PRIMER ARCHIVO SELECCIONADO
      const file = e.target.files[0];
      // VERIFICA SI EXISTE UN ARCHIVO SELECCIONADO
      if (file) {
        // INSTANCIA EL LECTOR DE ARCHIVOS DE JAVASCRIPT
        const reader = new FileReader();
        // DEFINE LA ACCIÓN TRAS COMPLETAR LA LECTURA DEL ARCHIVO
        reader.onload = function(e) {
          // ASIGNA LA RUTA EN BASE64 A LA IMAGEN DE PREVISUALIZACIÓN
          avatarPreview.src = e.target.result;
          // HACE VISIBLE LA IMAGEN QUITANDO LA CLASE HIDDEN
          avatarPreview.classList.remove('hidden');
          // OCULTA EL CONTENEDOR DE LAS INICIALES
          avatarInitials.classList.add('hidden');
        }
        // LEE EL ARCHIVO COMO UNA URL CON ENCODIFICACIÓN BASE64
        reader.readAsDataURL(file);
      }
    });

    // SELECCIONA EL BOTÓN DE MENÚ PARA DISPOSITIVOS MÓVILES
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    // SELECCIONA LA BARRA LATERAL (SIDEBAR)
    const sidebar       = document.getElementById('sidebar');
    // SELECCIONA LA CAPA DE FONDO OSCURO PARA MÓVILES
    const mobileOverlay = document.getElementById('mobile-overlay');

    // FUNCIÓN PARA ALTERNAR LA VISIBILIDAD DE LA BARRA LATERAL EN MÓVILES
    function toggleMobileMenu() {
      // EVALÚA SI LA BARRA LATERAL SE ENCUENTRA VISIBLE O DESPLAZADA
      const isOpen = !sidebar.classList.contains('-translate-x-full');
      if (isOpen) {
        // OCULTA EL SIDEBAR MOVIÉNDOLO FUERA DE LA PANTALLA A LA IZQUIERDA
        sidebar.classList.add('-translate-x-full');
        // OCULTA LA CAPA DE FONDO OSCURECIDO
        mobileOverlay.classList.add('hidden');
      } else {
        // MUESTRA EL SIDEBAR RETIRANDO LA CLASE DE TRASLACIÓN
        sidebar.classList.remove('-translate-x-full');
        // MUESTRA LA CAPA DE FONDO OSCURECIDO
        mobileOverlay.classList.remove('hidden');
      }
    }

    // REGISTRA EL EVENTO CLIC EN EL BOTÓN MÓVIL SI ESTÁ PRESENTE EN EL DOM
    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    }
    // REGISTRA EL EVENTO CLIC EN LA CAPA DE FONDO PARA CERRAR EL MENÚ MÓVIL
    if (mobileOverlay) {
      mobileOverlay.addEventListener('click', toggleMobileMenu);
    }

    // CONTROLADOR QUE OCULTA AUTOMÁTICAMENTE LA CAPA OSCURA AL REIMENSIONAR A PANTALLA DE ESCRITORIO
    window.addEventListener('resize', () => {
      if (window.innerWidth >= 768 && mobileOverlay) {
        mobileOverlay.classList.add('hidden');
      }
    });
  </script>

</body>
</html>