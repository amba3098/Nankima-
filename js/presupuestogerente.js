

/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarPresupuestoGerente", function(){

  var idPresupuesto = $(this).attr("idPresupuesto");

  var datos = new FormData();
  datos.append("idPresupuesto", idPresupuesto);

  $.ajax({
    url: "ajax/presupuestogerente.ajax.php",
    method: "POST",
        data: datos,
        cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success: function(respuesta){

        $("#nuevoPresupuesto").val(respuesta["presupuesto"]);
        $("#idPresupuesto").val(respuesta["codigo"]);
        
   //   $("#nuevoSeguro").val(respuesta["seguros"]);
    //  $("#nuevoCostoMateriales").val(respuesta["materiales"]);
    //  $("#nuevoMaquinaria").val(respuesta["maquinaria"]);
     // $("#nuevoCostoPermisos").val(respuesta["permisos"]);
     // $("#nuevoPresupuestoCont").val(respuesta["contingencia"]); 

      }

  }) 


})
/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarPresupuesto", function () {

var idPresupuesto = $(this).attr("idPresupuesto");

swal({
  title: '¿Está seguro de borrar el Presupuesto?',
  text: "¡Si no lo está puede cancelar la acción!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Cancelar',
  confirmButtonText: '¡Si, borrar Presupuesto!'
}).then(function (result) {

  if (result.value) {

    window.location = "index.php?ruta=presupuestogerente&idPresupuesto=" + idPresupuesto;

  }

})

})



  document.getElementById('filtroCategorias').addEventListener('change', function() {
    var categoriaSeleccionada = this.value.toLowerCase();
    var tabla = document.getElementById('tablaProyectos');
    var dataTable = $(tabla).DataTable();
    dataTable.search(categoriaSeleccionada).draw();
  });



 

  function mostrarIdPresupuesto(idPresupuesto) {
    // Mostrar el ID del proyecto en el elemento con el id "proyectoId" del modal
    document.getElementById("idPresupuesto").textContent = idPresupuesto;
  }


