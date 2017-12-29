<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class Categoria extends \Phalcon\Mvc\Model
{
	public $id_categoria;
	public $nombre_categoria;
	public $estado;

	
public function initialize()
    {
    	$this->hasMany("id_categoria", "Concepto", "id_categoria");
	}	
	
	
	
}
