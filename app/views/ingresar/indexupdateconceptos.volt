
{{ content() }}


<div class="bs-docs-section">
		<h1 id="tables-example">Actualizar Registro</h1>
		<hr> <!-- Footer -->
</div>

<p class="alert alert-info" role="alert" >Actualice el registro y de clic en Guardar</p>

<br>

{{ form("ingresar/updconceptos", "method":"post", "class":"form-signin", "data-parsley-validate" : "") }}

			<input type="hidden" name="id" value={{ id }} >
			<input type="hidden" name="id_prestador" value={{id_prestador}}>
			<input type="hidden" name="id_modalidad" value={{id_modalidad}}>
			<input type="hidden" name="usuario" value={{usuario}}>
			<input type="hidden" name="estado" value={{estado}}>
						
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Contrato</div>
				<input data-parsley-required class="form-control" type="text" name="id_contrato" value={{id_contrato}} placeholder="Contrato" readonly>
				</div>
				</div>
				
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Año</div>
				<input data-parsley-required class="form-control" type="text" name="id_ano" value={{id_ano}} placeholder="Año" readonly>
				</div>
				</div>
				
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Mes</div>
				<input data-parsley-required class="form-control" type="text" name="id_mes" value={{id_mes}} placeholder="Mes" readonly>
				</div>
				</div>
			</div>
			
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Código Categoría</div>
					<select data-parsley-min="1" class="form-control" name="id_categoria">
					<option value={{id_categoria}} required>{{id_categoria}}</option>
					{% for categoria in categorias %}
					<option  value={{ categoria.id_categoria }}>{{ categoria.id_categoria }} - {{ categoria.nombre_categoria }}</option>
					{% endfor %}
					</select>
				</div>
				</div>
				
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Código Concepto</div>
					<select data-parsley-min="1" class="form-control" name="id_concepto">
					<option value={{id_concepto}} required>{{id_concepto}}</option>
					{% for concepto in conceptos %}
					<option  value={{ concepto.id_concepto }}>{{ concepto.id_concepto }} - {{ concepto.nombre_concepto }}</option>
					{% endfor %}
					</select>
				</div>
				</div>
				
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Código Sede</div>
					<select data-parsley-min="1" class="form-control" name="id_sede">
					<option value={{id_sede}} required>{{id_sede}}</option>
					{% for sede in sedes %}
					<option  value={{ sede.id_sede }}>{{ sede.id_sede }} - {{ sede.Sede.nombre_sede }}</option>
					{% endfor %}
					</select>
				</div>
				</div>
			</div>
			
			
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Valor</div>
				<input data-parsley-required class="form-control" type="number" name="valor" value={{valor}} placeholder="Ingrese el valor sin puntos, comas o espacios">
				</div>
				</div>
				
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Número Documento</div>
				<input class="form-control" type="text" name="numero_documento" value={{numero_documento}} placeholder="Ingrese el numero de documento">
				</div>
				</div>
				
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Fecha Documento</div>
				<input data-parsley-required class="form-control" type="date" name="fecha_documento" value={{fecha_documento}} placeholder="Ingrese la fecha del documento">
				</div>
				</div>
			</div>
			
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-12">
				<div class="input-group">
				<div class="input-group-addon">Descripción Documento</div>
				<input class="form-control" type="text" name="descripcion_documento" value={{descripcion_documento}} placeholder="Ingrese una descripción del documento">
				</div>
				</div>
			</div>
			
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-4">
				<div class="input-group">
				<div class="input-group-addon">Cantidad</div>
				<input class="form-control" type="number" name="cantidad" value={{cantidad}} placeholder="Ingrese la cantidad">
				</div>
				</div>
				
				<div class="form-group col-sm-8">
				<div class="input-group">
				<div class="input-group-addon">Nombre Proveedor</div>
				<input class="form-control" type="text" name="nombre_proveedor" value={{nombre_proveedor}} placeholder="Ingrese el nombre del Proveedor">
				</div>
				</div>
			</div>
			
			<div class="form-group col-sm-12">
				<div class="form-group col-sm-12">
				<div class="input-group">
				<div class="input-group-addon">Observaciones</div>
				<input class="form-control" type="text" name="observaciones" value={{observaciones}} placeholder="Ingrese las observaciones">
				</div>
				</div>
			</div>
			
			<button  class="btn btn-info btn-lg col-sm-3" type="submit" id="submit" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Actualizar Registro</button>
			<br>
			<br>
</form>

	
		

</div>
<br>
<br>
<div class="container">		