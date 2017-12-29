
<div class="container">

<div class="bs-docs-section">
		<h1 id="tables-example">Ingresar Soportes</h1>
		<hr> <!-- Footer -->
</div>

<p class="alert alert-info" role="alert" >Cargue por medio de un archivo ZIP o RAR los soportes de las facturas y demás que respalden la información digitada en los numerales anteriores.<br><strong>Recuerde que el archivo tiene un peso maximo de 500 MB</strong></a></p>

<br>

{{ form("ingresar/inssoportes", "method":"post", "class":"form-signin", "enctype":"multipart/form-data", "data-parsley-validate" : "") }}

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
		<select data-parsley-min="1" class="form-control input-lg" name="id_mes">
			<option value="0">Seleccione el Mes...</option>
			{% for mes in meses %}
			<option  value={{ mes.id_mes }}>{{ mes.nombre_mes }}</option>
			{% endfor %}
		</select>
	</div>

	<div class="form-group col-sm-3">
		<button  class="btn btn-info btn-lg" type="submit" onclick="javascript:this.form.submit();this.disabled= true;"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Cargar Archivo Nuevo </button>
	</div>

</form>


<br>

</div><!-- /container -->
<hr> <!-- Footer -->
<br>
<br>


<div class="bs-docs-section">
			{{ form("ingresar/indexsoportes", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
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




{% if (not(soportes is empty)) %}
<br>

<table align="center" class="table table-bordered table-hover" id='table' style="width: 98%">
    <thead>
        <tr>
			<th class="info">Eliminar</th>
			<th class="info">Contrato</th>
			<th class="info">Prestador</th>
			<th class="info">Año-Mes</th>
			<th class="info">Descargar</th>
         </tr>
    </thead>
    <tbody>
    {% for soporte in soportes %}
    	<tr>
	        <td align="center">
			{% if soporte.estado == 1 %}
			<a class="btn btn-default" href="delsoportes/{{ soporte.id_archivo_soporte }}" role="button" title="Elimina solo los soportes RAR o ZIP"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span></a>
			{% endif %}
			{% if soporte.id_mes == 0 %}
				
			{% else %}
				{% if soporte.estado == 1 %}
				<a class="btn btn-default" href="delsoportes/{{ soporte.id_archivo_soporte }}" role="button" title="Elimina solo los soportes RAR o ZIP"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span></a>
				{% endif %}
			{% endif %}
			</td>
			<td align="right">{{ soporte.id_contrato }}</td>
			<td align="right">{{ soporte.Prestador.nombre_prestador }}</td>
			<td class="info" align="right">{{ soporte.id_ano }}-{{ soporte.id_mes }}</td>
			<td align="center">
			<?php if (file_exists($write_soporte.$soporte->nombre_archivo)) { ?> <a class="btn btn-danger" href="<?php echo $read_soporte.$soporte->nombre_archivo; ?>" role="button" title="Soportes [rar,zip]"><span class="glyphicon glyphicon-download-alt" aria-hidden="true" ></span></a> <?php } ?>
			<?php if (file_exists($write_files."RH-".$soporte->id_contrato."-".$soporte->id_ano."-".$soporte->id_mes.".csv")) { ?> <a class="btn btn-info" href="<?php echo $read_files."RH-".$soporte->id_contrato."-".$soporte->id_ano."-".$soporte->id_mes.".csv"; ?>" role="button" title="Recurso Humano [csv]"><span class="glyphicon glyphicon-download-alt" aria-hidden="true" ></span></a> <?php } ?>
			<?php if (file_exists($write_files."CO-".$soporte->id_contrato."-".$soporte->id_ano."-".$soporte->id_mes.".csv")) { ?> <a class="btn btn-success" href="<?php echo $read_files."CO-".$soporte->id_contrato."-".$soporte->id_ano."-".$soporte->id_mes.".csv"; ?>" role="button" title="Conceptos Canasta [csv]"><span class="glyphicon glyphicon-download-alt" aria-hidden="true" ></span></a> <?php } ?>
			</td>
        </tr>
    {% endfor %}
    </tbody>
</table>
{% else %}
</div>
<div class="container">
<p class="alert alert-warning" role="alert" >No hay soportes ingresados para este prestador</p>
{% endif %}
