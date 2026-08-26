<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Registrar Usuario - Proyecto Smart</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style data-purpose="custom-styles">
    body { font-family: 'Inter', sans-serif; }
    .input-smart-custom {
      background-color: #1a1a1a !important;
      border: 1px solid #ffffff !important;
      color: #ffffff !important;
      transition: border-color 0.25s ease, box-shadow 0.25s ease !important;
    }
    .input-smart-custom:hover, .input-smart-custom:focus {
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
    .alert-codeigniter-danger { background-color: #c03c3c; border: 1px solid #c03c3c; color: #fecaca; }
  </style>
</head>
<body class="text-white min-h-screen flex items-center justify-center p-6 bg-smart-red">
  <div class="bg-smart-bg w-full max-w-4xl rounded-2xl shadow-2xl flex flex-col md:flex-row overflow-hidden">
    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
      <header class="w-full flex items-center justify-start mb-8">
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

      <main class="w-full flex flex-col">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold">Registro Nuevo Usuario</h2>
          <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M15 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm-9-2V7H4v3H1v2h3v3h2v-3h3v-2H6zm9 4c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
          </svg>
        </div>

        <?php if(session()->getFlashdata('msg')):?>
          <div class="mb-6 p-3 rounded-md alert-codeigniter-danger text-sm text-center font-medium">
            <?= session()->getFlashdata('msg') ?>
          </div>
        <?php endif;?>

        <form action="<?= base_url('/usuarios/guardar') ?>" method="post" class="flex flex-col gap-4">
          <div class="flex flex-col gap-1">
            <label class="text-sm font-semibold tracking-wide" for="curp">CURP</label>
            <input class="input-smart-custom rounded-md py-3 px-4 placeholder-smart-text-muted w-full text-sm" id="curp" name="curp" value="<?= old('curp') ?>" placeholder="Ingresa la CURP" required maxlength="18" type="text" />
          </div>

          <div class="flex flex-col gap-1">
            <label class="text-sm font-semibold tracking-wide" for="password">Contraseña</label>
            <input class="input-smart-custom rounded-md py-3 px-4 placeholder-smart-text-muted w-full text-sm" id="password" name="password" placeholder="Contraseña" required type="password" />
          </div>

          <div class="flex flex-col gap-1">
            <label class="text-sm font-semibold tracking-wide" for="puesto_id">Puesto</label>
            <select class="input-smart-custom rounded-md py-3 px-4 w-full text-sm" id="puesto_id" name="puesto_id" required>
              <option value="" disabled selected>Selecciona un puesto</option>
              <?php foreach($puestos as $puesto): ?>
                <option value="<?= $puesto['ID_puesto'] ?>" <?= old('puesto_id') == $puesto['ID_puesto'] ? 'selected' : '' ?>>
                  <?= $puesto['Nombre_puesto'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="flex flex-col gap-1">
            <label class="text-sm font-semibold tracking-wide" for="roles_id">Rol de Usuario</label>
            <select class="input-smart-custom rounded-md py-3 px-4 w-full text-sm" id="roles_id" name="roles_id" required>
              <option value="" disabled selected>Selecciona un rol</option>
              <?php foreach($roles as $rol): ?>
                <option value="<?= $rol['ID_roles'] ?>" <?= old('roles_id') == $rol['ID_roles'] ? 'selected' : '' ?>>
                  <?= $rol['Tipo_rol'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="flex justify-center mt-4">
            <button class="font-bold py-3 px-8 rounded-md w-full max-w-[250px] btn-smart-glow" type="submit">
              Registrarse
            </button>
          </div>
        </form>

        <div class="mt-6 text-center">
          <p class="text-sm text-white font-medium">
            ¿Ya tienes una cuenta? <a class="text-white hover:text-smart-red transition-colors font-semibold" href="<?= base_url('/') ?>">Volver al Login</a>
          </p>
        </div>
      </main>
    </div>

    <div class="hidden md:block md:w-1/2 bg-gray-900">
      <img alt="Decorative Background" class="w-full h-full object-cover" src="<?= base_url('CIUDAD1.jpg') ?>"/>
    </div>
  </div>
</body>
</html>