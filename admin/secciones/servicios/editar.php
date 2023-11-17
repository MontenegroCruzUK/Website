<?php
// Incluir el archivo de conexión a la base de datos
include "../../db.php";

// Declarar e inicializar las variables
$txt_id = "";
$icono = "";
$titulo = "";
$descripcion = "";
$mensaje = "";

// Verificar si se ha proporcionado el parámetro 'txt_id' en la URL
if (isset($_GET['txt_id'])) {
    $txt_id = $_GET['txt_id'];

    // Consultar la base de datos para obtener los detalles del registro
    $consulta = "SELECT * FROM tbl_servicios WHERE id = :id";
    $sentencia = $connection->prepare($consulta);
    $sentencia->bindParam(":id", $txt_id);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        // Asignar los valores del registro a las variables
        $icono = $registro['icono'];
        $titulo = $registro['titulo'];
        $descripcion = $registro['descripcion'];
    } else {
        // Mostrar un mensaje de error si no se encuentra el registro
        $mensaje = "Registro no encontrado";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validar y obtener los valores enviados por POST
    $txt_id = isset($_POST['txt_id']) ? $_POST['txt_id'] : "";
    $icono = isset($_POST['icono']) ? $_POST['icono'] : "";
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";

    // Actualizar los datos en la base de datos
    $actualizacion = "UPDATE tbl_servicios SET icono = :icono, titulo = :titulo, descripcion = :descripcion WHERE id = :id";
    $sentencia = $connection->prepare($actualizacion);
    $sentencia->bindParam(":icono", $icono);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":id", $txt_id);

    if ($sentencia->execute()) {
        $mensaje = "Registro modificado con éxito";
        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit(); // Terminar la ejecución después de redirigir
    } else {
        $mensaje = "Error al actualizar el registro";
    }
}
// Incluir el encabezado de la página
include "../../template/header.php";?>

<!-- Aquí va el contenido de tu página, como el formulario HTML y la presentación de mensajes -->
<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <!-- Crear una tarjeta -->
      <div class="card">
        <div class="card-header text-center">
          <h2>Editar</h2> <!-- Encabezado de la tarjeta con el título "Editar" -->
        </div>
        <div class="card-body">
          <!-- Iniciar un formulario que enviará datos a la misma página -->
          <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-2">
              <!-- ID -->
              <label for="txt_id" class="form-label">Id</label> <!-- Etiqueta para el campo de ID -->
              <input readonly value="<?php echo $txt_id; ?>" type="text" class="form-control form-control-sm"
                name="txt_id" id="txt_id" placeholder="Id"> <!-- Campo de solo lectura para mostrar el ID -->
            </div>
            <!-- Icono -->
            <div class="mb-2">
              <label for="icono" class="form-label">Icono</label> <!-- Etiqueta para el campo de icono -->
              <input value="<?php echo $icono; ?>" type="text" class="form-control form-control-sm" name="icono"
                id="icono" placeholder="Icono"> <!-- Campo para ingresar el icono -->
            </div>
            <!-- Titulo -->
            <div class="mb-2">
              <label for="titulo" class="form-label">Titulo</label> <!-- Etiqueta para el campo de título -->
              <input value="<?php echo $titulo; ?>" type="text" class="form-control form-control-sm" name="titulo"
                id="titulo" placeholder="Titulo"> <!-- Campo para ingresar el título -->
            </div>
            <!-- Descripcion -->
            <label for="descripcion" class="form-label">Descripción</label>
            <!-- Etiqueta para el campo de descripción -->
            <div class="mb-2">
              <input value="<?php echo $descripcion; ?>" type="text" class="form-control form-control-sm"
                name="descripcion" id="descripcion" placeholder="Descripción">
              <!-- Campo para ingresar la descripción -->
            </div>
            <!-- Botones -->
            <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
            <!-- Botón para enviar el formulario -->
            <a name="" id="" class="btn btn-primary btn-sm" href="index.php" role="button">Cancelar</a>
            <!-- Enlace para cancelar y regresar a la página principal -->
          </form> <!-- Cerrar el formulario -->
        </div>
        <div class="card-footer text-muted">
          <!-- Pie de la tarjeta, puede ser utilizado para mostrar información adicional -->
        </div>
      </div> <!-- Cerrar la tarjeta -->
    </div>
  </div>
</div>

<?php
// Incluir el pie de página
include "../../template/footer.php";
?>