<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class Cargo extends \Phalcon\Mvc\Model
{
	public $id_cargo;
	public $nombre_cargo;
	public $codigo_tipo_contrato;
	public $base_salario_honorarios;
	public $estado;
	
	public function initialize()
    {
    	$this->hasMany("id_cargo", "MatrizEjecucionRh", "id_cargo");
	}
}
