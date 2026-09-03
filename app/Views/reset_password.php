<!DOCTYPE html>
<html lang="es">
<head>
  <!-- CONFIGURACIÓN BÁSICA DEL DOCUMENTO Y SOPORTE DE IDIOMA -->
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>NUEVA CONTRASEÑA - PROYECTO SMART</title>

  <!-- TAILWIND CSS DESDE CDN -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  
  <!-- CONFIGURACIÓN DE COLORES -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'smart-bg': '#000000',
            'smart-red': '#c03c3c',
            'smart-input-bg': '#1a1a1a',
            'smart-text-muted': '#a3a3a3',
          },
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <!-- FUENTES EXTERNAS -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>

  <!-- ESTILOS CSS PERSONALIZADOS -->
  <style data-purpose="custom-styles">
    body { font-family: 'Inter', sans-serif; }
    .input-smart-custom {
      background-color: #1a1a1a !important;
      border: 1px solid #ffffff !important;
      color: #ffffff !important;
      transition: border-color 0.25s ease, box-shadow 0.25s ease !important;
    }
    .input-smart-custom:hover,
    .input-smart-custom:focus {
      border-color: #c03c3c !important;
      box-shadow: inset 0 0 10px #c03c3c !important;
      outline: none !important;
    }
    .btn-smart-glow {
      background-color: #ffffff !important;
      color: #000000 !important;
      border: none !important;
      transition: background-color 0.25s ease, color 0.25s ease, transform 0.2s ease !important;
    }
    .btn-smart-glow:hover {
      background-color: #c03c3c !important;
      color: #ffffff !important;
      transform: translateY(-2px) !important;
    }
    .btn-smart-glow:active { transform: translateY(0px) !important; }
    .alert-codeigniter-danger {
      background-color: #c03c3c;
      border: 1px solid #c03c3c;
      color: #fecaca;
    }
    .alert-codeigniter-success {
      background-color: rgba(6, 78, 59, 0.85);
      border: 1px solid #10b981;
      color: #a7f3d0;
    }
  </style>
</head>

<body class="text-white min-h-screen flex items-center justify-center p-6 bg-smart-red">

  <div class="bg-smart-bg w-full max-w-md rounded-2xl shadow-2xl overflow-hidden p-8 md:p-10 flex flex-col justify-center">
    
    <header class="w-full flex items-center justify-center mb-6" data-purpose="header">
      <div class="flex items-center gap-3">
        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="2" x2="22" y1="12" y2="12"></line>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
          <path d="M12 2v20"></path>
        </svg>
        <h1 class="text-xl font-bold tracking-wide">PROYECTO SMART</h1>
      </div>
    </header>

    <main class="w-full flex flex-col" data-purpose="main-content">
      
      <div class="flex flex-col items-center justify-center mb-6 text-center" data-purpose="title-section">
        <div class="bg-smart-input-bg p-3 rounded-full mb-3 border border-gray-700">
          <svg class="w-7 h-7 text-smart-red" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
        </div>
        <h2 class="text-2xl font-bold uppercase">NUEVA CONTRASEÑA</h2>
        <p class="text-xs text-smart-text-muted mt-1 uppercase">INGRESA TU NUEVA CLAVE DE ACCESO PARA ACTUALIZARLA.</p>
      </div>

      <!-- ALERTAS DINÁMICAS PHP -->
      <?php if(session()->getFlashdata('msg')):?>
        <div class="mb-6 p-3 rounded-md alert-codeigniter-danger text-sm text-center font-medium uppercase">
          <?= session()->getFlashdata('msg') ?>
        </div>
      <?php endif;?>

      <?php if(session()->getFlashdata('success')):?>
        <div class="mb-6 p-3 rounded-md alert-codeigniter-success text-sm text-center font-medium uppercase">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif;?>

      <!-- FORMULARIO DE RESTABLECIMIENTO -->
      <form action="<?= base_url('login/update-password') ?>" method="post" class="flex flex-col gap-5" data-purpose="password-reset-form">
        <?= csrf_field() ?>
        
        <!-- CAMPO OCULTO: TOKEN -->
        <input type="hidden" name="token" value="<?= esc($token) ?>">

        <!-- CAMPO 1: NUEVA CONTRASEÑA -->
        <div class="flex flex-col gap-2">
          <label class="text-sm font-semibold tracking-wide uppercase" for="password">NUEVA CONTRASEÑA</label>
          <input 
            class="input-smart-custom rounded-md py-3 px-4 placeholder-smart-text-muted w-full text-sm" 
            id="password" 
            name="password" 
            placeholder="MÍNIMO 6 CARACTERES" 
            required 
            minlength="6"
            type="password"
          />
        </div>

        <!-- CAMPO 2: CONFIRMAR CONTRASEÑA -->
        <div class="flex flex-col gap-2">
          <label class="text-sm font-semibold tracking-wide uppercase" for="confirm_password">CONFIRMAR CONTRASEÑA</label>
          <input 
            class="input-smart-custom rounded-md py-3 px-4 placeholder-smart-text-muted w-full text-sm" 
            id="confirm_password" 
            name="confirm_password" 
            placeholder="REPITE TU NUEVA CONTRASEÑA" 
            required 
            minlength="6"
            type="password"
          />
        </div>

        <div class="flex justify-center mt-2">
          <button class="font-bold py-3 px-8 rounded-md w-full btn-smart-glow uppercase" type="submit">
            CAMBIAR CONTRASEÑA
          </button>
        </div>
      </form>

      <div class="mt-8 text-center" data-purpose="footer-link">
        <p class="text-sm text-white font-medium uppercase">
          ¿RECORDASTE TU CLAVE? <a class="text-white hover:text-smart-red transition-colors font-semibold uppercase" href="<?= base_url('login') ?>">VOLVER AL LOGIN</a>
        </p>
      </div>

    </main>
  </div>

</body>
</html>