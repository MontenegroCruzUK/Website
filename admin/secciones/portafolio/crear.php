<?php
include "../../db.php";
if ($_POST) {
    // Obtener los datos del formulario
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $subtitulo = (isset($_POST['subtitulo'])) ? $_POST['subtitulo'] : "";
    $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";
    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : "";
    $categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : "";
    $url = (isset($_POST['url'])) ? $_POST['url'] : "";

    try {
        // Preparar la sentencia SQL para la inserción en la tabla 'tbl_portafolio '
        $sentencia = $connection->prepare("INSERT INTO `tbl_portafolio `(`id`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`) VALUES (NULL, :titulo, :subtitulo, :imagen, :descripcion, :cliente, :categoria, :url);");
        // Vincular los valores a los marcadores de posición en la sentencia SQL
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":subtitulo", $subtitulo);
        $sentencia->bindParam(":imagen", $imagen);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":cliente", $cliente);
        $sentencia->bindParam(":categoria", $categoria);
        $sentencia->bindParam(":url", $url);

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
include "../../template/header.php";?>
<div class="card">
  <div class="card-header">
    Producto Del Portafolio
  </div>
  <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">
      <!-- Titulo -->
      <div class="mb-3">
        <label for="titulo" class="form-label">Titulo</label>
        <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId"
          placeholder="Titulo">
      </div>
      <!-- Subtitulo -->
      <div class="mb-3">
        <label for="subtitulo" class="form-label">Subtitulo</label>
        <input type="text" class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId"
          placeholder="Subtitulo">
      </div>
      <!-- Imagen -->
      <div class="mb-3">
        <label for="imagen" class="form-label">Imagen</label>
        <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId"
          placeholder="Imagen">
      </div>
      <!-- Descripcion -->
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripcion</label>
        <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId"
          placeholder="Descripcion">
      </div>
      <!-- Cliente -->
      <div class="mb-3">
        <label for="cliente" class="form-label">Cliente</label>
        <input type="text" class="form-control" name="cliente" id="cliente" aria-describedby="helpId"
          placeholder="Cliente">
      </div>
      <!-- Categoria -->
      <div class="mb-3">
        <label for="categoria" class="form-label">Categoria</label>
        <input type="text" class="form-control" name="categoria" id="categoria" aria-describedby="helpId"
          placeholder="Categoria">
      </div>
      <!-- URL -->
      <div class="mb-3">
        <label for="url" class="form-label">Direccion URL</label>
        <input type="text" class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="URL">
      </div>
      <!-- Botones -->
      <button type="submit" class="btn btn-success btn-sm">Agregar</button>
      <a name="" id="" class="btn btn-primary btn-sm" href="index.php" role="button">Cancelar</a>
    </form>

  </div>
  <div class="card-footer text-muted">
    Footer
  </div>
</div>












<?php include "../../template/footer.php";?>