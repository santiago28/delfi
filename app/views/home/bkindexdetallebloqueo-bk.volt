
{{ content() }}


<div class="bs-docs-section">
		<h1 id="tables-example">Detalle del Bloqueo por contrato</h1>
		<hr> <!-- Footer -->
</div>


		
<br>


{% if (not(bloqueados is empty)) %}


<br>

<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
    <thead>
        <tr>
			<th class="info">Contrato - Modalidad</th>
			<th class="info">Prestador</th>
			<th class="info">Mes</th>
			<th class="info">Componente Bloqueado</th>
			<th class="info">Fecha Bloqueo</th>
			<th class="info">Usuario que Bloquea</th>
         </tr>
    </thead>
    <tbody>
    {% for bloqueado in bloqueados %}
    	<tr>
	        <td>{{ bloqueado.id_contrato }} - {{ bloqueado.Modalidad.nombre_modalidad }}</td>
			<td >{{ bloqueado.Prestador.nombre_prestador }}</td>
			<td >{{ bloqueado.id_mes }}</td>
			<td >{{ bloqueado.nombre_componente_bloqueado }}</td>
			<td >{{ bloqueado.fecha_bloqueo  }}</td>
			<td >{{ bloqueado.usuario  }}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>
{% else %}
<p class="alert alert-warning" role="alert" >No hay ningun concepto bloqueado</p>
{% endif %}








