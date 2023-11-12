<?php
if ($_SESSION["perfil"] == "Vendedor") {
  echo '<script>
    window.location = "inicio";
  </script>';
  return;
}
if ($_SESSION["perfil"] != "Gerente") {

  echo '
    
    ';

}


?>


<div class="content-wrapper">
  <section class="content-header">

    <?php
    if ($_SESSION['perfil'] == "Gerente") {
      echo '<h1>      
    Proyectos  
  </h1>';
    } else {
      echo '<h1>      
    Galería de Proyectos    
  </h1>';
    }
    ?>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <?php
      if ($_SESSION['perfil'] == "Administrador") {
        echo '<li class="active">Administrar Proyectos</li>';
      } else {
        echo '<li class="active">Galería de Proyectos</li> ';
      }
      ?>

    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <?php
        if ($_SESSION["perfil"] == "Gerente") {
          echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProyecto">          
          Agregar Proyecto
        </button>     
          
        <table class="table table-bordered table-striped dt-responsive tablas " width="100%">         
        <thead>         
          <tr>         
          <th>Código</th>
          <th>Categoría</th>
          <th>Cliente</th>
          <th>Cédula</th>
          <th>Presupuesto</th>
          <th>Plazo en Meses</th>
          <th>Hitos</th>
          <th>Tipo Empleados</th>
          <th>Horas Empleado</th>
          <th>Teléfono</th>
          <th>Ubicación</th>
          <th>Tareas</th>
          <th>Acciones</th>
          </tr> 
        </thead>
        <tbody>';

          $item = null;
          $valor = null;
          $proyectosG = ControladorProyectosGerente::ctrMostrarProyectosGerente($item, $valor);
          foreach ($proyectosG as $key => $value) {

            /*=============================================
            TRAEMOS LA CATEGORÍA
            =============================================*/
            $item = "id";
            $valor = $value["id_categoria"];
            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            /*=============================================
           TRAEMOS EL CLIENTE
           =============================================*/
            $item = "id";
            $valor = $value["id_cliente"];
            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

            /*=============================================
         TRAEMOS LOS HITOS
         =============================================*/
            $item = "id";
            $valor = $value["id_hito"];
            $hitos = ControladorHito::ctrMostrarHito($item, $valor);

            /*=============================================
          TRAEMOS LOS EMPLEADOS
          =============================================*/
            $item = "id";
            $valor = $value["empleado"];
            $empleados = ControladorEmpleado::ctrMostrarEmpleados($item, $valor);

            /*=============================================
          TRAEMOS LOS HITOS
          =============================================*/
            $item = "id";
            $valor = $value["tareas"];
            $tareas = ControladorTarea::ctrMostrarTarea($item, $valor);

            echo ' <tr>
                  <td>' . $value["id"] . '</td>
                  <td>' . $categorias["categoria"] . '</td>
                  <td>' . $clientes["nombre"] . '</td>
                  <td>' . $value["cedula"] . '</td>
                  <td>' . $value["presupuesto"] . '</td>
                  <td>' . $value["plazo"] . '</td>
                  <td>' . $hitos["descripcion"] . '</td>
                  <td>' . $empleados["descripcion"] . '</td>
                  <td>' . $value["horas"] . '</td>
                  <td>' . $value["numero"] . '</td>
                  <td>' . $value["ubicacion"] . '</td>
                  <td>' . $tareas["descripcion"] . '</td>
                  
                  <td>
                    <div class="btn-group">
                        
                      <button class="btn btn-danger btnEliminarProyecto" idProyecto="' . $value["id"] . '"><i class="fa fa-times"></i></button>
                      <button class="btn btn-warning btnEditarProyecto" data-toggle="modal" data-target="#modalEditarProyectoGerente" data-idproyecto="'.$value["id"].'"><i class="fa fa-pencil"></i></button>


                      </div>  
                  </td>
                  ';
          }

          $eliminarProyecto = new ControladorProyectosGerente();
          $eliminarProyecto->ctrEliminarProyecto();

        }
        ?>
      </div>
    </div>
  </section>
</div>


<script>
 $(document).ready(function() {
    // Escuchar el clic en los botones de edición
    $(".btnEditarProyecto").click(function() {
        // Obtener el ID del proyecto desde el atributo data-idproyecto
        var idProyecto = $(this).data("idproyecto");

        // Realizar la solicitud AJAX para obtener los datos del proyecto
        $.ajax({
            type: "POST",
            url: "ajax/proyectosgerente.ajax.php",
            data: { id: idProyecto },
            success: function(data) {
                // Parsear y llenar los campos del formulario con los datos recibidos
                var proyectoData = JSON.parse(data);
                $("#nuevoPresupuesto").val(proyectoData.presupuesto);
                $("#Plazo").val(proyectoData.plazo);
                $("#Categoria").val(proyectoData.id_categoria);
                $("#Hito").val(proyectoData.id_hito);
                $("#Tarea").val(proyectoData.tareas);
                $("#Empleado").val(proyectoData.empleado);
                $("#nuevoHoras").val(proyectoData.horas);
                $("#Numero").val(proyectoData.numero);
                $("#Ubicacion").val(proyectoData.ubicacion);
                $("#id").val(idProyecto);
            },
            error: function(error) {
                // Manejar errores si los hubiera
                console.log("Error al obtener los datos del proyecto: " + error);
            }
        });
    });
});


</script>

<!--=====================================
MODAL AGREGAR Proyecto
======================================-->
<div id="modalAgregarProyecto" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Proyecto </h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="nuevoCategoria" name="nuevoCategoria" required>
                  <option value="">Selecionar categoría</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR Cliente -->
            <!-- HTML -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" id="nuevoCliente" name="nuevoCliente" required>
                  <option value="">Seleccionar Cliente</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                  foreach ($clientes as $key => $value) {
                    echo '<option value="' . $value["id"] . '" data-cedula="' . $value["documento"] . '" " data-telefono="' . $value["telefono"] . '">' . $value["nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA LA CEDULA -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>
                <input type="text" class="form-control input-lg" id="nuevoCedula" name="nuevoCedula"
                  placeholder="Ingresar cédula del Cliente" maxlength="45" required readonly>
              </div>
            </div>

            <!-- ENTRADA PARA PRESUPUESTO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" name="nuevoPresupuesto" min="0"
                  placeholder="Presupuesto estimado" required>
              </div>
            </div>
            <!-- ENTRADA PARA Plazo -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoPlazo" min="0"
                  placeholder="Plazo en meses" required>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR HITO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <select class="form-control input-lg" id="nuevoHito" name="nuevoHito" required>
                  <option value="">Selecionar Hito</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $hitos = ControladorHito::ctrMostrarHito($item, $valor);
                  foreach ($hitos as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR Tarea -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                <select class="form-control input-lg" id="nuevoTarea" name="nuevoTarea" required>
                  <option value="">Selecionar Tarea</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $tareas = ControladorTarea::ctrMostrarTarea($item, $valor);
                  foreach ($tareas as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR  TIPO DE EMPLEADOS -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" id="nuevoEmpleado" name="nuevoEmpleado" required>
                  <option value="">Selecionar Tipo de Empleado</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $tareas = ControladorEmpleado::ctrMostrarEmpleados($item, $valor);
                  foreach ($tareas as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA HORAS -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoHoras" min="1"
                  placeholder="Horas por empleado" required>
              </div>
            </div>


            <!-- ENTRADA PARA la NUMERO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" id="nuevoNumero" name="nuevoNumero"
                  placeholder="Ingresar Número Telefónico Cliente" maxlength="20" required>
              </div>
            </div>

            <!-- ENTRADA PARA la UBICACION -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                <input type="text" class="form-control input-lg" id="nuevoUbicacion" name="nuevoUbicacion"
                  placeholder="Ingresar Ubicación de Cliente" maxlength="100" required>
              </div>


            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Proyecto</button>
        </div>
      </form>
      <?php
      $crearProyecto = new ControladorProyectosGerente();
      $crearProyecto->ctrCrearProyectoGerente();
      ?>
    </div>
  </div>
</div>




<!--=====================================
MODAL EDITAR Proyecto
======================================-->

  <div id="modalEditarProyectoGerente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Proyecto </h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">




           <!-- ENTRADA ID -->
             <div class="form-group">
              <div class="input-group">
                <!-- <span class="input-group-addon">ID</span> -->
                <input type="hidden" class="form-control input-lg" id="id" name="codigo" min="0"
                  placeholder="Ingrese el Codigo" required>
              </div>
<!-- <button type="button" class="btn btn-info" id="llenarDatosBtn">Llenar datos</button>  -->
            </div> 


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
            <div class="form-group">
            <h5>Categoria</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="Categoria" name="nuevoCategoria" required>
                  <option value="">Editar categoría</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

           

            <!-- ENTRADA PARA PRESUPUESTO -->
            <div class="form-group">
            <h5>Presupuesto</h5>
              <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" id="nuevoPresupuesto" name="nuevoPresupuesto" min="0"
                  placeholder="Presupuesto estimado" required>
              </div>
            </div>
            <!-- ENTRADA PARA Plazo -->
            <div class="form-group">
            <h5>Plazo en Meses</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="number" class="form-control input-lg" id="Plazo" name="nuevoPlazo" min="0"
                  placeholder="Plazo en meses" required>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR HITO -->
            <div class="form-group">
            <h5>Hito</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <select class="form-control input-lg" id="Hito" name="nuevoHito" required>
                  <option value="">Selecionar Hito</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $hitos = ControladorHito::ctrMostrarHito($item, $valor);
                  foreach ($hitos as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR Tarea -->
            <div class="form-group">
            <h5>Tarea</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check-square"></i></span>
                <select class="form-control input-lg" id="Tarea" name="nuevoTarea" required>
                  <option value="">Selecionar Tarea</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $tareas = ControladorTarea::ctrMostrarTarea($item, $valor);
                  foreach ($tareas as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR  TIPO DE EMPLEADOS -->
            <div class="form-group">
            <h5>Tipo de empleado</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" id="Empleado" name="nuevoEmpleado" required>
                  <option value="">Selecionar Tipo de Empleado</option>
                  <?php
                  $item = null;
                  $valor = null;
                  $tareas = ControladorEmpleado::ctrMostrarEmpleados($item, $valor);
                  foreach ($tareas as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA HORAS -->
            <div class="form-group">
            <h5>Horas por Empleado</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                <input type="number" class="form-control input-lg" id="nuevoHoras" name="nuevoHoras" min="1"
                  placeholder="Horas por empleado" required>
              </div>
            </div>


            <!-- ENTRADA PARA la NUMERO -->
            <div class="form-group">
            <h5>Número Telefónico Cliente</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" id="Numero" name="nuevoNumero"
                  placeholder="Ingresar Número Telefónico Cliente" maxlength="20" required>
              </div>
            </div>

            <!-- ENTRADA PARA la UBICACION -->
            <div class="form-group">
            <h5>Ubicación</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map"></i></span>
                <input type="text" class="form-control input-lg" id="Ubicacion" name="nuevoUbicacion"
                  placeholder="Ingresar Ubicación de Cliente" maxlength="100" required>
              </div>


            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar Proyecto</button>
        </div>
      </form>
      <?php
      $crearProyecto = new ControladorProyectosGerente();
      $crearProyecto->ctrEditarProyectoGerente();
      ?>
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
    // Cuando se haga clic en el botón "Llenar Datos"
    $("#llenarDatosBtn").click(function() {
        // Obtener el ID del presupuesto que se debe cargar (por ejemplo, desde un campo de entrada)
        var id= $("#id").val(); // Asegúrate de que el campo de entrada tenga el id "idPresupuesto" o ajusta este código según tu estructura HTML.
        // Realizar la solicitud AJAX para obtener los datos
        $.ajax({
            type: "POST",
            url: "ajax/proyectosgerente.ajax.php", 
            data: { id: id },
            success: function(data) {
                // Parsear y llenar los campos del formulario con los datos recibidos
                var proyectoData = JSON.parse(data);
                $("#nuevoPresupuesto").val(proyectoData.presupuesto);
                $("#Plazo").val(proyectoData.plazo);
                $("#nuevoCategoria").val(proyectoData.categoria);
                $("#nuevoHito").val(proyectoData.hito);
                $("#nuevoEmpleado").val(proyectoData.empleado);
                
                
            },
            error: function(error) {
                // Manejar errores si los hubiera
                console.log("Error al obtener los datos del presupuesto: " + error);
            }
        });
    });
});
</script>