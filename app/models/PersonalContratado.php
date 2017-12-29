<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class PersonalContratado extends \Phalcon\Mvc\Model
{
		public $id;
		public $id_contrato;
		public $id_prestador;
		public $id_modalidad;
		public $cedula;
		public $primer_nombre;
		public $segundo_nombre;
		public $primer_apellido;
		public $segundo_apellido;
		public $sexo;
		public $numero_telefono;
		public $numero_celular;
		public $email;
		public $formacion_academica;
		public $nombre_institucion;
		public $id_cargo;
		public $id_sede;
		public $codigo_tipo_contrato;
		public $base_salario_honorarios;
		public $porcentaje_dedicacion;
		public $fecha_ingreso;
		public $fecha_afiliacion_ss;
		public $fecha_terminacion_contrato;
		public $fecha_retiro;
		public $observaciones;
		public $usuario;
		public $estado;

	
	public function initialize()
    {
    	$this->belongsTo("id_prestador", "Prestador", "id_prestador");
		$this->belongsTo("id_modalidad", "Modalidad", "id_modalidad");
		$this->belongsTo("id_cargo", "Cargo", "id_cargo");
		$this->belongsTo("id_sede", "Sede", "id_sede");
	}
}
