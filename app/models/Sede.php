<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class Sede extends \Phalcon\Mvc\Model
{
	public $id_sede;
	public $nombre_sede;
	public $barrio_sede;
	public $direccion_sede;
	public $telefono_sede;
	public $estado;
	public $id_uds;

	public function initialize()
    {
    	$this->hasMany("id_sede", "ContratoXSede", "id_sede");
	}


}
