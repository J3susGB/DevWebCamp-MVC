<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Regístrate en DevWebcamp</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

<form method="POST" action="/registro" class="formulario">
        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>
            <input
                type="text"
                class="formulario__input"
                placeholder="Introduce tu nombre"
                id="nombre"
                name="nombre"
                value="<?php echo $usuario->nombre; ?>"
            />
        </div>
        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>
            <input
                type="text"
                class="formulario__input"
                placeholder="Introduce tu apellido"
                id="apellido"
                name="apellido"
                value="<?php echo $usuario->apellido; ?>"
            />
        </div>
        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>
            <input
                type="email"
                class="formulario__input"
                placeholder="Introduce tu email"
                id="email"
                name="email"
                value="<?php echo $usuario->email; ?>"
            />
        </div>
        <div class="formulario__campo">
            <label for="password" class="formulario__label">Contraseña</label>
            <input
                type="password"
                class="formulario__input"
                placeholder="Introduce tu contraseña"
                id="password"
                name="password"
            />
        </div>
        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir contraseña</label>
            <input
                type="password"
                class="formulario__input"
                placeholder="Vuelve a introducir la contraseña"
                id="password2"
                name="password2"
            />
        </div>
        <input type="submit" class="formulario__submit" value="Crear cuenta">
    </form>

    <div class="acciones">
            <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar sesión</a>
            <a href="/olvide" class="acciones__enlace">Olvidé mi contraseña</a>
    </div>
</main>