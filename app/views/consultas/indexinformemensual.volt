
{{ content() }}


<div class="bs-docs-section">
		<h1 id="tables-example">Informe de Ejecución Financiera Mensual</h1>
		<hr> <!-- Footer -->
</div>

<p class="alert alert-info" role="alert" >Ingrese todos los campos para obtener el reporte mensual de su contrato.</p>

		
		{{ form("consultas/indexinformemensual", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
			
			<div class="form-group col-sm-12">
				<label>Contrato</label>
				<select data-parsley-min="1" class="form-control input-lg" name="id_contrato">
					<option value="0" required>Seleccione el Contrato...</option>
					{% for contrato in querycontratos %}
					<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
					 {% endfor %}
				</select>
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
		
			<br>
			<button  class="btn btn-info btn-lg" type="submit" id="submit" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar </button>
			<br>
			<br>
		
		</form> <!-- Form end -->
		
<br>


{% if (not(totales is empty)) %}


{{ form("consultas/printinformemensual", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "", "target":"_blank") }}
			
<input type="hidden" name="id_contrato" value={{ id_contrato }} >
<input type="hidden" name="id_ano" value={{ id_ano }}>
<input type="hidden" name="id_mes" value={{ id_mes }}>
			
<br>
<button  class="btn btn-success btn-lg" type="submit" id="submit" ><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Versión para imprimir </button>
<br>

</form> <!-- Form end -->


<hr> <!-- Footer -->
	<div class="row">
        <div class="col-md-12">
		  <table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
		  
              <tr>
                <th class="info" colspan="3"><div style="text-align:center">INFORME MENSUAL DE EJECUCIÓN FINANCIERA</div></th>
              </tr>
           
			
			<tbody>
              <tr>
                <th colspan="3"><div style="text-align:center">INTERVENTORÍA BUEN COMIENZO - OPERADA POR LA INSTITUCIÓN UNIVERSITARIA PASCUAL BRAVO</div></th>
              </tr>
            </tbody>
		  
            <tbody>
			  
              <tr>
                <td class="col-md-4">Contrato: <strong>{{ id_contrato }}</td>
                <td colspan="2">Prestador: <strong>{{ datoscontrato.Prestador.nombre_prestador }}</td>
              </tr>
			  
			  
              <tr>
                <td class="col-md-4">Modalidad: <strong>{{ datoscontrato.Modalidad.nombre_modalidad }}</td>
				<td class="col-md-4">Año: <strong>{{ id_ano }}</td>
                <td class="col-md-4">Mes: <strong>{{ id_mes }}</td>
              </tr>
			  
			  
            </tbody>
          </table>
        </div>
        
    </div>



<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
    <thead>
        <tr>
			<th class="info">Componente de la Canasta</th>
			<th class="info">Valor Ejecución Mensual</th>
			<th class="info">Porcentaje de Ejecución</th>
         </tr>
    </thead>
    <tbody>
    	<tr>
	        <td>1. RECURSO HUMANO</td>
			<td>$ <?php echo number_format (round($recurso_humano,0), 0, ',', '.'); ?></td>
			<td><?php echo number_format ($recurso_humano/$totales*100, 2, ',', '.'); ?> %</td>
        </tr>
		
		<tr>
	        <td>2. DOTACIÓN</td>
			<td>$ <?php echo number_format (round($dotacion,0), 0, ',', '.'); ?></td>
			<td><?php echo number_format ($dotacion/$totales*100, 2, ',', '.'); ?> %</td>
        </tr>
		
		<tr>
	        <td>3. SERVICIOS GENERALES</td>
			<td>$ <?php echo number_format (round($servicios_grales,0), 0, ',', '.'); ?></td>
			<td><?php echo number_format ($servicios_grales/$totales*100, 2, ',', '.'); ?> %</td>
        </tr>
		
		<tr>
	        <td>4. MATERIAL DIDÁCTICO</td>
			<td>$ <?php echo number_format (round($material_didactico,0), 0, ',', '.'); ?></td>
			<td><?php echo number_format ($material_didactico/$totales*100, 2, ',', '.'); ?> %</td>
        </tr>
		
		<tr>
	        <td>5. ALIMENTACIÓN</td>
			<td>$ <?php echo number_format (round($alimentacion,0), 0, ',', '.'); ?></td>
			<td><?php echo number_format ($alimentacion/$totales*100, 2, ',', '.'); ?> %</td>
        </tr>
		
		<tr>
	        <td>6. COSTOS ADMINISTRATIVOS</td>
			<td>$ <?php echo number_format (round($costos_admin,0), 0, ',', '.'); ?></td>
			<td><?php echo number_format ($costos_admin/$totales*100, 2, ',', '.'); ?> %</td>
        </tr>
		
		<tr>
	        <td class="info">TOTALES</td>
			<td class="info">$ <?php echo number_format (round($totales,0), 0, ',', '.'); ?></td>
			<td class="info">100%</td>
        </tr>
    </tbody>
</table>



{% else %}
<p class="alert alert-warning" role="alert" >No hay ejecución financiera para este prestador en el mes seleccionado o no se han diligenciado los filtros</p>
{% endif %}








