

  // Esperar a que el documento esté listo
  document.addEventListener('DOMContentLoaded', function() {
    // Agregar un evento change al select
    document.getElementById('nuevoCliente').addEventListener('change', function() {
      // Obtener el valor de la cédula del cliente seleccionado
      const selectedOption = this.options[this.selectedIndex];
      const cedulaClienteSeleccionado = selectedOption.getAttribute('data-cedula');
      // Asignar el valor de la cédula al input de cédula
      document.getElementById('nuevoCedula').value = cedulaClienteSeleccionado;
    });
  });


    // Esperar a que el documento esté listo
    document.addEventListener('DOMContentLoaded', function() {
    // Agregar un evento change al select
    document.getElementById('nuevoCliente').addEventListener('change', function() {
      // Obtener el valor de la cédula del cliente seleccionado
      const selectedOption = this.options[this.selectedIndex];
      const telefonoClienteSeleccionado = selectedOption.getAttribute('data-telefono');
      // Asignar el valor de la cédula al input de cédula
      document.getElementById('nuevoNumero').value = telefonoClienteSeleccionado;
    });
  });


    // Esperar a que el documento esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Agregar un evento change al select
        document.getElementById('editarCliente').addEventListener('change', function() {
          // Obtener el valor de la cédula del cliente seleccionado
          const selectedOption = this.options[this.selectedIndex];
          const cedulaClienteSeleccionado = selectedOption.getAttribute('data-cedula');
          // Asignar el valor de la cédula al input de cédula
          document.getElementById('editarCedula').value = cedulaClienteSeleccionado;
        });
      });
    
    
        // Esperar a que el documento esté listo
        document.addEventListener('DOMContentLoaded', function() {
        // Agregar un evento change al select
        document.getElementById('editarCliente').addEventListener('change', function() {
          // Obtener el valor de la cédula del cliente seleccionado
          const selectedOption = this.options[this.selectedIndex];
          const telefonoClienteSeleccionado = selectedOption.getAttribute('data-telefono');
          // Asignar el valor de la cédula al input de cédula
          document.getElementById('editarNumero').value = telefonoClienteSeleccionado;
        });
      });
/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarProyecto", function () {

var idProyecto = $(this).attr("idProyecto");

swal({
  title: '¿Está seguro de borrar el Proyecto?',
  text: "¡Si no lo está puede cancelar la acción!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Cancelar',
  confirmButtonText: '¡Si, borrar Proyecto!'
}).then(function (result) {

  if (result.value) {

    window.location = "index.php?ruta=proyectosgerente&idProyecto=" + idProyecto;

  }

})

})



  document.getElementById('filtroCategorias').addEventListener('change', function() {
    var categoriaSeleccionada = this.value.toLowerCase();
    var tabla = document.getElementById('tablaProyectos');
    var dataTable = $(tabla).DataTable();
    dataTable.search(categoriaSeleccionada).draw();
  });


  $(".tablas").on("click", ".btnEditarProyecto", function(){

    var idProyecto = $(this).attr("idProyecto");
  
    var datos = new FormData();
      datos.append("idProyecto", idProyecto);
  
      $.ajax({
  
        url:"ajax/proyectosgerente.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
        
           $("#idProyecto").val(respuesta["id"]);
           $("#nuevoPresupuesto").val(respuesta["presupuesto"]);
           
      }
  
      })
  
  })
 

  function mostrarIdProyecto(idProyecto) {
    // Mostrar el ID del proyecto en el elemento con el id "proyectoId" del modal
    document.getElementById("proyectoId").textContent = idProyecto;
  }