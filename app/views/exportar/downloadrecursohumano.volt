<?php
//Construcción tabla en Excel
	header('Content-type: application/vnd.ms-excel'); 
	header("Content-Disposition: attachment; filename=Descargable_Recurso_Humano.xls"); 
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
		<th bgcolor='#09227E'><font color='#ffffff'>CEDULA</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>CARGO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>NOVEDAD</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>FECHA NOVEDAD</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>TIPO CONTRATO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>% DEDICACION</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>BASE SALARIO/HONORARIOS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>DIAS LABORADOS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PLANILLA SS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>SALARIO/HONORARIOS * DIAS LABORADOS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>AUX TRANSPORTE * DIAS LABORADOS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>SALARIO DEVENGADO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>DEDUCCION SS EMPLEADO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>OTRAS DEDUCCIONES</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>ASUMIDOS PRESTADOR</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>SALARIO EFECTIVAMENTE RECIBIDO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>DOTACION</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>EXAMEN MEDICO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>SEGURIDAD SOCIAL EMPRESA</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PROVISION CESANTIAS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PROVISION INTERESES CESANTIAS</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PROVISION PRIMA</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>PROVISION VACACIONES</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>TOTAL PROVISIONES</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>VALOR TOTAL EJECUTADO</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>OBSERVACIONES</a></th>
		<th bgcolor='#09227E'><font color='#ffffff'>INDICE RELACION TECNICA</a></th>
	</tr>

	{% for rh in queryrh %}
	<tr>
		<td>{{rh.id_contrato}}</td>
		<td>{{rh.Prestador.nombre_prestador}}</td>
		<td>{{rh.Modalidad.nombre_modalidad}}</td>
		<td>{{rh.id_ano}}</td>
		<td>{{rh.id_mes}}</td>
		<td>{{rh.Categoria.nombre_categoria}}</td>
		<td>{{rh.Concepto.nombre_concepto}}</td>
		<td>{{rh.cedula}} - <?php if(isset($rh->PersonalContratado->primer_nombre)){echo $rh->PersonalContratado->primer_nombre." ".$rh->PersonalContratado->segundo_nombre." ".$rh->PersonalContratado->primer_apellido." ".$rh->PersonalContratado->segundo_apellido ;} else { echo "¡ERROR!";}?> </td>
		<td>{{rh.Cargo.nombre_cargo}}</td>
		<td>{{rh.codigo_novedad}}</td>
		<td>{{rh.fecha_novedad}}</td>
		<td>{{rh.codigo_tipo_contrato}}</td>
		<td><?php echo str_replace ( '.' , ',' , $rh->porcentaje_dedicacion ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->base_salario_honorarios ); ?></td>
		<td>{{rh.dias_laborados}}</td>
		<td>{{rh.planilla_ss}}</td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_salario_honorarios ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_auxilio_transporte ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_bruto ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_deduccion_ss ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_otras_deducciones ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_asumidos_prestador ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_neto ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_dotacion ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_examen_medico ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_seguridad_social ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_prov_cesantias ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_prov_intereses_cesantias ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_prov_prima ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_prov_vacaciones ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_total_provisiones ); ?></td>
		<td><?php echo str_replace ( '.' , ',' , $rh->valor_total_ejecutado ); ?></td>
		<td>{{rh.observaciones}}</td>
		<td><?php echo str_replace ( '.' , ',' , $rh->indice_relacion_tecnica ); ?></td>
	</tr>
	{% endfor %}
</table>	









