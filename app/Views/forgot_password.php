<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Recuperar Contraseña - Proyecto Smart</title>

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

  <div class="bg-smart-bg w-full max-w-4xl rounded-2xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
    
    <!-- COLUMNA IZQUIERDA: FORMULARIO -->
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
      
      <header class="w-full flex items-center justify-start mb-8" data-purpose="header">
        <div class="flex items-center gap-3">
          <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" x2="22" y1="12" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
            <path d="M12 2v20"></path>
          </svg>
          <h1 class="text-xl font-bold tracking-wide">PROYECTO SMART</h1>
        </div>
      </header>

      <main class="w-full flex flex-col" data-purpose="main-content">
        
        <div class="flex flex-col mb-6" data-purpose="title-section">
          <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold">Recuperar Contraseña</h2>
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0110 0v4"></path>
            </svg>
          </div>
          <p class="text-xs text-smart-text-muted mt-2">
            Ingresa tu CURP y correo electrónico para enviarte las instrucciones de restablecimiento.
          </p>
        </div>

        <!-- ALERTAS DINÁMICAS PHP -->
        <?php if(session()->getFlashdata('msg')):?>
          <div class="mb-6 p-3 rounded-md alert-codeigniter-danger text-sm text-center font-medium">
            <?= session()->getFlashdata('msg') ?>
          </div>
        <?php endif;?>

        <?php if(session()->getFlashdata('success')):?>
          <div class="mb-6 p-3 rounded-md alert-codeigniter-success text-sm text-center font-medium">
            <?= session()->getFlashdata('success') ?>
          </div>
        <?php endif;?>

        <!-- FORMULARIO -->
        <form action="<?= base_url('login/send-reset-link') ?>" method="post" class="flex flex-col gap-5" data-purpose="reset-form">
          <?= csrf_field() ?>
          
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold tracking-wide" for="curp">CURP</label>
            <input 
              class="input-smart-custom rounded-md py-3 px-4 placeholder-smart-text-muted w-full text-sm" 
              id="curp" 
              name="curp" 
              placeholder="Ingresa tu CURP" 
              required 
              maxlength="18" 
              type="text"
            />
          </div>

          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold tracking-wide" for="email">Correo Electrónico</label>
            <input 
              class="input-smart-custom rounded-md py-3 px-4 placeholder-smart-text-muted w-full text-sm" 
              id="email" 
              name="email" 
              placeholder="ejemplo@correo.com" 
              required 
              type="email"
            />
          </div>

          <div class="flex justify-center mt-4">
            <button class="font-bold py-3 px-8 rounded-md w-full max-w-[250px] btn-smart-glow" type="submit">
              Enviar Enlace
            </button>
          </div>
        </form>

        <div class="mt-8 text-center" data-purpose="footer-link">
          <a class="text-sm text-white hover:text-smart-red transition-colors font-medium inline-flex items-center gap-2" href="<?= base_url('login') ?>">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver a Iniciar Sesión
          </a>
        </div>

      </main>
    </div>

    <!-- COLUMNA DERECHA: IMAGEN -->
    <div class="hidden md:block md:w-1/2 bg-gray-900">
      <img alt="Decorative Background" class="w-full h-full object-cover" src="<?= base_url('CIUDAD1.jpg') ?>"/>
    </div>

  </div>

</body>
</html>