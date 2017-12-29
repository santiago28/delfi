<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class Mes extends \Phalcon\Mvc\Model
{
	public $id_mes;
	public $nombre_mes;
	public $bloqueo_total;
	public $estado;
	
public function initialize()
    {
    	$this->hasMany("id_mes", "MatrizEjecucionFinanciera", "id_mes");
		
	}
	
}
