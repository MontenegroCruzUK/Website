<?php
include "../../db.php";
// Preparar y ejecutar la sentencia SQL para obtener la lista de portafolio
$sentencia = $connection->prepare("SELECT * FROM `tbl_portafolio`");
$sentencia->execute();
$lista_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Incluir el encabezado del sitio
include "../../template/header.php";
?>

<div class="card">
  <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar</a>
  </div>
  <div class="card-body">
    <div class="table-responsive-sm">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">titulo</th>
            <th scope="col">Subtitulo</th>
            <th scope="col">Imagen</th>
            <th scope="col">Descripción</th>
            <th scope="col">Cliente</th>
            <th scope="col">Categoria</th>
            <th scope="col">URL</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr class="">
            <td scope="col">1</td>
            <td scope="col"> Desarrollo de Apps Personalizadas</td>
            <td scope="col">Transformando Ideas en Experiencias Digitales</td>
            <td scope="col">imagen_1.png</td>
            <td scope="col">Nuestro equipo de expertos en desarrollo de aplicaciones está listo para convertir tu visión
              en una realidad digital. </td>
            <td scope="col">Estudio Creativo AppGenius</td>
            <td scope="col">Creación de Aplicaciones</td>
            <td scope="col">www.appgenius-desarrolloapps.com/desarrollo-apps-personalizadas</td>
            <td scope="col">Editar | Eliminar</td>
          </tr>

        </tbody>
      </table>
    </div>

  </div>
</div>

<?php include "../../template/footer.php";?>