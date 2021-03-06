<section class="flex-container login">
  <div class="form-container">
    <h1>FRASES FAVORITAS</h1>
    <h2>Iniciar Sesión</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" autocomplete="off">
      <div class="form-group">
        <label for="email">Correo:</label>
        <input type="text" placeholder="ejemplo@ejemplo.com" name="email" value="<?php echo $email;?>">
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" name="password">
      </div>
      <div class="btn-group">
        <button class="btn success" name="login">Entrar</button>
        <a href="register.php" class="btn success">Registrarse</a>
      </div>
      <div class="form-group">
        <?php 
          if (!$validado)
            echo $err;
          else {
            echo "<p class=\"noAuth\">*Usuario no Autorizado</p>";
            echo "<p>Quedan {$_SESSION["count"]} intentos</p>";
          }
        ?>
      </div>
    </form>
  </div>
</section>