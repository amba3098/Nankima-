<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      Cotizar
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">
  <?php
$item = null;
$valor = null;

$elementos = ControladorElementos::ctrMostrarElementos($item, $valor);


$optionsElementos = '';

$total = 0;

foreach ($elementos as $key => $value) {
  $optionsElementos .= '
    <div class="card" style="width: 26rem;">
      <div class="card-body" style="text-align:center;border:solid;border-width: 0.5px;margin-left:15px;background-color:##d7dbe0">
        <h4 class="card-title" ><img class="card-img-top" src="vistas/img/cotizar/'.$value["nombre"].'.jpg" alt="Card image" style="width:100%"height="170rem">' . $value["nombre"] . '</h4>
        <p class="card-text">Precio: ' . $value["precio"] . '</p>
        <input class="form-control cantidad" style="width:70%;" type="number" min="0" placeholder="Cantidad" style="margin-left:20px">
        <p class="card-text subtotal">Subtotal: ₡0.00</p>
      </div>
    </div>
    
   
    ';
}




echo '<div style="display:flex;flex-direction:row;flex-wrap:wrap;font-size: 18px;
margin-top: 6%;">' . $optionsElementos . '</div>';



echo '<center><div id="total" style="text-align: center; margin-top: 100px;font-size: 30px;background-color:#ffbd59; width:40%;border:solid;border-width:2px;border-radius: 8px; height:9rem;"><h1>Total: ₡0.00</h1></div></center>';
?>

<script>
  // Obtener todos los elementos con la clase 'cantidad'
  var cantidadInputs = document.querySelectorAll('.cantidad');

  // Recorrer los elementos y asignar un evento de cambio
  cantidadInputs.forEach(function(input) {
    input.addEventListener('change', function() {
      calcularSubtotal(this);
      calcularTotal();
    });
  });

  // Calcular el subtotal para un elemento específico
  function calcularSubtotal(input) {
    var cantidad = input.value;
    var cardBody = input.parentNode;
    var precio = cardBody.querySelector('p.card-text').innerText.split(':')[1].trim();
    var subtotal = cardBody.querySelector('.subtotal');

    var subtotalValue = parseFloat(precio) * parseInt(cantidad);

    subtotal.innerText = 'Subtotal: ₡' + subtotalValue.toFixed(2);
  }

  // Calcular el total sumando los subtotales de todos los elementos
  function calcularTotal() {
    var subtotales = document.querySelectorAll('.subtotal');
    var total = 0;

    subtotales.forEach(function(subtotal) {
      var subtotalValue = parseFloat(subtotal.innerText.split(':')[1].trim().substring(1));
      total += subtotalValue;
    });

    document.getElementById('total').innerText = 'Total: ₡' + total.toFixed(2);
  }
</script>




      
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->