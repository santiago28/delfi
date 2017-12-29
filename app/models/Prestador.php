<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class Prestador extends \Phalcon\Mvc\Model
{
	public $id_prestador;
	public $nombre_prestador;
	public $estado;
	
	public function initialize()
    {
    	$this->hasMany("id_prestador", "InformacionContrato", "id_prestador");
		$this->hasMany("id_prestador", "ContratoXSede", "id_prestador");
		$this->hasMany("id_prestador", "Users", "id_prestador");
		$this->hasMany("id_prestador", "MatrizEjecucionFinanciera", "id_prestador");
		$this->hasMany("id_prestador", "MatrizEjecucionRh", "id_prestador");
		$this->hasMany("id_prestador", "MatrizAjuste", "id_prestador");
		$this->hasMany("id_prestador", "BloquearPeriodo", "id_prestador");
	}
}
