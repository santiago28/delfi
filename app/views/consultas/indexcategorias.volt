
{{ content() }}


<div class="bs-docs-section">
		<h1 id="tables-example">Códigos de las Categorias y Conceptos</h1>
		<hr> <!-- Footer -->
</div>

 <p class="alert alert-info" role="alert" >Tenga en cuenta los siguientes códigos para diligenciar la Ejecución Financiera</p>

		
		
<br>


{% if (not(queryconceptos is empty)) %}


<br>


<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
    <thead>
        <tr>
			<th class="info">ID Categoria</th>
			<th class="info">Nombre Categoria</th>
			<th class="info">ID Concepto</th>
			<th class="info">Nombre Concepto</th>
         </tr>
    </thead>
    <tbody>
    {% for concepto in queryconceptos %}
    	<tr>
	        <td class="info" align="center">{{ concepto.id_categoria }}</td>
			<td >{{ concepto.Categoria.nombre_categoria }}</td>
			<td class="info" align="center">{{ concepto.id_concepto }}</td>
			<td >{{ concepto.nombre_concepto }}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>
{% else %}
<p class="alert alert-warning" role="alert" >No hay conceptos creados</p>
{% endif %}








