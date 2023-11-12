<?php
if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){
  echo '<script>
    window.location = "inicio";
  </script>';
  return;
}
?>
<div class="content-wrapper">
  <section class="content-header">    
    <h1> Modificar Usuario</h1>
    <ol class="breadcrumb">      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>      
      <li class="active">Modificar Usuario</li>    
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">  
      </div>
      <div class="box-body">        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">         
        
        <tbody>
        <?php

          echo ' 
             <h3>Nombre:</h3><h4>'.$_SESSION["nombre"].'<h/4>
            <h3>Usuario:</h3><h4>'.$_SESSION["usuario"].' <h/4>';
                
                  if($_SESSION["foto"] != ""){
                    echo '<h3>Foto de Perfil</h3><img src="'.$_SESSION["foto"].'" class="img-thumbnail" width="150px">';
                  }else{
                    echo '<h3>Foto de Perfil</h3><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="150px">';
                  }            
                  echo '
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-info btnEditarUsuario" idUsuario="'.$_SESSION["id"].'" data-toggle="modal" data-target="#modalEditarUsuario">Modificar Datos</button>
                    </div>  
                  </td>';
          
        ?> 
        </tbody>
       </table>
      </div>
    </div>
  </section>
</div>
<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA EL NOMBRE -->            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
              </div>
            </div>
            <!-- ENTRADA PARA EL USUARIO -->
             <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
              </div>
            </div>
            <!-- ENTRADA PARA LA CONTRASEÑA -->
             <div class="form-group" hidden>              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                <input class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña" >
                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>
            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
            <div class="form-group" hidden>              
              <div class="input-group" >              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarPerfil">                  
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR FOTO -->
             <div class="form-group" hidden>              
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="editarFoto">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">
              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar usuario</button>
        </div>
        <?php
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarMiUsuario();
        ?> 
      </form>
    </div>
  </div>
</div>
