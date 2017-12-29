<?php
//Construcción tabla en Excel
	header('Content-type: application/vnd.ms-excel'); 
	header("Content-Disposition: attachment; filename=Descargable_Personal_Contratado.xls"); 
	header("Pragma: no-cache"); 
	header("Expires: 0");

?>

<table align='center' border='1'>
	<tr> 
		<th bgcolor='#09227E'><font color='#ffffff'>CONTRATO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PRESTADOR</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>MODALIDAD</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>CEDULA</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PRIMER NOMBRE</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>SEGUNDO NOMBRE</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PRIMER APELLIDO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>SEGUNDO APELLIDO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>SEXO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>NUMERO TELEFONO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>NUMERO CELULAR</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>EMAIL</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>FORMACION ACADEMICA</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>NOMBRE INSTITUCION</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>CARGO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>SEDE</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>UDS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>TIPO CONTRATO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>BASE SALARIO/HONORARIOS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PORCENTAJE DEDICACION</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>EPS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>ARL</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>FECHA INGRESO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>FECHA AFILIACION SS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>FECHA TERMINACION CONTRATO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>FECHA RETIRO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>OBSERVACIONES</a></th>
	</tr>

	{% for pc in querypc %}
	<tr>
		<td>{{ pc.id_contrato }}</td>
		<td>{{ pc.Prestador.nombre_prestador }}</td>
		<td>{{ pc.Modalidad.nombre_modalidad }}</td>
		<td>{{ pc.cedula }}</td>
		<td>{{ pc.primer_nombre }}</td>
		<td>{{ pc.segundo_nombre }}</td>
		<td>{{ pc.primer_apellido }}</td>
		<td>{{ pc.segundo_apellido }}</td>
		<td>{{ pc.sexo }}</td>
		<td>{{ pc.numero_telefono }}</td>
		<td>{{ pc.numero_celular }}</td>
		<td>{{ pc.email }}</td>
		<td>{{ pc.formacion_academica }}</td>
		<td>{{ pc.nombre_institucion }}</td>
		<td>{{ pc.Cargo.nombre_cargo }}</td>
		<td>{{ pc.Sede.nombre_sede }}</td>
		<td>{{ pc.UDS }}</td>
		<td>{{ pc.codigo_tipo_contrato }}</td>
		<td>{{ pc.base_salario_honorarios }}</td>
		<td><?php echo str_replace ( '.' , ',' , $pc->porcentaje_dedicacion ); ?></td>
		<td>{{ pc.EPS }}</td>
		<td>{{ pc.ARL }}</td>
		<td>{{ pc.fecha_ingreso }}</td>
		<td>{{ pc.fecha_afiliacion_ss }}</td>
		<td>{{ pc.fecha_terminacion_contrato }}</td>
		<td>{{ pc.fecha_retiro }}</td>
		<td>{{ pc.observaciones }}</td>
	</tr>
	{% endfor %}
</table>	









