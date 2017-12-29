
<div class="container">


<div class="bs-docs-section">
		<h1 id="tables-example">Ingresar Recurso Humano</h1>
		<hr> <!-- Footer -->
</div>

<p class="alert alert-info" role="alert" >Cargue por medio de un archivo CSV la ejecución de recurso humano. Consulte el instructivo dando clic {{ link_to("consultas/indexinstructivos", 'AQUÍ') }}</p>

<br>

{{ form("ingresar/insrecursohumano", "method":"post", "class":"form-signin", "enctype":"multipart/form-data", "data-parsley-validate" : "") }}
	
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
			{{ form("ingresar/indexrecursohumano", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
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

{% if (not(rhs is empty)) %}

<div class="container">
<br>
<!-- Boton Modal eliminar Periodo -->
<div class="form-group col-sm-3">
<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModaleliminarperiodo"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar Periodo Completo</button>
</div>
</div><!-- /container -->


<table align="center" class="table table-bordered table-hover" id='table' style="width: 95%">
    <thead>
        <tr>
			<!-- <th class="info">Acciones</th> -->
			<th class="info">Contrato</th>
			<th class="info">Prestador</th>
			<th class="info">Año-Mes</th>
			<th class="info">Cedula-Nombre</th>
			<th class="info">Cargo</th>
			<!-- <th class="info">Riesgo ARL</th> -->
			<th class="info">Novedad-Fecha</th>
			<th class="info">Tipo Contrato</th>
			<th class="info">% Dedicación</th>
			<th class="info">Dias Laborados</th>
			<th class="info">Base Salario/Honorarios</th>
			<th class="info">Salario/Honorarios</th>
			<th class="info">Auxilio Transporte</th>
			<th class="info">Salario Devengado</th>
			<th class="info">Seguridad Social Empleado</th>
			<th class="info">Otras Deducciones</th>
			<th class="info">Valores Asumidos Prestador</th>
			<th class="info">Salario Neto Recibido</th>
			<th class="info">Dotación</th>
			<th class="info">Examen Medico</th>
			<th class="info">Seguridad Social Empresa</th>
			<th class="info">Provisión Cesantías</th>
			<th class="info">Provisión Intereses Cesantías</th>
			<th class="info">Provisión Prima</th>
			<th class="info">Provisión Vacaciones</th>
			<th class="info">Total Provisiones</th>
			<th class="info">Valor Total Ejecutado antes de Ajustes</th>
			<th class="info">Índice  Relación Técnica</th>
			<th class="info">Observaciones</th>
			
         </tr>
    </thead>
    <tbody>
    {% for rh in rhs %}
    	<tr>
	        <!-- <td align="center">
			{% if rh.estado == 1 %}
			<a class="btn btn-default" role="button" href="delrecursohumano/{{ rh.id }}"  title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span></a>
			<a class="btn btn-default" role="button" href="indexupdaterecursohumano/{{ rh.id }}"  title="Actualizar y Guardar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></a> 
			{% endif %}
			</td> -->
			<td class="info">{{ rh.id_contrato }} - {{ rh.Modalidad.abr_modalidad }}</td>
			<td>{{ rh.Prestador.nombre_prestador }} </td>
			<td class="info">{{ rh.id_ano }}-{{ rh.id_mes }}</td>
			<td>{{ rh.cedula }} - <?php if(isset($rh->PersonalContratado->primer_nombre)){echo $rh->PersonalContratado->primer_nombre." ".$rh->PersonalContratado->segundo_nombre." ".$rh->PersonalContratado->primer_apellido." ".$rh->PersonalContratado->segundo_apellido ;} else { echo "¡ERROR!";}?> </td>
			<td class="info">{{ rh.id_cargo }} - <?php if(isset($rh->Cargo->nombre_cargo)){echo $rh->Cargo->nombre_cargo;} else { echo "¡ERROR!";}?></td>
			<!-- <td>I: 0,522%</td> -->
			<td>
			{% if rh.codigo_novedad != 'SN' %}
				{{ rh.codigo_novedad }} : {{ rh.fecha_novedad }} 
			 {% endif %}
			</td>
			<td class="info">{{ rh.codigo_tipo_contrato }}</td>
			<td>{{ rh.porcentaje_dedicacion*100 }}%</td>
			<td class="info">{{ rh.dias_laborados }}</td>
			<td><?php echo number_format ($rh->base_salario_honorarios, 2, ',', '.'); ?></td>
			<td class="danger"><?php echo number_format ($rh->valor_salario_honorarios, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_auxilio_transporte, 2, ',', '.'); ?></td>
			<td class="info"><?php echo number_format ($rh->valor_bruto, 2, ',', '.'); ?></td>
			<td>- <?php echo number_format ($rh->valor_deduccion_ss, 2, ',', '.'); ?></td>
			<td class="info">- <?php echo number_format ($rh->valor_otras_deducciones, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_asumidos_prestador, 2, ',', '.'); ?></td>
			<td class="success"><?php echo number_format ($rh->valor_neto, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_dotacion, 2, ',', '.'); ?></td>
			<td class="info"><?php echo number_format ($rh->valor_examen_medico, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_seguridad_social, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_prov_cesantias, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_prov_intereses_cesantias, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_prov_prima, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_prov_vacaciones, 2, ',', '.'); ?></td>
			<td class="warning"><?php echo number_format ($rh->valor_total_provisiones, 2, ',', '.'); ?></td>
			<td class="danger"><?php echo number_format ($rh->valor_total_ejecutado, 2, ',', '.'); ?></td>
			<td><?php echo round ($rh->indice_relacion_tecnica, 2); ?></td>
			<td class="info">{{ rh.observaciones }}</td>
			
			
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
	  
		{{ form("ingresar/delperiodorecursohumano", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}
		
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





