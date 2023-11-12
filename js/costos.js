/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarCosto", function(){

	var idCosto = $(this).attr("idCosto");

	var datos = new FormData();
	datos.append("idCosto", idCosto);

	$.ajax({
		url: "ajax/costos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarCosto").val(respuesta["costo"]);
     		$("#idCosto").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarCosto", function(){

	 var idCosto = $(this).attr("idCosto");

	 swal({
	 	title: '¿Está seguro de borrar la categoría?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar costo!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=costos&idCosto="+idCosto;

	 	}

	 })

})