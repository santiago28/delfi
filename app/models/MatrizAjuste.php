<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class MatrizAjuste extends \Phalcon\Mvc\Model
{
	public $id;
	public $id_contrato;
	public $id_prestador;
	public $id_modalidad;
	public $id_ano;
	public $id_mes;
	public $id_categoria;
	public $id_concepto;
	public $fecha_ajuste;
	public $valor_ajuste;
	public $observaciones;
	public $usuario;
	public $estado;
	

	

	public function initialize()
    {
		$this->belongsTo("id_prestador", "Prestador", "id_prestador");
		$this->belongsTo("id_modalidad", "Modalidad", "id_modalidad");
		$this->belongsTo("id_categoria", "Categoria", "id_categoria");
		$this->belongsTo("id_concepto", "Concepto", "id_concepto");
		
	}
	
	
}
