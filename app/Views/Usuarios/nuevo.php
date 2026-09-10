<!DOCTYPE html>
<html class="dark" lang="es">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>REGISTRAR USUARIO - PROYECTO SMART</title>
  
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <script>
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
            'smart-text-muted': '#9ca3af',
          },
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <style>
    /* Estilo para quitar el fondo azul nativo de autofill en inputs */
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus {
      -webkit-text-fill-color: #ffffff !important;
      -webkit-box-shadow: 0 0 0px 1000px #1a1a1a inset !important;
      transition: background-color 5000s ease-in-out 0s;
    }
  </style>
</head>
<body class="bg-smart-bg text-white min-h-screen flex items-center justify-center p-4 selection:bg-smart-red selection:text-white">

  <div class="w-full max-w-md space-y-6">
    
    <!-- HEADER ARRIBA FUERA DE LA TARJETA -->
    <div class="text-center space-y-2">
      <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-smart-red/10 border border-smart-red/30 text-smart-red mb-2">
        <span class="material-symbols-outlined text-3xl">person_add</span>
      </div>
      <h1 class="text-2xl font-extrabold tracking-tight uppercase">REGISTRAR USUARIO</h1>
      <p class="text-xs text-smart-text-muted uppercase">CREA UNA CUENTA PARA ACCEDER AL PROYECTO SMART</p>
    </div>

    <!-- MENSAJES DE ERROR / ÉXITO (FLASH DATA) -->
    <?php if (session()->getFlashdata('msg')): ?>
      <div class="p-3.5 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-semibold flex items-center gap-2 uppercase">
        <span class="material-symbols-outlined text-lg">error</span>
        <span><?= session()->getFlashdata('msg') ?></span>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-semibold flex items-center gap-2 uppercase">
        <span class="material-symbols-outlined text-lg">check_circle</span>
        <span><?= session()->getFlashdata('success') ?></span>
      </div>
    <?php endif; ?>

    <!-- TARJETA DEL FORMULARIO DE REGISTRO -->
    <div class="bg-smart-card border border-smart-border rounded-2xl p-6 shadow-2xl space-y-5">
      <form action="<?= base_url('usuarios/guardar') ?>" method="POST" class="space-y-4">
        
        <?= csrf_field() ?>

        <!-- CAMPO CURP -->
        <div class="space-y-1.5">
          <label for="curp" class="text-xs font-bold uppercase tracking-wider text-smart-text-muted">CURP</label>
          <div class="relative">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-smart-text-muted text-lg">badge</span>
            <input 
              type="text" 
              id="curp" 
              name="curp" 
              value="<?= old('curp') ?>"
              required 
              maxlength="18"
              placeholder="ABCD123456HDFRRX01" 
              class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-white placeholder-gray-500 focus:outline-none focus:border-smart-red uppercase tracking-wider transition-colors"
            >
          </div>
        </div>

        <!-- CAMPO CONTRASEÑA -->
        <div class="space-y-1.5">
          <label for="password" class="text-xs font-bold uppercase tracking-wider text-smart-text-muted">CONTRASEÑA</label>
          <div class="relative">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-smart-text-muted text-lg">key</span>
            <input 
              type="password" 
              id="password" 
              name="password" 
              required 
              placeholder="••••••••" 
              class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-white placeholder-gray-500 focus:outline-none focus:border-smart-red transition-colors"
            >
          </div>
        </div>

        <!-- DROPDOWN PERSONALIZADO DE TIPO DE USUARIO -->
        <div class="space-y-1.5 relative">
          <label class="text-xs font-bold uppercase tracking-wider text-smart-text-muted">TIPO DE USUARIO</label>
          
          <!-- Input Oculto que envía el valor al Backend (PHP) -->
          <input type="hidden" name="roles_id" id="roles_id_input" value="<?= old('roles_id') ?>" required>

          <!-- Botón Principal del Desplegable -->
          <button 
            type="button" 
            id="dropdownBtn"
            onclick="toggleDropdown()"
            class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-left text-white focus:outline-none focus:border-smart-red uppercase transition-colors relative flex items-center justify-between"
          >
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-smart-text-muted text-lg">admin_panel_settings</span>
            <span id="dropdownLabel" class="truncate text-gray-500">SELECCIONA UNA OPCIÓN</span>
            <span id="dropdownArrow" class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-smart-text-muted text-lg transition-transform duration-200">expand_more</span>
          </button>

          <!-- Lista Flotante de Opciones (Solo muestra Administrador y Usuario / Roles de DB) -->
          <div 
            id="dropdownMenu" 
            class="hidden absolute z-30 w-full mt-1.5 bg-[#181818] border border-smart-border rounded-xl shadow-2xl overflow-hidden py-1"
          >
            <?php if (!empty($roles)): ?>
              <?php foreach($roles as $rol): ?>
                <div 
                  onclick="selectOption('<?= $rol['ID_roles'] ?>', '<?= strtoupper($rol['Tipo_rol']) ?>')"
                  class="px-4 py-2.5 text-xs text-gray-300 hover:bg-smart-red hover:text-white cursor-pointer uppercase transition-colors flex items-center gap-2"
                >
                  <span class="material-symbols-outlined text-base">person</span>
                  <span><?= strtoupper($rol['Tipo_rol']) ?></span>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div onclick="selectOption('1', 'ADMINISTRADOR')" class="px-4 py-2.5 text-xs text-gray-300 hover:bg-smart-red hover:text-white cursor-pointer uppercase transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-base">shield_person</span>
                <span>ADMINISTRADOR</span>
              </div>
              <div onclick="selectOption('2', 'USUARIO')" class="px-4 py-2.5 text-xs text-gray-300 hover:bg-smart-red hover:text-white cursor-pointer uppercase transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-base">person</span>
                <span>USUARIO</span>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- BOTÓN REGISTRARSE -->
        <button 
          type="submit" 
          class="w-full py-2.5 px-4 rounded-xl bg-smart-red hover:bg-red-700 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-smart-red/20 transition-all flex items-center justify-center gap-2 mt-2"
        >
          <span>REGISTRARSE</span>
          <span class="material-symbols-outlined text-base">person_add</span>
        </button>

      </form>
    </div>

    <!-- ENLACE VOLVER AL LOGIN -->
    <p class="text-center text-xs text-smart-text-muted uppercase">
      <a href="<?= base_url('/login') ?>" class="text-white font-bold hover:underline uppercase inline-flex items-center gap-1">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        VOLVER A INICIAR SESIÓN
      </a>
    </p>

  </div>

  <!-- SCRIPT JS PARA EL DROPDOWN -->
  <script>
    function toggleDropdown() {
      const menu = document.getElementById('dropdownMenu');
      const arrow = document.getElementById('dropdownArrow');
      const btn = document.getElementById('dropdownBtn');

      menu.classList.toggle('hidden');
      arrow.classList.toggle('rotate-180');
      
      if (!menu.classList.contains('hidden')) {
        btn.classList.add('border-smart-red');
      } else {
        btn.classList.remove('border-smart-red');
      }
    }

    function selectOption(id, label) {
      document.getElementById('roles_id_input').value = id;
      
      const labelSpan = document.getElementById('dropdownLabel');
      labelSpan.innerText = label;
      labelSpan.classList.remove('text-gray-500');
      labelSpan.classList.add('text-white');

      toggleDropdown();
    }

    // Cierra el menú al hacer clic fuera
    document.addEventListener('click', function(e) {
      const btn = document.getElementById('dropdownBtn');
      const menu = document.getElementById('dropdownMenu');
      if (btn && menu && !btn.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.add('hidden');
        document.getElementById('dropdownArrow').classList.remove('rotate-180');
        btn.classList.remove('border-smart-red');
      }
    });
  </script>

</body>
</html>