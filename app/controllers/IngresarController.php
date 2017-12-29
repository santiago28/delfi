<?php

use Phalcon\Mvc\Model\Criteria;

class IngresarController extends ControllerBase
{

	public function initialize()
	{
		$this->tag->setTitle("Ingresar Información Mensual"); //Titulo de la pagina
		$this->sesauth = $this->session->get('auth'); //Valores de la sesion auth
		if(!$this->sesauth['username']){
			$this->flash->error('¡No se ha iniciado Sesión!');
			return $this->response->redirect('');
		}
		parent::initialize();
	}


	/* INDEX */

	public function indexrecursohumanoAction()
	{

		$id_group = $this->sesauth['id_group'];
		$id_contrato = $this->request->getPost("id_contrato");

		if($id_group==20){
			$id_prestador = $this->sesauth['id_prestador'];
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array( "id_prestador='$id_prestador' AND estado= '1' ", "group"=> "id_contrato" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de la Matriz Ejecución RH
			$rhs = MatrizEjecucionRh::find(  array( "id_prestador='$id_prestador' AND id_contrato='$id_contrato'",	"order"=> "id_contrato,id_ano, id_mes"	));
			if (count($rhs) == 0) {
				//$this->flash->error("Mensaje de Error");
				$rhs = null;
			}
		}else{
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array(	" id_modalidad IN (1,5,6,7,8,11,12,13) AND estado= '1' ",	"group"=> "id_contrato" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de la Matriz Ejecución RH
			$rhs = MatrizEjecucionRh::find(  array( " id_contrato='$id_contrato' ",		"order"=> "id_contrato,id_ano, id_mes"	));
			if (count($rhs) == 0) {
				//$this->flash->error("Mensaje de Error");
				$rhs = null;
			}
		}

		//Query para el select de los años
		$anos = Ano::find(	array(	"estado= '1' " ));
		if (count($anos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$anos = null;
		}

		//Query para el select de los años
		$meses = Mes::find(	array(	"estado= '1' and id_mes != 13" ));
		if (count($meses) == 0) {
			//$this->flash->error("Mensaje de Error");
			$meses = null;
		}


		$this->view->anos = $anos;
		$this->view->meses = $meses;
		$this->view->querycontratos = $querycontratos;
		$this->view->rhs = $rhs;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');
		$this->assets
		->addJs('js/bootstrap-modal.js');

	}




	public function indexcostosAction()
	{

		$id_group = $this->sesauth['id_group'];
		$id_contrato = $this->request->getPost("id_contrato");

		if($id_group==20){
			$id_prestador = $this->sesauth['id_prestador'];
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array( "id_prestador='$id_prestador' AND estado= '1' ", "group"=> "id_contrato" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de la Matriz Ejecución Financiera
			$costos = MatrizEjecucionFinanciera::find(  array( "id_prestador='$id_prestador' AND id_categoria='6' AND id_contrato='$id_contrato' ",	"order"=> "id_contrato,id_ano, id_mes"	));
			if (count($costos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$costos = null;
			}
		}else{
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array(	"id_modalidad IN (1,5,6,8,11,12,13) AND estado= '1' ",	"group"=> "id_contrato" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de la Matriz Ejecución Financiera
			$costos = MatrizEjecucionFinanciera::find(  array( "id_contrato='$id_contrato' AND id_categoria='6' ",	"order"=> "id_contrato,id_ano, id_mes"	));
			if (count($costos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$costos = null;
			}
		}

		//Query para el select de los años
		$anos = Ano::find(	array(	"estado= '1'" ));
		if (count($anos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$anos = null;
		}

		//Query para el select de los años
		$meses = Mes::find(	array(	"estado= '1' and id_mes != 13" ));
		if (count($meses) == 0) {
			//$this->flash->error("Mensaje de Error");
			$meses = null;
		}


		$this->view->anos = $anos;
		$this->view->meses = $meses;
		$this->view->querycontratos = $querycontratos;
		$this->view->costos = $costos;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');


	}

	public function indexconceptosAction()
	{

		$id_group = $this->sesauth['id_group'];
		$id_contrato = $this->request->getPost("id_contrato");

		if($id_group==20){
			$id_prestador = $this->sesauth['id_prestador'];
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array( "id_prestador='$id_prestador' AND estado= '1' ", "group"=> "id_contrato" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de la Matriz Ejecución Financiera
			$costos = MatrizEjecucionFinanciera::find(  array( "id_prestador='$id_prestador' AND id_categoria IN (2,3,4,5) AND id_contrato='$id_contrato' ",	"order"=> "id_contrato,id_ano, id_mes"	));
			if (count($costos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$costos = null;
			}
		}else{
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array(	" id_modalidad IN (1,5,6,8,11,12,13) AND estado= '1' ",	"group"=> "id_contrato" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de la Matriz Ejecución Financiera
			$costos = MatrizEjecucionFinanciera::find(  array( "id_categoria IN (2,3,4,5) AND id_contrato='$id_contrato' ",	"order"=> "id_contrato,id_ano, id_mes"	));
			if (count($costos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$costos = null;
			}
		}

		//Query para el select de los años
		$anos = Ano::find(	array(	"estado= '1' " ));
		if (count($anos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$anos = null;
		}

		//Query para el select de los años
		$meses = Mes::find(	array(	"estado= '1' and id_mes != 13" ));
		if (count($meses) == 0) {
			//$this->flash->error("Mensaje de Error");
			$meses = null;
		}


		$this->view->anos = $anos;
		$this->view->meses = $meses;
		$this->view->querycontratos = $querycontratos;
		$this->view->costos = $costos;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');
		$this->assets
		->addJs('js/bootstrap-modal.js');

	}

	public function indexsoportesAction()
	{

		$id_group = $this->sesauth['id_group'];
		$id_contrato = $this->request->getPost("id_contrato");

		if($id_group==20){
			$id_prestador = $this->sesauth['id_prestador'];
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array( "id_prestador='$id_prestador' AND estado= '1' ", "group"=> "id_contrato" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de ArchivoSoporte
			$soportes = ArchivoSoporte::find(  array( " id_prestador='$id_prestador' AND id_contrato='$id_contrato' ",	"order"=> "id_contrato,id_ano, id_mes"	));
			if (count($soportes) == 0) {
				//$this->flash->error("Mensaje de Error");
				$soportes = null;
			}

		}else{
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array(	"id_modalidad IN (1,5,6,8,11,12,13) AND estado= '1' ",	"group"=> "id_contrato" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de ArchivoSoporte
			$soportes = ArchivoSoporte::find(  array( " id_contrato='$id_contrato' ", "order"=> "id_contrato,id_ano, id_mes"	));
			if (count($soportes) == 0) {
				//$this->flash->error("Mensaje de Error");
				$soportes = null;
			}

		}


		//Query para el select de los años
		$anos = Ano::find(	array(	"estado= '1' " ));
		if (count($anos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$anos = null;
		}

		//Query para el select de los meses
		$meses = Mes::find(	array(	"estado= '1' " ));
		if (count($meses) == 0) {
			//$this->flash->error("Mensaje de Error");
			$meses = null;
		}

		//Base Path para descargar archivos
		$db = $this->getDI()->getDb();
		$config = $this->getDI()->getConfig();
		$read_soporte = $config->application->baseUri ."public/soportes/";
		$write_soporte = $config->application->basePath ."public/soportes/";
		$read_files = $config->application->baseUri ."public/files/";
		$write_files = $config->application->basePath ."public/files/";




		$this->view->anos = $anos;
		$this->view->meses = $meses;
		$this->view->querycontratos = $querycontratos;
		$this->view->soportes = $soportes;
		$this->view->read_soporte = $read_soporte;
		$this->view->write_soporte = $write_soporte;
		$this->view->read_files = $read_files;
		$this->view->write_files = $write_files;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');
		$this->assets
		->addJs('js/bootstrap-modal.js');

	}



	public function indexupdateconceptosAction($id)
	{

		//Query para ver la tabla de la Matriz Ejecución Financiera
		$costos = MatrizEjecucionFinanciera::findFirst($id);
		$this->view->id = $costos->id;
		$this->view->id_contrato=$costos->id_contrato;
		$this->view->id_prestador=$costos->id_prestador;
		$this->view->id_modalidad=$costos->id_modalidad;
		$this->view->id_ano=$costos->id_ano;
		$this->view->id_mes=$costos->id_mes;
		$this->view->id_categoria=$costos->id_categoria;
		$this->view->id_concepto=$costos->id_concepto;
		$this->view->id_sede=$costos->id_sede;
		$this->view->valor=$costos->valor;
		$this->view->numero_documento=$costos->numero_documento;
		$this->view->fecha_documento=$costos->fecha_documento;
		$this->view->descripcion_documento=$costos->descripcion_documento;
		$this->view->cantidad=$costos->cantidad;
		$this->view->nombre_proveedor=$costos->nombre_proveedor;
		$this->view->observaciones=$costos->observaciones;
		$this->view->usuario = $this->sesauth['username'];
		$this->view->estado=$costos->estado;

		//Query para ver la tabla de la Categorías
		$categorias = Categoria::find(array(	"id_categoria IN (2,3,4,5) AND estado='1'	 "));
		if (count($categorias) == 0) {
			//$this->flash->error("Mensaje de Error");
			$categorias = null;
		}

		//Query para ver la tabla de la Conceptos
		$conceptos = Concepto::find(array(	"id_categoria IN (2,3,4,5)	AND estado='1' "));
		if (count($conceptos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$conceptos = null;
		}


		//Query para ver la tabla de la Conceptos
		$sedes = ContratoXSede::find(array(	"id_contrato = $costos->id_contrato 	AND estado='1' "));
		if (count($sedes) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sedes = null;
		}


		$this->view->categorias = $categorias;
		$this->view->conceptos = $conceptos;
		$this->view->sedes = $sedes;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');

	}


	/* INSERTAR */

	public function insrecursohumanoAction()
	{
		if (!$this->request->isPost()) {
			return $this->response->redirect('');
		}

		//Variables financieras -- Ajustadas al año 2017
		$valor_salario_minimo     = 737717;
		$valor_auxilio_transporte = 83140;
		$porc_ss_empleado         = 0.08; 			//	Salud 4% | Pension 4%
		$porc_ss_empresa          = 0.30022; 		// 	Salud 8,50% | Pension 12% | ARL 0,522% | Caja de Compensacion 4% | ICBF 3% | Sena 2%
		$porc_cesantias           = 0.083333; 	    // 	Cesantias 8,3333%
		$porc_intereses_cesantias = 0.12; 	        //	Interes Mensual 1%
		$porc_prima               = 0.083333;		// 	Prima 8,3333%
		$porc_vacaciones          = 0.0417;			//	Vacaciones 4,17%
		//$valor=1828400;						    //  Ejemplo manual
		//$codigo_tipo_contrato="VL";			    // Ejemplo manual

		//Variables del contrato
		$id_contrato = $this->request->getPost("id_contrato");
		$id_ano = $this->request->getPost("id_ano");
		$id_mes = $this->request->getPost("id_mes");
		$usuario = $this->sesauth['username'];
		$query1 = ContratoXSede::findFirst("id_contrato = '$id_contrato'" );
		$id_prestador = $query1->id_prestador;
		$id_modalidad = $query1->id_modalidad;
		$id_categoria=1;
		$id_concepto=1001;
		$estado =1;


		//Validar si todos los campos fueron diligenciados
		if($id_contrato && 	$id_ano &&	$id_mes ){

			//Validacion para determinar si el periodo esta abierto o cerrado
			$validacion = BloquearPeriodo::findFirst("
			id_contrato = '$id_contrato' AND
			id_ano = '$id_ano' AND
			id_mes = '$id_mes' AND
			nombre_componente_bloqueado = 'RECURSO'
			");
			if($validacion){
				$this->flash->error("¡El periodo está bloqueado!");
				return $this->response->redirect("ingresar/indexrecursohumano");
			}

			//Validar que se haya cargado un archivo
			if($this->request->hasFiles() == true){

				$uploads = $this->request->getUploadedFiles();
				$isUploaded = false;
				$i = 1;

				foreach($uploads as $upload){

					//Variables para cargar el archivo
					$nombre_archivo=$upload->getname();
					$renombrar_archivo= "RH-".$id_contrato."-".$id_ano."-".$id_mes.".csv";
					$extension_archivo=$upload->getextension();
					$tamano_archivo=$upload->getsize();
					$path = "files/".$renombrar_archivo;
					$peso_mb=10;
					$tamano_maximo = $peso_mb*1024*1024;



					//Realizar validacion antes de cargar el archivo
					if($extension_archivo=='csv' && $tamano_archivo<$tamano_maximo ){
						($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
					}
					$i++;

				}

				if($isUploaded){

					$db = $this->getDI()->getDb();
					$config = $this->getDI()->getConfig();
					$timestamp = new DateTime();
					$temporal_table = "temp_" . $timestamp->getTimestamp();
					$archivo_csv = $config->application->basePath ."/public/files/".$renombrar_archivo;

					$file_contents = file_get_contents("$archivo_csv");
					$file_contents = str_replace('"','',$file_contents);
					$file_contents = str_replace(',','.',$file_contents);
					file_put_contents($archivo_csv,$file_contents);

					//Paso 1: Crear tabla temporal
					$db->query("
					CREATE TEMPORARY TABLE $temporal_table
					(
						id_contrato bigint(20) NOT NULL,
						id_mes int(11) NOT NULL,
						cedula bigint(20) NOT NULL,
						id_cargo int(11) NOT NULL,
						base_salario_honorarios int(11) NOT NULL,
						codigo_tipo_contrato varchar(2) NOT NULL,
						codigo_novedad varchar(2) NOT NULL,
						fecha_novedad date NOT NULL,
						porcentaje_dedicacion decimal(5,4) NOT NULL,
						dias_laborados int(11) NOT NULL,
						planilla_ss bigint(20) NOT NULL,
						valor_salario_honorarios decimal(20,2) NOT NULL,
						valor_auxilio_transporte decimal(20,2) NOT NULL,
						valor_otras_deducciones decimal(20,2) NOT NULL,
						valor_asumidos_prestador decimal(20,2) NOT NULL,
						valor_dotacion decimal(20,2) NOT NULL,
						valor_examen_medico decimal(20,2) NOT NULL,
						observaciones text NOT NULL
						)
						CHARACTER SET utf8 COLLATE utf8_bin
						");

						//Paso 2.1: Poblar tabla temporal con los datos del archivo CSV
						$db->query("
						LOAD DATA INFILE '$archivo_csv' IGNORE INTO TABLE $temporal_table CHARACTER SET Latin1 FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' IGNORE 1 LINES
						(
							@CONTRATO,
							@MES,
							@CEDULA,
							@COD_CARGO,
							@COD_NOVEDAD,
							@FECHA_NOVEDAD,
							@PORCENTAJE_DEDICACION,
							@DIAS_LABORADOS,
							@PLANILLA_SS,
							@AUXILIO_TRANSPORTE_DEVENGADO,
							@VALOR_OTRAS_DEDUCCIONES,
							@VALOR_ASUMIDOS_PRESTADOR,
							@VALOR_DOTACION,
							@VALOR_EXAMEN_MEDICO,
							@OBSERVACIONES
							)
							SET
							id_contrato=@CONTRATO,
							id_mes=@MES,
							cedula=@CEDULA,
							id_cargo=@COD_CARGO,
							codigo_novedad=@COD_NOVEDAD,
							fecha_novedad=STR_TO_DATE(@FECHA_NOVEDAD, '%d/%m/%Y'),
							porcentaje_dedicacion=REPLACE(@PORCENTAJE_DEDICACION, ',' , '.'),
							dias_laborados=@DIAS_LABORADOS,
							planilla_ss=@PLANILLA_SS,
							valor_auxilio_transporte=REPLACE(@AUXILIO_TRANSPORTE_DEVENGADO, ',' , '.'),
							valor_otras_deducciones=REPLACE(@VALOR_OTRAS_DEDUCCIONES, ',' , '.'),
							valor_asumidos_prestador=REPLACE(@VALOR_ASUMIDOS_PRESTADOR, ',' , '.'),
							valor_dotacion=REPLACE(@VALOR_DOTACION, ',' , '.'),
							valor_examen_medico=REPLACE(@VALOR_EXAMEN_MEDICO, ',' , '.'),
							observaciones=@OBSERVACIONES
							");

							$db->query(" DELETE FROM $temporal_table WHERE $temporal_table.id_contrato = 0 OR $temporal_table.id_contrato = '' ");


							//Validación RE

							$resultadoSqlRE = $db->query("SELECT $temporal_table.id_contrato as id_contrato FROM $temporal_table WHERE $temporal_table.codigo_novedad != 'RE'");
							$resultadoSqlRE->setFetchMode(Phalcon\Db::FETCH_OBJ);
							$cantidadRE     = $resultadoSqlRE->numRows();
							if ($cantidadRE > 0) {
								$this->flash->error("Al menos uno de los registros, presenta tipo de novedad diferente a RE");
								return $this->response->redirect("ingresar/indexrecursohumano");
							}

							//Validación SN

							$resultadoSqlSN = $db->query("SELECT $temporal_table.id_contrato as id_contrato, $temporal_table.codigo_novedad FROM $temporal_table WHERE $temporal_table.codigo_novedad = 'SN'");
							$resultadoSqlSN->setFetchMode(Phalcon\Db::FETCH_OBJ);
							$cantidadSN = $resultadoSqlSN->numRows();
							if ($cantidadSN > 0) {
								$id_contrato = 0;
								foreach ($resultadoSqlSN->fetchAll() as $key => $row0) {
									$id_contrato = $row0->id_contrato;
								}

								$resultadoSqlContrato = $db->query("SELECT id_contrato, id_modalidad FROM informacion_contrato WHERE id_contrato = $id_contrato");
								$resultadoSqlContrato->setFetchMode(Phalcon\Db::FETCH_OBJ);
								$cantidadContrato = $resultadoSqlContrato->numRows();
								if ($cantidadContrato > 0) {
									foreach ($resultadoSqlContrato->fetchAll() as $key => $value) {
										if ($value->id_modalidad == 1) {
											$this->flash->error("Al menos uno de los registros, presenta tipo de novedad SN");
											return $this->response->redirect("ingresar/indexrecursohumano");
										}
									}
								}
							}

							// Validación para que el contrato indicado en el archivo csv por parte del prestador-oferente
							// sea el misno que el seleccionado en el combo de selección de contratos a traves de la interfaz
							// @daniel.gallo 03/04/2017
							$resultadoSql00 = $db->query("SELECT $temporal_table.id_contrato as id_contrato FROM $temporal_table WHERE $temporal_table.id_contrato != 0 AND $temporal_table.id_contrato != $id_contrato");
							$resultadoSql00->setFetchMode(Phalcon\Db::FETCH_OBJ);
							$cantidad     = $resultadoSql00->numRows();
							if($cantidad > 0)
							{
								$htmlContratosCSV = "<ul class='list-group'>";
								foreach($resultadoSql00->fetchAll() as $key0 => $row0){
									$htmlContratosCSV .= "<li class='list-group-item list-group-item-danger'>Linea # ".($key0)." - <strong>".$row0->id_contrato."</strong></li>";
								}
								$htmlContratosCSV .= "</ul>";

								$db->query("DROP TABLE $temporal_table ");
								$this->flash->error("Los siguientes contratos del archivo CSV - Excel:<br> $htmlContratosCSV <br> no corresponden con el contrato seleccionado: <strong>$id_contrato</strong> en el selector de contratos 'Seleccione el Contrato...' ");
								return $this->response->redirect("ingresar/indexrecursohumano");
							}

							// Daniel Gallo 29/03/2017 - la validación de que el mes seleccionado corresponda con el mes indicado en el archivo csv
							$resultadoSql = $db->query("SELECT $temporal_table.id_mes as id_mes FROM $temporal_table WHERE $temporal_table.id_mes != $id_mes");
							$resultadoSql->setFetchMode(Phalcon\Db::FETCH_OBJ);
							$cantidad     = $resultadoSql->numRows();
							if($cantidad > 0)
							{
								switch ($id_mes) {
									case 1:
									$mes = 'Enero';
									break;
									case 2:
									$mes = 'Febrero';
									break;
									case 3:
									$mes = 'Marzo';
									break;
									case 4:
									$mes = 'Abril';
									break;
									case 5:
									$mes = 'Mayo';
									break;
									case 6:
									$mes = 'Junio';
									break;
									case 7:
									$mes = 'Julio';
									break;
									case 8:
									$mes = 'Agosto';
									break;
									case 9:
									$mes = 'Septiembre';
									break;
									case 10:
									$mes = 'Octubre';
									break;
									case 11:
									$mes = 'Noviembre';
									break;
									case 12:
									$mes = 'Diciembre';
									break;
								}
								$htmlContratosCSV = "<ul class='list-group'>";
								foreach($resultadoSql->fetchAll() as $key => $row){
									switch ($row->id_mes) {
										case 1:
										$mesCSV = 'Enero';
										break;
										case 2:
										$mesCSV = 'Febrero';
										break;
										case 3:
										$mesCSV = 'Marzo';
										break;
										case 4:
										$mesCSV = 'Abril';
										break;
										case 5:
										$mesCSV = 'Mayo';
										break;
										case 6:
										$mesCSV = 'Junio';
										break;
										case 7:
										$mesCSV = 'Julio';
										break;
										case 8:
										$mesCSV = 'Agosto';
										break;
										case 9:
										$mesCSV = 'Septiembre';
										break;
										case 10:
										$mesCSV = 'Octubre';
										break;
										case 11:
										$mesCSV = 'Noviembre';
										break;
										case 12:
										$mesCSV = 'Diciembre';
										break;
									}
									$htmlContratosCSV .= "<li class='list-group-item list-group-item-danger'>Linea # ".($key)." - <strong>".$mesCSV."</strong></li>";
								}
								$htmlContratosCSV .= "</ul>";

								$db->query("DROP TABLE $temporal_table ");
								$this->flash->error("Los siguientes registros de recurso humano en el campo mes del archivo CSV - Excel:<br> $htmlContratosCSV <br> no corresponden con el mes seleccionado: <strong>$mes</strong> en el selector de Mes 'Seleccione el Mes...' ");
								return $this->response->redirect("ingresar/indexrecursohumano");
							}

							//AND $temporal_table.codigo_novedad  = 'RE'
							// Validación que se realiza atraves del cargue de información de recurso humano donde las novedades son RE y que verifica si el personal
							// contratado tiene fecha de retiro no lo debe dejar ingresar. Si el personal tiene fecha de retiro direfente a 0000-00-00 y la fecha de la
							// la novedad es mayor a la fecha de ingreso debe elimnar la novedad de la plantilla de recurso humano.
							$resultadoSql0 = $db->query("
							SELECT personal_contratado.id_sede as id_sede,
							personal_contratado.cedula as cedula,
							MAX(personal_contratado.fecha_ingreso) as fecha_ingreso,
							$temporal_table.fecha_novedad as fecha_novedad,
							personal_contratado.id_cargo as id_cargo
							FROM personal_contratado, $temporal_table
							WHERE personal_contratado.id_contrato = $id_contrato
							AND personal_contratado.cedula      = $temporal_table.cedula
							AND personal_contratado.id_cargo    = $temporal_table.id_cargo
							GROUP BY personal_contratado.cedula
							");
							$resultadoSql0->setFetchMode(Phalcon\Db::FETCH_OBJ);
							$cantidad0    = $resultadoSql0->numRows();
							if($cantidad0 > 0)
							{
								$id_sede         = '';
								$fecha_ingreso   = '';
								$fecha_novedad   = '';
								$cedula          = '';
								$id_cargo        = '';
								$htmlContratosCSV2 = "<ul class='list-group'>";
								$flag              = 0;
								foreach($resultadoSql0->fetchAll() as $key0 => $row0){

									$id_sede       = $row0->id_sede;
									$fecha_ingreso = $row0->fecha_ingreso;
									$fecha_novedad = $row0->fecha_novedad;
									$cedula        = $row0->cedula;
									$id_cargo      = $row0->id_cargo;

									$resultadoSql2 = $db->query("
									SELECT MAX(personal_contratado.fecha_retiro) as fecha_retiro,
									personal_contratado.id_contrato as id_contrato,
									personal_contratado.cedula as cedula,
									personal_contratado.id_cargo as id_cargo,
									personal_contratado.id_sede as id_sede
									FROM personal_contratado
									WHERE personal_contratado.fecha_ingreso = '$fecha_ingreso'
									AND personal_contratado.fecha_ingreso <= '$fecha_novedad'
									AND (personal_contratado.fecha_retiro != '0000-00-00' AND personal_contratado.fecha_retiro IS NOT NULL )
									AND personal_contratado.id_contrato   = $id_contrato
									AND personal_contratado.cedula        = $cedula
									AND personal_contratado.id_cargo      = $id_cargo
									GROUP BY personal_contratado.cedula
									");
									$resultadoSql2->setFetchMode(Phalcon\Db::FETCH_OBJ);
									$cantidad2     = $resultadoSql2->numRows();

									if($cantidad2 > 0)
									{
										foreach($resultadoSql2->fetchAll() as $key2 => $row2){

											$fecha_retiro = $row2->fecha_retiro;

											if( !empty($fecha_retiro) )
											{
												$htmlContratosCSV2 .= "<li class='list-group-item list-group-item-danger'>El documento: <strong>".$cedula."</strong> presenta fecha de retiro ".$fecha_retiro." </li>";
												$flag++;
											}
										}
									}

								}

								if( $flag > 0 )
								{
									$htmlContratosCSV2 .= "</ul>";
									$db->query("DROP TABLE $temporal_table ");
									$this->flash->error("Se reportan las siguientes inconsistencias: ".$htmlContratosCSV2);
									return $this->response->redirect("ingresar/indexrecursohumano");
								}

							}

							// Validación Daniel Gallo 06/04/2017 el sistema no debe permitir subir personal con un cargo diferente al registrado en personal contratado
							$resultadoSql31 = $db->query("
							SELECT $temporal_table.cedula as cedula,
							$temporal_table.id_cargo as id_cargo
							FROM $temporal_table
							WHERE $temporal_table.id_contrato = $id_contrato
							");
							$resultadoSql31->setFetchMode(Phalcon\Db::FETCH_OBJ);
							$cantidad31    = $resultadoSql31->numRows();
							if($cantidad31 > 0)
							{
								$cedula            = '';
								$id_cargo          = '';
								$htmlContratosCSV3 = "<ul class='list-group'>";
								$flag              = 0;
								foreach($resultadoSql31->fetchAll() as $key31 => $row31){

									$cedula       = $row31->cedula;
									$id_cargo     = $row31->id_cargo;

									$resultadoSql3 = $db->query("
									SELECT personal_contratado.id_cargo
									FROM personal_contratado
									WHERE personal_contratado.id_contrato = $id_contrato
									AND personal_contratado.cedula      = $cedula
									AND personal_contratado.id_cargo    = $id_cargo
									GROUP BY personal_contratado.cedula, personal_contratado.id_cargo
									");
									$resultadoSql3->setFetchMode(Phalcon\Db::FETCH_OBJ);
									$cantidad3     = $resultadoSql3->numRows();
									if($cantidad3 == 0)
									{
										$htmlContratosCSV3 .= "<li class='list-group-item list-group-item-danger'>El personal con cedula: <strong>".$cedula."</strong> y cargo: ".$id_cargo." no se encuentran registrado em el personal contratado</li>";
										$flag++;
									}
								}
								if($flag > 0 )
								{
									$htmlContratosCSV3 .= "</ul>";
									$db->query("DROP TABLE $temporal_table ");
									$this->flash->error("Los siguientes registros: ".$htmlContratosCSV3);
									return $this->response->redirect("ingresar/indexrecursohumano");
								}
							}

							// Validación Daniel Gallo 06/04/2017 el sistema no debe permitir subir personal con un cargo diferente al registrado en personal contratado
							$resultadoSql7 = $db->query("
							SELECT $temporal_table.id_contrato as id_contrato,
							$temporal_table.id_mes as id_mes,
							$temporal_table.id_cargo as id_cargo,
							$temporal_table.codigo_novedad as codigo_novedad,
							$temporal_table.porcentaje_dedicacion as porcentaje_dedicacion
							FROM $temporal_table, matriz_ejecucion_rh
							WHERE $temporal_table.id_contrato           = $id_contrato
							AND $temporal_table.id_contrato           = matriz_ejecucion_rh.id_contrato
							AND $temporal_table.id_mes                = matriz_ejecucion_rh.id_mes
							AND $temporal_table.id_cargo              = matriz_ejecucion_rh.id_cargo
							AND $temporal_table.codigo_novedad        = matriz_ejecucion_rh.codigo_novedad
							AND $temporal_table.porcentaje_dedicacion = matriz_ejecucion_rh.porcentaje_dedicacion
							");
							$resultadoSql7->setFetchMode(Phalcon\Db::FETCH_OBJ);
							$cantidad7    = $resultadoSql7->numRows();
							if($cantidad7 > 0)
							{
								$htmlContratosCSV7 = "<ul class='list-group'>";
								foreach($resultadoSql7->fetchAll() as $key7 => $row7){
									$id_contrato           = $row7->id_contrato;
									$id_mes                = $row7->id_mes;
									$id_cargo              = $row7->id_cargo;
									$codigo_novedad        = $row7->codigo_novedad;
									$porcentaje_dedicacion = $row7->porcentaje_dedicacion;

									switch ($id_mes) {
										case 1:
										$mesCSV = 'Enero';
										break;
										case 2:
										$mesCSV = 'Febrero';
										break;
										case 3:
										$mesCSV = 'Marzo';
										break;
										case 4:
										$mesCSV = 'Abril';
										break;
										case 5:
										$mesCSV = 'Mayo';
										break;
										case 6:
										$mesCSV = 'Junio';
										break;
										case 7:
										$mesCSV = 'Julio';
										break;
										case 8:
										$mesCSV = 'Agosto';
										break;
										case 9:
										$mesCSV = 'Septiembre';
										break;
										case 10:
										$mesCSV = 'Octubre';
										break;
										case 11:
										$mesCSV = 'Noviembre';
										break;
										case 12:
										$mesCSV = 'Diciembre';
										break;
									}

									$htmlContratosCSV7 .= "<li class='list-group-item list-group-item-danger'>Contrato: <b>".$id_contrato."</b> - Periodo: <b>".$mesCSV."</b> - Cargo: <b>".$id_cargo."</b> - Codigo Novedad: <b>".$codigo_novedad."</b> - Porcentaje de Dedicación: <b> % ".$porcentaje_dedicacion."</b></li>";
								}
								$htmlContratosCSV7 .= "</ul>";
								$db->query("DROP TABLE $temporal_table ");
								$this->flash->error("Los siguientes registros ya se encuentran en el recurso humano: ".$htmlContratosCSV7);
								return $this->response->redirect("ingresar/indexrecursohumano");
							}

							// Daniel Gallo 07/04/2017 - El sistema no debe permitir novedades con fecha superior a la fecha de terminación del contrato
							$resultadoSql8 = $db->query("
							SELECT $temporal_table.cedula as cedula,
							$temporal_table.id_cargo as id_cargo,
							$temporal_table.fecha_novedad as fecha_novedad,
							informacion_contrato.fecha_terminacion_contrato as fecha_terminacion_contrato
							FROM $temporal_table, informacion_contrato
							WHERE $temporal_table.id_contrato   = $id_contrato
							AND $temporal_table.id_contrato   = informacion_contrato.id_contrato
							AND $temporal_table.fecha_novedad > informacion_contrato.fecha_terminacion_contrato
							");
							$resultadoSql8->setFetchMode(Phalcon\Db::FETCH_OBJ);
							$cantidad8    = $resultadoSql8->numRows();
							if($cantidad8 > 0)
							{
								$htmlContratosCSV8 = "<ul class='list-group'>";
								foreach($resultadoSql8->fetchAll() as $key8 => $row8){
									$cedula                     = $row8->cedula;
									$id_cargo                   = $row8->id_cargo;
									$fecha_novedad              = $row8->fecha_novedad;
									$fecha_terminacion_contrato = $row8->fecha_terminacion_contrato;
									$htmlContratosCSV8         .= "<li class='list-group-item list-group-item-danger'>Contrato: <b>".$id_contrato."</b> - Fecha Terminación Contrato: <b>".$fecha_terminacion_contrato."</b> - Fecha de Novedad: <b>".$fecha_novedad."</b> - Cedula: <b>".$cedula."</b></li>";
								}
								$htmlContratosCSV8 .= "</ul>";
								$db->query("DROP TABLE $temporal_table ");
								$this->flash->error("Los siguientes registros del recurso humano: ".$htmlContratosCSV8." tiene fecha de novedad superior a la fecha de terminación del contrato");
								return $this->response->redirect("ingresar/indexrecursohumano");
							}

							//Paso 2.2: Update tabla temporal con salario y tipo contrato
							/*	if ($id_modalidad==12){ */
							$db->query("
							UPDATE
							$temporal_table, cargo
							SET
							$temporal_table.codigo_tipo_contrato = cargo.codigo_tipo_contrato
							WHERE
							$temporal_table.id_cargo = cargo.id_cargo
							");
							$db->query("
							UPDATE
							$temporal_table, personal_contratado
							SET
							$temporal_table.base_salario_honorarios = personal_contratado.base_salario_honorarios
							WHERE
							$temporal_table.id_cargo = personal_contratado.id_cargo AND
							$temporal_table.id_contrato = personal_contratado.id_contrato AND
							$temporal_table.cedula = personal_contratado.cedula
							");
							//Daniel Gallo - 01/03/2017
							// Sistema debe validar la existencia de sede para el contrato, da arrojar un error, el valor en la variable
							// "base_salario_honorarios" debe ser o convertirse a cero
							/*$db->query("
							UPDATE
							$temporal_table, personal_contratado
							SET
							personal_contratado.base_salario_honorarioss = 0
							WHERE
							$temporal_table.id_cargo = personal_contratado.id_cargo AND
							$temporal_table.id_contrato = personal_contratado.id_contrato AND
							$temporal_table.cedula = personal_contratado.cedula AND
							personal_contratado.fecha_retiro IS NOT NULL
							");*/
							// Daniel Gallo - 01/03/2017	actualizar la fecha de retiro si el codigo de novedad es RE por fecha de novedad y la fecha de retiro
							// es igual 0000-00-00
							$db->query("
							UPDATE $temporal_table, personal_contratado
							SET personal_contratado.fecha_retiro = $temporal_table.fecha_novedad
							WHERE $temporal_table.id_cargo         = personal_contratado.id_cargo
							AND $temporal_table.id_contrato      = personal_contratado.id_contrato
							AND $temporal_table.cedula           = personal_contratado.cedula
							AND $temporal_table.codigo_novedad   = 'RE'
							AND (personal_contratado.fecha_retiro = '0000-00-00' OR personal_contratado.fecha_retiro IS NULL )
							");
							/*} else {
							$db->query("
							UPDATE
							$temporal_table, cargo
							SET
							$temporal_table.base_salario_honorarios = cargo.base_salario_honorarios,
							$temporal_table.codigo_tipo_contrato = cargo.codigo_tipo_contrato
							WHERE
							$temporal_table.id_cargo = cargo.id_cargo
							");
						}*/
						//Paso 2.3: Update tabla temporal con operaciones entre campos
						$db->query("
						UPDATE
						$temporal_table
						SET
						valor_salario_honorarios = base_salario_honorarios*(dias_laborados/30)*porcentaje_dedicacion
						");

						//Paso 3: Insertar datos de la tabla temporal a la tabla real
						$db->query("
						REPLACE INTO matriz_ejecucion_rh
						(
							id_contrato,
							id_prestador,
							id_modalidad,
							id_ano,
							id_mes,
							id_categoria,
							id_concepto,
							cedula,
							id_cargo,
							codigo_novedad,
							fecha_novedad,
							codigo_tipo_contrato,
							porcentaje_dedicacion,
							base_salario_honorarios,
							dias_laborados,
							planilla_ss,
							valor_salario_honorarios,
							valor_auxilio_transporte,
							valor_bruto,
							valor_deduccion_ss,
							valor_otras_deducciones,
							valor_asumidos_prestador,
							valor_neto,
							valor_dotacion,
							valor_examen_medico,
							tipo_riesgo_arl,
							valor_seguridad_social,
							valor_prov_cesantias,
							valor_prov_intereses_cesantias,
							valor_prov_prima,
							valor_prov_vacaciones,
							valor_total_provisiones,
							valor_total_ejecutado,
							observaciones,
							indice_relacion_tecnica,
							usuario,
							estado
							)
							SELECT
							'$id_contrato',
							'$id_prestador',
							'$id_modalidad',
							'$id_ano',
							'$id_mes',
							'$id_categoria',
							'$id_concepto',
							cedula,
							id_cargo,
							codigo_novedad,
							fecha_novedad,
							codigo_tipo_contrato,
							porcentaje_dedicacion,
							base_salario_honorarios,
							dias_laborados,
							planilla_ss,
							valor_salario_honorarios,
							valor_auxilio_transporte,
							valor_salario_honorarios+valor_auxilio_transporte valor_bruto,
							if(codigo_tipo_contrato='VL',valor_salario_honorarios*'$porc_ss_empleado',0) valor_deduccion_ss,
							valor_otras_deducciones,
							valor_asumidos_prestador,
							valor_salario_honorarios + valor_auxilio_transporte-if(codigo_tipo_contrato='VL',valor_salario_honorarios*'$porc_ss_empleado',0)-valor_otras_deducciones+valor_asumidos_prestador valor_neto,
							valor_dotacion,
							valor_examen_medico,
							1,
							if(codigo_tipo_contrato='VL',valor_salario_honorarios*'$porc_ss_empresa',0) valor_seguridad_social,
							if(codigo_tipo_contrato='VL',(valor_salario_honorarios+valor_auxilio_transporte)*'$porc_cesantias',0) valor_prov_cesantias,
							if(codigo_tipo_contrato='VL',(valor_salario_honorarios+valor_auxilio_transporte)*'$porc_cesantias'*'$porc_intereses_cesantias'*(dias_laborados/360),0) valor_prov_intereses_cesantias,
							if(codigo_tipo_contrato='VL',(valor_salario_honorarios+valor_auxilio_transporte)*'$porc_prima',0) valor_prov_prima,
							if(codigo_tipo_contrato='VL',valor_salario_honorarios*'$porc_vacaciones',0) valor_prov_vacaciones,
							if(codigo_tipo_contrato='VL',(valor_salario_honorarios+valor_auxilio_transporte)*'$porc_cesantias',0)+if(codigo_tipo_contrato='VL',(valor_salario_honorarios+valor_auxilio_transporte)*'$porc_cesantias'*'$porc_intereses_cesantias'*(dias_laborados/360),0)+if(codigo_tipo_contrato='VL',(valor_salario_honorarios+valor_auxilio_transporte)*'$porc_prima',0)+if(codigo_tipo_contrato='VL',valor_salario_honorarios*'$porc_vacaciones',0) valor_total_provisiones,
							valor_salario_honorarios+valor_auxilio_transporte+valor_dotacion+valor_examen_medico+if(codigo_tipo_contrato='VL',valor_salario_honorarios*'$porc_ss_empresa',0)+if(codigo_tipo_contrato='VL',(valor_salario_honorarios+valor_auxilio_transporte)*'$porc_cesantias',0)+if(codigo_tipo_contrato='VL',(valor_salario_honorarios+valor_auxilio_transporte)*'$porc_cesantias'*'$porc_intereses_cesantias'*(dias_laborados/360),0)+if(codigo_tipo_contrato='VL',(valor_salario_honorarios+valor_auxilio_transporte)*'$porc_prima',0)+if(codigo_tipo_contrato='VL',valor_salario_honorarios*'$porc_vacaciones',0) valor_total_ejecutado,
							observaciones,
							(dias_laborados/30)*porcentaje_dedicacion,
							'$usuario',
							'$estado'
							FROM
							$temporal_table
							WHERE cedula > 0
							");

							//Paso 4: Borrar tabla temporal
							$db->query("DROP TABLE $temporal_table ");
							$this->flash->success("Se ha cargado exitosamente el archivo: ". $nombre_archivo );
							return $this->response->redirect("ingresar/indexrecursohumano");


						} else {
							$this->flash->error("Ocurrió un error al cargar el archivo, revise que la extensión sea CSV y/o el tamaño sea menor de 10MB");
							return $this->response->redirect("ingresar/indexrecursohumano");
						}
					}else{
						$this->flash->error("Error al cargar el archivo, intente nuevamente o póngase en contacto con el administrador del sistema");
						return $this->response->redirect("ingresar/indexrecursohumano");
					}

				}else{
					$this->flash->error("Error: todos los campos son obligatorios, revise e intente cargar de nuevo el archivo");
					return $this->response->redirect("ingresar/indexrecursohumano");
				}


			}


			public function inscostosAction()
			{
				if (!$this->request->isPost()) {
					return $this->response->redirect('');
				}

				//Validacion para determinar si el periodo esta abierto o cerrado
				$id_contrato = $this->request->getPost("id_contrato");
				$id_ano = $this->request->getPost("id_ano");
				$id_mes = $this->request->getPost("id_mes");

				$validacion = BloquearPeriodo::findFirst("
				id_contrato = '$id_contrato' AND
				id_ano = '$id_ano' AND
				id_mes = '$id_mes' AND
				nombre_componente_bloqueado = 'COSTOS'
				");
				if($validacion){
					$this->flash->error("¡El periodo está bloqueado!");
					return $this->response->redirect("ingresar/indexcostos");
				}

				//Variables a insertar en MatrizEjecucionFinanciera
				$var = new MatrizEjecucionFinanciera();
				$var->id_contrato = $this->request->getPost("id_contrato");
				$var->id_ano = $this->request->getPost("id_ano");
				$var->id_mes = $this->request->getPost("id_mes");
				$var->valor = $this->request->getPost("valor");
				$var->id_categoria = "6";
				$var->id_concepto = "6001";
				$var->numero_documento = "N/A";
				$var->fecha_documento = $var->id_ano."-".$var->id_mes."-01";
				$var->descripcion_documento = "N/A";
				$var->cantidad = "1";
				$var->nit_proveedor = 0;
				$var->nombre_proveedor = "N/A";
				$var->observaciones = "N/A";
				$var->usuario       = $this->sesauth['username'];
				$var->estado        = "1";

				//Consulta para obtener var faltantes
				$query1 = ContratoXSede::findFirst("id_contrato = '$var->id_contrato' AND id_sede LIKE '80___' ");
				$var->id_prestador = $query1->id_prestador;
				$var->id_modalidad = $query1->id_modalidad;
				$var->id_sede = $query1->id_sede;

				//Insertar usando modelo
				if (!$var->save()) {
					foreach ($var->getMessages() as $message) {
						$this->flash->error($message." debido a que no hay sede administrativa registrada");
					}
					return $this->response->redirect("ingresar/indexcostos");
				}

				$this->flash->success("¡Registro insertado Exitosamente!");
				return $this->response->redirect("ingresar/indexcostos");
			}


			public function insconceptosAction()
			{
				if (!$this->request->isPost()) {
					return $this->response->redirect('');
				}

				//Variables
				$id_contrato  = $this->request->getPost("id_contrato");
				$id_ano       = $this->request->getPost("id_ano");
				$id_mes       = $this->request->getPost("id_mes");
				$usuario      = $this->sesauth['username'];
				$estado       = "1";
				$query1       = ContratoXSede::findFirst("id_contrato = '$id_contrato'" );
				$id_prestador = $query1->id_prestador;
				$id_modalidad = $query1->id_modalidad;

				//Validar si todos los campos fueron diligenciados
				if($id_contrato && 	$id_ano &&	$id_mes ){

					//Validacion para determinar si el periodo esta abierto o cerrado
					$validacion = BloquearPeriodo::findFirst("
					id_contrato = '$id_contrato' AND
					id_ano = '$id_ano' AND
					id_mes = '$id_mes'AND
					nombre_componente_bloqueado = 'CANASTA'
					");
					if($validacion){
						$this->flash->error("¡El periodo está bloqueado!");
						return $this->response->redirect("ingresar/indexconceptos");
					}

					//Validar que se haya cargado un archivo
					if($this->request->hasFiles() == true){

						$uploads = $this->request->getUploadedFiles();
						$isUploaded = false;
						$i = 1;

						foreach($uploads as $upload){

							//Variables para cargar el archivo
							$nombre_archivo=$upload->getname();
							$renombrar_archivo= "CO-".$id_contrato."-".$id_ano."-".$id_mes.".csv";
							$extension_archivo=$upload->getextension();
							$tamano_archivo=$upload->getsize();
							$path = "files/".$renombrar_archivo;
							$peso_mb=5;
							$tamano_maximo = $peso_mb*1024*1024;

							//Realizar validacion antes de cargar el archivo
							if($extension_archivo=='csv' && $tamano_archivo<$tamano_maximo ){
								($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
							}
							$i++;

						}

						if($isUploaded){

							$db = $this->getDI()->getDb();
							$config = $this->getDI()->getConfig();
							$timestamp = new DateTime();
							$temporal_table = "temp_" . $timestamp->getTimestamp();
							$archivo_csv = $config->application->basePath ."/public/files/".$renombrar_archivo;

							//Paso 1: Crear tabla temporal
							$db->query("
							CREATE TEMPORARY TABLE $temporal_table
							(
								id_contrato bigint(20),
								id_mes int(11),
								id_categoria int(11),
								id_concepto int(11),
								id_sede int(11),
								valor bigint(20),
								numero_documento varchar(50),
								fecha_documento date,
								descripcion_documento text,
								cantidad int(11),
								nit_proveedor bigint(20),
								nombre_proveedor text,
								observaciones text
								)
								CHARACTER SET utf8 COLLATE utf8_bin
								");

								//Paso 2: Poblar tabla temporal con los datos del archivo CSV
								$db->query("
								LOAD DATA INFILE '$archivo_csv' IGNORE INTO TABLE $temporal_table CHARACTER SET Latin1 FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' IGNORE 1 LINES
								(
									@NUMERO_CONTRATO,
									@MES,
									@COD_CATEGORIA,
									@COD_CONCEPTO,
									@COD_SEDE,
									@VALOR,
									@NUMERO_DOCUMENTO,
									@FECHA_DOCUMENTO,
									@DESCRIPCION_DOCUMENTO,
									@CANTIDAD,
									@NIT,
									@NOMBRE_PROVEEDOR,
									@OBSERVACIONES
									)
									SET
									id_contrato=@NUMERO_CONTRATO,
									id_mes=@MES,
									id_categoria=@COD_CATEGORIA,
									id_concepto=@COD_CONCEPTO,
									id_sede=@COD_SEDE,
									valor=@VALOR,
									numero_documento=@NUMERO_DOCUMENTO,
									fecha_documento= STR_TO_DATE(@FECHA_DOCUMENTO, '%d/%m/%Y'),
									descripcion_documento=@DESCRIPCION_DOCUMENTO,
									cantidad=@CANTIDAD,
									nit_proveedor=@NIT,
									nombre_proveedor=@NOMBRE_PROVEEDOR,
									observaciones=@OBSERVACIONES
									");

									// Validación para que el contrato indicado en el archivo csv por parte del prestador-oferente
									// sea el misno que el seleccionado en el combo de selección de contratos a traves de la interfaz
									// Daniel Gallo 07/04/2017
									$resultadoSql00 = $db->query("
									SELECT $temporal_table.id_contrato as id_contrato
									FROM $temporal_table
									WHERE $temporal_table.id_contrato != 0
									AND $temporal_table.id_contrato != $id_contrato");
									$resultadoSql00->setFetchMode(Phalcon\Db::FETCH_OBJ);
									$cantidad     = $resultadoSql00->numRows();
									if($cantidad > 0)
									{
										$htmlContratosCSV = "<ul class='list-group'>";
										foreach($resultadoSql00->fetchAll() as $key0 => $row0){
											$htmlContratosCSV .= "<li class='list-group-item list-group-item-danger'><strong>".$row0->id_contrato."</strong></li>";
										}
										$htmlContratosCSV .= "</ul>";

										$db->query("DROP TABLE $temporal_table ");
										$this->flash->error("Los siguientes contratos indicados en canasta<br> $htmlContratosCSV <br> no corresponden con el contrato seleccionado: <strong>$id_contrato</strong> en el selector de contratos 'Seleccione el Contrato...' ");
										return $this->response->redirect("ingresar/indexconceptos");
									}

									// Validaciones Daniel Gallo 16/03/2017
									$resultadoSql = $db->query("SELECT $temporal_table.id_mes as id_mes FROM $temporal_table WHERE $temporal_table.id_mes != $id_mes");
									$resultadoSql->setFetchMode(Phalcon\Db::FETCH_OBJ);
									$cantidad     = $resultadoSql->numRows();
									if($cantidad > 0)
									{
										switch ($id_mes) {
											case 1:
											$mes = 'Enero';
											break;
											case 2:
											$mes = 'Febrero';
											break;
											case 3:
											$mes = 'Marzo';
											break;
											case 4:
											$mes = 'Abril';
											break;
											case 5:
											$mes = 'Mayo';
											break;
											case 6:
											$mes = 'Junio';
											break;
											case 7:
											$mes = 'Julio';
											break;
											case 8:
											$mes = 'Agosto';
											break;
											case 9:
											$mes = 'Septiembre';
											break;
											case 10:
											$mes = 'Octubre';
											break;
											case 11:
											$mes = 'Noviembre';
											break;
											case 12:
											$mes = 'Diciembre';
											break;
										}
										$htmlConceptosCSV = "<ul class='list-group'>";
										foreach($resultadoSql->fetchAll() as $key => $row){
											switch ($row->id_mes) {
												case 1:
												$mesCSV = 'Enero';
												break;
												case 2:
												$mesCSV = 'Febrero';
												break;
												case 3:
												$mesCSV = 'Marzo';
												break;
												case 4:
												$mesCSV = 'Abril';
												break;
												case 5:
												$mesCSV = 'Mayo';
												break;
												case 6:
												$mesCSV = 'Junio';
												break;
												case 7:
												$mesCSV = 'Julio';
												break;
												case 8:
												$mesCSV = 'Agosto';
												break;
												case 9:
												$mesCSV = 'Septiembre';
												break;
												case 10:
												$mesCSV = 'Octubre';
												break;
												case 11:
												$mesCSV = 'Noviembre';
												break;
												case 12:
												$mesCSV = 'Diciembre';
												break;
											}
											$htmlConceptosCSV .= "<li class='list-group-item list-group-item-danger'>Linea # ".(($key)+1)." - <strong>".$mesCSV."</strong></li>";
										}
										$htmlConceptosCSV .= "</ul>";

										$db->query("DROP TABLE $temporal_table ");
										$this->flash->error("Los siguientes conceptos de canasta en el campo mes - Excel:<br> $htmlConceptosCSV <br> no corresponden con el mes seleccionado: <strong>$mes</strong> en el selector de meses 'Seleccione el Mes...' ");
										return $this->response->redirect("ingresar/indexconceptos");
									}

									// Daniel Gallo 29/03/2017
									// Validación para verificar que las sedes indicadas en el archivo csv si correspondan al contrato seleccionado.
									$resultadoSql3 = $db->query("SELECT $temporal_table.id_contrato as id_contrato, $temporal_table.id_sede as id_sede
										FROM $temporal_table
										WHERE $temporal_table.id_contrato = $id_contrato
										AND $temporal_table.id_sede NOT IN(SELECT contrato_x_sede.id_sede FROM contrato_x_sede WHERE id_contrato = $id_contrato) ");
										$resultadoSql3->setFetchMode(Phalcon\Db::FETCH_OBJ);

										$cantidad2     = $resultadoSql3->numRows();
										if($cantidad2 > 0)
										{
											$htmlContratosCSV2 = "<ul class='list-group'>";

											foreach($resultadoSql3->fetchAll() as $key => $row3){
												$htmlContratosCSV2 .= "<li class='list-group-item list-group-item-danger'>El còdigo de sede <strong>".$row3->id_sede."</strong> no esta asignado al contrato: <strong>".$row3->id_contrato."</strong></li>";
											}
											$htmlContratosCSV2 .= "</ul>";

											$db->query("DROP TABLE $temporal_table ");
											$this->flash->error("Las siguientes sedes indicadas en el archivo CSV de canasta- Excel:<br> $htmlContratosCSV2 <br> no corresponden con el contrato seleccionado: <strong>$id_contrato</strong> en el selector de contratos 'Seleccione el Contrato...' ");
											return $this->response->redirect("ingresar/indexconceptos");
										}
										//Fin

										// Daniel Gallo 05/04/2017
										// Validación para verificar que el campo cantidad del archivo CSV sea mayor a 0.
										$resultadoSql4 = $db->query("SELECT $temporal_table.numero_documento as numero_documento, $temporal_table.cantidad as cantidad
											FROM $temporal_table
											WHERE $temporal_table.cantidad <= 0 ");
											$resultadoSql4->setFetchMode(Phalcon\Db::FETCH_OBJ);

											$cantidad4     = $resultadoSql4->numRows();
											if($cantidad4 > 0)
											{
												$htmlContratosCSV4 = "<ul class='list-group'>";

												foreach($resultadoSql4->fetchAll() as $key4 => $row4){
													$htmlContratosCSV4 .= "<li class='list-group-item list-group-item-danger'>Para el documento <strong>".$row4->numero_documento."</strong> el campo cantidad es: <strong>".$row4->cantidad."</strong></li>";
												}
												$htmlContratosCSV4 .= "</ul>";

												$db->query("DROP TABLE $temporal_table ");
												$this->flash->error("Los siguientes conceptos de canasta indicados en el archivo - Excel:<br> $htmlContratosCSV4 <br> para el contrato seleccionado: <strong>$id_contrato</strong> tiene el campo cantidad igual o menor a 0");
												return $this->response->redirect("ingresar/indexconceptos");
											}

											// Daniel Gallo - 07/04/2017
											// Validación par averficar que el codigo de conepto exista y este asociado a la categoria
											$resultadoSql6 = $db->query("
											SELECT $temporal_table.numero_documento as numero_documento,
											$temporal_table.id_concepto as id_concepto,
											$temporal_table.id_categoria as id_categoria,
											categoria.nombre_categoria as nombre_categoria
											FROM $temporal_table, categoria
											WHERE $temporal_table.id_contrato      = $id_contrato
											AND $temporal_table.id_categoria     = categoria.id_categoria
											GROUP BY $temporal_table.id_concepto");
											$resultadoSql6->setFetchMode(Phalcon\Db::FETCH_OBJ);

											$cantidad6     = $resultadoSql6->numRows();
											if($cantidad6 > 0)
											{
												$htmlContratosCSV6 = "<ul class='list-group'>";
												$flag=0;
												foreach($resultadoSql6->fetchAll() as $key6 => $row6){
													$id_concepto      = $row6->id_concepto;
													$id_categoria     = $row6->id_categoria;
													$numero_documento = $row6->numero_documento;
													$nombre_categoria = $row6->nombre_categoria;
													$resultadoSql61 = $db->query("
													SELECT concepto.id_concepto
													FROM concepto
													WHERE concepto.id_categoria = $id_categoria
													AND concepto.id_concepto  = $id_concepto
													GROUP BY concepto.id_concepto");
													$resultadoSql61->setFetchMode(Phalcon\Db::FETCH_OBJ);

													$cantidad61     = $resultadoSql61->numRows();
													if($cantidad61 == 0)
													{
														$htmlContratosCSV6 .= "<li class='list-group-item list-group-item-danger'>Para el documento <strong>".$numero_documento."</strong> el concepto indicado: <strong>".$id_concepto."</strong> no esta asociado a la categoria <strong>".$nombre_categoria."</strong></li>";
														$flag++;
													}

												}
												$htmlContratosCSV6 .= "</ul>";

												if($flag > 0)
												{
													$db->query("DROP TABLE $temporal_table ");
													$this->flash->error("Los siguientes conceptos de canasta indicados en el archivo - Excel:<br> ".$htmlContratosCSV6);
													return $this->response->redirect("ingresar/indexconceptos");
												}

											}

											// Daniel Gallo - 07/04/2017
											// Validación que se realiza para verificar que no se ingresen registros duplicados a la matriz de canasta
											$resultadoSql5 = $db->query("
											SELECT $temporal_table.id_categoria as id_categoria,
											$temporal_table.id_concepto as id_concepto,
											$temporal_table.id_sede as id_sede,
											$temporal_table.valor as valor,
											$temporal_table.numero_documento as numero_documento
											FROM $temporal_table, matriz_ejecucion_financiera
											WHERE $temporal_table.id_contrato      = $id_contrato
											AND $temporal_table.id_contrato      = matriz_ejecucion_financiera.id_contrato
											AND $temporal_table.id_categoria     = matriz_ejecucion_financiera.id_categoria
											AND $temporal_table.id_concepto      = matriz_ejecucion_financiera.id_concepto
											AND $temporal_table.id_sede          = matriz_ejecucion_financiera.id_sede
											AND $temporal_table.id_mes           = matriz_ejecucion_financiera.id_mes
											AND $temporal_table.valor            = matriz_ejecucion_financiera.valor
											AND $temporal_table.numero_documento = matriz_ejecucion_financiera.numero_documento ");
											$resultadoSql5->setFetchMode(Phalcon\Db::FETCH_OBJ);

											$cantidad5     = $resultadoSql5->numRows();
											if($cantidad5 > 0)
											{
												$htmlContratosCSV5 = "<ul class='list-group'>";
												foreach($resultadoSql5->fetchAll() as $key5 => $row5){
													$htmlContratosCSV5 .= "<li class='list-group-item list-group-item-danger'>Categoria: <strong>".$row5->id_categoria."</strong> Categoria: <strong>".$row5->id_concepto."</strong> Sede: ".$row5->id_sede." Valor: <strong>".$row5->valor."</strong> Documento: <strong>".$row5->numero_documento."</strong> </li>";
												}
												$htmlContratosCSV5 .= "</ul>";

												$db->query("DROP TABLE $temporal_table ");
												$this->flash->error("Los siguientes conceptos de canasta indicados en la plantilla:<br> $htmlContratosCSV5 <br> se encuentran ya activos");
												return $this->response->redirect("ingresar/indexconceptos");
											}

											//Paso 3: Insertar datos de la tabla temporal a la tabla real
											if ($id_modalidad == 12 ){
												$aux=" WHERE id_concepto IN (2003,3003,3009,3010,3011,3012,4001,4002,4003,4004,4005,4006,4007,4008,4009,4010)";
											} else {
												$aux="";
											}
											$db->query("
											INSERT IGNORE INTO matriz_ejecucion_financiera
											(
												id_contrato,
												id_prestador,
												id_modalidad,
												id_ano,
												id_mes,
												id_categoria,
												id_concepto,
												id_sede,
												valor,
												numero_documento,
												fecha_documento,
												descripcion_documento,
												cantidad,
												nit_proveedor,
												nombre_proveedor,
												observaciones,
												usuario,
												estado
												)
												SELECT
												'$id_contrato',
												'$id_prestador',
												'$id_modalidad',
												'$id_ano',
												'$id_mes',
												id_categoria,
												id_concepto,
												id_sede,
												valor,
												numero_documento,
												fecha_documento,
												descripcion_documento,
												cantidad,
												nit_proveedor,
												nombre_proveedor,
												observaciones,
												'$usuario',
												'1'
												FROM
												$temporal_table
												$aux
												");

												//Paso 4: Borrar tabla temporal
												$db->query("DROP TABLE $temporal_table ");
												$this->flash->success("Se ha cargado exitosamente el archivo: ". $nombre_archivo );
												return $this->response->redirect("ingresar/indexconceptos");


											} else {
												$this->flash->error("Ocurrió un error al cargar el archivo, revise que la extensión sea CSV y/o el tamaño sea menor de 5MB");
												return $this->response->redirect("ingresar/indexconceptos");
											}
										}else{
											$this->flash->error("Error al cargar el archivo, intente nuevamente o póngase en contacto con el administrador del sistema");
											return $this->response->redirect("ingresar/indexconceptos");
										}

									}else{
										$this->flash->error("Error: todos los campos son obligatorios, revise e intente cargar de nuevo el archivo");
										return $this->response->redirect("ingresar/indexconceptos");
									}


								}

								public function inssoportesAction()
								{
									if (!$this->request->isPost()) {
										return $this->response->redirect('');
									}
									//print_r($_POST);DIE();
									//Variables
									echo $id_contrato = $this->request->getPost("id_contrato");
									echo $id_ano = $this->request->getPost("id_ano");
									echo $id_mes = $this->request->getPost("id_mes");
									echo $usuario = $this->sesauth['username'];
									$estado = "1";
									$query1 = ContratoXSede::findFirst("id_contrato = '$id_contrato'" );
									$id_prestador = $query1->id_prestador;
									$id_modalidad = $query1->id_modalidad;

									//Validar si todos los campos fueron diligenciados
									if($id_contrato && 	$id_ano &&	$id_mes ){

										//Validacion para determinar si el periodo esta abierto o cerrado
										$validacion = BloquearPeriodo::findFirst("
										id_contrato = '$id_contrato' AND
										id_ano = '$id_ano' AND
										id_mes = '$id_mes' AND
										nombre_componente_bloqueado = 'SOPORTES'
										");
										if($validacion){
											$this->flash->error("¡El periodo está bloqueado!");
											return $this->response->redirect("ingresar/indexsoportes");
										}

										//Validar que se haya cargado un archivo
										if($this->request->hasFiles() == true){

											$uploads = $this->request->getUploadedFiles();
											$isUploaded = false;
											$i = 1;

											foreach($uploads as $upload){
												//Variables para cargar el archivo
												$nombre_archivo=$upload->getname();
												$extension_archivo=$upload->getextension();
												$renombrar_archivo= $id_contrato."-".$id_ano."-".$id_mes.".".$extension_archivo;
												$tamano_archivo=$upload->getsize();
												$path = "soportes/".$renombrar_archivo;
												$peso_mb=500;
												$tamano_maximo = $peso_mb*1024*1024;

												//Realizar validacion antes de cargar el archivo
												if($extension_archivo=='zip' && $tamano_archivo<$tamano_maximo || $extension_archivo=='rar' && $tamano_archivo<$tamano_maximo ){
													($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
												}
												$i++;
											}

											if($isUploaded){

												//Ingresar registro en la BD

												//Variables a insertar en ArchivoSoporte
												$var = new ArchivoSoporte();
												$var->id_contrato = $id_contrato;
												$var->id_prestador = $id_prestador;
												$var->id_ano = $id_ano;
												$var->id_mes = $id_mes;
												$var->nombre_archivo = $renombrar_archivo;
												$var->usuario = $usuario;
												$var->fecha_modificacion = date("Y-m-d H:i:s");
												$var->estado = "1";

												//Insertar usando modelo
												if (!$var->save()) {
													foreach ($var->getMessages() as $message) {
														$this->flash->error($message);
													}
													return $this->response->redirect("ingresar/indexsoportes");
												}
												$this->flash->success("Se ha cargado exitosamente el archivo: ". $nombre_archivo );
												return $this->response->redirect("ingresar/indexsoportes");
											} else {
												$this->flash->error("Ocurrió un error al cargar el archivo, revise que la extensión sea RAR o ZIP (la extension actual es $extension_archivo) y/o el tamaño sea menor de 200MB. (El Tamaño actual es $tamano_archivo)");
												return $this->response->redirect("ingresar/indexsoportes");
											}
										}else{
											$this->flash->error("Error al cargar el archivo, intente nuevamente o póngase en contacto con el administrador del sistema");
											return $this->response->redirect("ingresar/indexsoportes");
										}

									}else{
										$this->flash->error("Error: todos los campos son obligatorios, revise e intente cargar de nuevo el archivo");
										return $this->response->redirect("ingresar/indexsoportes");
									}


								}





								/* ELIMINAR */

								public function delcostosAction($id)
								{

									$deletecostoadmin = MatrizEjecucionFinanciera::findFirstById($id);
									if (!$deletecostoadmin) {
										$this->flash->error("Error: No se pudo eliminar el registro. Consulte con el administrador del sistema");
										return $this->response->redirect("ingresar/indexcostos");
									}

									if (!$deletecostoadmin->delete()) {
										foreach ($deletecostoadmin->getMessages() as $message) {
											$this->flash->error($message);
										}
										return $this->response->redirect("ingresar/indexcostos");
									}
									$this->flash->success("El registro fue eliminado exitosamente");
									return $this->response->redirect("ingresar/indexcostos");
								}


								public function delconceptosAction($id)
								{

									$deletecostoadmin = MatrizEjecucionFinanciera::findFirstById($id);
									if (!$deletecostoadmin) {
										$this->flash->error("Error: No se pudo eliminar el registro. Consulte con el administrador del sistema");
										return $this->response->redirect("ingresar/indexconceptos");
									}

									if (!$deletecostoadmin->delete()) {
										foreach ($deletecostoadmin->getMessages() as $message) {
											$this->flash->error($message);
										}
										return $this->response->redirect("ingresar/indexconceptos");
									}
									$this->flash->success("El registro fue eliminado exitosamente");
									return $this->response->redirect("ingresar/indexconceptos");
								}


								public function delperiodoconceptosAction()
								{
									$id_contrato = $this->request->getPost("id_contrato");
									$id_ano = $this->request->getPost("id_ano");
									$id_mes = $this->request->getPost("id_mes");
									$i=0;

									$queryperiodomatriz = MatrizEjecucionFinanciera::find("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria IN (2,3,4,5) AND estado='1' ");

									if (count($queryperiodomatriz)== 0) {
										$this->flash->error("¡El periodo está bloqueado o no hay registros para eliminar!");
										return $this->response->redirect("ingresar/indexconceptos");
									}

									foreach ($queryperiodomatriz as $deleteperiodomatriz) {
										if ($deleteperiodomatriz->delete() == true) {
											$i=$i+1;
										}
									}
									$this->flash->success("¡Se han eliminado  $i registro(s)!");
									return $this->response->redirect("ingresar/indexconceptos");
								}


								public function delperiodorecursohumanoAction()
								{
									$id_contrato = $this->request->getPost("id_contrato");
									$id_ano = $this->request->getPost("id_ano");
									$id_mes = $this->request->getPost("id_mes");
									$i=0;

									$queryperiodomatriz = MatrizEjecucionRh::find("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND estado='1' ");

									if (count($queryperiodomatriz)== 0) {
										$this->flash->error("¡El periodo está bloqueado o no hay registros para eliminar!");
										return $this->response->redirect("ingresar/indexrecursohumano");
									}

									foreach ($queryperiodomatriz as $deleteperiodomatriz) {
										if ($deleteperiodomatriz->delete() == true) {
											$i=$i+1;
										}
									}
									$this->flash->success("¡Se han eliminado  $i registro(s)!");
									return $this->response->redirect("ingresar/indexrecursohumano");
								}


								public function delsoportesAction($id_archivo_soporte)
								{

									$deletesoportes = ArchivoSoporte::findFirstByIdArchivoSoporte($id_archivo_soporte);
									if (!$deletesoportes) {
										$this->flash->error("Error: No se pudo eliminar el registro. Consulte con el administrador del sistema");
										return $this->response->redirect("ingresar/indexsoportes");
									}

									if (!$deletesoportes->delete()) {
										foreach ($deletesoportes->getMessages() as $message) {
											$this->flash->error($message);
										}
										return $this->response->redirect("ingresar/indexsoportes");
									}
									$this->flash->success("El registro fue eliminado exitosamente");
									return $this->response->redirect("ingresar/indexsoportes");
								}




								/* ACTUALIZAR */
								public function updconceptosAction()
								{
									if (!$this->request->isPost()) {
										return $this->response->redirect('');
									}

									//Variables a insertar en MatrizEjecucionFinanciera
									$var = new MatrizEjecucionFinanciera();
									$var->id = $this->request->getPost("id");
									$var->id_contrato = $this->request->getPost("id_contrato");
									$var->id_prestador = $this->request->getPost("id_prestador");
									$var->id_modalidad = $this->request->getPost("id_modalidad");
									$var->id_ano = $this->request->getPost("id_ano");
									$var->id_mes = $this->request->getPost("id_mes");
									$var->id_sede = $this->request->getPost("id_sede");
									$var->valor = $this->request->getPost("valor");
									$var->id_categoria = $this->request->getPost("id_categoria");
									$var->id_concepto = $this->request->getPost("id_concepto");
									$var->numero_documento = $this->request->getPost("numero_documento");
									$var->fecha_documento = $this->request->getPost("fecha_documento");
									$var->descripcion_documento = $this->request->getPost("descripcion_documento");
									$var->cantidad = $this->request->getPost("cantidad");
									$var->nombre_proveedor = $this->request->getPost("nombre_proveedor");
									$var->observaciones = $this->request->getPost("observaciones");
									$var->usuario = $this->request->getPost("usuario");
									$var->estado = $this->request->getPost("estado");

									//Insertar usando modelo
									if (!$var->update()) {
										foreach ($var->getMessages() as $message) {
											$this->flash->error($message);
										}
										return $this->response->redirect("ingresar/indexconceptos");
									}

									$this->flash->success("¡Registro actualizado Exitosamente!");
									return $this->response->redirect("ingresar/indexconceptos");
								}


							}
