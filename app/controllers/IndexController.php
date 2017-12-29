<?php

use Phalcon\Mvc\Model\Criteria;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle("Login"); //Titulo de la pagina
		parent::initialize();
    }

    public function indexAction()
    {
		
    }

	
	public function loginAction()
    {
    	if ($this->request->isPost()) {
			//Variables traidas via Post
    		$username = $this->request->getPost('username');
    		$passincodificar = $this->request->getPost('passincodificar');
			$password=md5(htmlspecialchars($passincodificar));
    		
			//Consulta a la BD
    		$queryuser = Users::findFirst(
								array("
								username=	'$username' AND 
								password = 	'$password' AND
								active=		'1'
								"));
				
    		if ($queryuser) {
    			//Redirecciona a la siguiente vista cuando user y pwd son correctos
				$nombre_usuario=$queryuser->first_name;
				$username=$queryuser->username;
				$id_componente=$queryuser->id_componente;
				$id_prestador=$queryuser->id_prestador;
				$id_group=$queryuser->id_group;
				
				$this->_registerSession( $nombre_usuario, $username, $id_componente, $id_prestador, $id_group );
				$this->flash->success('¡Bienvenido ' . $nombre_usuario.'!');
    			return $this->response->redirect('home/indexhome');
    		}
				//Retorna cuando el usuario y pwd son incorrectos
				$this->flash->error('Usuario y/o Contraseña incorrectos');
        }
        //Retorna cuando la variable no procede de un Post
		return $this->response->redirect('');
    }
	
	
    private function _registerSession($nombre_usuario, $username, $id_componente, $id_prestador, $id_group)
    {
    		$this->session->set('auth', array(
    				'nombre_usuario' => $nombre_usuario,
    				'username' => $username,
    				'id_componente' => $id_componente,
					'id_prestador' => $id_prestador,
    				'id_group' => $id_group
					));
    	
    } 
	 
	 
	 public function logoutAction()
    {
        $this->session->remove('auth');
        $this->flash->success('¡Sesión finalizada con éxito!');
        return $this->response->redirect('');
    }


	
	
}
