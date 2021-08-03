<section class="container">
  <a href="<?php echo $_SERVER["PHP_SELF"], "?logout"?>" class="btn success">Logout</a>
  <h1>Mis frases favoritas</h1>
  <p>Bienvenido <?php echo $_SESSION["name"];?></p>
  <form id="form-send" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
    <div class="flex-container">
      <div class="form-group flex-1">
        <label>Frase</label><input type="text" name="frase">
      </div>
      <div class="form-group flex-1">
        <label>Autor</label><input type="text" name="autor">
      </div>
      <div class="form-group flex-1">
        <label>Categoria</label><input type="text" name="categoria">
      </div>
      <div class="form-group">
        <label>es pública?</label><input type="checkbox" checked name="esPublico">
      </div>
    </div>
    <div class="form-group">
      <?= !empty($err)? $err : "" ?>
    </div>
    <div class="btn-group">
      <button class="btn success" name="sendInsert">insertar</button>
    </div>
  </form>
  <div class="flex-container">
    <table class="table">
      <thead>
        <tr>
          <th>Es público?</th>
          <th>Frase</th>
          <th>autor</th>
          <th>Categoria</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?= create_rows($_SESSION["data"], $edit) ?>
      </tbody>
    </table>
  </div>
</section>