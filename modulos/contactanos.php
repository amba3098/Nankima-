<head>
  <style> 
 .contenedor {
    display: flex;
    align-items: center;
    margin-top: 20px;
    background-color:#aeeaeb;
  }

  .image {
    width: 600px;
    height: auto;
    margin-right: 20px;
  }
  
  .content {
    flex: 1;
  }
  .carousel-caption{
    background-color:black;
    opacity: 70%;
    color:white;
  }
 
  
  .contacto{
    display: flex;
    align-items: center;
    margin-top: 20px;
    width: 60%;
  
   }

   .formulario{
    margin-top: 20px;
    width: 40%;
  
   }
    .caja{
    display: flex;
    align-items: center;
    margin-top: 20px;
}

  </style>
</head>

<div class="content-wrapper">

  <section class="content-header">
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">
  <b><h1>Contáctanos</h1></b>
<div class="caja">
    
  <div class="formulario">
  <div class="container" style="width: 70%;">
  <h2>Formulario de Contacto</h2>
  <form action="https://formsubmit.co/castrodva@gmail.com" method="POST">
    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" require class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
      <label for="telefono">Teléfono:</label>
      <input require type="tel" class="form-control" id="telefono" name="telefono" required>
    </div>
    <div class="form-group">
      <label for="email">Correo Electrónico:</label>
      <input require type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="servicio">Tipo de Servicio:</label>
      <select require class="form-control" id="servicio" name="servicio" required>
        <option value="">Seleccione un servicio</option>
        <option value="Remodelaciones">Remodelaciones</option>
        <option value="Mantenimiento de construcciones">Mantenimiento de construcciones</option>
        <option value="Edificios Residenciales">Edificios Residenciales</option>
        <option value="Comerciales e industriales">Comerciales e industriales</option>
      </select>
    </div>
    <div class="form-group">
      <label for="descripcion">Descripción o Consulta:</label>
      <textarea require class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
    </div>
   <center><button type="submit" class="btn btn-primary">Enviar</button> </center> 
  </form>
    </div>
</div>

   <div class="contacto" >
      <div class="content">
        <div style="display :flex; justify-content: space-around ;  ">
          <div>
        <h4>Nuestros Correos</h4>
        <a href="mailto:info@nankima.com">info@nankima.com</a><br>
        <a href="mailto:ventas@nankima.com">ventas@nankima.com</a> <br> <br>
        </div>
        <div>
           <h4>Nuestros Telefonos</h4>
        <p>(+506) 8330-4082</p>
        <p>(+506) 7090-0939</p>
        </div>
    <div>
            <h4>Nuestra Dirección</h4>
            <p>Montenegro de Bagaces, antigua Soda la Carreta</p>
        </div>
        <a href="https://www.facebook.com/cnankima/?show_switched_toast=0&show_invite_to_follow=0&show_switched_tooltip=0&show_podcast_settings=0&show_community_review_changes=0&show_community_rollback=0&show_follower_visibility_disclosure=0"><img src="vistas/img/nosotros/facebook.webp" width="50" height="50" alt="facebook" ></a>
    
    </div>
    <div >
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d490.4087592464039!2d-85.207328!3d10.479363!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f9fe095a7d98fe9%3A0x18f766018b5276cc!2sFQHV%2BP3V%2C%20Provincia%20de%20Guanacaste%2C%20Bagaces%2C%20Costa%20Rica!5e0!3m2!1sen!2sus!4v1689108907876!5m2!1sen!2sus" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
	</div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->