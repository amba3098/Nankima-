
<?php

$perfil = $_SESSION['perfil'];

if($perfil=='Administrador'){
    echo '

	<aside class="main-sidebar">
	<section class="sidebar">

	<ul class="sidebar-menu">

		<li class="active">

			<a href="inicio">

				<i class="fa fa-home"></i>
				<span>Inicio</span>

			</a>

		</li>

		<li>

			<a href="usuarios">

				<i class="fa fa-user"></i>
				<span>Usuarios</span>

			</a>

		</li>

		<li>

			<a href="categorias">

				<i class="fa fa-th"></i>
				<span>Categorías</span>

			</a>

		</li>

		<li>

			<a href="proyectos">

				<i class="fa fa-product-hunt"></i>
				<span>Proyectos</span>

			</a>

		</li>

		<li>

			<a href="clientes">

				<i class="fa fa-users"></i>
				<span>Clientes</span>

			</a>

		</li>

	

		</ul>

		</section>
   
   </aside>
	';
}
elseif($perfil=='Gerente'){
    echo '

	<aside class="main-sidebar">
	<section class="sidebar">

	<ul class="sidebar-menu">

		<li class="active">

			<a href="inicio">

				<i class="fa fa-home"></i>
				<span>Inicio</span>

			</a>

		</li>

		<li>

			<a href="proyectosgerente">

				<i class="fa fa-product-hunt"></i>
				<span>Proyectos</span>

			</a>

		</li>
		
		<li>

			<a href="presupuestogerente">

			<i class="fa fa-book" aria-hidden="true"></i>
				<span>Presupuestos</span>

			</a>

		</li>

		<li>

			<a href="costos">

			<i class="fa fa-money" aria-hidden="true"></i>
				<span>Costos</span>

			</a>

		</li>
		</li>
		

		</ul>

		</section>

</aside>
	';
}

else{
	echo '
	<aside class="main-sidebar">

	<section class="sidebar">

		<ul class="sidebar-menu">

			<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<li>

				<a href="proyectos">

					<i class="fa fa-product-hunt"></i>
					<span>Proyectos</span>

				</a>

			</li>

			<li class="active">

				<a href="cotizar">

					<i class="fa fa-credit-card-alt"></i>
					<span>Cotizar</span>

				</a>

			</li>

			<li class="active">

				<a href="catalogo">

					<i class="fa fa-file-text"></i>
					<span>Catálogo</span>

				</a>

			</li>

			<li class="active">

				<a href="contactanos">

					<i class="fa fa-phone-square"></i>
					<span>Contáctanos</span>

				</a>

			</li>


			<li class="active">

				<a href="nosotros">

					<i class="fa fa-info-circle"></i>
					<span>Sobre Nosotros</span>

				</a>

			</li>




		</ul>

	 </section>

</aside>
	
	';
}
	
			?>
<!--Esto esta Comentado
			<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>

					<li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>

						</a>

					</li>

				</ul>

			</li>

			Hasta Aqui
-->
