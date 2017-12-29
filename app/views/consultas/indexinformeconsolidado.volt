
{{ content() }}


<div class="bs-docs-section">
		<h1 id="tables-example">Informe de Ejecución Financiera Consolidado</h1>
		<hr> <!-- Footer -->
</div>

<p class="alert alert-info" role="alert" >Ingrese todos los campos para obtener el reporte mensual de su contrato.</p>


		{{ form("consultas/indexinformeconsolidado", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}

			<div class="form-group col-sm-8">
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

			<br>
			<button  class="btn btn-info btn-lg" type="submit" id="submit" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Consultar </button>
			<br>
			<br>

		</form> <!-- Form end -->

<br>


{% if (not(totales is empty)) %}

{{ form("consultas/printinformeconsolidado", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "", "target":"_blank") }}

<input type="hidden" name="id_contrato" value={{ id_contrato }} >
<input type="hidden" name="id_ano" value={{ id_ano }}>

<br>
<button  class="btn btn-success btn-lg" type="submit" id="submit" ><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Versión para imprimir </button>
<br>

</form> <!-- Form end -->




<hr> <!-- Footer -->
	<div class="row">
        <div class="col-md-12">
		  <table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">

              <tr>
                <th class="info" colspan="3"><div style="text-align:center">INFORME CONSOLIDADO DE EJECUCIÓN FINANCIERA</div></th>
              </tr>


			<tbody>
              <tr>
                <th colspan="3"><div style="text-align:center">INTERVENTORÍA BUEN COMIENZO - OPERADA POR LA INSTITUCIÓN UNIVERSITARIA PASCUAL BRAVO</div></th>
              </tr>
            </tbody>

            <tbody>

              <tr>
                <td class="col-md-4">Contrato: <strong>{{ id_contrato }}</td>
                <td colspan="2">Prestador: <strong>{{ infocontrato.Prestador.nombre_prestador }}</td>
              </tr>


              <tr>
                <td class="col-md-6">Modalidad: <strong>{{ infocontrato.Modalidad.nombre_modalidad }}</td>
				<td class="col-md-6">Año: <strong>{{ id_ano }}</td>
              </tr>


            </tbody>
          </table>
        </div>

    </div>

</div> <!-- Salirse del contenedor-->

<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
				<tr>
					<th class="info">CATEGORÍAS </th>
					{% for mes in meses %}
					<td class="info">{{ mes.nombre_mes }}</td>
					{% endfor %}
					<td class="info">TOTALES</td>
				</tr>

				<tr>
					<th>RECURSO HUMANO</th>
					{% for recurso_hno in query1 %}
					<td align="right"><?php echo number_format (round($recurso_hno,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query1),0), 0, ',', '.'); ?></td>
				</tr>

				<tr>
					<th>AJUSTES RECURSO HUMANO</th>
					{% for query_ajuste_rh1 in query_ajuste_RH %}
					<td align="right"><?php echo number_format (round($query_ajuste_rh1,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query_ajuste_RH),0), 0, ',', '.'); ?></td>
				</tr>

				<tr style="background:#e6e6e6;">
					<th>1. TOTAL RECURSO HUMANO</th>
					{% for query_total_rh in query_total_RH %}
					<td align="right"><strong><?php echo number_format (round($query_total_rh,0), 0, ',', '.'); ?></strong></td>
					{% endfor %}
					<td class="" align="right"><strong><?php echo number_format (round(array_sum($query_total_RH),0), 0, ',', '.'); ?></strong></td>
				</tr>

				<tr>
					<th>DOTACIÓN</th>
					{% for dotacion in query2 %}
					<td align="right"><?php echo number_format (round($dotacion,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query2),0), 0, ',', '.'); ?></td>
				</tr>

				<tr>
					<th>AJUSTES DOTACIÓN</th>
					{% for query_ajuste_dotacion in query_ajuste_Dotacion %}
					<td align="right"><?php echo number_format (round($query_ajuste_dotacion,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query_ajuste_Dotacion),0), 0, ',', '.'); ?></strong></td>
				</tr>

				<tr style="background:#e6e6e6;">
					<th>2. TOTAL DOTACIÓN</th>
					{% for query_total_dotacion in query_total_Dotacion %}
					<td align="right"><strong><?php echo number_format (round($query_total_dotacion,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="" align="right"><strong><?php echo number_format (round(array_sum($query_total_Dotacion),0), 0, ',', '.'); ?></strong></td>
				</tr>

				<tr>
					<th>SERVICIOS GENERALES</th>
					{% for servicios_grales in query3 %}
					<td align="right"><?php echo number_format (round($servicios_grales,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query3),0), 0, ',', '.'); ?></td>
				</tr>

				<tr>
					<th>AJUSTES SERVICIOS GENERALES</th>
					{% for query_ajuste_servicios in query_ajuste_Servicios %}
					<td align="right"><?php echo number_format (round($query_ajuste_servicios,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query_ajuste_Servicios),0), 0, ',', '.'); ?></td>
				</tr>

				<tr style="background:#e6e6e6;">
					<th>3. TOTAL SERVICIOS GENERALES</th>
					{% for query_total_servicios in query_total_Servicios %}
					<td align="right"><strong><?php echo number_format (round($query_total_servicios,0), 0, ',', '.'); ?></strong></td>
					{% endfor %}
					<td class="" align="right"><strong><?php echo number_format (round(array_sum($query_total_Servicios),0), 0, ',', '.'); ?></strong></td>
				</tr>

				<tr>
					<th>MATERIAL DIDÁCTICO</th>
					{% for mat_didactico in query4 %}
					<td align="right"><?php echo number_format (round($mat_didactico,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query4),0), 0, ',', '.'); ?></td>
				</tr>

				<tr>
					<th>AJUSTES MATERIAL DIDÁCTICO</th>
					{% for query_ajuste__material_d in query_ajuste_Material_D %}
					<td align="right"><?php echo number_format (round($query_ajuste__material_d,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query_ajuste_Material_D),0), 0, ',', '.'); ?></td>
				</tr>

				<tr style="background:#e6e6e6;">
					<th>4. TOTAL MATERIAL DIDÁCTICO</th>
					{% for query_total_material_d in query_total_Material_D %}
					<td align="right"><strong><?php echo number_format (round($query_total_material_d,0), 0, ',', '.'); ?></strong></td>
					{% endfor %}
					<td class="" align="right"><strong><?php echo number_format (round(array_sum($query_total_Material_D),0), 0, ',', '.'); ?></strong></td>
				</tr>

				<tr>
					<th>ALIMENTACIÓN</th>
					{% for alimentacion in query5 %}
					<td align="right"><?php echo number_format (round($alimentacion,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query5),0), 0, ',', '.'); ?></td>
				</tr>

				<tr>
					<th>AJUSTES ALIMENTACIÓN</th>
					{% for query_ajuste_alimentacion in query_ajuste_Alimentacion %}
					<td align="right"><?php echo number_format (round($query_ajuste_alimentacion,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query_ajuste_Alimentacion),0), 0, ',', '.'); ?></td>
				</tr>

				<tr style="background:#e6e6e6;">
					<th>5. TOTAL ALIMENTACIÓN</th>
					{% for query_total_alimentacion in query_total_Alimentacion %}
					<td align="right"><strong><?php echo number_format (round($query_total_alimentacion,0), 0, ',', '.'); ?></strong></td>
					{% endfor %}
					<td class="" align="right"><strong><?php echo number_format (round(array_sum($query_total_Alimentacion),0), 0, ',', '.'); ?></strong></td>
				</tr>

				<tr>
					<th>COSTOS ADMINISTRATIVOS</th>
					{% for costos in query6 %}
					<td align="right"><?php echo number_format (round($costos,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query6),0), 0, ',', '.'); ?></td>
				</tr>

				<tr>
					<th>AJUSTES COSTOS ADMINISTRATIVOS</th>
					{% for query_ajuste_costos in query_ajuste_Costos %}
					<td align="right"><?php echo number_format (round($query_ajuste_costos,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><?php echo number_format (round(array_sum($query_ajuste_Costos),0), 0, ',', '.'); ?></td>
				</tr>

				<tr style="background:#e6e6e6;">
					<th>6. COSTOS ADMINISTRATIVOS</th>
					{% for query_total_costos in query_total_Costos %}
					<td align="right"><strong><?php echo number_format (round($query_total_costos,0), 0, ',', '.'); ?></strong></td>
					{% endfor %}
					<td class="" align="right"><strong><?php echo number_format (round(array_sum($query_total_Costos),0), 0, ',', '.'); ?></strong></td>
				</tr>

				<tr>
				<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>

				<tr>
					<th class="info">RESUMEN </th>
					{% for mes in meses %}
					<td class="info">{{ mes.nombre_mes }}</td>
					{% endfor %}
					<td class="info">TOTALES</td>
				</tr>

				<tr>
					<th class="">TOTAL CONCEPTO CANASTA</th>
					{% for total_sin_ajustes in querytotales_sinajustes %}
					<td class="" align="right"><?php echo number_format (round($total_sin_ajustes,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><strong><?php echo number_format (round(array_sum($querytotales_sinajustes),0), 0, ',', '.'); ?></strong></td>
				</tr>

				<tr>
					<th>TOTAL AJUSTES</th>
					{% for ajustes in query7 %}
					<td align="right"><?php echo number_format (round($ajustes,0), 0, ',', '.'); ?></td>
					{% endfor %}
					<td class="info" align="right"><strong><?php echo number_format (round(array_sum($query7),0), 0, ',', '.'); ?></strong></td>
				</tr>

				<tr>
					<th class="info">TOTAL EJECUCIÓN</th>
					{% for total in querytotales %}
					<td class="info" align="right"><strong><?php echo number_format (round($total,0), 0, ',', '.'); ?></strong></td>
					{% endfor %}
					<td class="info" align="right"><strong><?php echo number_format (round(array_sum($querytotales),0), 0, ',', '.'); ?></strong></td>
				</tr>





</table>


<center><h4>DESCRIPCIÓN DE AJUSTES</h4></center>

{% if (not(detalle_ajustes is empty)) %}
<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
	<thead>
		<tr>
			<th class="info">Concepto Ajuste</th>
			<th class="info">Correspondiente al Año-Mes</th>
			<th class="info">Valor del Ajuste</th>
			<th class="info">Observaciones</th>
			<th class="info">Fecha_Ajuste</th>
		 </tr>
	</thead>
	<tbody>
	{% for detalle in detalle_ajustes %}
		<tr>
			<td align="right">{{ detalle.id_concepto}} - {{ detalle.Concepto.nombre_concepto}}</td>
			<td align="right">{{ detalle.id_ano}}-{{ detalle.id_mes}}</td>
			<td align="right"><?php echo number_format ($detalle->valor_ajuste, 2, ',', '.'); ?></td>
			<td align="left">{{ detalle.observaciones }}</td>
			<td align="right">{{ detalle.fecha_ajuste }}</td>
		</tr>
	{% endfor %}
	</tbody>
</table>
{% endif %}


{% else %}
<p class="alert alert-warning" role="alert" >No hay ejecución financiera para este prestador en el mes seleccionado o no se han diligenciado los filtros</p>
{% endif %}
