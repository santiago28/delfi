<?php
//Construcción tabla en Excel
	header('Content-type: application/vnd.ms-excel'); 
	header("Content-Disposition: attachment; filename=Descargable_Conceptos_Canasta.xls"); 
	header("Pragma: no-cache"); 
	header("Expires: 0");

?>

<table align='center' border='1'>
	<tr> 
		<th bgcolor='#09227E'><font color='#ffffff'>CONTRATO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PRESTADOR</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>MODALIDAD</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>AÑO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>MES</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>CATEGORIA</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>CONCEPTO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>SEDE</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>VALOR</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>NUMERO DOCUMENTO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>FECHA DOCUMENTO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>DESCRIPCION DOCUMENTO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>CANTIDAD</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>NIT PROVEEDOR</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>NOMBRE PROVEEDOR</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>OBSERVACIONES</a></th>
	</tr>

	{% for co in queryco %}
	<tr>
		<td>{{ co.id_contrato }}</td>
		<td>{{ co.Prestador.nombre_prestador }}</td>
		<td>{{ co.Modalidad.nombre_modalidad }}</td>
		<td>{{ co.id_ano }}</td>
		<td>{{ co.id_mes }}</td>
		<td>{{ co.Categoria.nombre_categoria }}</td>
		<td>{{ co.Concepto.nombre_concepto }}</td>
		<td>{{ co.Sede.nombre_sede }}</td>
		<td>{{ co.valor }}</td>
		<td>{{ co.numero_documento }}</td>
		<td>{{ co.fecha_documento }}</td>
		<td>{{ co.descripcion_documento }}</td>
		<td>{{ co.cantidad }}</td>
		<td>{{ co.nit_proveedor }}</td>
		<td>{{ co.nombre_proveedor }}</td>
		<td>{{ co.observaciones }}</td>
	</tr>
	{% endfor %}
</table>	









