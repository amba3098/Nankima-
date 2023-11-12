<head>
    <style>
    .card {
        margin-left: 50px;
        margin-top: 40px;
        border: solid;
        border-width: 1px;
        text-align: center;
    }

    .card-body {
        margin: 0 auto;
    }
    </style>
</head>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Catálogo de servicios
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Tablero</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div style="display:flex;flex-direction:row;flex-wrap:wrap;font-size: 18px;">
            <div class="card" style="width:400px;">
                <img class="card-img-top" src="vistas/img/catalogo/remodelacion.jpg" alt="Card image" style="width:100%"height="60%">
                <div class="card-body">
                    <h1 class="card-title">Remodelaciones</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCatalogo"
                        data-servicio="Remodelaciones" data-precio="500">Contratar Servicio</button>
                </div>
            </div>

            <div class="card" style="width:400px;">
                <img class="card-img-top" src="vistas/img/catalogo/pintura.webp" alt="Card image" style="width:100%" height="60%">
                <div class="card-body">
                    <h1 class="card-title">Pintura</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCatalogo" data-servicio="Pintura" data-precio="300">Contratar Servicio</button>
                </div>
            </div>

            <div class="card" style="width:400px;">
                <img class="card-img-top" src="vistas/img/catalogo/techo.jpeg" alt="Card image" style="width:100%;"heigth=800px; height="60%">
                <div class="card-body">
                    <h1 class="card-title">Reparación de Techos</h1>
                    <button class="btn btn-primary" style="margin-bottom:50px" data-toggle="modal" data-target="#modalAgregarCatalogo" data-servicio="Reparación de Techos" data-precio="5000">Contratar Servicio</button>
                </div>
            </div>

            <div class="card" style="width:400px;">
                <img class="card-img-top" src="vistas/img/catalogo/suelos.jpg" alt="Card image" style="width:100%" height="60%">
                <div class="card-body">
                    <h1 class="card-title">Evaluación de Suelos</h1>
                    <button class="btn btn-primary" style="margin-bottom:50px" data-toggle="modal"  data-target="#modalAgregarCatalogo" data-servicio="Evaluación de Suelos" data-precio="2000">Contratar Servicio</button>
                </div>
            </div>

            <div class="card" style="width:400px;">
                <img class="card-img-top" src="vistas/img/catalogo/interior.webp" alt="Card image" style="width:100%" height="60%">
                <div class="card-body">
                    <h1 class="card-title">Diseño de Interiores</h1>
                    <button class="btn btn-primary" style="margin-bottom:50px" data-toggle="modal" data-target="#modalAgregarCatalogo" data-servicio="Diseño de Interiores" data-precio="1000">Contratar Servicio</button>
                </div>
            </div>

            <div class="card" style="width:400px;">
                <img class="card-img-top" src="vistas/img/catalogo/piso.jpg" alt="Card image" style="width:100%" height="60%">
                <div class="card-body">
                    <h1 class="card-title">Cambio de pisos</h1>
                    <button class="btn btn-primary" style="margin-bottom:50px" data-toggle="modal"
                        data-target="#modalAgregarCatalogo" data-servicio="Cambio de pisos" data-precio="700">Contratar Servicio</button>
                </div>
            </div>

            <!-- Resto de las tarjetas -->

        </div>

        <div id="modalAgregarCatalogo" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <!-- Cabeza del modal -->
                        <div class="modal-header" style="background:#3c8dbc; color:white">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Selección de horas</h4>
                        </div>
                        <!-- Cuerpo del modal -->
                        <div class="modal-body">
                            <div class="box-body">

                                <label>Servicio</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                        <input type="text" id="servicio" name="servicio" class="form-control input-lg" readonly>
                                    </div>
                                </div>

                                <label>Horas</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        <input type="number" class="form-control input-lg" name="horas" id="horas" min="1" placeholder="Cantidad de Horas" required>
                                    </div>
                                </div>

                                <label>Precio</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">₡</span>
                                        <input type="text" class="form-control input-lg" name="precio" id="precio" placeholder="Precio" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pie del modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                            <button type="submit" class="btn btn-primary">Solicitar Servicio</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
$(document).ready(function() {
    $('#modalAgregarCatalogo').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var servicio = button.data('servicio');
        var precio = button.data('precio');
        var modal = $(this);
        modal.find('#servicio').val(servicio);
        modal.find('#precio').val('₡' + precio);
        modal.find('#horas').on('input', function() {
            var horas = $(this).val();
            var precioTotal = precio * horas;
            modal.find('#precio').val('₡' + precioTotal);
        });
    });
});
</script>