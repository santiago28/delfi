
<div class="container">


<div class="bs-docs-section">
		<h1 id="tables-example">Ingresar Recurso Humano</h1>
		<hr> <!-- Footer -->
</div>

<p class="alert alert-info" role="alert" >Cargue por medio de un archivo CSV la ejecución de recurso humano. Consulte el instructivo dando clic {{ link_to("consultas/indexinstructivos", 'AQUÍ') }}</p>

<br>

{{ form("ingresar/insrecursohumano", "name":"farchivo", "method":"post", "class":"form-signin", "enctype":"multipart/form-data", "data-parsley-validate" : "") }}

	<div class="form-group col-sm-12">
		<label>Contrato</label>
		<select data-parsley-min="1" class="form-control input-lg" name="id_contrato">
			<option value="0" required>Seleccione el Contrato...</option>
			{% for contrato in querycontratos %}
			<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
			 {% endfor %}
		</select>
	</div>

	<div class="form-group col-sm-12">
		<label>Cargar Archivo</label>
		<input data-parsley-required type="file" class="filestyle" name="archivo" id="archivo" value="" data-buttonName="btn-info" data-buttonText=" Buscar...">
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
		<select data-parsley-min="1" class="form-control input-lg" name="id_mes" id="id_mes" >
			<option value="0">Seleccione el Mes...</option>
			{% for mes in meses %}
			<option  value={{ mes.id_mes }}>{{ mes.nombre_mes }}</option>
			{% endfor %}
		</select>
	</div>

	<div class="form-group col-sm-3">
	<button  class="btn btn-info btn-lg" type="button" onclick="javascript:validaarchivo();this.disabled= true;"><span class="glyphicon glyphicon-plus" aria-hidden="true" id="boton"></span> Cargar Nuevos Registros </button> <!-- onclick="javascript:this.form.submit(); -->
	</div>
	<div class="form-group col-sm-3" id="errores">
	</div>
</form>



</div><!-- /container -->
<hr> <!-- Footer -->
<br>
<br>


<div class="bs-docs-section">
			{{ form("ingresar/indexrecursohumano", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-6">
				<h2 id="tables-example">Consultar Registros</h2>
				<h5 id="tables-example">Seleccione una opción del filtro para ver los registros insertados</h5>
				<div class="input-group">
				<div class="input-group-addon">Contrato</div>
					<select data-parsley-min="1" class="form-control input-lg" name="id_contrato" id="select1" onchange=formulario.submit()>
					<option value="0" required>Seleccione el Contrato...</option>
					{% for contrato in querycontratos %}
					<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
					{% endfor %}
					</select>
				</div>
				</div>
			</div>
			</form>

</div>




</div><!-- /container -->

{% if (not(rhs is empty)) %}

<div class="container">
<br>
<!-- Boton Modal eliminar Periodo -->
<div class="form-group col-sm-3">
<button id="modal-eliminar" type="button" class="btn btn-danger btn-lg" data-toggle="modal"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar Periodo Completo</button>
</div>
</div><!-- /container -->


<table align="center" class="table table-bordered table-hover" id='table' style="width: 95%">
    <thead>
        <tr>
			<!-- <th class="info">Acciones</th> -->
			<th class="info">Contrato</th>
			<th class="info">Prestador</th>
			<th class="info">Año-Mes</th>
			<th class="info">Cedula-Nombre</th>
			<th class="info">Cargo</th>
			<!-- <th class="info">Riesgo ARL</th> -->
			<th class="info">Novedad-Fecha</th>
			<th class="info">Tipo Contrato</th>
			<th class="info">% Dedicación</th>
			<th class="info">Dias Laborados</th>
			<th class="info">Planilla SS</th>
			<th class="info">Base Salario/Honorarios</th>
			<th class="info">Salario/Honorarios</th>
			<th class="info">Auxilio Transporte</th>
			<th class="info">Salario Devengado</th>
			<th class="info">Seguridad Social Empleado</th>
			<th class="info">Otras Deducciones</th>
			<th class="info">Valores Asumidos Prestador</th>
			<th class="info">Salario Neto Recibido</th>
			<th class="info">Dotación</th>
			<th class="info">Examen Medico</th>
			<th class="info">Seguridad Social Empresa</th>
			<th class="info">Provisión Cesantías</th>
			<th class="info">Provisión Intereses Cesantías</th>
			<th class="info">Provisión Prima</th>
			<th class="info">Provisión Vacaciones</th>
			<th class="info">Total Provisiones</th>
			<th class="info">Valor Total Ejecutado antes de Ajustes</th>
			<th class="info">Índice  Relación Técnica</th>
			<th class="info">Observaciones</th>

         </tr>
    </thead>
    <tbody>
    {% for rh in rhs %}
    	<tr>
	        <!-- <td align="center">
			{% if rh.estado == 1 %}
			<a class="btn btn-default" role="button" href="delrecursohumano/{{ rh.id }}"  title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span></a>
			<a class="btn btn-default" role="button" href="indexupdaterecursohumano/{{ rh.id }}"  title="Actualizar y Guardar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></a>
			{% endif %}
			</td> -->
			<td class="info">{{ rh.id_contrato }} - {{ rh.Modalidad.abr_modalidad }}</td>
			<td>{{ rh.Prestador.nombre_prestador }} </td>
			<td class="info">{{ rh.id_ano }}-{{ rh.id_mes }}</td>
			<td>{{ rh.cedula }} - <?php if(isset($rh->PersonalContratado->primer_nombre)){echo $rh->PersonalContratado->primer_nombre." ".$rh->PersonalContratado->segundo_nombre." ".$rh->PersonalContratado->primer_apellido." ".$rh->PersonalContratado->segundo_apellido ;} else { echo "¡ERROR!";}?> </td>
			<td class="info">{{ rh.id_cargo }} - <?php if(isset($rh->Cargo->nombre_cargo)){echo $rh->Cargo->nombre_cargo;} else { echo "¡ERROR!";}?></td>
			<!-- <td>I: 0,522%</td> -->
			<td>
			{% if rh.codigo_novedad != 'SN' %}
				{{ rh.codigo_novedad }} : {{ rh.fecha_novedad }}
			 {% endif %}
			</td>
			<td class="info">{{ rh.codigo_tipo_contrato }}</td>
			<td>{{ rh.porcentaje_dedicacion*100 }}%</td>
			<td class="info">{{ rh.dias_laborados }}</td>
			<td class="info">{{ rh.planilla_ss }}</td>
			<td><?php echo number_format ($rh->base_salario_honorarios, 2, ',', '.'); ?></td>
			<td class="danger"><?php echo number_format ($rh->valor_salario_honorarios, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_auxilio_transporte, 2, ',', '.'); ?></td>
			<td class="info"><?php echo number_format ($rh->valor_bruto, 2, ',', '.'); ?></td>
			<td>- <?php echo number_format ($rh->valor_deduccion_ss, 2, ',', '.'); ?></td>
			<td class="info">- <?php echo number_format ($rh->valor_otras_deducciones, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_asumidos_prestador, 2, ',', '.'); ?></td>
			<td class="success"><?php echo number_format ($rh->valor_neto, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_dotacion, 2, ',', '.'); ?></td>
			<td class="info"><?php echo number_format ($rh->valor_examen_medico, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_seguridad_social, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_prov_cesantias, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_prov_intereses_cesantias, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_prov_prima, 2, ',', '.'); ?></td>
			<td><?php echo number_format ($rh->valor_prov_vacaciones, 2, ',', '.'); ?></td>
			<td class="warning"><?php echo number_format ($rh->valor_total_provisiones, 2, ',', '.'); ?></td>
			<td class="danger"><?php echo number_format ($rh->valor_total_ejecutado, 2, ',', '.'); ?></td>
			<td><?php echo round ($rh->indice_relacion_tecnica, 2); ?></td>
			<td class="info">{{ rh.observaciones }}</td>


        </tr>
    {% endfor %}
    </tbody>
</table>

{% else %}
<div class="container">
<p class="alert alert-warning" role="alert" >No hay registros ingresados para este prestador o no se ha seleccionado el filtro</p>
{% endif %}



<br>

<!-- ****************** SECCION MODALS ***************************** -->

<!-- Modal Eliminar periodo -->
<div id="myModaleliminarperiodo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Eliminar Periodo:</h4>
		<h5 class="modal-title">¡Solo se permitiran eliminar los periodos que no estén cerrados!</h5>
	  </div>
	  <div class="modal-body">

		{{ form("ingresar/delperiodorecursohumano", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}

			<div class="form-group col-sm-6">
			<label>Contrato</label>
			<select data-parsley-min="1" class="form-control" name="id_contrato">
				<option value="0" required>Contrato...</option>
				{% for contrato in querycontratos %}
				<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
				{% endfor %}
			</select>
			</div>

			<div class="form-group col-sm-3">
			<label>Año</label>
			<select data-parsley-min="1" class="form-control" name="id_ano">
				<option value="0">Año...</option>
				{% for ano in anos %}
				<option  value={{ ano.id_ano }}>{{ ano.id_ano }}</option>
				{% endfor %}
			</select>
			</div>

			<div class="form-group col-sm-3">
			<label>Mes</label>
			<select data-parsley-min="1" class="form-control" name="id_mes">
				<option value="0">Mes...</option>
				{% for mes in meses %}
				<option  value={{ mes.id_mes }}>{{ mes.nombre_mes }}</option>
				{% endfor %}
			</select>
			</div>

			<button  class="btn btn-danger" type="submit" id="submit" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar Registros </button>
		</form>

	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	  </div>
	</div>

  </div>
</div><!-- /Modal Eliminar periodo -->


<div class="container">

<script>
$(document).ready(function(){
	
	$('#modal-eliminar').on('click', function (event) {
		$('#myModaleliminarperiodo').modal('show');
	});
});

function validaarchivo(){
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
        var error = "";
        if (regex.test($("#archivo").val().toLowerCase())) {
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var table = $("<table />");
                    var rows = e.target.result.split("\n");
                    for (var i = 1; i < rows.length; i++) {
                        rows[i] = rows[i].replace('"', '');
                        rows[i] = rows[i].replace(',', '.');
                        if (rows[i].length < 2) {
                            continue;
                        }
                        var row = $("<tr />");
                        var cells = rows[i].split(";");
                        for (var j = 0; j < cells.length; j++) {
                            var cell = $("<td />");
                            var valor=cells[j]; error +="";
                            switch(j) {
                                case 0: // Campo Contrato
                                    if (valor.length != 10) {
                                        error += "Linea"+i+" -Campo: Contrato -Error: Longitud Errada;";
                                    } else if (!/^([0-9])*$/.test(valor)) {
                                        error += "Linea"+i+" -Campo: Contrato -Error: C&oacute;digo No Num&eacute;rico;";
                                    }
                                    break;
                                case 1: // campo Mes
                                    if (!/^([0-9])*$/.test(valor)) {
                                        error += "<p>Linea"+i+" -Campo: Mes -Error: C&oacute;digo No Num&eacute;rico;";
                                    } else if (valor < 1 && valor > 12) {
                                        error += "<p>Linea"+i+" -Campo: Mes -Error: Fuera de Rango;";
                                    } else if (valor != document.getElementById("id_mes").value) {
                                        error += "<p>Linea"+i+" -Campo: Mes -Error: No es el Mes escogido;";
                                    }
                                    break;
                                case 2: // campo cédula
                                    if (!/^([0-9])*$/.test(valor)) {
                                        error += "<p>Linea"+i+" -Campo: C&eacute;dula -Error: No es Num&eacute;rico;";
                                    } else if (valor.length <6 || valor.length >11) {
                                        error += "<p>Linea"+i+" -Campo: C&eacute;dula -Error: Longitud de Caracteres Errada;";
                                    }
                                    break;
                                case 3: // campo cargo
                                    if (!/^([0-9])*$/.test(valor)) {
                                        error += "<p>Linea"+i+" -Campo: Cargo -Error: No es Num&eacute;rico;";
                                    } else if (valor <100 || valor >300) {
                                        error += "<p>Linea"+i+" -Campo: Cargo -Error: C&oacute;digo de Cargo Errado;";
                                    }
                                    break;
                                case 4: // campo Novedad -> solo IN: Ingreso, RE: Retiro, SN: Sin Novedad
                                    var valArray = ['IN', 'RE', 'SN', 'RI', 'IC', 'LC'];
                                    if ($.inArray(valor,valArray) == -1) {
                                         error += "<p>Linea"+i+" -Campo: Novedad -Error: C&oacute;digo de Novedad Errado;";
                                    }
                                    break;
                                case 5: // campo fecha novedad -- la fecha debe ser del mes a subir
                                    var mesevento = document.getElementById("id_mes").value; //hacer el enlace del mes a cargar
                                    campofecha = valor.split("/",3);
                                    if (campofecha[0]== "31") { campofecha[0]=30;}
                                    fechaReg = new Date(campofecha[2], campofecha[1], campofecha[0]);
									//console.log(parseInt(campofecha[1]));
                                    var fechaHoy = Date.now();
                                    resultado = fechaHoy - fechaReg;
                                    if (typeof fechaReg == "undefined") {
                                        error += "<p>Linea"+i+" -Campo: Fecha -Error: No es un Formato de Fecha";
                                    }else if (campofecha[1]!=12) {
                                        if (mesevento != parseInt(campofecha[1])) {
                                            error += "<p>Linea"+i+" -Campo: Fecha -Error: Fuera del mes a subir"+mesevento+"+"+fechaReg.getMonth()+"--"+valor;
                                        }
                                    }                                    break;
                                case 6: //campo Porcentaje de Dedicación
                                    if (!(/^-{0,1}\d*\.{0,1}\d+$/.test(valor))) {
                                        error += "<p>Linea"+i+" -Campo: % Dedicaci&oacute;n -Error: No es Num&eacute;rico;";
                                    } else if(valor <0.00 || valor >1.00) {
                                        error += "<p>Linea"+i+" -Campo: % Dedicaci&oacute;n -Error: Fuera del limite permitido;";
                                    }
                                    break;
                                case 7: // campo de Días laborados
                                    if (!/^([0-9])*$/.test(valor)) {
                                        error += "<p>Linea"+i+" -Campo: D&iacute;as Laborados -Error: No es Num&eacute;rico;";
                                    } else if(valor <0 || valor >30) {
                                        error += "<p>Linea"+i+" -Campo: D&iacute;as Laborados -Error: Fuera del limite permitido;";
                                    }
                                    break;
								case 8: // Resto de campos
									if (!/^([0-9])*$/.test(valor)) {
                                        error += "<p>Linea"+i+" -Campo: planilla ss -Error: No es Num&eacute;rico;";
									} else if(valor < 0 ) {
										error += "<p>Linea"+i+" -Campo: planilla ss -Error: debe ser positivo;";
									}
									break;
                                case 9: // campo Auxilio de Transporte numerico valor entre 0 y 77.700
                                    if (!/^([0-9])*$/.test(valor)) {
                                        error += "<p>Linea"+i+" -Campo: Auxilio de Transporte -Error: No es Num&eacute;rico;";
                                    } else if(valor <0 || valor >83140) {
                                        error += "<p>Linea"+i+" -Campo: Auxilio de Transporte -Error: Fuera del limite permitido;";
                                    }
                                    break;
                                case 10:
                                case 11:
                                case 12:
                                    if (!/^([0-9])*$/.test(valor)) {
                                        error += "<p>Linea"+i+" -Campo:de otras deducciones y dem&aacute;s -Error: No es Num&eacute;rico;";
                                    }
                                    break;


                            }
                            cell.html(i);
                            cell.html(cells[j]);
                            row.append(cell);
                        }
                        table.append(row);
                    }

                    $("#dvCSV").html('');
                    $("#dvCSV").append(table);
                    $("#errores").html("").show();
                    $("#errores").html(error);
                    if (error == "") {
                        document.forms["farchivo"].submit();
                    } else {
                    	document.getElementById("boton").removeAttribute("disabled");
                        return false;
                    }
                }
                reader.readAsText($(":file")[0].files[0]);
            } else {
                alert("El navegador no soporta HTML5.");
            }
        } else {
            alert("Favor cargar un archivo CSV valido.");
        }
}
</script>



