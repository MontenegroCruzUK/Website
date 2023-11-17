<?php
// Incluir el archivo de conexión a la base de datos
require_once "../../db.php";

// Definir una función para eliminar un registro por su ID
function eliminarServicio($connection, $id)
{
    $sentencia = $connection->prepare("DELETE FROM tbl_servicios WHERE id = :id");
    $sentencia->bindParam(":id", $id, PDO::PARAM_INT);
    $sentencia->execute();
}

// Verificar si se ha recibido el parámetro txt_id en la URL
if (isset($_GET['txt_id'])) {
    // Obtener y limpiar el valor del parámetro txt_id para evitar inyección SQL
    $txt_id = intval($_GET['txt_id']); // Convertir a entero para seguridad
    eliminarServicio($connection, $txt_id);
}

// Preparar y ejecutar la sentencia SQL para obtener la lista de servicios
$sentencia = $connection->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();
$lista_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Incluir el encabezado del sitio
require_once "../../template/header.php";?>

<!-- Aquí va el contenido de la página -->
<div class="container">
  <!-- Crea una tarjeta (card) que ocupará todo el ancho del contenedor -->
  <div class="card w-100">
    <!-- Encabezado de la tarjeta -->
    <div class="card-header">
      <!-- Botón para agregar registros -->
      <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros</a>
    </div>
    <!-- Cuerpo de la tarjeta -->
    <div class="card-body">
      <!-- Utiliza la clase table-responsive-sm para hacer la tabla responsive en pantallas pequeñas -->
      <div class="table-responsive-sm">
        <!-- Crea una tabla (table) con Bootstrap -->
        <table class="table">
          <!-- Encabezados de la tabla -->
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Icono</th>
              <th scope="col">Título</th>
              <th scope="col">Descripción</th>
              <th scope="col">Acción</th>
            </tr>
          </thead>
          <!-- Cuerpo de la tabla -->
          <tbody>
            <?php foreach ($lista_servicios as $registro) {?>
            <!-- Fila de datos -->
            <tr class="">
              <!-- Mostrar el ID del registro -->
              <td><?php echo $registro['id']; ?></td>
              <!-- Mostrar el icono del servicio -->
              <td><?php echo $registro['icono']; ?></td>
              <!-- Mostrar el título del servicio -->
              <td><?php echo $registro['titulo']; ?></td>
              <!-- Mostrar la descripción del servicio -->
              <td><?php echo $registro['descripcion']; ?></td>
              <td>
                <!-- Botón de edición con enlace a editar.php y pasando el ID como parámetro -->
                <a name="" id="" class="btn btn-info" href="editar.php?txt_id=<?php echo $registro['id']; ?>"
                  role="button">Editar</a>
                <!-- Botón de eliminación con enlace a index.php y pasando el ID como parámetro -->
                <a name="" id="" class="btn btn-danger" href="index.php?txt_id=<?php echo $registro['id']; ?>"
                  role="button">Eliminar</a>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
// Incluir el pie de página
require_once "../../template/footer.php";?>