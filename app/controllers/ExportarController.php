<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Mvc\Model\Query;

class ExportarController extends ControllerBase
{
    
	public function initialize() 
    {
    	$this->tag->setTitle("Exportar"); //Titulo de la pagina
		$this->sesauth = $this->session->get('auth'); //Valores de la sesion auth
		if(!$this->sesauth['username']){
			$this->flash->error('¡No se ha iniciado Sesión!');
			return $this->response->redirect('');
		}
        parent::initialize();
    }

    
	
    public function indexexportarAction()
    {
		
		$id_group = $this->sesauth['id_group'];
		
		if($id_group==20){
			$id_prestador = $this->sesauth['id_prestador'];
			$querycontratos = ContratoXSede::find(
												array(
												"id_prestador='$id_prestador' AND estado= '1' ",
												"group"=> "id_contrato",
												)
											); 	
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}
		
		}else{
			$querycontratos = ContratoXSede::find(
												array(
												"id_modalidad IN (1,5,6,7,8,11,12,13) AND estado= '1' ",
												"group"=> "id_contrato",
												)
											); 	
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}
			
		}
		
		//Variable retorno GET
		$id_contrato= $this->request->getPost("id_contrato");
		
		$queryrh = MatrizEjecucionRh::find(	array("id_contrato='$id_contrato'",	"order"=> "id_contrato, id_ano, id_mes "	)); 	
    	if (count($queryrh) == 0) {
    		//$this->flash->error("Mensaje de Error");
    		$queryrh = null;
    	}
		
		$queryco = MatrizEjecucionFinanciera::find(	array("id_contrato='$id_contrato'",	"order"=> "id_contrato, id_ano, id_mes "	)); 	
    	if (count($queryco) == 0) {
    		//$this->flash->error("Mensaje de Error");
    		$queryco = null;
    	}
		
		$querypc = PersonalContratado::find(	array("id_contrato='$id_contrato'",	"order"=> "id_contrato "	)); 	
    	if (count($querypc) == 0) {
    		//$this->flash->error("Mensaje de Error");
    		$querypc = null;
    	}
		
		
		$this->view->id_contrato = $id_contrato;
		$this->view->queryrh = $queryrh;
		$this->view->queryco = $queryco;
		$this->view->querypc = $querypc;
		$this->view->querycontratos = $querycontratos;
		$this->assets
        ->addJs('js/filtros-tablesorter.min.js');

    }
    

	public function downloadrecursohumanoAction()
    {
		
		
		//Variable retorno GET
		$id_contrato= $this->request->getPost("id_contrato");
		
		$queryrh = MatrizEjecucionRh::find(	array("id_contrato='$id_contrato'",	"order"=> "id_contrato, id_ano, id_mes "	)); 	
    	if (count($queryrh) == 0) {
    		//$this->flash->error("Mensaje de Error");
    		$queryrh = null;
    	}
		$this->view->queryrh = $queryrh;
		$this->view->setTemplateAfter('../exportar/downloadrecursohumano');

    }
	

public function downloadconceptosAction()
    {
		
		
		//Variable retorno GET
		$id_contrato= $this->request->getPost("id_contrato");
		
	
		$queryco = MatrizEjecucionFinanciera::find(	array("id_contrato='$id_contrato'",	"order"=> "id_contrato, id_ano, id_mes "	)); 	
    	if (count($queryco) == 0) {
    		//$this->flash->error("Mensaje de Error");
    		$queryco = null;
    	}
		
		$this->view->queryco = $queryco;
		$this->view->setTemplateAfter('../exportar/downloadconceptos');

    }	
	
public function downloadpersonalAction()
    {
		
		
		//Variable retorno GET
		$id_contrato= $this->request->getPost("id_contrato");
		
	
		$querypc = PersonalContratado::find(	array("id_contrato='$id_contrato'",	"order"=> "id_contrato "	)); 	
    	if (count($querypc) == 0) {
    		//$this->flash->error("Mensaje de Error");
    		$querypc = null;
    	}
		
		$this->view->querypc = $querypc;
		$this->view->setTemplateAfter('../exportar/downloadpersonal');

    }		
	
	
}
