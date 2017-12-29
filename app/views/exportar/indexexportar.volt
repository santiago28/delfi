
<div class="bs-docs-section">
		<h1 id="tables-example">Exportar información a Excel</h1>
		<hr> <!-- Footer -->
</div>

 <h5>Seleccione el contrato para verificar los registros insertados...</h5>


		{{ form("exportar/indexexportar", "method":"post", "class":"form-signin", "id":"formulario", "name":"formulario", "data-parsley-validate" : "") }}

			<select data-parsley-min="1" class="form-control input-lg" name="id_contrato" id="select1" onchange=$('#formulario').submit()>
				<option id="option1_js" value="0" required>Seleccione el Contrato...</option>
				{% for contrato in querycontratos %}
				<option  value={{ contrato.id_contrato }}>{{ contrato.id_contrato }}: {{ contrato.Modalidad.nombre_modalidad }} - {{ contrato.Prestador.nombre_prestador }}</option>
				 {% endfor %}
			</select>

		</form>

<br>


{% if (not(queryrh is empty)) %}
{{ form("exportar/downloadrecursohumano", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
<p class="alert alert-success" role="alert" >¡Recurso Humano generado correctamente! Descargue dando clic en el siguiente botón:
<input type="hidden" name="id_contrato" value={{ id_contrato }}>
<button  class="btn btn-default btn" type="submit" id="submit" ><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></button>
</form>
</p>
{% endif %}



{% if (not(querypc is empty)) %}
{{ form("exportar/downloadpersonal", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
<p class="alert alert-info" role="alert" >¡Personal Contratado generado correctamente! Descargue dando clic en el siguiente botón:
<input type="hidden" name="id_contrato" value={{ id_contrato }}>
<button  class="btn btn-default btn" type="submit" id="submit" ><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></button>
</form>
</p>
{% endif %}


{% if (not(queryco is empty)) %}
{{ form("exportar/downloadconceptos", "method":"post", "class":"form-signin", "name":"formulario", "data-parsley-validate" : "") }}
<p class="alert alert-warning" role="alert" >¡Conceptos de la canasta generado correctamente! Descargue dando clic en el siguiente botón:
<input type="hidden" name="id_contrato" value={{ id_contrato }}>
<button  class="btn btn-default btn" type="submit" id="submit" ><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span></button>
</form>
</p>
{% endif %}





