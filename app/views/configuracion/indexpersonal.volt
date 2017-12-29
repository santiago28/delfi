
<div class="container">
<div class="bs-docs-section">
		<h1 id="tables-example">Personal Contratado</h1>
		<h5 id="tables-example">Señor prestador: Cargue el personal contratado para cada uno de sus contratos. El sistema no permitirá ingresar registros duplicados con la combinación (CONTRATO-CEDULA-CARGO-SEDE) </h5>
		<hr> <!-- Footer -->
</div>


<p class="alert alert-info" role="alert" >Cargue por medio de un archivo CSV el personal contratado. Consulte el instructivo dando clic {{ link_to("consultas/indexinstructivos", 'AQUÍ') }}. Advertencia: No es valido eliminar registros una vez ingresados.</p>


{{ form("configuracion/inspersonal", "method":"post", "class":"form-signin", "enctype":"multipart/form-data", "data-parsley-validate" : "") }}

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

	<div class="form-group col-sm-3">
		<button  class="btn btn-info btn-lg" type="submit" onclick="javascript:this.form.submit();this.disabled= true;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cargar Nuevos Registros </button>
	</div>

</form>

<br>


</div> <!-- /container -->


<hr> <!-- Footer -->
<br>
<br>


<div class="bs-docs-section">
			{{ form("configuracion/indexpersonal", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
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




{% if (not(empleados is empty)) %}
<table align="center" class="table table-bordered table-hover" id='table' style="width: 95%">
    <thead>
        <tr>
			<th class="info">Acciones</th>
			<th class="info">Contrato</th>
			<th class="info">Prestador</th>
			<th class="info">Cédula</th>
			<th class="info">Nombres y Apellidos</th>
			<th class="info">Teléfonos</th>
			<th class="info">e-mail</th>
			<th class="info">Formación Académica</th>
			<th class="info">Institución</th>
			<th class="info">Cargo</th>
			<th class="info">Tipo Contrato - Salario</th>
			<th class="info">Sede</th>
			<th class="info">UDS</th>
			<th class="info">Porcentaje Dedicación</th>
			<th class="info">EPS</th>
			<th class="info">ARL</th>
			<th class="info">Fecha de Ingreso</th>
			<th class="info">Fecha Afiliación Seguridad Social</th>
			<th class="info">Fecha Terminación segun Contrato</th>
			<th class="info">Fecha Retiro</th>
			<th class="info">Observaciones</th>

         </tr>
    </thead>
    <tbody>
    {% for empleado in empleados %}
    	<tr>
	        <td align="center">
			<a class="btn btn-default" role="button" href="indexupdatepersonal/{{ empleado.id }}"  title="Actualizar y Guardar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span></a>
			</td>
			<td class="info">{{ empleado.id_contrato }} - {{ empleado.Modalidad.abr_modalidad }}</td>
			<td>{{ empleado.Prestador.nombre_prestador }}</td>
			<td class="info">{{ empleado.cedula }}</td>
			<td>{{ empleado.primer_nombre  }}  {{ empleado.segundo_nombre  }} {{ empleado.primer_apellido  }} {{ empleado.segundo_apellido  }}</td>
			<td class="info">{{ empleado.numero_telefono }} - {{ empleado.numero_celular }}</td>
			<td>{{ empleado.email }}</td>
			<td> {{ empleado.formacion_academica }} </td>
			<td>{{ empleado.nombre_institucion }}</td>
			<td class="info">{{ empleado.id_cargo }} - <?php if(isset($empleado->Cargo->nombre_cargo)){echo $empleado->Cargo->nombre_cargo;} else { echo "¡ERROR!";}?></td>
			<td>{{ empleado.codigo_tipo_contrato }} : $<?php echo number_format ($empleado->base_salario_honorarios, 2, ',', '.'); ?></td>
			<td class="info">{{ empleado.id_sede }} - <?php if(isset($empleado->Sede->nombre_sede)){echo $empleado->Sede->nombre_sede;} else { echo "¡ERROR!";}?></td>
			<td>{{ empleado.UDS }}</td>
			<td>{{ empleado.porcentaje_dedicacion *100}}%</td>
			<td>{{ empleado.EPS }}</td>
			<td>{{ empleado.ARL }}</td>
			<td  class="info">{{ empleado.fecha_ingreso }}</td>
			<td>{{ empleado.fecha_afiliacion_ss }}</td>
			<td  class="info">{{ empleado.fecha_terminacion_contrato }}</td>
			<td>{{ empleado.fecha_retiro }}</td>
			<td  class="info">{{ empleado.observaciones }}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>

{% else %}
<div class="container">
<p class="alert alert-warning" role="alert" >No hay personal ingresado para este contrato o no se ha seleccionado el filtro</p>
{% endif %}



<br>


<div class="container">

<script>
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
                        rows[i] = rows[i].replace(',', '');
                        rows[i] = rows[i].replace('ñ', 'n');
                        if (rows[i].length < 2) {
                            continue;
                        }

                        var row = $("<tr />");
                        var cells = rows[i].split(";");
                        if (cells.legnth > 2) {
	                        for (var j = 0; j < cells.length; j++) {
	                            var cell = $("<td />");
	                            var valor=cells[j]; error +="";
	                            cell.html(i);
	                            cell.html(cells[j]);
	                            row.append(cell);
	                        }
	                        table.append(row);
	                    } else { continue; }
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