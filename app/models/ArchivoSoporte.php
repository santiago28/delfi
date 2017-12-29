<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class ArchivoSoporte extends \Phalcon\Mvc\Model
{
	public $id_archivo_soporte;
	public $id_contrato;
	public $id_prestador;
	public $id_ano;
	public $id_mes;
	public $nombre_archivo;
	public $fecha_modificacion;
	public $usuario;
	public $estado;
	

public function initialize()
    {
		$this->belongsTo("id_prestador", "Prestador", "id_prestador");
			
	}	


	
	
	
	
}
