<?php
include "../../db.php";

if ($_POST) {
    // Obtener los datos del formulario
    $icono = (isset($_POST['icon'])) ? $_POST['icon'] : "";
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";

    try {
        // Preparar la sentencia SQL para la inserción en la tabla 'tbl_servicios'
        $sentencia = $connection->prepare("INSERT INTO `tbl_servicios`(`id`, `icono`, `titulo`, `descripcion`) VALUES (NULL, :icono, :titulo, :descripcion)");

        // Vincular los valores a los marcadores de posición en la sentencia SQL
        $sentencia->bindParam(":icono", $icono);
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":descripcion", $descripcion);

        // Ejecutar la sentencia SQL
        $sentencia->execute();

        // Asignar el mensaje de éxito
        $mensaje = "Registro insertado correctamente";

        // Redirigir al usuario de vuelta al index después de realizar la acción y mostrar el mensaje
        header("Location: index.php");
        exit();

    } catch (PDOException $e) {
        // Capturar y mostrar cualquier error en la ejecución de la consulta
        echo "Error: " . $e->getMessage();
    }
}

include "../../template/header.php";
?>

<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Crear Servicios
        </div>
        <div class="card-body">
          <!-- Mostrar el mensaje de éxito si está presente -->
          <?php if (!empty($mensaje)) {?>
          <div class="alert alert-success" role="alert">
            <?php echo $mensaje; ?>
          </div>
          <?php }?>
          <form action="" enctype="multipart/form-data" method="post">
            <!-- Icono -->
            <div class="mb-2">
              <label for="icon" class="form-label">Icono</label>
              <input type="text" class="form-control form-control-sm" name="icon" id="icon" placeholder="Icono">
            </div>
            <!-- Titulo -->
            <div class="mb-2">
              <label for="titulo" class="form-label">Titulo</label>
              <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" placeholder="Titulo">
            </div>
            <!-- Descripcion -->
            <label for="descripcion" class="form-label">Descripción</label>
            <div class="mb-2">
              <input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion"
                placeholder="Descripción">
            </div>
            <button type="submit" class="btn btn-success btn-sm">Agregar</button>
            <a name="" id="" class="btn btn-primary btn-sm" href="index.php" role="button">Cancelar</a>
          </form>
        </div>
        <div class="card-footer text-muted">
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "../../template/footer.php";?>