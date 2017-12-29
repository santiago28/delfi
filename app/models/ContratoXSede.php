<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class ContratoXSede extends \Phalcon\Mvc\Model
{
	public $id_contratoxsede;
	public $id_contrato;
	public $id_prestador;
	public $id_modalidad;
	public $id_sede;
	public $estado;
	
	public function initialize()
    {
		$this->belongsTo("id_prestador", "Prestador", "id_prestador");
		$this->belongsTo("id_modalidad", "Modalidad", "id_modalidad");
		$this->belongsTo("id_sede", "Sede", "id_sede");

	}
	
	
}
