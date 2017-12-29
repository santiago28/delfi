
<div class="container">


<div class="bs-docs-section">
		<h1 id="tables-example">Ingresar Dotación, Servicios Generales, Material Didáctico y Alimentación</h1>
		<hr> <!-- Footer -->
</div>

<p class="alert alert-info" role="alert" >Cargue por medio de un archivo CSV los conceptos de dotación, servicios generales, material didáctico y alimentación. Consulte el instructivo dando clic {{ link_to("consultas/indexinstructivos", 'AQUÍ') }}</p>

<br>

{{ form("ingresar/insconceptos", "method":"post", "class":"form-signin", "enctype":"multipart/form-data", "data-parsley-validate" : "") }}
	
	<div class="form-group col-sm-12">
		<label>Contrato</label>
		<select data-parsley-min="1" class="form-control input-lg" name="id_contrato">
			<option value="0" required>Seleccione el Contrato...</option>
			{% for contrato in querycontratos %}
			<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
			 {% endfor %}
		</select>
	</div>
	
	<div class="form-group col-sm-12">
		<label>Cargar Archivo</label>
		<input data-parsley-required type="file" class="filestyle" name="archivo" id="archivo" value="" data-buttonName="btn-info" data-buttonText=" Buscar...">
	</div>
	
	
	<div class="form-group col-sm-6">
		<label>Año</label>
		<select data-parsley-min="1" class="form-control input-lg" name="id_ano">
			<option value="0">Seleccione el Año...</option>
			{% for ano in anos %}
			<option  value={{ ano.id_ano }}>{{ ano.id_ano }}</option>
			{% endfor %}
		</select>
	</div>

	<div class="form-group col-sm-6">
		<label>Mes</label>
		<select data-parsley-min="1" class="form-control input-lg" name="id_mes">
			<option value="0">Seleccione el Mes...</option>
			{% for mes in meses %}
			<option  value={{ mes.id_mes }}>{{ mes.nombre_mes }}</option>
			{% endfor %}
		</select>
	</div>
	
	<div class="form-group col-sm-3">
	<button  class="btn btn-info btn-lg" type="submit" onclick="javascript:this.form.submit();this.disabled= true;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cargar Nuevos Registros </button>
	</div>
	
</form>


</div><!-- /container -->
<hr> <!-- Footer -->
<br>
<br>


<div class="bs-docs-section">
			{{ form("ingresar/indexconceptos", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-6">
				<h2 id="tables-example">Consultar Registros</h2>
				<h5 id="tables-example">Seleccione una opción del filtro para ver los registros insertados</h5>
				<div class="input-group">
				<div class="input-group-addon">Contrato</div>
					<select data-parsley-min="1" class="form-control input-lg" name="id_contrato" id="select1" onchange=formulario.submit()>
					<option value="0" required>Seleccione el Contrato...</option>
					{% for contrato in querycontratos %}
					<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
					{% endfor %}
					</select>
				</div>
				</div>
			</div>
			</form>

</div>



</div><!-- /container -->

{% if (not(costos is empty)) %}

<div class="container">
<br>
<!-- Boton Modal eliminar Periodo -->
<div class="form-group col-sm-3">
<button id="modal-eliminar" type="button" class="btn btn-danger btn-lg" data-toggle="modal"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar Periodo Completo</button>
</div>
</div> <!-- /container -->



<table align="center" class="table table-bordered table-hover" id='table' style="width: 95%">
    <thead>
        <tr>
			<!-- <th class="info">Acciones</th> -->
			<th class="info">Contrato</th>
			<th class="info">Prestador</th>
			<th class="info">Año-Mes</th>
			<th class="info">Nombre Categoria</th>
			<th class="info">Nombre Concepto</th>
			<th class="info">Nombre Sede</th>
			<th class="info">Valor</th>
			<th class="info">Número Documento</th>
			<th class="info">Fecha Documento</th>
			<th class="info">Descripción Documento</th>
			<th class="info">Cantidad</th>
			<th class="info">NIT Proveedor</th>
			<th class="info">Nombre Proveedor</th>
			<th class="info">Observaciones</th>
         </tr>
    </thead>
    <tbody>
    {% for costo in costos %}
    	<tr>
	        <!-- <td align="center">
			{% if costo.estado == 1 %}
			<a class="btn btn-default" role="button" href="delconceptos/{{ costo.id }}"  title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span></a>
			<a class="btn btn-default" role="button" href="indexupdateconceptos/{{ costo.id }}"  title="Actualizar y Guardar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></a> 
			{% endif %}
			</td> -->
			<td class="info">{{ costo.id_contrato }} - {{ costo.Modalidad.abr_modalidad }}</td>
			<td>{{ costo.Prestador.nombre_prestador }}</td>
			<td class="info">{{ costo.id_ano }}-{{ costo.id_mes }}</td>
			<td>{{ costo.id_categoria  }} - <?php if(isset($costo->Categoria->nombre_categoria)){echo $costo->Categoria->nombre_categoria;} else { echo "¡ERROR!";}?></td>
			<td class="info">{{ costo.id_concepto }} - <?php if(isset($costo->Concepto->nombre_concepto)){echo $costo->Concepto->nombre_concepto;} else { echo "¡ERROR!";}?></td>
			<td>{{ costo.id_sede }} - <?php if(isset($costo->Sede->nombre_sede)){echo $costo->Sede->nombre_sede;} else { echo "¡ERROR!";}?></td>
			<td class="info"><?php echo number_format ($costo->valor, 2, ',', '.'); ?></td>
			<td>{{ costo.numero_documento }}</td>
			<td class="info">{{ costo.fecha_documento }}</td>
			<td>{{ costo.descripcion_documento }}</td>
			<td class="info">{{ costo.cantidad }}</td>
			<td>{{ costo.nit_proveedor }}</td>
			<td  class="info">{{ costo.nombre_proveedor }}</td>
			<td>{{ costo.observaciones }}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>

{% else %}
<div class="container">
<p class="alert alert-warning" role="alert" >No hay registros ingresados para este prestador o no se ha seleccionado el filtro</p>
{% endif %}



<br>

<!-- ****************** SECCION MODALS ***************************** -->

<!-- Modal Eliminar periodo -->
<div id="myModaleliminarperiodo" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Eliminar Periodo:</h4>
		<h5 class="modal-title">¡Solo se permitiran eliminar los periodos que no estén cerrados!</h5>
	  </div>
	  <div class="modal-body">
	  
		{{ form("ingresar/delperiodoconceptos", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}
		
			<div class="form-group col-sm-6">
			<label>Contrato</label>
			<select data-parsley-min="1" class="form-control" name="id_contrato">
				<option value="0" required>Contrato...</option>
				{% for contrato in querycontratos %}
				<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
				{% endfor %}
			</select>
			</div>

			<div class="form-group col-sm-3">
			<label>Año</label>
			<select data-parsley-min="1" class="form-control" name="id_ano">
				<option value="0">Año...</option>
				{% for ano in anos %}
				<option  value={{ ano.id_ano }}>{{ ano.id_ano }}</option>
				{% endfor %}
			</select>
			</div>

			<div class="form-group col-sm-3">
			<label>Mes</label>
			<select data-parsley-min="1" class="form-control" name="id_mes">
				<option value="0">Mes...</option>
				{% for mes in meses %}
				<option  value={{ mes.id_mes }}>{{ mes.nombre_mes }}</option>
				{% endfor %}
			</select>
			</div>

			<button  class="btn btn-danger" type="submit" id="submit" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar Registros </button>
		</form>
	  
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	  </div>
	</div>

  </div>
</div><!-- /Modal Eliminar periodo -->


<div class="container">
<script>
$(document).ready(function(){
	
	$('#modal-eliminar').on('click', function (event) {
		$('#myModaleliminarperiodo').modal('show');
	});
});

</script>


