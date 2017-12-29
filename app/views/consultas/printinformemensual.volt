
{{ content() }}

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

{% if (datoscontrato.Modalidad.id_modalidad == 13) %}

<div class="row">
        <div class="col-md-12">
		  <table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
            <tbody>
			  
              <tr>
                <td class="col-md-6 row-md-2">Coordinador General: <strong></td>
				
              </tr> 
			  
			  
              <tr>
                <td class="col-md-6">Cédula: <strong></td>
              </tr>
			  
			  
            </tbody>
          </table>
        </div>
</div>
{% else %}
<div class="row">
        <div class="col-md-12">
		  <table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
            <tbody>
			  
              <tr>
                <td class="col-md-6 row-md-2">Representante Legal: <strong></td>
				<td class="col-md-6">Contador o Revisor Fiscal: <strong></td>
              </tr> 
			  
			  
              <tr>
                <td class="col-md-6">Cédula: <strong></td>
                <td class="col-md-6">Tarjeta Profesional: <strong></td>
              </tr>
			  
			  
            </tbody>
          </table>
        </div>
</div>

{% endif %}

<div class="row">
        <div class="col-md-12">
		  <table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
            <tbody>
			  
              <tr>
                <td class="col-md-6 row-md-2">Fecha elaboración informe: <strong></td>
				<td class="col-md-6"><strong><?php echo date("Y-m-d H:i:s"); ?></td>
              </tr> 
			  
			  
              <tr>
                <td class="col-md-6">Usuario que elabora: <strong></td>
                <td class="col-md-6">{{ usuario }}<strong></td>
              </tr>
			  
			  
            </tbody>
          </table>
        </div>
</div>	
