<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class MatrizEjecucionRh extends \Phalcon\Mvc\Model
{
	public $id;
	public $id_contrato;
	public $id_prestador;
	public $id_modalidad;
	public $id_ano;
	public $id_mes;
	public $id_categoria;
	public $id_concepto;
	public $cedula;
	public $id_cargo;
	public $codigo_novedad;
	public $fecha_novedad;
	public $codigo_tipo_contrato;
	public $porcentaje_dedicacion;
	public $base_salario_honorarios;
	public $dias_laborados;
	public $valor_salario_honorarios;
	public $valor_auxilio_transporte;
	public $valor_bruto;
	public $valor_deduccion_ss;
	public $valor_otras_deducciones;
	public $valor_asumidos_prestador;
	public $valor_neto;
	public $valor_dotacion;
	public $valor_examen_medico;
	public $tipo_riesgo_arl;
	public $valor_seguridad_social;
	public $valor_prov_cesantias;
	public $valor_prov_intereses_cesantias;
	public $valor_prov_prima;
	public $valor_prov_vacaciones;
	public $valor_total_provisiones;
	public $valor_total_ejecutado;
	public $observaciones;
	public $indice_relacion_tecnica;
	public $usuario;
	public $estado;

	public function initialize()
    {
		$this->belongsTo("id_prestador", "Prestador", "id_prestador");
		$this->belongsTo("id_modalidad", "Modalidad", "id_modalidad");
		$this->belongsTo("id_categoria", "Categoria", "id_categoria");
		$this->belongsTo("id_concepto", "Concepto", "id_concepto");
		$this->belongsTo("id_cargo", "Cargo", "id_cargo");
		$this->belongsTo("cedula", "PersonalContratado", "cedula");
		
	}
	
	
}
