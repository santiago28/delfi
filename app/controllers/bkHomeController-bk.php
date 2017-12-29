<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Mvc\Model\Query;

class HomeController extends ControllerBase
{

	public function initialize()
    {
    	$this->tag->setTitle("Home"); //Titulo de la pagina
		$this->sesauth = $this->session->get('auth'); //Valores de la sesion auth
		if(!$this->sesauth['username']){
			$this->flash->error('¡No se ha iniciado Sesión!');
			return $this->response->redirect('');
		}
        parent::initialize();
    }



    public function indexhomeAction()
    {

		$id_group= $this->sesauth['id_group'];
		$id_prestador = $this->sesauth['id_prestador'];
		$username = $this->sesauth['username'];

		//Query para hallar la informacion de contratos por prestador
		$contratos = InformacionContrato::find(
											array("
											id_prestador='$id_prestador' AND
											estado=		'1'
											")
										);
		if (count($contratos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$contratos = null;
		}


		//Query para llevar el nombre del prestador
		$query_nombre_prestador = Prestador::findFirst($id_prestador);
    	$nombre_prestador=$query_nombre_prestador->nombre_prestador;

		//Query para mostrar los contratos bloqueados por mes (solo para los interventores)
		$bloqueados = BloquearPeriodo::find();
		if (count($bloqueados) == 0) {
    		//$this->flash->error("Mensaje de Error");
    		$bloqueados = null;
    	}

		//Columna Contratos Distintos
		$contratos_arr = ContratoXSede::find( array( " id_modalidad IN (1,6,8,11,12) ", "group"=>"id_contrato" , "order" => "id_contrato" ) );
		if (count($contratos_arr) == 0) {
    		//$this->flash->error("Mensaje de Error");
    		$contratos_arr = null;
    	}

		$dist_contratos= array();
		$dist_contratos_modalidad= array();
		$dist_contratos_prestador= array();

		foreach($contratos_arr as $x){
			$dist_contratos[]=$x->id_contrato;
			$dist_contratos_modalidad[]=$x->Modalidad->abr_modalidad;
			$dist_contratos_prestador[]=$x->Prestador->nombre_prestador;
		}


		$bloq_cont_mes = array();
		for ($j=0; $j < count($dist_contratos);$j++){
		$bloq_cont_mes[$j][] = "$dist_contratos[$j]"." - "."$dist_contratos_modalidad[$j]"." : "."$dist_contratos_prestador[$j]";
			for ($i=1; $i <= 12 ;$i++){
				$consulta= BloquearPeriodo::find(array( "id_contrato='$dist_contratos[$j]' AND id_mes='$i'")); //, " group " => " id_contrato"

				if (count($consulta) == 0) {
					$bloq_cont_mes[$j][] = "";
				}else{
						$componentesNuevo="";
					foreach($consulta as $x){
						$componentesNuevo .= ", ".$x->nombre_componente_bloqueado;
					}
					$bloq_cont_mes[$j][] = count($consulta);//$bloqueados->nombre_componente_bloqueado;//count($consulta);
						//$bloq_cont_mes[$j][] = $componentesNuevo;
				}
			}

		}


		//Query para mostrar los ajustes por mes (solo para los interventores)
		$ajustes = MatrizAjuste::find();
		if (count($ajustes) == 0) {
    		//$this->flash->error("Mensaje de Error");
    		$ajustes = null;
    	}

		//Query para el select de los contratos
		if($id_group==1){	//Administradores
			$listacontratos = ContratoXSede::find(	array(	" id_modalidad IN (1,6,8,11,12) AND estado= '1' ",	"group"=> "id_contrato" ));
			if (count($listacontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$listacontratos = null;
			}
		} else{		//Interventores
			$listacontratos = ContratoXInterventor::find(	array(	"id_interventor='$username' AND estado= '1' " ));
			if (count($listacontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$listacontratos = null;
			}
		}

		//Query para el select de los años
		$anos = Ano::find(	array(	"estado= '1' " ));
		if (count($anos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$anos = null;
		}

		//Query para el select de los meses
		$meses = Mes::find(	array(	"estado= '1' AND bloqueo_total='1' " ));
		if (count($meses) == 0) {
			//$this->flash->error("Mensaje de Error");
			$meses = null;
		}

		//Query para el select de los conceptos
		$conceptos = Concepto::find(	array(	"id_categoria='7' AND estado= '1' " ));
		if (count($conceptos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$conceptos = null;
		}


		$this->view->anos = $anos;
		$this->view->meses = $meses;
		$this->view->conceptos = $conceptos;
		$this->view->contratos = $contratos;
		$this->view->nombre_prestador = $nombre_prestador;
		$this->view->bloqueados = $bloqueados;
		$this->view->dist_contratos = $dist_contratos;
		$this->view->bloq_cont_mes = $bloq_cont_mes;
		$this->view->ajustes = $ajustes;
		$this->view->listacontratos = $listacontratos;
		$this->view->id_group = $id_group;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');

    }

	    public function indexdetallebloqueoAction($variable)
    {

		$id_contrato=substr($variable,0,10);

		//Query para ver la tabla de bloqueados
		$bloqueados = BloquearPeriodo::find(array(	"id_contrato = '$id_contrato'  "));
		if (count($bloqueados) == 0) {
			//$this->flash->error("Mensaje de Error");
			$bloqueados = null;
		}


		$this->view->bloqueados = $bloqueados;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');

    }





	/* INSERTAR */
	public function insbloqueoAction()
    {

		//Variables
		$db = $this->getDI()->getDb(); 	//Llamar la conexion a la BD
		$id_contrato = $this->request->getPost("id_contrato");
    	$id_ano = $this->request->getPost("id_ano");
		$id_mes = $this->request->getPost("id_mes");
		$nombre_componente_bloqueado = $this->request->getPost("nombre_componente_bloqueado");
		$query1 = ContratoXSede::findFirst("id_contrato = '$id_contrato'" );
		$id_prestador = $query1->id_prestador;
		$id_modalidad = $query1->id_modalidad;
		$usuario = $this->sesauth['username'];
		$fecha_bloqueo = date("Y-m-d H:i:s");


		//Convertir todos los datos en un array
		$elementos = array(
			'nombre_componente_bloqueado' => $nombre_componente_bloqueado,
			'id_contrato' => $id_contrato,
			'id_prestador' => $id_prestador,
			'id_modalidad' => $id_modalidad,
			'id_ano' => $id_ano,
			'id_mes' => $id_mes,
			'fecha_bloqueo' => $fecha_bloqueo,
			'usuario' => $usuario
	    );


		// Insertar usando modelo de la carpeta Library
		$sql = $this->conversiones->multipleinsert("bloquear_periodo", $elementos);
		$query = $db->query($sql);

		// Actualizar matriz
		for ($i=0; $i < count($nombre_componente_bloqueado);$i++){
			switch ($nombre_componente_bloqueado[$i]) {

				case "RECURSO":
				//Actualizar matriz con estado 0
				$db->query("UPDATE matriz_ejecucion_rh SET estado='0' WHERE id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' ");
				break;

				case "COSTOS":
				//Actualizar matriz con estado 0
				$db->query("UPDATE matriz_ejecucion_financiera SET estado='0' WHERE id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='6' ");
				break;

				case "CANASTA":
				//Actualizar matriz con estado 0
				$db->query("UPDATE matriz_ejecucion_financiera SET estado='0' WHERE id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria IN (2,3,4,5) ");
				break;

				case "SOPORTES":
				//Actualizar matriz con estado 0
				$db->query("UPDATE archivo_soporte SET estado='0' WHERE id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' ");
				break;

			}
		}

		$this->flash->success("¡Periodo Bloqueado Exitosamente!");
    	return $this->response->redirect("home/indexhome");

    }


	public function insajusteAction()
    {

		$id_contrato = $this->request->getPost("id_contrato");
    	$id_ano = $this->request->getPost("id_ano");
		$id_mes = $this->request->getPost("id_mes");
		$id_concepto = $this->request->getPost("id_concepto");
		$valor_ajuste = $this->request->getPost("valor_ajuste");
		$observaciones = $this->request->getPost("observaciones");

		$query1 = ContratoXSede::findFirst("id_contrato = '$id_contrato'" );
		$id_prestador = $query1->id_prestador;
		$id_modalidad = $query1->id_modalidad;

		//Variables a insertar en MatrizAjuste
    	$var = new MatrizAjuste();
    	$var->id_contrato = $id_contrato;
		$var->id_prestador = $id_prestador;
		$var->id_modalidad = $id_modalidad;
    	$var->id_ano = $id_ano;
		$var->id_mes = $id_mes;
		$var->id_categoria =7;
		$var->id_concepto =$id_concepto;
		$var->fecha_ajuste =date("Y-m-d H:i:s");
		$var->valor_ajuste = $valor_ajuste;
		$var->observaciones = $observaciones;
		$var->usuario = $this->sesauth['username'];
		$var->estado = 1;


		//Insertar usando modelo
    	if (!$var->save()) {
    		foreach ($var->getMessages() as $message) {
    			$this->flash->error($message);
    		}
    		return $this->response->redirect("home/indexhome");
    	}


		$this->flash->success("¡Ajuste ingresado Exitosamente!");
    	return $this->response->redirect("home/indexhome");

    }


	/* ELIMINAR */
	public function delbloqueoAction()
    {
		//Variables
		$db = $this->getDI()->getDb(); 	//Llamar la conexion a la BD
		$id_contrato = $this->request->getPost("id_contrato");
    	$id_ano = $this->request->getPost("id_ano");
		$id_mes = $this->request->getPost("id_mes");
		$nombre_componente_bloqueado = $this->request->getPost("nombre_componente_bloqueado");


		// Realizar ciclo por cada elemento de nombre_componente_bloqueado
		for ($i=0; $i < count($nombre_componente_bloqueado);$i++){

			switch ($nombre_componente_bloqueado[$i]) {

				case "RECURSO":
				//Eliminar Bloqueo de la tabla BloquearPeriodo
				$deletebloqueo = BloquearPeriodo::find("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND nombre_componente_bloqueado='$nombre_componente_bloqueado[$i]' ");
				$deletebloqueo->delete();
				//Actualizar matriz con estado 1
				$db->query("UPDATE matriz_ejecucion_rh SET estado='1' WHERE id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' ");
				break;

				case "COSTOS":
				//Eliminar Bloqueo de la tabla BloquearPeriodo
				$deletebloqueo = BloquearPeriodo::find("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND nombre_componente_bloqueado='$nombre_componente_bloqueado[$i]' ");
				$deletebloqueo->delete();
				//Actualizar matriz con estado 1
				$db->query("UPDATE matriz_ejecucion_financiera SET estado='1' WHERE id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='6' ");
				break;

				case "CANASTA":
				//Eliminar Bloqueo de la tabla BloquearPeriodo
				$deletebloqueo = BloquearPeriodo::find("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND nombre_componente_bloqueado='$nombre_componente_bloqueado[$i]' ");
				$deletebloqueo->delete();
				//Actualizar matriz con estado 1
				$db->query("UPDATE matriz_ejecucion_financiera SET estado='1' WHERE id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria IN (2,3,4,5) ");
				break;

				case "SOPORTES":
				//Eliminar Bloqueo de la tabla BloquearPeriodo
				$deletebloqueo = BloquearPeriodo::find("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND nombre_componente_bloqueado='$nombre_componente_bloqueado[$i]' ");
				$deletebloqueo->delete();
				//Actualizar matriz con estado 1
				$db->query("UPDATE archivo_soporte SET estado='1' WHERE id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' ");
				break;

			}

		}

		$this->flash->success("¡Periodo Desbloqueado Exitosamente!");
		return $this->response->redirect("home/indexhome");

	}

	public function delajusteAction()
    {

		$id = $this->request->getPost("id");
		$id_contrato = $this->request->getPost("id_contrato");
    	$id_ano = $this->request->getPost("id_ano");
		$id_mes = $this->request->getPost("id_mes");


		//Eliminar Ajuste
		$deleteajuste = MatrizAjuste::find("id='$id' AND id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' ");
    	if (!$deleteajuste) {
    		$this->flash->error("Error: No se pudo eliminar el registro. Consulte con el administrador del sistema");
    		return $this->response->redirect("home/indexhome");
    	}

    	if (!$deleteajuste->delete()) {
            foreach ($deleteajuste->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->response->redirect("home/indexhome");
        }



		$this->flash->success("¡Revise nuevamente el codigo del ajuste, si no fue borrado es porque los datos seleccionados no coincidían!");
    	return $this->response->redirect("home/indexhome");

    }



}
