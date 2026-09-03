<!DOCTYPE html>
<html class="dark" lang="es">
<head>
  <!-- CONFIGURACIÓN BÁSICA DEL DOCUMENTO -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- TAILWIND CSS -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

  <!-- FUENTES EXTERNAS Y MATERIAL ICONS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- CONFIGURACIÓN DE TAILWIND -->
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            'smart-bg': '#000000',        /* Fondo oscuro base */
            'smart-red': '#c03c3c',        /* Rojo SMART */
            'smart-card': '#121212',        /* Superficie de tarjetas */
            'smart-input-bg': '#1a1a1a',    /* Fondo de elementos secundarios */
            'smart-border': '#2a2a2a',      /* Bordes */
            'smart-border-hover': '#404040', /* Bordes al interactuar */
            'smart-text-muted': '#9ca3af',   /* Texto secundario */
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

  <!-- ESTILOS CSS PERSONALIZADOS -->
  <style data-purpose="custom-styles">
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Scrollbar minimalista */
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

    .smart-transition {
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hover en elementos del menú */
    .nav-item-smart {
      transition: all 0.2s ease;
    }
    .nav-item-smart:hover {
      background-color: #c03c3c !important;
      color: #ffffff !important;
      box-shadow: 0 4px 15px -3px rgba(192, 60, 60, 0.4);
    }
    .nav-item-smart:hover .material-symbols-outlined {
      color: #ffffff !important;
    }

    /* Botón principal */
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

    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>

<body class="bg-smart-bg text-white h-screen flex flex-col font-sans overflow-hidden selection:bg-smart-red selection:text-white">

  <?php
    // Comprobamos la sesión activa
    $isLoggedIn = session()->get('isLoggedIn') || session()->get('logged_in');
    
    // Datos del usuario para avatar
    $rawName = session()->get('name') ?? 'Invitado';
    $initials = strtoupper(substr((string)$rawName, 0, 2));

    // Captura numérica del rol (1 = Administrador, 2 = Usuario)
    $userRole = (int) (session()->get('role') ?? 0);

    // Rutas directas hacia los módulos
    $urlPerfil   = base_url('/perfil');
    $urlUsuarios = base_url('/admin/usuarios'); 
    $urlMapa     = base_url('/mapa');
    $urlReportes = base_url('/reportes');
  ?>

  <header class="flex justify-between items-center w-full px-4 sm:px-6 md:px-8 h-16 bg-smart-bg/90 backdrop-blur-md border-b border-smart-border flex-shrink-0 z-50">
    
    <div class="flex items-center gap-2 sm:gap-3">
      <!-- BOTÓN MENÚ HAMBURGUESA (MÓVIL) -->
      <button id="mobile-menu-btn" aria-label="ABRIR MENÚ" class="md:hidden text-smart-text-muted hover:text-white transition-colors focus:outline-none p-1.5 rounded-lg border border-smart-border bg-smart-card">
        <span class="material-symbols-outlined text-2xl flex items-center justify-center">menu</span>
      </button>

      <!-- LOGO PROYECTO SMART -->
      <a class="flex items-center gap-2.5" href="<?= base_url('/') ?>">
        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-smart-red flex-shrink-0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="2" x2="22" y1="12" y2="12"></line>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
          <path d="M12 2v20"></path>
        </svg>
        <div class="flex flex-col">
          <span class="text-xs sm:text-sm font-extrabold tracking-wider uppercase text-white leading-none">PROYECTO SMART</span>
          <span class="text-[9px] sm:text-[10px] text-smart-text-muted font-medium tracking-normal mt-0.5 uppercase">DEVELOPERS ANA AND AXEL</span>
        </div>
      </a>
    </div>

    <!-- ACCIÓN DE SESIÓN -->
    <div class="flex items-center gap-2 sm:gap-3">
      <?php if ($isLoggedIn): ?>
        <!-- BOTÓN CERRAR SESIÓN -->
        <a class="flex items-center gap-1.5 sm:gap-2 btn-smart-primary px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs font-bold shadow-sm uppercase" href="<?= base_url('/logout') ?>">
          <span class="material-symbols-outlined text-sm sm:text-base">logout</span>
          <span>CERRAR SESIÓN</span>
        </a>
      <?php else: ?>
        <!-- BOTÓN INICIAR SESIÓN -->
        <a class="flex items-center gap-1.5 sm:gap-2 btn-smart-primary px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs font-bold shadow-sm uppercase" href="<?= base_url('/login') ?>">
          <span class="material-symbols-outlined text-sm sm:text-base">login</span>
          <span>INICIA SESIÓN</span>
        </a>
      <?php endif; ?>
    </div>  

  </header>

  <div class="flex flex-1 overflow-hidden relative w-full">

    <!-- BACKDROP MÓVIL CON BLUR -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-30 hidden md:hidden transition-opacity"></div>

    <!-- BARRA LATERAL (SIDEBAR) -->
    <aside id="sidebar" class="absolute md:relative inset-y-0 left-0 w-64 bg-smart-bg border-r border-smart-border flex-shrink-0 flex flex-col justify-between p-4 z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
      
      <!-- SECCIÓN SUPERIOR DE NAVEGACIÓN -->
      <div class="space-y-4">
        <div class="px-2 pt-2">
          <p class="text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">MÓDULOS</p>
        </div>

        <!-- MENÚ DE NAVEGACIÓN -->
        <nav class="space-y-1.5">
          <!-- 1. PERFIL -->
          <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlPerfil ?>">
            <span class="material-symbols-outlined text-xl transition-colors">person</span>
            <span>PERFIL</span>
          </a>

          <!-- 2. GESTIÓN DE USUARIOS (Visible solo si el rol es 1 - Administrador) -->
          <?php if ($isLoggedIn && $userRole === 1): ?>
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlUsuarios ?>">
              <span class="material-symbols-outlined text-xl transition-colors">group</span>
              <span>GESTIÓN DE USUARIOS</span>
            </a>
          <?php endif; ?>

          <!-- 3. VISUALIZACIÓN DE MAPA -->
          <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlMapa ?>">
            <span class="material-symbols-outlined text-xl transition-colors">map</span>
            <span>VISUALIZACIÓN DE MAPA</span>
          </a>

          <!-- 4. REPORTES -->
          <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlReportes ?>">
            <span class="material-symbols-outlined text-xl transition-colors">description</span>
            <span>REPORTES</span>
          </a>
        </nav>
      </div>

      <!-- DATOS DEL USUARIO O INVITADO -->
      <div class="p-3 mt-6 bg-smart-card border border-smart-border rounded-xl flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-smart-red/20 border border-smart-red flex items-center justify-center text-smart-red font-bold text-xs flex-shrink-0 uppercase">
          <?= esc($initials) ?>
        </div>
        <div class="flex flex-col min-w-0">
          <p class="text-xs font-bold text-white truncate uppercase">
            <?= esc($rawName) ?>
          </p>
          <p class="text-[10px] text-smart-text-muted truncate uppercase">
            <?php if ($isLoggedIn): ?>
              ROL: <?= $userRole === 1 ? 'ADMINISTRADOR (1)' : 'USUARIO GENERAL (' . $userRole . ')' ?>
            <?php else: ?>
              SIN INICIAR SESIÓN
            <?php endif; ?>
          </p>
        </div>
      </div>

    </aside>

    <!-- ÁREA DE CONTENIDO PRINCIPAL -->
    <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8 relative bg-black flex flex-col">
      
      <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-64 bg-smart-red/10 blur-[120px] pointer-events-none rounded-full"></div>

      <div class="w-full max-w-6xl mx-auto relative z-10 space-y-6">
        
        <!-- HEADER DE LA PÁGINA -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 pb-2 border-b border-smart-border/50">
          <div>
            <h1 class="text-lg sm:text-xl md:text-2xl font-extrabold text-white tracking-tight uppercase">PANEL DE CONTROL</h1>
            <p class="text-xs text-smart-text-muted mt-0.5 uppercase">¡HOLA! BIENVENIDO A SMART.</p>
          </div>
          
          <div class="flex items-center gap-2 self-start sm:self-auto">
            <span class="px-3 py-1.5 rounded-lg bg-smart-card border border-smart-border text-xs text-smart-text-muted font-medium flex items-center gap-2 uppercase">
              <span class="material-symbols-outlined text-sm text-smart-red">calendar_today</span>
              <?= date('d M, Y') ?>
            </span>
          </div>
        </div>

        <!-- TARJETA VISUALIZADORA (CARRUSEL) -->
        <div class="bg-smart-card border border-smart-border rounded-2xl overflow-hidden shadow-smart-card hover:border-smart-border-hover smart-transition group relative">
          
          <!-- ENCABEZADO DE LA TARJETA -->
          <div class="px-4 sm:px-5 py-3 border-b border-smart-border/60 bg-smart-input-bg/50 flex items-center justify-between gap-2">
            <div class="flex items-center gap-2 min-w-0">
              <span class="w-2.5 h-2.5 rounded-full bg-smart-red flex-shrink-0"></span>
              <span class="text-xs font-bold uppercase tracking-wider text-white truncate">VISTA PREVIA DEL MÓDULO</span>
            </div>
            <span class="text-[10px] sm:text-[11px] text-smart-text-muted bg-smart-bg px-2 sm:px-2.5 py-1 rounded-md border border-smart-border flex-shrink-0 uppercase">NEZAYORK</span>
          </div>

          <!-- CONTENEDOR VISUAL DE LA IMAGEN -->
          <div class="relative w-full aspect-video sm:aspect-[21/9] bg-smart-bg flex items-center justify-center overflow-hidden group">
            <div class="absolute inset-0 bg-cover bg-center filter blur-md opacity-50 scale-110" style="background-image: url('<?= base_url('Coyote.jpeg') ?>');"></div>
            <img alt="VISUALIZACIÓN DEL PANEL" class="relative z-10 h-[230%] w-auto object-contain group-hover:scale-105 smart-transition" src="<?= base_url('Coyote.jpeg') ?>">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/20 pointer-events-none"></div>
          </div>

          <!-- CONTROLES DE NAVEGACIÓN -->
          <button id="prevSlide" aria-label="ANTERIOR" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-8 sm:w-9 h-8 sm:h-9 rounded-xl bg-black/60 border border-white/10 flex items-center justify-center text-white hover:text-white hover:bg-smart-red hover:border-smart-red smart-transition backdrop-blur-md z-20">
            <span class="material-symbols-outlined text-lg sm:text-xl">chevron_left</span>
          </button>
          <button id="nextSlide" aria-label="SIGUIENTE" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-8 sm:w-9 h-8 sm:h-9 rounded-xl bg-black/60 border border-white/10 flex items-center justify-center text-white hover:text-white hover:bg-smart-red hover:border-smart-red smart-transition backdrop-blur-md z-20">
            <span class="material-symbols-outlined text-lg sm:text-xl">chevron_right</span>
          </button>

          <!-- FOOTER SOBRE LA IMAGEN -->
          <div class="absolute bottom-3 sm:bottom-4 left-0 right-0 px-4 sm:px-6 flex items-center justify-between z-20 pointer-events-none">
            <p class="text-xs font-semibold text-white/90 hidden sm:block uppercase">CIUDAD INTELIGENTE</p>
            <div class="flex items-center gap-1.5 mx-auto sm:mx-0">
              <span class="w-5 sm:w-6 h-1.5 rounded-full bg-smart-red"></span>
              <span class="w-1.5 h-1.5 rounded-full bg-white/40"></span>
              <span class="w-1.5 h-1.5 rounded-full bg-white/40"></span>
            </div>
          </div>

        </div>

        <!-- TARJETAS SECUNDARIAS DE ESTADO -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
          
          <div class="p-3.5 sm:p-4 rounded-xl bg-smart-card border border-smart-border flex items-center gap-3 sm:gap-4">
            <div class="p-2.5 sm:p-3 rounded-lg bg-smart-red/10 border border-smart-red/30 text-smart-red flex-shrink-0">
              <span class="material-symbols-outlined text-xl sm:text-2xl flex items-center justify-center">grid_view</span>
            </div>
            <div class="min-w-0">
              <p class="text-[10px] sm:text-[11px] text-smart-text-muted uppercase font-bold truncate">ESTADO MÓDULOS</p>
              <p class="text-xs sm:text-sm font-bold text-white mt-0.5 truncate uppercase">
                <?php 
                  if (!$isLoggedIn) {
                      echo '0 ACTIVOS';
                  } else {
                      echo ($userRole === 1) ? '4 ACTIVOS' : '3 ACTIVOS';
                  }
                ?>
              </p>
            </div>
          </div>

          <div class="p-3.5 sm:p-4 rounded-xl bg-smart-card border border-smart-border flex items-center gap-3 sm:gap-4">
            <div class="p-2.5 sm:p-3 rounded-lg bg-smart-red/10 border border-smart-red/30 text-smart-red flex-shrink-0">
              <span class="material-symbols-outlined text-xl sm:text-2xl flex items-center justify-center">shield</span>
            </div>
            <div class="min-w-0">
              <p class="text-[10px] sm:text-[11px] text-smart-text-muted uppercase font-bold truncate">SEGURIDAD</p>
              <p class="text-xs sm:text-sm font-bold text-white mt-0.5 truncate uppercase">PROTEGIDO</p>
            </div>
          </div>

          <div class="p-3.5 sm:p-4 rounded-xl bg-smart-card border border-smart-border flex items-center gap-3 sm:gap-4">
            <div class="p-2.5 sm:p-3 rounded-lg bg-smart-red/10 border border-smart-red/30 text-smart-red flex-shrink-0">
              <span class="material-symbols-outlined text-xl sm:text-2xl flex items-center justify-center">sync</span>
            </div>
            <div class="min-w-0">
              <p class="text-[10px] sm:text-[11px] text-smart-text-muted uppercase font-bold truncate">SINCRONIZACIÓN</p>
              <p class="text-xs sm:text-sm font-bold text-white mt-0.5 truncate uppercase">ACTUALIZADO</p>
            </div>
          </div>

        </div>

      </div>

    </main>
  </div>

  <!-- MODAL DE ALERTA DE AUTENTICACIÓN -->
  <?php if (session()->getFlashdata('show_auth_modal')): ?>
    <div id="authAlertModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
      <div class="bg-smart-card border border-smart-border rounded-2xl max-w-md w-full overflow-hidden shadow-2xl transform transition-all animate-in fade-in zoom-in duration-200">
        
        <div class="bg-smart-input-bg border-b border-smart-border px-6 py-4 flex items-center gap-3">
          <div class="p-2 rounded-lg bg-amber-500/10 border border-amber-500/20 text-amber-500 flex-shrink-0">
            <span class="material-symbols-outlined text-xl flex items-center justify-center">lock</span>
          </div>
          <div>
            <h3 class="text-sm font-bold uppercase tracking-wider text-white">ACCESO RESTRINGIDO</h3>
            <p class="text-[11px] text-smart-text-muted uppercase">AUTENTICACIÓN REQUERIDA</p>
          </div>
        </div>

        <div class="p-6 text-center">
          <p class="text-sm text-gray-300 leading-relaxed uppercase">
            ¡HOLA! INICIA SESIÓN PARA INGRESAR A LAS FUNCIONALIDADES Y MÓDULOS PROTEGIDOS DEL SISTEMA.
          </p>
        </div>

        <div class="bg-smart-bg px-6 py-4 border-t border-smart-border flex flex-col sm:flex-row items-center justify-end gap-2">
          <button type="button" onclick="closeAuthModal()" class="w-full sm:w-auto px-4 py-2 rounded-lg border border-smart-border text-xs font-semibold text-smart-text-muted hover:text-white hover:bg-smart-input-bg transition-colors uppercase">
            REGRESAR AL INICIO
          </button>
          <a href="<?= base_url('/login') ?>" class="w-full sm:w-auto px-4 py-2 rounded-lg bg-smart-red hover:bg-red-700 text-white text-xs font-bold text-center transition-colors shadow-lg shadow-smart-red/20 flex items-center justify-center gap-1.5 uppercase">
            <span class="material-symbols-outlined text-base">login</span>
            <span>INICIAR SESIÓN</span>
          </a>
        </div>

      </div>
    </div>

    <script>
      function closeAuthModal() {
        const modal = document.getElementById('authAlertModal');
        if (modal) {
          modal.classList.add('hidden');
        }
      }
    </script>
  <?php endif; ?>

  <!-- JS DE NAVEGACIÓN Y MENÚ MÓVIL -->
  <script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.getElementById('sidebar');
    const mobileOverlay = document.getElementById('mobile-overlay');

    function toggleMobileMenu() {
      const isOpen = !sidebar.classList.contains('-translate-x-full');
      
      if (isOpen) {
        sidebar.classList.add('-translate-x-full');
        mobileOverlay.classList.add('hidden');
      } else {
        sidebar.classList.remove('-translate-x-full');
        mobileOverlay.classList.remove('hidden');
      }
    }

    mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    mobileOverlay.addEventListener('click', toggleMobileMenu);

    window.addEventListener('resize', () => {
      if (window.innerWidth >= 768) {
        mobileOverlay.classList.add('hidden');
      }
    });
  </script>

</body>
</html>