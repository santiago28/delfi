<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class Users extends \Phalcon\Mvc\Model
{
	public $id;
	public $first_name;
	public $last_name;
	public $username;
	public $password;
	public $email;
	public $phone;
	public $id_componente;
	public $id_prestador;
	public $id_group;
	public $created_on;
	public $active;
	
	public function initialize()
    {
    	$this->belongsTo("id_prestador", "Prestador", "id_prestador");
	}
}
