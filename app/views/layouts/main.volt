 <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          {{ image("img/header-logo.png", "alt": "logo Header", "width":"120", "height":"50") }} 
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
			<li>{{ link_to("home/indexhome", '<i class="glyphicon glyphicon-home"></i> Inicio') }}</li>
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configuración Inicial<span class="caret"></span></a>
              <ul class="dropdown-menu">
				<li>{{ link_to("configuracion/indexpersonal", '1. Relación de Personal Contratado') }}</li>
              </ul>
            </li>
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> Ingresar información mensual<span class="caret"></span></a>
              <ul class="dropdown-menu">
				<li>{{ link_to("ingresar/indexrecursohumano", '1. Recurso Humano') }}</li>
                <li>{{ link_to("ingresar/indexcostos", '2. Costos Administrativos') }}</li>
				<li>{{ link_to("ingresar/indexconceptos", '3. Dotación, Servicios Generales, Material Didáctico y Alimentación') }}</li>
				<li>{{ link_to("ingresar/indexsoportes", '4. Soportes') }}</li>
              </ul>
            </li>
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultas<span class="caret"></span></a>
              <ul class="dropdown-menu">
				<li>{{ link_to("consultas/indexinformemensual", '1. Informes de Ejecución Financiera Mensual') }}</li>
				<li>{{ link_to("consultas/indexinformeconsolidado", '2. Informes de Ejecución Financiera Consolidado') }}</li>
                <li>{{ link_to("consultas/indexsedes", '3. Códigos de las Sedes') }}</li>
				<li>{{ link_to("consultas/indexcargos", '4. Códigos de los Cargos') }}</li>
				<li>{{ link_to("consultas/indexcategorias", '5. Códigos de las Categorías y Conceptos') }}</li>
				<li>{{ link_to("consultas/indexinstructivos", '6. Instructivos') }}</li>
              </ul>
            </li>
			
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Exportar<span class="caret"></span></a>
              <ul class="dropdown-menu">
				<li>{{ link_to("exportar/indexexportar", '1. Exportar registros a Excel') }}</li>
              </ul>
            </li>
			
            <li class="active">{{ link_to("index/logout", '<i class="glyphicon glyphicon-off"></i> Cerrar Sesión') }}</li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
 </nav>



<div class="container">
	<br>
	<br>
	<br>
    {{ flash.output() }} <!-- Acá se mostraran los mensajes de exito o error que se envien del controlador -->
    {{ content() }}
    
    <footer>
        <hr>
		{{ image("img/footer-logo.jpg", "alt": "logo Footer", "width":"60", "height":"60") }}  <!-- Logo del Footer Imagen de alta resolucion -->
		<?=date('Y')?> &copy; Sistema de información de la Interventoría Buen Comienzo. 
    </footer>
</div>
