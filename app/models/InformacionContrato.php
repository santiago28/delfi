<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class InformacionContrato extends \Phalcon\Mvc\Model
{
	public $id_contrato;
	public $id_prestador;
	public $id_modalidad;
	public $valor_contrato;
	public $cantidad_cupos;
	public $fecha_inicio_contrato;
	public $fecha_terminacion_contrato;
	public $estado;
	
	public function initialize()
    {
    	$this->belongsTo("id_modalidad", "Modalidad", "id_modalidad");
		$this->belongsTo("id_prestador", "Prestador", "id_prestador");
	}
	
	
}
