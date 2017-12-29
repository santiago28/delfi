
{{ content() }}


<div class="bs-docs-section">
		<h1 id="tables-example">Códigos y valores de los Cargos</h1>
		<hr> <!-- Footer -->
</div>

 <p class="alert alert-info" role="alert" >Tenga en cuenta las siguientes convenciones. PS: Prestación de Servicios, VL: Vínculo Laboral, JIN: Jardín Infantil cantidad de cargos encontrados: <b>{{ cantidadcargos }}</b></p>

<h5>Seleccione el contrato para verificar los cargos asociados a la modalidad del contrato...</h5>

		
		{{ form("consultas/indexcargos", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
			
			<select data-parsley-min="1" class="form-control input-lg" name="id_contrato" id="select1" onchange=formulario.submit()>
				<option id="option1_js" value="0" required>Seleccione el Contrato...</option>
				{% for contrato in querycontratos %}
				<?php $selected = ''; ?>
				{% if(contrato_select == contrato.id_contrato) %}
				<?php $selected = 'selected'; ?>
				{% endif %}
				<option <?=$selected?> value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
				 {% endfor %}
			</select>
			
		</form>
		
<br>		
		
<br>


{% if (not(querycargos is empty)) %}


<br>


<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
    <thead>
        <tr>
			<th class="info">ID Cargo</th>
			<th class="info">Nombre del Cargo</th>
			<th class="info">Tipo de Contrato</th>
			<th class="info">Valor</th>
         </tr>
    </thead>
    <tbody>
    {% for cargo in querycargos %}
    	<tr>
	        <td class="info" align="center">{{ cargo.id_cargo }}</td>
			<td >{{ cargo.nombre_cargo }}</td>
			<td >{{ cargo.codigo_tipo_contrato }}</td>
			<td >$ <?php echo number_format ($cargo->base_salario_honorarios, 0, ',', '.'); ?></td>
        </tr>
    {% endfor %}
    </tbody>
</table>
{% else %}
<p class="alert alert-warning" role="alert" >No hay cargos para este prestador</p>
{% endif %}








