
<div class="container">
<div class="bs-docs-section">
		<h1 id="tables-example">Ingresar Costos Administrativos</h1>
		<hr> <!-- Footer -->
</div>


<p class="alert alert-info" role="alert" >Ingrese y consulte los costos administrativos para sus diferentes contratos. Recuerde ingresar el valor del costo sin puntos, comas o espacios</p>

<br>		
		<!-- Form-->
		{{ form("ingresar/inscostos", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}
			
			<div class="form-group col-sm-12">
				<label>Contrato</label>
				<select data-parsley-min="1" class="form-control input-lg" name="id_contrato">
					<option value="0" required>Seleccione el Contrato...</option>
					{% for contrato in querycontratos %}
					<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
					 {% endfor %}
				</select>
			</div>
			
			<div class="form-group col-sm-4">
				<label>Año</label>
				<select data-parsley-min="1" class="form-control input-lg" name="id_ano">
					<option value="0">Seleccione el Año...</option>
					{% for ano in anos %}
					<option  value={{ ano.id_ano }}>{{ ano.id_ano }}</option>
					{% endfor %}
				</select>
			</div>
		
			<div class="form-group col-sm-4">
				<label>Mes</label>
				<select data-parsley-min="1" class="form-control input-lg" name="id_mes">
					<option value="0">Seleccione el Mes...</option>
					{% for mes in meses %}
					<option  value={{ mes.id_mes }}>{{ mes.nombre_mes }}</option>
					{% endfor %}
				</select>
			</div>
		
			<div class="form-group col-sm-4">
				<label>Valor Costo Administrativo</label>
				<input data-parsley-required data-parsley-min="0" type="number" class="form-control input-lg" name="valor" placeholder="Valor en $COP">
			</div>
			
			<br>
			<button  class="btn btn-info btn-lg" type="submit" id="submit" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ingresar Nuevo </button>
			<br>
		
		</form> <!-- Form end -->
		
<br>

</div><!-- /container -->
<hr> <!-- Footer -->
<br>
<br>


<div class="bs-docs-section">
			{{ form("ingresar/indexcostos", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
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




{% if (not(costos is empty)) %}
<br>

<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
    <thead>
        <tr>
			<th class="info">Eliminar</th>
			<th class="info">Contrato</th>
			<th class="info">Prestador</th>
			<th class="info">Modalidad</th>
			<th class="info">Año-Mes</th>
			<th class="info">Valor</th>
         </tr>
    </thead>
    <tbody>
    {% for costo in costos %}
    	<tr>
	        <td align="center">
			{% if costo.estado == 1 %}
			<a class="btn btn-default" href="delcostos/{{ costo.id }}" role="button" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span></a>
			{% endif %}
			</td>
			<td align="right">{{ costo.id_contrato }}</td>
			<td align="right">{{ costo.Prestador.nombre_prestador }}</td>
			<td align="right">{{ costo.Modalidad.nombre_modalidad }}</td>
			<td class="info" align="right">{{ costo.id_ano }}-{{ costo.id_mes }}</td>
			<td align="right"><?php echo number_format ($costo->valor, 2, ',', '.'); ?></td>
        </tr>
    {% endfor %}
    </tbody>
</table>
{% else %}
</div>

<div class="container">
<p class="alert alert-warning" role="alert" >No hay costos administrativos ingresados para este prestador o no se ha seleccionado el filtro</p>
{% endif %}

<div class="container">






