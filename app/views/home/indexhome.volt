
<div class="container">


<div class="bs-docs-section">
		<h1 id="tables-example">Sistema de Información Financiera <?=date('Y')?></h1>
		<hr> <!-- Footer -->
</div>


<br> <!-- Salto de linea -->
{% if id_group == 20 %}
	<div class="bs-docs-section">
			<h3 id="tables-example">1. Información General del Prestador</h3>
	</div>
	<p class="alert alert-info" role="alert" ><strong>{{ nombre_prestador }}</strong></p>

	<br>
	<div class="bs-docs-section">
			<h3 id="tables-example">2. Convenios y/o Contratos</h3>
	</div>

	{% if (not(contratos is empty)) %}
	<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
		<thead>
			<tr>
				<th class="info">Contrato o Convenio</th>
				<th class="info">Modalidad</th>
				<th class="info">Valor</th>
				<th class="info">Fecha Inicio Contrato</th>
				<th class="info">Fecha Terminación Contrato</th>
				<th class="info">Cupos Contratados</th>
			 </tr>
		</thead>
		<tbody>
		{% for contrato in contratos %}
			<tr>
				<td align="right">{{ contrato.id_contrato }}</td>
				<td align="right">{{ contrato.Modalidad.nombre_modalidad }}</td>
				<td align="right">$<?php echo number_format ($contrato->valor_contrato, 2, ',', '.'); ?></td>
				<td align="right">{{ contrato.fecha_inicio_contrato }}</td>
				<td align="right"> {{ contrato.fecha_terminacion_contrato }}</td>
				<td align="right">{{ contrato.cantidad_cupos }}</td>
			</tr>
		{% endfor %}
		</tbody>
	</table>
	{% else %}
		<br>
		<p class="alert alert-warning" role="alert" >No hay contratos o convenios cargados para este prestador</p>
	{% endif %}



{% else %}

<div class="panel-group" id="accordion">

  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
       1. BLOQUEAR/DESBLOQUEAR PERIODOS</a>
      </h2>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">


			<p class="alert alert-info" role="alert" ><strong>Señor Interventor: </strong> Recuerde bloquear el periodo de sus contratos asignados antes de comenzar el proceso de revisión, para evitar que el prestador ingrese nuevos datos o elimine registros en medio de dicha revisión</p>
			<hr> <!-- Footer -->

			<div class="form-group col-sm-3">
			<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModalbloquearperiodo"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Bloquear Período</button>
			</div>



			<div class="form-group col-sm-3">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModaldesbloquearperiodo"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Desbloquear Período</button>
			</div>

			{% if (not(bloqueados is empty)) %}
			<table align="center" class="table table-bordered table-hover" id='table1' style="width: 80%">
				<thead>
					<tr>
						<th class="info">Contratos Bloqueados</th>
						<th class="info">Ene</th>
						<th class="info">Feb</th>
						<th class="info">Mar</th>
						<th class="info">Abr</th>
						<th class="info">May</th>
						<th class="info">Jun</th>
						<th class="info">Jul</th>
						<th class="info">Ago</th>
						<th class="info">Sep</th>
						<th class="info">Oct</th>
						<th class="info">Nov</th>
						<th class="info">Dic</th>
						<th class="info">OFG_2130</th>
						<th class="info">Interventor</th>
					 </tr>
				</thead>
				<tbody>
					<?php
					for($i=0;$i<count($bloq_cont_mes);$i++) {
						 echo "<tr>";
						 echo "<td><a href='indexdetallebloqueo/".$bloq_cont_mes[$i][0]."'>".$bloq_cont_mes[$i][0]."</a></td>";
						 echo "<td>".$bloq_cont_mes[$i][1]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][2]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][3]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][4]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][5]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][6]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][7]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][8]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][9]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][10]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][11]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][12]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][13]."</td>";
						 echo "<td>".$bloq_cont_mes[$i][14]."</td>";
						 echo "</tr>";
					}
					?>
				</tbody>
			</table>
			{% else %}
			<div>
			<br>
			<br>
			<br>
				<p class="alert alert-warning" role="alert" >No hay contratos bloqueados que mostrar</p>
			</div>
			{% endif %}


			<!--
			{% if (not(bloqueados is empty)) %}
			<table align="center" class="table table-bordered table-hover" id='table2' style="width: 80%">
				<thead>
					<tr>
						<th class="info">Contratos Bloqueados</th>
						<th class="info">Prestador</th>
						<th class="info">Año-Mes</th>
						<th class="info">Bloqueado por</th>
						<th class="info">Fecha último bloqueo</th>
					 </tr>
				</thead>
				<tbody>
				{% for bloqueado in bloqueados %}
					<tr>
						<td align="right">{{ bloqueado.id_contrato }} - {{bloqueado.Modalidad.abr_modalidad}}</td>
						<td align="right">{{ bloqueado.Prestador.nombre_prestador }}</td>
						<td align="right">{{ bloqueado.id_ano }}-{{ bloqueado.id_mes}}</td>
						<td align="right">{{ bloqueado.usuario }}</td>
						<td align="right">{{ bloqueado.fecha_bloqueo }}</td>
					</tr>
				{% endfor %}
				</tbody>
			</table>
			{% else %}
			<div>
			<br>
			<br>
			<br>
				<p class="alert alert-warning" role="alert" >No hay contratos bloqueados que mostrar</p>
			</div>
			{% endif %}
	  -->

	  </div>
    </div>
  </div>

  <div class="panel panel-default" >
    <div class="panel-heading">
      <h3 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        2. INGRESAR/ELIMINAR AJUSTES</a>
      </h3>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">


			<p class="alert alert-danger" role="alert" ><strong>Señor Interventor: </strong> Ingrese los ajustes necesarios por contrato SOLO SI encuentra inconsistencias en la revisión de la Ejecución Financiera, y acuerda con el prestador que no se repetira el proceso de carga de información.</p>
			<hr> <!-- Footer -->


			<div class="form-group col-sm-3">
			<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModalingresarajuste"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Ingresar Ajuste</button>
			</div>


			<div class="form-group col-sm-3">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModaleliminarajuste"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Eliminar Ajuste</button>
			</div>


			{% if (not(ajustes is empty)) %}
			<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
				<thead>
					<tr>
						<th class="info">Codigo Ajuste</th>
						<th class="info">Contrato-Modalidad</th>
						<th class="info">Año-Mes</th>
						<th class="info">Valor del Ajuste</th>
						<th class="info">Observaciones</th>
						<th class="info">Fecha</th>
					 </tr>
				</thead>
				<tbody>
				{% for ajuste in ajustes %}
					<tr>
						<td align="right">{{ ajuste.id }}</td>
						<td align="right">{{ ajuste.id_contrato }} - {{ajuste.Modalidad.abr_modalidad}}</td>
						<td align="right">{{ ajuste.id_ano}}-{{ ajuste.id_mes}}</td>
						<td align="right"><?php echo number_format ($ajuste->valor_ajuste, 2, ',', '.'); ?></td>
						<td align="left">{{ ajuste.observaciones }}</td>
						<td align="right">{{ ajuste.fecha_ajuste }}</td>
					</tr>
				{% endfor %}
				</tbody>
			</table>
			{% else %}
			<div>
				<br>
				<br>
				<br>
				<p class="alert alert-warning" role="alert" >No hay ajustes que mostrar</p>
			</div>
			{% endif %}

	  </div>
    </div>
  </div>


</div>







<!-- ****************** SECCION MODALS ***************************** -->


<!-- Modal Desbloquear periodo -->
<div id="myModaldesbloquearperiodo" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Desbloquear Periodo:</h4>
		<h5 class="modal-title">¡Premite abrir periodos pasados para que el prestador corrija los valores ya ingresados o ingrese nuevos!</h5>
	  </div>
	  <div class="modal-body">

		{{ form("home/delbloqueo", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}

			<div class="form-group col-sm-12">
				<div class="form-group col-sm-12">
				<label>Contrato</label>
				<select data-parsley-min="1" class="form-control" name="id_contrato">
					<option value="0" required>Contrato...</option>
					{% for contrato in listacontratos %}
					<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
					{% endfor %}
				</select>
				</div>
			</div>

			<div class="form-group col-sm-12">
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

				<div class="form-group col-sm-6">
				<label>Bloquear (uno o varios)</label>
				<select data-parsley-required class="form-control" name="nombre_componente_bloqueado[]" multiple>
					<option value="RECURSO">Recurso Humano</option>
					<option value="COSTOS">Costos Administrativos</option>
					<option value="CANASTA">Canasta</option>
					<option value="SOPORTES">Soportes</option>

				</select>
				</div>
			</div>


			<button  class="btn btn-info" type="submit" id="submit" ><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Desbloquear </button>
		</form>

	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	  </div>
	</div>

  </div>
</div><!-- /Modal Desbloquear periodo -->


<!-- Modal Bloquear periodo -->
<div id="myModalbloquearperiodo" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Bloquear Periodo:</h4>
		<h5 class="modal-title">¡Previene que el prestador pueda modificar los valores ya ingresados!</h5>
	  </div>
	  <div class="modal-body">

		{{ form("home/insbloqueo", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}

			<div class="form-group col-sm-12">
				<div class="form-group col-sm-12">
				<label>Contrato</label>
				<select data-parsley-min="1" class="form-control" name="id_contrato">
					<option value="0" required>Contrato...</option>
					{% for contrato in listacontratos %}
					<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
					{% endfor %}
				</select>
				</div>
			</div>

			<div class="form-group col-sm-12">
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

				<div class="form-group col-sm-6">
				<label>Bloquear (uno o varios)</label>
				<select data-parsley-required class="form-control" name="nombre_componente_bloqueado[]" multiple>
					<option value="RECURSO">Recurso Humano</option>
					<option value="COSTOS">Costos Administrativos</option>
					<option value="CANASTA">Canasta</option>
					<option value="SOPORTES">Soportes</option>

				</select>
				</div>
			</div>

			<button  class="btn btn-danger" type="submit" id="submit" ><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Bloquear </button>
		</form>

	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	  </div>
	</div>

  </div>
</div><!-- /Modal Bloquear periodo -->


<!-- Modal Ingresar Ajuste -->
<div id="myModalingresarajuste" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Ingresar Ajuste:</h4>
		<h5 class="modal-title">Recuerde colocar el valor en POSITIVO o NEGATIVO según sea el caso</h5>
	  </div>
	  <div class="modal-body">

		{{ form("home/insajuste", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}

			<div class="form-group col-sm-6">
			<label>Contrato</label>
			<select data-parsley-min="1" class="form-control" name="id_contrato">
				<option value="0" required>Contrato...</option>
				{% for contrato in listacontratos %}
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
				{% for mes in mesesAjustes %}
				<option  value={{ mes.id_mes }}>{{ mes.nombre_mes }}</option>
				{% endfor %}
			</select>
			</div>

			<div class="form-group col-sm-6">
			<label>Concepto</label>
			<select data-parsley-min="1" class="form-control" name="id_concepto">
				<option value="0">Concepto...</option>
				{% for concepto in conceptos %}
				<option  value={{ concepto.id_concepto }}>{{ concepto.nombre_concepto }}</option>
				{% endfor %}
			</select>
			</div>

			<div class="form-group col-sm-6">
				<label>Valor Ajuste</label>
				<input data-parsley-required type="number" class="form-control input" name="valor_ajuste" placeholder="Valor en $COP">
			</div>

			<div class="form-group col-sm-12">
				<label>Observaciones</label>
				<textarea data-parsley-required name="observaciones" rows="5" style="width:100%" placeholder="Ingrese la observación" ></textarea>
			</div>


			<button  class="btn btn-info" type="submit" id="submit" ><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Ingresar Ajuste </button>
		</form>

	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	  </div>
	</div>

  </div>
</div><!-- /Modal Insertar Ajuste -->

<!-- Modal Eliminar Ajuste -->
<div id="myModaleliminarajuste" class="modal fade" role="dialog">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Eliminar Ajuste:</h4>
		<h5 class="modal-title">Tome el codigo generado del ajuste para eliminar el registro </h5>
	  </div>
	  <div class="modal-body">

		{{ form("home/delajuste", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}

			<div class="form-group col-sm-6">
			<label>Contrato</label>
			<select data-parsley-min="1" class="form-control" name="id_contrato">
				<option value="0" required>Contrato...</option>
				{% for contrato in listacontratos %}
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
				{% for mes in mesesAjustes %}
				<option  value={{ mes.id_mes }}>{{ mes.nombre_mes }}</option>
				{% endfor %}
			</select>
			</div>

			<div class="form-group col-sm-12">
				<label>Codigo Ajuste</label>
				<input data-parsley-required type="number" class="form-control input" name="id" placeholder="Ingrese el codigo del ajuste para realizar la validación">
			</div>



			<button  class="btn btn-info" type="submit" id="submit" ><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Eliminar Ajuste </button>
		</form>

	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	  </div>
	</div>

  </div>
</div><!-- /Modal Eliminar Ajuste -->

{% endif %}
