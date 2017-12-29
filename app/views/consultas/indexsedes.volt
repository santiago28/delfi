
{{ content() }}


<div class="bs-docs-section">
		<h1 id="tables-example">Sedes por Contrato</h1>
		<hr> <!-- Footer -->
</div>

 <h5>Seleccione el contrato para verificar las sedes asociadas...</h5>


		{{ form("consultas/indexsedes", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}

			<select data-parsley-min="1" class="form-control input-lg" name="id_contrato" id="select1" onchange=formulario.submit()>
				<option id="option1_js" value="0" required>Seleccione el Contrato...</option>
				{% for contrato in querycontratos %}
				<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
				 {% endfor %}
			</select>

		</form>

<br>


{% if (not(querysedes is empty)) %}


<br>

<p class="alert alert-info" role="alert" >Utilice los siguientes códigos de las sedes para realizar los informes de Ejecución Financiera</p>

<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
    <thead>
        <tr>
			<th class="info">ID Sede</th>
			<th class="info">ID UDS</th>
			<th class="info">Contrato</th>
			<th class="info">Nombre de la sede</th>
			<th class="info">Barrio</th>
			<th class="info">Dirección</th>
			<th class="info">Teléfono</th>
         </tr>
    </thead>
    <tbody>
    {% for sedexcontrato in querysedes %}
    	<tr>
	    <td class="info" align="center">{{ sedexcontrato.id_sede }}</td>
			<td >{{ sedexcontrato.Sede.id_uds }}</td>
			<td >{{ sedexcontrato.id_contrato }}</td>
			<td >{{ sedexcontrato.Sede.nombre_sede }}</td>
			<td >{{ sedexcontrato.Sede.barrio_sede }}</td>
			<td >{{ sedexcontrato.Sede.direccion_sede  }}</td>
			<td >{{ sedexcontrato.Sede.telefono_sede  }}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>
{% else %}
<p class="alert alert-warning" role="alert" >No hay Sedes cargadas para este prestador o no se ha realizado el filtro</p>
{% endif %}
