<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Login - Proyecto Smart</title>

  <!-- 1. TAILWIND CSS DESDE CDN -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  
  <!-- 2. CONFIGURACIÓN DE COLORES  -->
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

   <!-- BLOQUE DE ESTILOS CSS RECOMENDADO -->
  <style data-purpose="custom-styles">
    body {
      font-family: 'Inter', sans-serif;
    }

   /* ESTILOS */

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

/* Botón blanco con texto negro*/
.btn-smart-glow {
  background-color: #ffffff !important;
  color: #000000 !important;
  border: none !important;
  transition: background-color 0.25s ease, color 0.25s ease, transform 0.2s ease !important;
}

/* Fondo rojo, texto blanco y animacion al pasar el mouse */
.btn-smart-glow:hover {
  background-color: #c03c3c !important;
  color: #ffffff !important;
  transform: translateY(-2px) !important;
}

/* Efecto de presion al hacer clic en el boton */
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

<!-- FONDO DE LA PÁGINA -->
<body class="text-white min-h-screen flex items-center justify-center p-6 bg-smart-red">

  <!-- TARJETA CONTENEDORA -->
  <div class="bg-smart-bg w-full max-w-4xl rounded-2xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
    
    <!-- COLUMNA IZQUIERDA: FORMULARIO -->
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
      
      <!-- ENCABEZADO CON LOGO -->
      <header class="w-full flex items-center justify-start mb-8" data-purpose="header">
        <div class="flex items-center gap-3">
          <!-- ICONO LOGO -->
          <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" x2="22" y1="12" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
            <path d="M12 2v20"></path>
          </svg>
          <h1 class="text-xl font-bold tracking-wide">PROYECTO SMART</h1>
        </div>
      </header>

      <!-- CONTENIDO PRINCIPAL -->
      <main class="w-full flex flex-col" data-purpose="main-content">
        
        <!-- TÍTULO DE LA SECCIÓN -->
        <div class="flex items-center justify-between mb-8" data-purpose="title-section">
          <h2 class="text-2xl font-bold">Inicio de Sesión</h2>
          <!-- ICONO DE USUARIO -->
          <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
          </svg>
        </div>

        <!-- ALERTAS DINÁMICAS PHP -->
        <?php if(session()->getFlashdata('msg')):?>
          <!-- ALERTA ERROR  -->
          <div class="mb-6 p-3 rounded-md alert-codeigniter-danger text-sm text-center font-medium">
            <?= session()->getFlashdata('msg') ?>
          </div>
        <?php endif;?>

        <?php if(session()->getFlashdata('success')):?>
          <!-- ALERTA ÉXITO -->
          <div class="mb-6 p-3 rounded-md alert-codeigniter-success text-sm text-center font-medium">
            <?= session()->getFlashdata('success') ?>
          </div>
        <?php endif;?>

        <!-- FORMULARIO -->
        <form action="<?= base_url('/login/auth') ?>" method="post" class="flex flex-col gap-6" data-purpose="login-form">
          
          <!-- CAMPO 1: CURP -->
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold tracking-wide" for="curp">CURP</label>
            <!-- 
               NOTA DE DISEÑO: INPUT CURP -->
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

          <!-- CAMPO 2: CONTRASEÑA -->
          <div class="flex flex-col gap-2">
            <label class="text-sm font-semibold tracking-wide" for="password">Contraseña</label>
            <!-- 
               INPUT CONTRASEÑA -->
            <input 
              class="input-smart-custom rounded-md py-3 px-4 placeholder-smart-text-muted w-full text-sm" 
              id="password" 
              name="password" 
              placeholder="Ingresa tu contraseña" 
              required 
              type="password"
            />
          </div>

          <!-- ENLACE: RECUPERAR CONTRASEÑA -->
          <div class="flex justify-end mt-2">
            <!-- 
               ENLACE OLVIDASTE CONTRASEÑA -->
            <a class="text-sm text-white hover:text-smart-red transition-colors font-medium" href="<?= base_url('login/forgot-password') ?>">
              ¿Olvidaste tu contraseña?
            </a>
          </div>

          <!-- BOTÓN PRINCIPAL: INGRESAR -->
          <div class="flex justify-center mt-6">
            <!-- 
               NOTA DE DISEÑO: BOTÓN DE ENVÍO -->
            <button class="font-bold py-3 px-8 rounded-md w-full max-w-[250px] btn-smart-glow" type="submit">
              Ingresar
            </button>
          </div>
        </form>

        <!-- ENLACE DE REGISTRO (FOOTER) -->
        <div class="mt-8 text-center" data-purpose="footer-link">
          <p class="text-sm text-white font-medium">
            <!-- ENLACE REGÍSTRATE AQUÍ-->
            ¿No tienes cuenta? <a class="text-white hover:text-smart-red transition-colors font-semibold" href="<?= base_url('/usuarios/nuevo') ?>">Regístrate aquí</a>
          </p>
        </div>

      </main>
    </div>

    <!-- COLUMNA DERECHA: IMAGEN DECORATIVA -->
    <!-- IMAGEN LATERAL-->
    <div class="hidden md:block md:w-1/2 bg-gray-900">
  <img alt="Decorative Background" class="w-full h-full object-cover" src="<?= base_url('CIUDAD1.jpg') ?>"/>
</div>

  </div>

</body>
</html>