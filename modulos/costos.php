<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
       Costos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar costos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCosto">
          
          Agregar costos

        </button>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">Id</th>
           <th>Costo Total</th>
           <th>Id Proyecto</th>
           <th>Presupuesto Total</th>
           <th>Viabilidad</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $costos = ControladorCostos::ctrMostrarCostos($item, $valor);

          foreach ($costos as $key => $value) {


           
            echo ' <tr>

                    <td>'.$value["id"].'</td>

                    <td class="text-uppercase">'.$value["Costo"].'</td>
                    <td class="text-uppercase">'.$value["IdProyect"].'</td>
                    <td class="text-uppercase">'.$value["Presupuesto"].'</td>
                    <td class="text-uppercase">'.$value["Viabilidad"].'</td>

                    <td>

                      <div class="btn-group">
                        

                        <button class="btn btn-danger btnEliminarCosto" idCosto="'.$value["id"].'"><i class="fa fa-times"></i></button>
                        <button class="btn btn-warning btnEditarProyecto" data-toggle="modal" data-target="#modalEditarCosto" data-idproyecto="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                      </div>  

                    </td>

                  </tr>';
          }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>
<script>
 $(document).ready(function() {
    // Escuchar el clic en los botones de edición
    $(".btnEditarProyecto").click(function() {
        // Obtener el ID del proyecto desde el atributo data-idproyecto
        var idCosto = $(this).data("idproyecto");

        // Realizar la solicitud AJAX para obtener los datos del proyecto
        $.ajax({
            type: "POST",
            url: "ajax/costos.ajax.php",
            data: { id: idCosto},
            success: function(data) {
                // Parsear y llenar los campos del formulario con los datos recibidos
                var costoData = JSON.parse(data);
                $("#EditCosto").val(costoData.Costo);
                $("#selProyectos").val(costoData.IdProyect);
                $("#selpresupuesto").val(costoData.Presupuesto);
                $("#id").val(idCosto);
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
MODAL AGREGAR COSTO
======================================-->

<div id="modalAgregarCosto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Costo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCosto" placeholder="Ingresar costo" required>

              </div>

            </div>




     <!-- Proyectos  -->
             
         <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="tr" name="tr" required>
                  <option value="">Selecionar Proyecto Gerente</option>
                  <?php
                  $item = null;
                  $valor = null;
 $cate= ControladorProyectosGerente::ctrMostrarProyectosGerente($item,$valor);

                  foreach ($cate as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["id"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>





            <!-- presupuesto -->
             
         <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="presupuestoT" name="presupuestoT" required>
                  <option value="">Selecionar Presupuesto Total</option>
                  <?php
                  $item = null;
                  $valor = null;
 $categorias = ControladorPresupuestosGerente::ctrMostrarPresupuestosGerente($item,$valor);

                  foreach ($categorias as $key => $value) {
                    echo '<option value="' . $value["costoTotal"] . '">' . $value["costoTotal"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
      
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Costo</button>

        </div>

        <?php

          $crearCosto = new ControladorCostos();
          $crearCosto -> ctrCrearCostos();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR COSTO
======================================-->

<div id="modalEditarCosto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Costo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <!-- ENTRADA id -->

            <div class="form-group">
              <div class="input-group">
                <input type="hidden" class="form-control input-lg" id="id" name="id"
                  placeholder="Ingresar ID" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
            <h5>Costo Total</h5>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control input-lg" name="EditCosto" id="EditCosto" placeholder="Edita Costo" required>

              </div>

            </div>



             <!-- Proyectos  -->
             
         <div class="form-group">
         <h5>Id Proyecto</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="selProyectos" name="selProyectos" required>
                  <option value="">Editar Proyecto Gerente</option>
                  <?php
                  $item = null;
                  $valor = null;
 $cate= ControladorProyectosGerente::ctrMostrarProyectosGerente($item,$valor);

                  foreach ($cate as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["id"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>





            <!-- presupuesto -->
             
         <div class="form-group">
         <h5>Presupuesto</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="selpresupuesto" name="selpresupuesto" required>
                  <option value="">Editar Presupuesto Total</option>
                  <?php
                  $item = null;
                  $valor = null;
 $categorias = ControladorPresupuestosGerente::ctrMostrarPresupuestosGerente($item,$valor);

                  foreach ($categorias as $key => $value) {
                    echo '<option value="' . $value["costoTotal"] . '">' . $value["costoTotal"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      <?php

          $editarCosto = new ControladorCostos();
          $editarCosto -> ctrEditarCostos();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCosto = new ControladorCostos();
  $borrarCosto -> ctrBorrarCostos();

?>


