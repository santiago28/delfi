<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class Concepto extends \Phalcon\Mvc\Model
{
	public $id_concepto;
	public $nombre_concepto;
	public $id_categoria;
	public $estado;

public function initialize()
    {
		$this->belongsTo("id_categoria", "Categoria", "id_categoria");
		
	}	
	
	
	
}
