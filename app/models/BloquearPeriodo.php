<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class BloquearPeriodo extends \Phalcon\Mvc\Model
{
	public $id;
	public $id_contrato;
	public $id_prestador;
	public $id_modalidad;
	public $id_ano;
	public $id_mes;
	public $nombre_componente_bloqueado;
	public $fecha_bloqueo;
	public $usuario;
	
	public function initialize()
    {
		$this->belongsTo("id_prestador", "Prestador", "id_prestador");
		$this->belongsTo("id_modalidad", "Modalidad", "id_modalidad");
		
	}
	
	
	
}
