<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Nueva Contraseña - SMART</title>

  <!-- 1. TAILWIND CSS DESDE CDN -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  
  <!-- 2. CONFIGURACIÓN DE COLORES PERSONALIZADOS -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'smart-bg': '#000000',          /* Fondo tarjeta (Negro) */
            'smart-red': '#c03c3c',         /* Rojo principal SMART */
            'smart-input-bg': '#1a1a1a',     /* Fondo inputs (Gris oscuro) */
            'smart-text-muted': '#a3a3a3',   /* Texto secundario (Gris claro) */
          },
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <!-- 3. FUENTES EXTERNAS -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>

  <!-- 4. BLOQUE DE ESTILOS CSS PERSONALIZADOS -->
  <style data-purpose="custom-styles">
    /* Configuración tipográfica global */
    body {
      font-family: 'Inter', sans-serif;
    }

    /* Fondo gris con borde blanco y transición */
    .input-smart-custom {
      background-color: #1a1a1a !important;
      border: 1px solid #ffffff !important;
      color: #ffffff !important;
      transition: border-color 0.25s ease, box-shadow 0.25s ease !important;
    }

    /* Borde rojo y sombra interna roja */
    .input-smart-custom:hover,
    .input-smart-custom:focus {
      border-color: #c03c3c !important;
      box-shadow: inset 0 0 10px #c03c3c !important;
      outline: none !important;
    }

    /* Botón blanco con texto negro */
    .btn-smart-glow {
      background-color: #ffffff !important;
      color: #000000 !important;
      border: none !important;
      transition: background-color 0.25s ease, color 0.25s ease, transform 0.2s ease !important;
    }

    /* Fondo rojo, texto blanco y animación al pasar el mouse */
    .btn-smart-glow:hover {
      background-color: #c03c3c !important;
      color: #ffffff !important;
      transform: translateY(-2px) !important;
    }

    /* Efecto de presión al hacer clic en el botón */
    .btn-smart-glow:active {
      transform: translateY(0px) !important;
    }

    /* Fondo rojo semi-transparente para mensajes de error */
    .alert-codeigniter-danger {
      background-color: #c03c3c;
      border: 1px solid #c03c3c;
      color: #fecaca;
    }

    /* Fondo verde semi-transparente para mensajes de éxito */
    .alert-codeigniter-success {
      background-color: rgba(6, 78, 59, 0.85);
      border: 1px solid #10b981;
      color: #a7f3d0;
    }
  </style>
</head>

<!-- NOTA DE DISEÑO: FONDO DE LA PÁGINA (bg-smart-red le da el fondo rojo completo) -->
<body class="text-white min-h-screen flex items-center justify-center p-6 bg-smart-red">

  <!-- NOTA DE DISEÑO: TARJETA CONTENEDORA (bg-smart-bg la hace negra, max-w-md para tarjetas de interacción rápida) -->
  <div class="bg-smart-bg w-full max-w-md rounded-2xl shadow-2xl overflow-hidden p-8 md:p-10 flex flex-col justify-center">
    
    <!-- ENCABEZADO CON LOGO -->
    <header class="w-full flex items-center justify-center mb-6" data-purpose="header">
      <div class="flex items-center gap-3">
        <!-- NOTA DE DISEÑO: ICONO LOGO SMART (w-9 h-9 le da el tamaño y text-white el color blanco) -->
        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="2" x2="22" y1="12" y2="12"></line>
          <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1 4-10z"></path>
          <path d="M12 2v20"></path>
        </svg>
        <h1 class="text-xl font-bold tracking-wide">PROYECTO SMART</h1>
      </div>
    </header>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="w-full flex flex-col" data-purpose="main-content">
      
      <!-- TÍTULO DE LA SECCIÓN -->
      <div class="flex flex-col items-center justify-center mb-6 text-center" data-purpose="title-section">
        <!-- NOTA DE DISEÑO: ICONO DE CANDADO / SEGURIDAD -->
        <div class="bg-smart-input-bg p-3 rounded-full mb-3 border border-gray-700">
          <svg class="w-7 h-7 text-smart-red" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
        </div>
        <h2 class="text-2xl font-bold">Nueva Contraseña</h2>
        <p class="text-xs text-smart-text-muted mt-1">Ingresa tu nueva clave de acceso para actualizarla.</p>
      </div>

      <!-- ALERTAS DINÁMICAS PHP -->
      <?php if(session()->getFlashdata('msg')):?>
        <!-- NOTA DE DISEÑO: ALERTA ERROR (Usa la clase .alert-codeigniter-danger del CSS) -->
        <div class="mb-6 p-3 rounded-md alert-codeigniter-danger text-sm text-center font-medium">
          <?= session()->getFlashdata('msg') ?>
        </div>
      <?php endif;?>

      <?php if(session()->getFlashdata('success')):?>
        <!-- NOTA DE DISEÑO: ALERTA ÉXITO (Usa la clase .alert-codeigniter-success del CSS) -->
        <div class="mb-6 p-3 rounded-md alert-codeigniter-success text-sm text-center font-medium">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif;?>

      <!-- FORMULARIO DE RESTABLECIMIENTO -->
      <form action="<?= base_url('login/update-password') ?>" method="post" class="flex flex-col gap-6" data-purpose="password-reset-form">
        
        <!-- CAMPO OCULTO: TOKEN -->
        <input type="hidden" name="token" value="<?= esc($token) ?>">

        <!-- CAMPO: NUEVA CONTRASEÑA -->
        <div class="flex flex-col gap-2">
          <label class="text-sm font-semibold tracking-wide" for="password">Nueva Contraseña</label>
          <!-- 
             NOTA DE DISEÑO: INPUT CONTRASEÑA 
             - .input-smart-custom: Aplica el fondo #1a1a1a y el borde blanco/rojo al hacer foco.
             - py-3 px-4: Define la altura y espacio interno del texto.
             - placeholder-smart-text-muted: Mantiene la tipografía gris claro secundaria.
          -->
          <input 
            class="input-smart-custom rounded-md py-3 px-4 placeholder-smart-text-muted w-full text-sm" 
            id="password" 
            name="password" 
            placeholder="Mínimo 6 caracteres" 
            required 
            minlength="6"
            type="password"
          />
        </div>

        <!-- BOTÓN PRINCIPAL: CAMBIAR CONTRASEÑA -->
        <div class="flex justify-center mt-2">
          <!-- 
             NOTA DE DISEÑO: BOTÓN ACCIÓN 
             - .btn-smart-glow: Mantiene el comportamiento de fondo blanco, texto negro y transición a rojo.
          -->
          <button class="font-bold py-3 px-8 rounded-md w-full btn-smart-glow" type="submit">
            Cambiar Contraseña
          </button>
        </div>
      </form>

      <!-- ENLACE DE NAVEGACIÓN DE REGRESO (FOOTER) -->
      <div class="mt-8 text-center" data-purpose="footer-link">
        <p class="text-sm text-white font-medium">
          <!-- NOTA DE DISEÑO: ENLACE VOLVER AL LOGIN (Cambia a rojo al pasar el cursor) -->
          ¿Recordaste tu clave? <a class="text-white hover:text-smart-red transition-colors font-semibold" href="<?= base_url('/') ?>">Volver al Login</a>
        </p>
      </div>

    </main>
  </div>

</body>
</html>