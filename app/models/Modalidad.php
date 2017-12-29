<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class Modalidad extends \Phalcon\Mvc\Model
{
	public $id_modalidad;
	public $abr_modalidad;
	public $nombre_modalidad;
	public $estado;
	
	public function initialize()
    {
    	$this->hasMany("id_modalidad", "InformacionContrato", "id_modalidad");
		$this->hasMany("id_modalidad", "ContratoXSede", "id_modalidad");
		$this->hasMany("id_modalidad", "MatrizEjecucionFinanciera", "id_modalidad");
		$this->hasMany("id_modalidad", "MatrizEjecucionRh", "id_modalidad");
		$this->hasMany("id_modalidad", "MatrizAjuste", "id_modalidad");
		$this->hasMany("id_modalidad", "BloquearPeriodo", "id_modalidad");
		
	}
}
