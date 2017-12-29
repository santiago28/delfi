<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class ContratoXInterventor extends \Phalcon\Mvc\Model
{
	public $id_contratoxinterventor;
	public $id_contrato;
	public $id_prestador;
	public $id_modalidad;
	public $id_interventor;
	public $estado;
	
	public function initialize()
    {
		$this->belongsTo("id_prestador", "Prestador", "id_prestador");
		$this->belongsTo("id_modalidad", "Modalidad", "id_modalidad");
		$this->belongsTo("id_sede", "Sede", "id_sede");

	}
	
	
}
