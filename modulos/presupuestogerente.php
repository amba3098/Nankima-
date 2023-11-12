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
    Presupuestos  
  </h1>';
    } else {
      echo '<h1>      
    Galería de Presupuesto    
  </h1>';
    }
    ?>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <?php
      if ($_SESSION['perfil'] == "Administrador") {
        echo '<li class="active">Administrar Presupuestos</li>';
      } else {
        echo '<li class="active">Galería de Presupuestos</li> ';
      }
      ?>

    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">

        <?php
        if ($_SESSION["perfil"] == "Gerente") {
          echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCostos">          
          Agregar Presupuesto
        </button>';

        echo '<div class="box-body">        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">       
        <thead>         
          <tr>         
          <th>Código</th>
          <th>Categoría</th>
          <th>Cliente</th>
          <th>Cédula</th>
          <th>Presupuesto</th>
          <th>Presupuesto Seguros</th>
          <th>Presupuesto Materiales</th>
          <th>Presupuesto Maquinaria</th>
          <th>Presupuesto Permisos</th>
          <th>Presupuesto Contingencia</th>
          <th>Presupuesto Total</th>
          <th>Acciones</th>
          </tr> 
        </thead>
        <tbody>';

          $item = null;
          $valor = null;
          $PresupuestoA = ControladorPresupuestosGerente::ctrMostrarPresupuestosGerente($item, $valor);
          foreach ($PresupuestoA as $key => $value) {

            /*=============================================
            TRAEMOS LA CATEGORÍA
            =============================================*/
            $item = "id";
            $valor = $value["categoria"];
            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            /*=============================================
           TRAEMOS EL CLIENTE
           =============================================*/
            $item = "id";
            $valor = $value["cliente"];
            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                    

            echo ' <tr>
                  <td>' . $value["codigo"] . '</td>
                  <td>' . $categorias["categoria"] . '</td>
                  <td>' . $clientes["nombre"] . '</td>
                  <td>' . $value["cedula"] . '</td>
                  <td>' . $value["presupuesto"] . '</td>
                  <td>' . $value["seguros"] . '</td>
                  <td>' . $value["materiales"] . '</td>
                  <td>' . $value["maquinaria"] . '</td>
                  <td>' . $value["permisos"] . '</td>
                  <td>' . $value["contingencia"] . '</td>
                  <td>' . $value["costoTotal"] . '</td>
                  

                  <td>
                     <div class="btn-group">

                      <button class="btn btn-danger btnEliminarPresupuesto" idPresupuesto="' . $value["codigo"] . '">
                      <i class="fa fa-times"></i></button>
                      <button class="btn btn-warning btnEditarPresupuesto" data-toggle="modal" data-target="#modalEditarPresupuestoGerente" data-idproyecto="'.$value["codigo"].'"><i class="fa fa-pencil"></i></button>


                      </div>
                  </td>
                  ';
          }
        
          $eliminarPresupuesto = new ControladorPresupuestosGerente();
          $eliminarPresupuesto->ctrEliminarPresupuesto();

        }
        ?>
      </div>
    </div>
  </section>
</div>
<script>
 $(document).ready(function() {
    $(".btnEditarPresupuesto").click(function() {
        var idPresupuesto = $(this).data("idproyecto");
        $.ajax({
            type: "POST",
            url: "ajax/presupuestogerente.ajax.php",  
            data: { id: idPresupuesto },
            success: function(data) {
                var presupuestoData = JSON.parse(data);
                $("#nuevoPresupuesto").val(presupuestoData.presupuesto);
                $("#nuevoSeguro").val(presupuestoData.seguros);
                $("#nuevoCostoMateriales").val(presupuestoData.materiales);
                $("#nuevaMaquinaria").val(presupuestoData.maquinaria);
                $("#nuevoCostoPermisos").val(presupuestoData.permisos);
                $("#nuevoPresupuestoCont").val(presupuestoData.contingencia);
                $("#id").val(idPresupuesto);
            },
            error: function(error) {
                // Manejar errores si los hubiera
                console.log("Error al obtener los datos del presupuesto: " + error);
            }
        });
    });
});
</script>

<!--=====================================
MODAL AGREGAR Proyecto
======================================-->
<div id="modalAgregarCostos" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Presupuesto </h4>
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
            <!-- ENTRADA PARA CostoSeguros -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" name="nuevoSeguro" min="0"
                  placeholder="Costos Seguros" required>
              </div>
            </div>
            <!-- ENTRADA PARA Precio Materiales -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" name="nuevoCostoMateriales" min="0"
                  placeholder="Costo Materiales" required>
              </div>
            </div>

            
            <!-- ENTRADA PARA el costo de Maquinaria -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">₡</i></span>
                <input type="number" class="form-control input-lg" id="nuevoMaquinaria" name="nuevoMaquinaria"
                  placeholder="Ingresar Costo Maquinaria" maxlength="100000000" required>
              </div>

              <!-- ENTRADA PARA PCostoPermisos -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" name="nuevoCostoPermisos" min="0"
                  placeholder="Costo Permisos" required>
              </div>
            </div>

            </div>
            <!-- ENTRADA PARA PRESUPUESTO Contingencia -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" name="nuevoPresupuestoCont" min="0"
                  placeholder="Presupuesto de Contingencia" required>
              </div>
            </div>

             

          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Presupuesto</button>
        </div>
      </form>
      <?php
      $crearProyecto = new ControladorPresupuestosGerente();
      $crearProyecto->ctrCrearPresupuestoGerente();
      ?>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR Proyecto
======================================-->
<div id="modalEditarPresupuestoGerente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Presupuesto</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">



            <!-- ID -->
            <div class="form-group">
              <div class="input-group">
                
                <input type="hidden"  class="form-control input-lg" name="id" id="id" min="0"placeholder="Ingresar Id" required>             
              </div>  
              <!-- Botón para llenar datos
<button type="button" class="btn btn-info" id="llenarDatosBtn">Llenar datos</button>  -->
            </div>


          <!-- ENTRADA PARA PRESUPUESTO -->
            <div class="form-group">
              <h5>Presupuesto</h5>
              <div class="input-group">
                <span class="input-group-addon">₡</span>

                <input type="hidden" id="idPresupuesto" name="idPresupuesto"  required>

                <input type="number" class="form-control input-lg" name="nuevoPresupuesto" id="nuevoPresupuesto" min="0"placeholder="Presupuesto estimado" required>
             
              </div>   
            </div>


            <!-- ENTRADA PARA CostoSeguros -->
            <div class="form-group">
            <h5>Seguro</h5>
               <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" id="nuevoSeguro" name="nuevoSeguro" min="0"
                  placeholder="Costos Seguros" required>
              </div>
            </div>


            <!-- ENTRADA PARA Precio Materiales -->
            <div class="form-group">
            <h5>Presupuesto Materiales</h5>
              <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" id="nuevoCostoMateriales" name="nuevoCostoMateriales" min="0"
                  placeholder="Costo Materiales" required>
              </div>
            </div>

            
            <!-- ENTRADA PARA el costo de Maquinaria -->
            <div class="form-group">
            <h5>Presupuesto Maquinaria</h5>
              <div class="input-group">
                <span class="input-group-addon">₡</i></span>
                <input type="number" class="form-control input-lg" id="nuevaMaquinaria" name="nuevoMaquinaria"
                  placeholder="Ingresar Costo Maquinaria" maxlength="100000000" required>
              </div>
            </div>

            
              <!-- ENTRADA PARA PCostoPermisos -->
            <div class="form-group">
            <h5>Presupuesto Permisos</h5>
              <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" id="nuevoCostoPermisos" name="nuevoCostoPermisos" min="0"
                  placeholder="Costo Permisos" required>
              </div>
            </div>

            
            <!-- ENTRADA PARA PRESUPUESTO Contingencia -->
            <div class="form-group">
            <h5>Presupuesto Contingencia</h5>
              <div class="input-group">
                <span class="input-group-addon">₡</span>
                <input type="number" class="form-control input-lg" id="nuevoPresupuestoCont" name="nuevoPresupuestoCont" min="0"
                  placeholder="Presupuesto de Contingencia" required>
              </div>
            </div>


              <!--=====================================
        PIE DEL MODAL
        ======================================-->
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary">Actualizar Presupuesto</button>
                

              </div>
      </form>
      <?php
      $crearProyecto = new ControladorPresupuestosGerente();
      $crearProyecto->ctrEditarPresupuestoGerente();
      ?>
    </div>
  </div>
</div>



