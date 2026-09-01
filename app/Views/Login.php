<!DOCTYPE html>
<html class="dark" lang="es">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Iniciar Sesión - Proyecto SMART</title>
  
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
</head>
<body class="bg-smart-bg text-white min-h-screen flex items-center justify-center p-4 selection:bg-smart-red selection:text-white">

  <div class="w-full max-w-md space-y-6">
    
    <!-- LOGO HEADER -->
    <div class="text-center space-y-2">
      <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-smart-red/10 border border-smart-red/30 text-smart-red mb-2">
        <span class="material-symbols-outlined text-3xl">lock</span>
      </div>
      <h1 class="text-2xl font-extrabold tracking-tight uppercase">Iniciar Sesión</h1>
      <p class="text-xs text-smart-text-muted">Ingresa tu CURP y contraseña para acceder al Proyecto SMART</p>
    </div>

    <!-- MENSAJES DE ERROR / ÉXITO (FLASH DATA) -->
    <?php if (session()->getFlashdata('msg')): ?>
      <div class="p-3.5 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-xs font-semibold flex items-center gap-2">
        <span class="material-symbols-outlined text-lg">error</span>
        <span><?= session()->getFlashdata('msg') ?></span>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-semibold flex items-center gap-2">
        <span class="material-symbols-outlined text-lg">check_circle</span>
        <span><?= session()->getFlashdata('success') ?></span>
      </div>
    <?php endif; ?>

    <!-- FORMULARIO DE LOGIN -->
    <div class="bg-smart-card border border-smart-border rounded-2xl p-6 shadow-2xl space-y-5">
      <form action="<?= base_url('login/auth') ?>" method="POST" class="space-y-4">
        
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
              required 
              maxlength="18"
              placeholder="ABCD123456HDFRRX01" 
              class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-smart-input-bg border border-smart-border text-xs text-white placeholder-gray-500 focus:outline-none focus:border-smart-red uppercase tracking-wider transition-colors"
            >
          </div>
        </div>

        <!-- CAMPO CONTRASEÑA -->
        <div class="space-y-1.5">
          <div class="flex justify-between items-center">
            <label for="password" class="text-xs font-bold uppercase tracking-wider text-smart-text-muted">Contraseña</label>
            <a href="<?= base_url('login/forgot-password') ?>" class="text-[11px] text-smart-red hover:underline font-medium">¿Olvidaste tu contraseña?</a>
          </div>
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

        <!-- BOTÓN DE ENVIAR -->
        <button 
          type="submit" 
          class="w-full py-2.5 px-4 rounded-xl bg-smart-red hover:bg-red-700 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-smart-red/20 transition-all flex items-center justify-center gap-2 mt-2"
        >
          <span>Ingresar</span>
          <span class="material-symbols-outlined text-base">login</span>
        </button>

      </form>
    </div>

    <!-- ENLACE A REGISTRO -->
    <p class="text-center text-xs text-smart-text-muted">
      ¿No tienes una cuenta? 
      <a href="<?= base_url('usuarios/nuevo') ?>" class="text-white font-bold hover:underline">Regístrate aquí</a>
    </p>

  </div>

</body>
</html>