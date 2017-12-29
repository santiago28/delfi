
{{ content() }}


<div class="bs-docs-section">
		<h1 id="tables-example">Actualizar Registro</h1>
		<hr> <!-- Footer -->
</div>

<p class="alert alert-info" role="alert" >Actualice el registro y de clic en Guardar</p>

<br>

{{ form("configuracion/updpersonal", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}

			<input type="hidden" name="id" value={{ personal.id }}>
			<input type="hidden" name="id_prestador" value={{ personal.id_prestador }}>
			<input type="hidden" name="id_modalidad" value={{ personal.id_modalidad }}>
			<input type="hidden" name="sexo" value={{ personal.sexo }}>
			<input type="hidden" name="codigo_tipo_contrato" value={{ personal.codigo_tipo_contrato }}>
			<input type="hidden" name="base_salario_honorarios" value={{ personal.base_salario_honorarios }}>
			<input type="hidden" name="fecha_ingreso" value={{ personal.fecha_ingreso }}>
			<input type="hidden" name="fecha_afiliacion_ss" value={{ personal.fecha_afiliacion_ss }}>
			<input type="hidden" name="fecha_terminacion_contrato" value={{ personal.fecha_terminacion_contrato }}>
			<input type="hidden" name="usuario" value={{ personal.usuario }}>
			<input type="hidden" name="estado" value={{ personal.estado }}>
			<input type="hidden" name="id_componente" value={{ id_componente }}>
			<input type="hidden" name="id_group" value={{ id_group }}>


			<div class="form-group col-sm-12">
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Contrato</div>
				<input data-parsley-required class="form-control" type="text" name="id_contrato" value={{ personal.id_contrato}} placeholder="Contrato" readonly>
				</div>
				</div>

				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Cedula</div>
				<input data-parsley-required class="form-control" type="text" name="cedula" value={{ personal.cedula }} placeholder="Cedula" readonly>
				</div>
				</div>

				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Cargo</div>
				<input data-parsley-required class="form-control" type="text" name="id_cargo" value={{ personal.id_cargo }} placeholder="Codigo Cargo" readonly>
				</div>
				</div>
			</div>


			<div class="form-group col-sm-12">
				<div class="form-group col-sm-3">
				<div class="input-group">
				<div class="input-group-addon">Primer Nombre</div>
				<input data-parsley-required class="form-control" type="text" name="primer_nombre" value="{{ personal.primer_nombre }}" placeholder="Primer Nombre">
				</div>
				</div>

				<div class="form-group col-sm-3">
				<div class="input-group">
				<div class="input-group-addon">Segundo Nombre</div>
				<input class="form-control" type="text" name="segundo_nombre" value="{{ personal.segundo_nombre }}">
				</div>
				</div>

				<div class="form-group col-sm-3">
				<div class="input-group">
				<div class="input-group-addon">Primer Apellido</div>
				<input data-parsley-required class="form-control" type="text" name="primer_apellido" value="{{ personal.primer_apellido}}" placeholder="Primer Apellido">
				</div>
				</div>

				<div class="form-group col-sm-3">
				<div class="input-group">
				<div class="input-group-addon">Segundo Apellido</div>
				<input class="form-control" type="text" name="segundo_apellido" value="{{ personal.segundo_apellido }}">
				</div>
				</div>
			</div>

			<div class="form-group col-sm-12">
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Teléfono Fijo</div>
				<input data-parsley-required class="form-control" type="text" name="numero_telefono" value={{ personal.numero_telefono }} placeholder="Ingrese el número Fijo">
				</div>
				</div>

				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Celular</div>
				<input data-parsley-required class="form-control" type="text" name="numero_celular" value={{ personal.numero_celular }} placeholder="Ingrese el número Celular">
				</div>
				</div>

				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">e-mail</div>
				<input data-parsley-required class="form-control" type="text" name="email" value={{ personal.email }} placeholder="Ingrese el email">
				</div>
				</div>
			</div>

			<div class="form-group col-sm-12">
				<div class="form-group col-sm-6">
				<div class="input-group">
				<div class="input-group-addon">Formación Académica</div>
				<input data-parsley-required class="form-control" type="text" name="formacion_academica" value={{ personal.formacion_academica }} placeholder="Ingrese la formación académica">
				</div>
				</div>

				<div class="form-group col-sm-6">
				<div class="input-group">
				<div class="input-group-addon">Institución</div>
				<input data-parsley-required class="form-control" type="text" name="nombre_institucion" value={{ personal.nombre_institucion }} placeholder="Ingrese el nombre de la institución">
				</div>
				</div>
			</div>

			<div class="form-group col-sm-12">
				<div class="form-group col-sm-6">
				<div class="input-group">
				<div class="input-group-addon">Nombre Sede</div>
					<select data-parsley-min="1" class="form-control" name="id_sede">
					<option value={{ personal.id_sede}} required > {{ personal.id_sede}} - <?php if(isset($personal->Sede->nombre_sede)){echo $personal->Sede->nombre_sede;} else { echo "¡ERROR!";} ?></option>
					{% for sede in sedes %}
					<option  value={{ sede.id_sede }} > {{ sede.id_sede }} - {{ sede.Sede.nombre_sede }} </option>
					{% endfor %}
					</select>
				</div>
				</div>

				<div class="form-group col-sm-6">
				<div class="input-group">
				<div class="input-group-addon">Porcentaje de dedicación</div>
				<input data-parsley-range="[0, 1]" data-parsley-type="number" class="form-control" type="text"  name="porcentaje_dedicacion" value={{  personal.porcentaje_dedicacion }} placeholder="En forma decimal y usando el punto. Ejemplo: 0.15)">
				</div>
				</div>
			</div>
			<?php $readonly = 'readonly'; ?>
			{% if(id_componente == 4) %}
					<?php $readonly = ''; ?>
			{% endif %}
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">EPS</div>
				<input data-parsley-required class="form-control" type="text" name="EPS" value={{ personal.EPS }} placeholder="Ingrese el nombre de la EPS" <?=$readonly?>>
				</div>
				</div>

				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">ARL</div>
				<input data-parsley-required class="form-control" type="text" name="ARL" value={{ personal.ARL }} placeholder="Ingrese el nombre de la ARL" <?=$readonly?>>
				</div>
				</div>

				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">UDS</div>
				<input data-parsley-required class="form-control" type="text" name="UDS" value={{ personal.UDS }} placeholder="Ingrese el nombre de la UDS">
				</div>
				</div>
			</div>

			<div class="form-group col-sm-12">
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Fecha de Ingreso</div>
				<input data-parsley-required class="form-control" type="date" value={{personal.fecha_ingreso}} name="fecha_ingreso" <?=$readonly?>>
				</div>
				</div>
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Afiliación SS</div>
				<input data-parsley-required class="form-control" type="date" value={{personal.fecha_afiliacion_ss}} name="fecha_afiliacion_ss" <?=$readonly?>>
				</div>
				</div>
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Terminación Contrato</div>
				<input data-parsley-required class="form-control" type="date" value={{personal.fecha_terminacion_contrato}} name="fecha_terminacion_contrato" <?=$readonly?>>
				</div>
				</div>
			</div>


			<div class="form-group col-sm-12">
				<div class="form-group col-sm-6">
				<div class="input-group">
				<div class="input-group-addon">Fecha Retiro</div>
				<input class="form-control" type="date" name="fecha_retiro" value={{ personal.fecha_retiro }}>
				</div>
				</div>

				<div class="form-group col-sm-6">
				<div class="input-group">
				<div class="input-group-addon">Observaciones</div>
				<input class="form-control" type="text" name="observaciones" placeholder="Ingrese las observaciones" value='{{ personal.observaciones}}' >
				</div>
				</div>
			</div>

			<div class="form-group col-sm-12">
			</div>

			<button  class="btn btn-info btn-lg col-sm-3" type="submit" id="submit" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Actualizar Registro</button>
			<br>
			<br>
</form>




</div>
<br>
<br>
<div class="container">
