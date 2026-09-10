<!DOCTYPE html>
<html class="dark" lang="es">
<head>
  <!-- CONFIGURACIÓN BÁSICA DEL DOCUMENTO -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PROYECTO SMART - Mi Perfil</title>

  <!-- TAILWIND CSS -->{
    
  }
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
            'smart-bg': '#000000',
            'smart-red': '#c03c3c',
            'smart-card': '#121212',
            'smart-input-bg': '#1a1a1a',
            'smart-border': '#2a2a2a',
            'smart-border-hover': '#404040',
            'smart-text-muted': '#9ca3af',
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
  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

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

    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>

<body class="bg-smart-bg text-white h-screen flex flex-col font-sans overflow-hidden selection:bg-smart-red selection:text-white">

  <?php
    $usr = $usuario ?? [];
    
    $nombreUsuario = $usr['Nombre'] ?? $usr['nombre'] ?? '';
    $curpUsuario   = $usr['curp'] ?? session()->get('curp') ?? 'SIN CURP';
    $areaUsuario   = $usr['Area'] ?? $usr['area'] ?? '';
    $correoUsuario = $usr['Correo'] ?? $usr['correo'] ?? '';
    $fotoUsuario   = $usr['foto'] ?? '';
    $idUsuario     = $usr['ID_usuario'] ?? $usr['id'] ?? session()->get('id') ?? session()->get('id_usuario') ?? 0;

    $cadenaIniciales = !empty($nombreUsuario) ? $nombreUsuario : $curpUsuario;
    $initials        = strtoupper(substr((string)$cadenaIniciales, 0, 2));

    $userRole = (int) ($usr['ROLES_ID_roles'] ?? $usr['roles_id'] ?? session()->get('role') ?? 2);

    $urlPerfil   = base_url('/perfil');
    $urlUsuarios = base_url('/admin/usuarios'); 
    $urlMapa     = base_url('/mapa');
    $urlReportes = base_url('/reportes');
  ?>

  <!-- HEADER / NAVEGACIÓN SUPERIOR -->
  <header class="flex justify-between items-center w-full px-4 sm:px-6 md:px-8 h-16 bg-smart-bg/90 backdrop-blur-md border-b border-smart-border flex-shrink-0 z-50">
    
    <div class="flex items-center gap-2 sm:gap-3">
      <button id="mobile-menu-btn" aria-label="ABRIR MENÚ" class="md:hidden text-smart-text-muted hover:text-white transition-colors focus:outline-none p-1.5 rounded-lg border border-smart-border bg-smart-card">
        <span class="material-symbols-outlined text-2xl flex items-center justify-center">menu</span>
      </button>

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

    <div class="flex items-center gap-2 sm:gap-3">
      <a class="flex items-center gap-1.5 sm:gap-2 btn-smart-primary px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg text-xs font-bold shadow-sm uppercase" href="<?= base_url('/logout') ?>">
        <span class="material-symbols-outlined text-sm sm:text-base">logout</span>
        <span>CERRAR SESIÓN</span>
      </a>
    </div>  

  </header>

  <div class="flex flex-1 overflow-hidden relative w-full">

    <div id="mobile-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-30 hidden md:hidden transition-opacity"></div>

    <!-- BARRA LATERAL (SIDEBAR) -->
    <aside id="sidebar" class="absolute md:relative inset-y-0 left-0 w-64 bg-smart-bg border-r border-smart-border flex-shrink-0 flex flex-col justify-between p-4 z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
      
      <div class="space-y-4">
        <div class="px-2 pt-2">
          <p class="text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">MÓDULOS</p>
        </div>

        <nav class="space-y-1.5">
          <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg bg-smart-red text-white font-semibold text-xs tracking-wide uppercase shadow-lg shadow-smart-red/30" href="<?= $urlPerfil ?>">
            <span class="material-symbols-outlined text-xl">person</span>
            <span>PERFIL</span>
          </a>

          <?php if ($userRole === 1): ?>
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlUsuarios ?>">
              <span class="material-symbols-outlined text-xl transition-colors">group</span>
              <span>GESTIÓN DE USUARIOS</span>
            </a>
          <?php endif; ?>

          <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlMapa ?>">
            <span class="material-symbols-outlined text-xl transition-colors">map</span>
            <span>VISUALIZACIÓN DE MAPA</span>
          </a>

          <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-smart-text-muted nav-item-smart font-semibold text-xs tracking-wide uppercase" href="<?= $urlReportes ?>">
            <span class="material-symbols-outlined text-xl transition-colors">description</span>
            <span>REPORTES</span>
          </a>
        </nav>
      </div>

      <div class="p-3 mt-6 bg-smart-card border border-smart-border rounded-xl flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-smart-red/20 border border-smart-red flex items-center justify-center text-smart-red font-bold text-xs flex-shrink-0 uppercase overflow-hidden">
          <?php if (!empty($fotoUsuario)): ?>
            <img src="<?= base_url('uploads/perfiles/' . $fotoUsuario) ?>" class="w-full h-full object-cover">
          <?php else: ?>
            <?= esc($initials) ?>
          <?php endif; ?>
        </div>
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

    <!-- ÁREA DE CONTENIDO PRINCIPAL -->
    <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8 relative bg-black flex flex-col">
      
      <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-64 bg-smart-red/10 blur-[120px] pointer-events-none rounded-full"></div>

      <div class="w-full max-w-5xl mx-auto relative z-10 space-y-6">
        
        <?php if (session()->getFlashdata('mensaje')): ?>
          <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold flex items-center gap-3 uppercase">
            <span class="material-symbols-outlined text-lg">check_circle</span>
            <span><?= session()->getFlashdata('mensaje') ?></span>
          </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
          <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-bold flex items-center gap-3 uppercase">
            <span class="material-symbols-outlined text-lg">error</span>
            <span><?= session()->getFlashdata('error') ?></span>
          </div>
        <?php endif; ?>

        <div class="pb-2 border-b border-smart-border/50">
          <p class="text-xs text-smart-text-muted font-bold tracking-wider uppercase">INFORMACION PERSONAL</p>
        </div>

        <form action="<?= base_url('/perfil/guardar') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
          <?= csrf_field() ?>

          <div class="bg-smart-card border border-smart-border rounded-2xl p-5 sm:p-6 shadow-smart-card flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
              
              <div class="relative group flex-shrink-0">
                <div class="w-20 h-20 rounded-2xl bg-smart-red/20 border border-smart-red flex items-center justify-center text-smart-red font-extrabold text-2xl uppercase overflow-hidden shadow-inner">
                  <img id="avatarPreview" src="<?= !empty($fotoUsuario) ? base_url('uploads/perfiles/' . $fotoUsuario) : '' ?>" class="w-full h-full object-cover <?= empty($fotoUsuario) ? 'hidden' : '' ?>">
                  <span id="avatarInitials" class="<?= !empty($fotoUsuario) ? 'hidden' : '' ?>"><?= esc($initials) ?></span>
                </div>

                <label for="fotoInput" class="absolute -bottom-1 -right-1 p-1.5 bg-smart-red hover:bg-red-700 text-white rounded-lg cursor-pointer shadow-lg transition-transform hover:scale-110 flex items-center justify-center" title="Cambiar foto de perfil">
                  <span class="material-symbols-outlined text-sm">photo_camera</span>
                </label>
                <input type="file" id="fotoInput" name="foto" accept="image/*" class="hidden">
              </div>

              <div class="space-y-1">
                <div class="flex items-center gap-2 flex-wrap">
                  <span class="px-2.5 py-0.5 rounded-md bg-smart-red text-white text-[10px] font-extrabold uppercase tracking-wide">
                    <?= $userRole === 1 ? 'ADMINISTRADOR' : 'USUARIO GENERAL' ?>
                  </span>
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[10px] font-bold uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    EN LÍNEA
                  </span>
                </div>
                <h1 class="text-lg sm:text-xl font-extrabold text-white uppercase tracking-tight">
                  <?= !empty($nombreUsuario) ? esc($nombreUsuario) : '¡HOLA! COMPLETA TU PERFIL A CONTINUACIÓN' ?>
                </h1>
                <p class="text-xs text-smart-text-muted font-medium uppercase tracking-wider">
                  CURP: <span class="text-white font-mono font-bold"><?= esc($curpUsuario) ?></span>
                </p>
              </div>
            </div>

            <div class="self-end sm:self-center">
              <span class="px-3 py-1.5 rounded-lg bg-smart-input-bg border border-smart-border text-xs text-smart-text-muted font-mono font-bold uppercase">
                ID: #SMART-<?= str_pad((string)$idUsuario, 3, '0', STR_PAD_LEFT) ?>
              </span>
            </div>
          </div>

          <div class="bg-smart-card border border-smart-border rounded-2xl p-5 sm:p-6 shadow-smart-card space-y-6">
            
            <div class="pb-4 border-b border-smart-border/60">
              <div class="flex items-center gap-2 text-smart-red">
                <span class="material-symbols-outlined text-xl">edit_note</span>
                <h2 class="text-sm font-extrabold uppercase tracking-wider text-white">COMPLETA / EDITA TU EXPEDIENTE</h2>
              </div>
              <p class="text-[11px] text-smart-text-muted uppercase mt-1">INGRESA TUS DATOS PERSONALES CORRESPONDIENTES.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                
              <div class="space-y-1.5">
                <label class="block text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">CURP (SISTEMA)</label>
                <input type="text" value="<?= esc($curpUsuario) ?>" disabled class="w-full px-4 py-2.5 rounded-xl bg-smart-input-bg/50 border border-smart-border text-xs text-gray-400 font-mono focus:outline-none cursor-not-allowed">
              </div>

              <div class="space-y-1.5">
                <label class="block text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">NOMBRE COMPLETO *</label>
                <input type="text" name="nombre" value="<?= esc($nombreUsuario) ?>" required placeholder="NOMBRE APELLIDO PATERNO Y MATERNO" class="w-full px-4 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-white placeholder-smart-text-muted/50 focus:border-smart-red focus:ring-1 focus:ring-smart-red focus:outline-none uppercase smart-transition">
              </div>

              <div class="space-y-1.5">
                <label class="block text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">ÁREA / DEPARTAMENTO</label>
                <input type="text" name="area" value="<?= esc($areaUsuario) ?>" placeholder="EJ. AREA INFORMATICA" class="w-full px-4 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-white placeholder-smart-text-muted/50 focus:border-smart-red focus:ring-1 focus:ring-smart-red focus:outline-none uppercase smart-transition">
              </div>

              <div class="space-y-1.5">
                <label class="block text-[11px] font-bold text-smart-text-muted uppercase tracking-wider">CORREO ELECTRÓNICO</label>
                <input type="email" name="correo" value="<?= esc($correoUsuario) ?>" placeholder="EJ. usuario@smart.gob.mx" class="w-full px-4 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-white placeholder-smart-text-muted/50 focus:border-smart-red focus:ring-1 focus:ring-smart-red focus:outline-none uppercase smart-transition">
              </div>

            </div>

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
  </div>

  <script>
    const fotoInput = document.getElementById('fotoInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const avatarInitials = document.getElementById('avatarInitials');

    fotoInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          avatarPreview.src = e.target.result;
          avatarPreview.classList.remove('hidden');
          avatarInitials.classList.add('hidden');
        }
        reader.readAsDataURL(file);
      }
    });

    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebar       = document.getElementById('sidebar');
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

    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    }
    if (mobileOverlay) {
      mobileOverlay.addEventListener('click', toggleMobileMenu);
    }

    window.addEventListener('resize', () => {
      if (window.innerWidth >= 768 && mobileOverlay) {
        mobileOverlay.classList.add('hidden');
      }
    });
  </script>

</body>
</html>