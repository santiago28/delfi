<?php

use Phalcon\Mvc\Model\Criteria;

class ConfiguracionController extends ControllerBase
{

	public function initialize()
	{
		$this->tag->setTitle("Configuración Inicial"); //Titulo de la pagina
		$this->sesauth = $this->session->get('auth'); //Valores de la sesion auth
		if(!$this->sesauth['username']){
			$this->flash->error('¡No se ha iniciado Sesión!');
			return $this->response->redirect('');
		}
		parent::initialize();
	}


	/* INDEX */


	public function indexpersonalAction()
	{

		$id_group = $this->sesauth['id_group'];
		$id_contrato = $this->request->getPost("id_contrato");

		if($id_group==20){
			$id_prestador = $this->sesauth['id_prestador'];
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array( "id_prestador='$id_prestador' AND estado= '1' ", "group"=> "id_contrato, id_prestador" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de la Matriz Ejecución Financiera
			$empleados = PersonalContratado::find(  array( "id_prestador='$id_prestador' AND id_contrato='$id_contrato' ",	"order"=> "id_contrato,cedula "	));
			if (count($empleados) == 0) {
				//$this->flash->error("Mensaje de Error");
				$empleados = null;
			}
		}else{
			//Query para el select de los contratos
			$querycontratos = ContratoXSede::find(	array(	"id_modalidad IN (1,5,6,7,8,11,12,13) AND estado= '1' ",	"group"=> "id_contrato, id_prestador" ));
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

			//Query para ver la tabla de la Matriz Ejecución Financiera
			$empleados = PersonalContratado::find(  array( "id_contrato='$id_contrato' ",	"order"=> "id_contrato,cedula "	));
			if (count($empleados) == 0) {
				//$this->flash->error("Mensaje de Error");
				$empleados = null;
			}
		}

		$this->view->querycontratos = $querycontratos;
		$this->view->empleados = $empleados;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');
		$this->assets
		->addJs('js/bootstrap-modal.js');

	}

	public function indexupdatepersonalAction($id)
	{
		$id_group      = $this->sesauth['id_group'];
		$id_componente = $this->sesauth['id_componente'];
		//Query para ver la tabla de la PersonalContratado
		$personal = PersonalContratado::findFirst($id);

		//Query para ver la tabla de la Conceptos
		$sedes = ContratoXSede::find(array(	"id_contrato = $personal->id_contrato 	AND estado='1' "));
		if (count($sedes) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sedes = null;
		}
		$this->view->id_group      = $id_group;
		$this->view->id_componente = $id_componente;
		$this->view->personal      = $personal;
		$this->view->sedes         = $sedes;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');

	}


	/* INSERTAR */

	public function inspersonalAction()
	{
		if (!$this->request->isPost()) {
			return $this->response->redirect('');
		}



		//Variables del contrato
		$id_contrato = $this->request->getPost("id_contrato");
		$usuario = $this->sesauth['username'];
		$query1 = ContratoXSede::findFirst("id_contrato = '$id_contrato'" );
		$id_prestador = $query1->id_prestador;
		$id_modalidad = $query1->id_modalidad;
		$fecha_carga =date("Ymd-His");
		$estado =1;


		//Validar si todos los campos fueron diligenciados
		if($id_contrato){

			//Validar que se haya cargado un archivo
			if($this->request->hasFiles() == true){

				$uploads = $this->request->getUploadedFiles();
				$isUploaded = false;
				$i = 1;

				foreach($uploads as $upload){

					//Variables para cargar el archivo
					$nombre_archivo=$upload->getname();
					$renombrar_archivo= "PC-".$id_contrato."-".$fecha_carga.".csv";
					$extension_archivo=$upload->getextension();
					$tamano_archivo=$upload->getsize();
					$path = "filespc/".$renombrar_archivo;
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
					$archivo_csv = $config->application->basePath ."/public/filespc/".$renombrar_archivo;

					$file_contents = file_get_contents("$archivo_csv");
					$file_contents = str_replace('"','',$file_contents);
					$file_contents = str_replace(',','.',$file_contents);
					$file_contents = str_replace('ñ','n',$file_contents);
					file_put_contents($archivo_csv,$file_contents);

					//Paso 1: Crear tabla temporal
					$db->query("
					CREATE TEMPORARY TABLE $temporal_table
					(
						id_contrato bigint(20) NOT NULL,
						cedula bigint(20) NOT NULL,
						primer_nombre varchar(50) NOT NULL,
						segundo_nombre varchar(50) NOT NULL,
						primer_apellido varchar(50) NOT NULL,
						segundo_apellido varchar(50) NOT NULL,
						sexo varchar(2) NOT NULL,
						numero_telefono varchar(20) NOT NULL,
						numero_celular varchar(20) NOT NULL,
						email varchar(50) NOT NULL,
						formacion_academica text NOT NULL,
						nombre_institucion text NOT NULL,
						id_cargo int(11) NOT NULL,
						id_sede int(11) NOT NULL,
						UDS varchar(20) NOT NULL,
						codigo_tipo_contrato varchar(2) NOT NULL,
						base_salario_honorarios int(11) NOT NULL,
						porcentaje_dedicacion decimal(5,4) NOT NULL,
						EPS varchar(50) NOT NULL,
						ARL varchar(50) NOT NULL,
						fecha_ingreso date NOT NULL,
						fecha_afiliacion_ss date NOT NULL,
						fecha_terminacion_contrato date NOT NULL,
						observaciones text NOT NULL
						)
						CHARACTER SET utf8 COLLATE utf8_bin
						");

						//Paso 2.1: Poblar tabla temporal con los datos del archivo CSV
						$db->query("
						LOAD DATA INFILE '$archivo_csv' IGNORE INTO TABLE $temporal_table CHARACTER SET Latin1 FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' IGNORE 1 LINES
						(
							@CONTRATO,
							@CEDULA,
							@PRIMER_NOMBRE,
							@SEGUNDO_NOMBRE,
							@PRIMER_APELLIDO,
							@SEGUNDO_APELLIDO,
							@SEXO,
							@NUMERO_TELEFONO,
							@NUMERO_CELULAR,
							@EMAIL,
							@FORMACION_ACADEMICA,
							@NOMBRE_INSTITUCION,
							@COD_CARGO,
							@SALARIO,
							@COD_SEDE,
							@COD_UDS,
							@PORCENTAJE_DEDICACION,
							@EPS,
							@ARL,
							@FECHA_INGRESO,
							@FECHA_AFILIACION_SEGURIDAD_SOCIAL,
							@FECHA_TERMINACION_SEGUN_CONTRATO,
							@OBSERVACIONES
							)
							SET
							id_contrato=@CONTRATO,
							cedula=@CEDULA,
							primer_nombre=@PRIMER_NOMBRE,
							segundo_nombre=@SEGUNDO_NOMBRE,
							primer_apellido=@PRIMER_APELLIDO,
							segundo_apellido=@SEGUNDO_APELLIDO,
							sexo=@SEXO,
							numero_telefono=@NUMERO_TELEFONO,
							numero_celular=@NUMERO_CELULAR,
							email=@EMAIL,
							formacion_academica=@FORMACION_ACADEMICA,
							nombre_institucion=@NOMBRE_INSTITUCION,
							id_cargo=@COD_CARGO,
							base_salario_honorarios=@SALARIO,
							id_sede=@COD_SEDE,
							UDS=@COD_UDS,
							porcentaje_dedicacion=REPLACE(@PORCENTAJE_DEDICACION, ',' , '.'),
							EPS=@EPS,
							ARL=@ARL,
							fecha_ingreso=STR_TO_DATE(@FECHA_INGRESO, '%d/%m/%Y'),
							fecha_afiliacion_ss=STR_TO_DATE(@FECHA_AFILIACION_SEGURIDAD_SOCIAL, '%d/%m/%Y'),
							fecha_terminacion_contrato=STR_TO_DATE(@FECHA_TERMINACION_SEGUN_CONTRATO, '%d/%m/%Y'),
							observaciones=@OBSERVACIONES
							");

							$db->query("UPDATE $temporal_table SET UDS = REPLACE(UDS, '_', '') WHERE cedula > 0 ");

							// Validación para que el contrato indicado en el archivo csv por parte del prestador-oferente
							// sea el misno que el seleccionado en el combo de selección de contratos a traves de la interfaz
							// Grafica
							// @daniel.gallo
							$resultadoSql2 = $db->query("SELECT $temporal_table.id_contrato as id_contrato FROM $temporal_table WHERE $temporal_table.id_contrato != 0 AND $temporal_table.id_contrato != $id_contrato");
							$resultadoSql2->setFetchMode(Phalcon\Db::FETCH_OBJ);
							$cantidad     = $resultadoSql2->numRows();
							if($cantidad > 0)
							{
								$htmlContratosCSV = "<ul class='list-group'>";
								foreach($resultadoSql2->fetchAll() as $key2 => $row2){
									$htmlContratosCSV .= "<li class='list-group-item list-group-item-danger'>Linea # ".($key2)." - <strong>".$row2->id_contrato."</strong></li>";
								}
								$htmlContratosCSV .= "</ul>";

								$db->query("DROP TABLE $temporal_table ");
								$this->flash->error("Los siguientes contratos del archivo CSV - Excel:<br> $htmlContratosCSV <br> no corresponden con el contrato seleccionado: <strong>$id_contrato</strong> en el selector de contratos 'Seleccione el Contrato...' ");
								return $this->response->redirect("configuracion/indexpersonal");
							}

							//Validación de numero de caracteres del campo UDS

							// $resultUDS = $db->query("SELECT $temporal_table.cedula as cedula FROM $temporal_table WHERE LENGTH($temporal_table.UDS) < (11) OR LENGTH($temporal_table.UDS) > (14)");
							// $resultUDS->setFetchMode(Phalcon\Db::FETCH_OBJ);
							// $cantidadUDS = $resultUDS->numRows();

							// // foreach ($resultUDS>fetchAll() as $key => $row323) {
							// // 	$prueba = $row323;
							// // }

							// if($cantidadUDS > 0)
							// {
							// 	$htmlContratoCSVUDS = "<ul class='list-group'>";
							// 	foreach($resultUDS->fetchAll() as $key2 => $row2){
							// 		$htmlContratosCSV .= "<li class='list-group-item list-group-item-danger'>Linea # ".($key2)." - <strong>".$row2->cedula."</strong></li>";
							// 	}
							// 	$htmlContratosCSV .= "</ul>";
							// 	$db->query("DROP TABLE $temporal_table ");
							// 	$this->flash->error(" $htmlContratosCSV");
							// 	return $this->response->redirect("configuracion/indexpersonal");
							// }

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
										$htmlContratosCSV2 .= "<li class='list-group-item list-group-item-danger'>Linea # ".($key)." - El código de sede <strong>".$row3->id_sede."</strong> no esta asignada al contrato: <strong>".$row3->id_contrato."</strong></li>";
									}
									$htmlContratosCSV2 .= "</ul>";

									$db->query("DROP TABLE $temporal_table ");
									$this->flash->error("Las siguientes sedes indicadas en el archivo CSV - Excel:<br> $htmlContratosCSV2 <br> no corresponden con el contrato seleccionado: <strong>$id_contrato</strong> en el selector de contratos 'Seleccione el Contrato...' ");
									return $this->response->redirect("configuracion/indexpersonal");
								}

								//Validación para verificar que las UDS indicadas en el archivo CSV si correspondan a la sede seleccionada.
								$resultadoSqlUDS = $db->query("SELECT $temporal_table.id_sede as id_sede, $temporal_table.UDS as UDS
									FROM $temporal_table
									WHERE $temporal_table.UDS NOT IN (SELECT sede.id_uds FROM sede WHERE id_sede = $temporal_table.id_sede)");
									$resultadoSqlUDS->setFetchMode(Phalcon\Db::FETCH_OBJ);

									$cantidadUDS = $resultadoSqlUDS->numRows();
									if ($cantidadUDS > 0) {
										$htmlContratosCSV2 = "<ul class='list-group'>";
										$cont = 0;
										foreach($resultadoSqlUDS->fetchAll() as $key => $row3){
											$cont++;
											$htmlContratosCSV2 .= "<li class='list-group-item list-group-item-danger'>- La UDS <strong>".$row3->UDS."</strong> no esta asignada a la sede: <strong>".$row3->id_sede."</strong></li>";
										}
										$htmlContratosCSV2 .= "</ul>";

										$db->query("DROP TABLE $temporal_table ");
										$this->flash->error("Las siguientes UDS indicadas en el archivo CSV - Excel:<br> $htmlContratosCSV2 <br> no corresponden con las sedes seleccionadas");
										return $this->response->redirect("configuracion/indexpersonal");
									}

									// Validadción para evitar ingresar registros duplicados en la tabla de personal contratado cuando se cumple la siguiente condición
									// el codigo del contrato existe, la cedula existe, el codigo de cargo existe, el código de sede existe, y la fecha de ingreso indicada
									// en el archivo CSV es menor a la fecha de retiro elimina el registro para evitar registrar información erronea en la tabla de personal contratado
									$resultadoSql4 = $db->query("
									SELECT MAX(personal_contratado.fecha_retiro) as fecha_retiro,
									personal_contratado.id_contrato as id_contrato,
									personal_contratado.cedula as cedula,
									personal_contratado.id_cargo as id_cargo,
									personal_contratado.id_sede as id_sede
									FROM personal_contratado, $temporal_table
									WHERE personal_contratado.id_contrato   = $temporal_table.id_contrato
									AND personal_contratado.cedula        = $temporal_table.cedula
									AND personal_contratado.id_cargo      = $temporal_table.id_cargo
									AND personal_contratado.id_sede       = $temporal_table.id_sede
									AND (personal_contratado.fecha_retiro = '0000-00-00' OR personal_contratado.fecha_retiro IS NULL )
									GROUP BY personal_contratado.cedula");
									$resultadoSql4->setFetchMode(Phalcon\Db::FETCH_OBJ);

									$cantidad4     = $resultadoSql4->numRows();
									$fecha_retiro = '';
									if($cantidad4 > 0)
									{
										$htmlContratosCSV4 = "<ul class='list-group'>";
										foreach($resultadoSql4->fetchAll() as $key4 => $row4){
											$fecha_retiro = $row4->fecha_retiro;
											$id_contrato22= $row4->id_contrato;
											$cedula2      = $row4->cedula;
											$id_cargo2    = $row4->id_cargo;
											$id_sede2     = $row4->id_sede;

											if( (empty($fecha_retiro)) ||  (is_null($fecha_retiro)) || ($fecha_retiro == '0000-00-00'))
											{
												$htmlContratosCSV4 .= "<li class='list-group-item list-group-item-danger'>En personal contratado ya se encuentra un registro activo con la siguiente información: cedula: ".$cedula2." cargo: ".$id_cargo2." sede: ".$id_sede2." </li>";
											}
										}
										$htmlContratosCSV4 .= "</ul>";
										$db->query("DROP TABLE $temporal_table ");
										$this->flash->error("Los siguientes registros indicados en el archivo CSV - Excel:<br> $htmlContratosCSV4 <br> ya se encuentran activos en el personal contratado ");
										return $this->response->redirect("configuracion/indexpersonal");
									}

									// Validación para que el contrato indicado en el archivo csv por parte del prestador-oferente
									// sea el misno que el seleccionado en el combo de selección de contratos a traves de la interfaz
									// Grafica
									// @daniel.gallo



									if (($id_modalidad != '7') && ($id_modalidad != '13')) {
										$resultadoSql6 = $db->query("
										SELECT $temporal_table.id_contrato as id_contrato,
										$temporal_table.cedula as cedula,
										$temporal_table.base_salario_honorarios as base_salario_honorarios,
										cargo.base_salario_honorarios as base_salario_honorarios_cargo
										FROM $temporal_table, cargo
										WHERE $temporal_table.id_contrato               = $id_contrato
										AND $temporal_table.id_cargo                = cargo.id_cargo
										AND cargo.id_modalidad                      = (SELECT informacion_contrato.id_modalidad FROM informacion_contrato WHERE informacion_contrato.id_contrato = $id_contrato)
										AND $temporal_table.base_salario_honorarios != cargo.base_salario_honorarios");
									}else {
										$resultadoSql6 = $db->query("
										SELECT $temporal_table.id_contrato as id_contrato,
										$temporal_table.cedula as cedula,
										$temporal_table.base_salario_honorarios as base_salario_honorarios,
										cargo.base_salario_honorarios as base_salario_honorarios_cargo
										FROM $temporal_table, cargo
										WHERE $temporal_table.id_contrato               = $id_contrato
										AND $temporal_table.id_cargo                = cargo.id_cargo
										AND cargo.id_modalidad                      = (SELECT informacion_contrato.id_modalidad FROM informacion_contrato WHERE informacion_contrato.id_contrato = $id_contrato)
										AND $temporal_table.base_salario_honorarios > cargo.base_salario_honorarios");
									}
									$resultadoSql6->setFetchMode(Phalcon\Db::FETCH_OBJ);
									$cantidad6     = $resultadoSql6->numRows();
									if($cantidad6 > 0)
									{
										$htmlContratosCSV6 = "<ul class='list-group'>";
										foreach($resultadoSql6->fetchAll() as $key6 => $row6) {
											$id_contrato22                 = $row6->id_contrato;
											$cedula2                       = $row6->cedula;
											$base_salario_honorarios       = number_format($row6->base_salario_honorarios, 0, ".", ",");
											$base_salario_honorarios_cargo = number_format($row6->base_salario_honorarios_cargo, 0, ".", ",");

											$htmlContratosCSV6 .= "<li class='list-group-item list-group-item-danger'><b>cedula:</b> ".$cedula2." <b>base salario reportada:</b> ".$base_salario_honorarios." <b>base salario reportada para el cargo:</b> ".$base_salario_honorarios_cargo." </li>";
										}
										$htmlContratosCSV6 .= "</ul>";
										$db->query("DROP TABLE $temporal_table ");
										$this->flash->error("Los siguientes registros presentan salarios superiores a los autorizados en la canasta:<br> $htmlContratosCSV6 ");
										return $this->response->redirect("configuracion/indexpersonal");
									}

									// Validación para evitar ingresar registros duplicados cuando hay registros de personas que ya estan registrados en el sistema y con fecha de retiro = '0000-00-00'
									$resultadoSql5 = $db->query("
									SELECT personal_contratado.id_contrato as id_contrato, personal_contratado.cedula as cedula, personal_contratado.id_cargo as id_cargo, personal_contratado.id_sede as id_sede
									FROM $temporal_table, personal_contratado
									WHERE $temporal_table.id_contrato       = personal_contratado.id_contrato
									AND $temporal_table.cedula            = personal_contratado.cedula
									AND $temporal_table.id_cargo          = personal_contratado.id_cargo
									AND $temporal_table.id_sede           = personal_contratado.id_sede
									AND $temporal_table.fecha_ingreso     >= '$fecha_retiro'
									AND personal_contratado.fecha_retiro  = '0000-00-00' ");
									$resultadoSql5->setFetchMode(Phalcon\Db::FETCH_OBJ);

									$cantidad5     = $resultadoSql5->numRows();
									$fecha_retiro = '';
									if($cantidad5 > 0)
									{
										foreach($resultadoSql5->fetchAll() as $key5 => $row5) {
											$fecha_retiro = $row5->fecha_retiro;
											$id_contrato22= $row5->id_contrato;
											$cedula2      = $row5->cedula;
											$id_cargo2    = $row5->id_cargo;
											$id_sede2     = $row5->id_sede;

											if( !empty($fecha_retiro) )
											{
												$db->query("
												DELETE
												FROM $temporal_table
												WHERE $temporal_table.id_contrato = $id_contrato22
												AND $temporal_table.cedula        = $cedula2
												AND $temporal_table.id_cargo      = $id_cargo2
												AND $temporal_table.id_sede       = $id_sede2
												AND $temporal_table.fecha_ingreso >= '$fecha_retiro' ");
											}
										}
									}

									//Paso 2.2: Update tabla temporal con salario y tipo contrato
									//if ($id_modalidad==12) {
									$db->query("
									UPDATE
									$temporal_table, cargo
									SET
									$temporal_table.codigo_tipo_contrato = cargo.codigo_tipo_contrato
									WHERE
									$temporal_table.id_cargo = cargo.id_cargo
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

								//Paso 3: Insertar datos de la tabla temporal a la tabla real
								$db->query("
								INSERT IGNORE INTO personal_contratado
								(
									id_contrato,
									id_prestador,
									id_modalidad,
									cedula,
									primer_nombre,
									segundo_nombre,
									primer_apellido,
									segundo_apellido,
									sexo,
									numero_telefono,
									numero_celular,
									email,
									formacion_academica,
									nombre_institucion,
									id_cargo,
									id_sede,
									UDS,
									codigo_tipo_contrato,
									base_salario_honorarios,
									porcentaje_dedicacion,
									EPS,
									ARL,
									fecha_ingreso,
									fecha_afiliacion_ss,
									fecha_terminacion_contrato,
									fecha_retiro,
									observaciones,
									usuario,
									estado
									)
									SELECT
									'$id_contrato',
									'$id_prestador',
									'$id_modalidad',
									cedula,
									primer_nombre,
									segundo_nombre,
									primer_apellido,
									segundo_apellido,
									sexo,
									numero_telefono,
									numero_celular,
									email,
									formacion_academica,
									nombre_institucion,
									id_cargo,
									id_sede,
									UDS,
									codigo_tipo_contrato,
									base_salario_honorarios,
									porcentaje_dedicacion,
									EPS,
									ARL,
									fecha_ingreso,
									fecha_afiliacion_ss,
									fecha_terminacion_contrato,
									'0000-00-00',
									observaciones,
									'$usuario',
									'$estado'
									FROM
									$temporal_table
									WHERE cedula > 0
									");

									//Paso 4: Borrar tabla temporal
									$db->query("DROP TABLE $temporal_table ");
									$this->flash->success("Se ha cargado exitosamente el archivo: ". $nombre_archivo );
									return $this->response->redirect("configuracion/indexpersonal");


								} else {
									$this->flash->error("Ocurrió un error al cargar el archivo, revise que la extensión sea CSV y/o el tamaño sea menor de 10MB");
									return $this->response->redirect("configuracion/indexpersonal");
								}
							}else{
								$this->flash->error("Error al cargar el archivo, intente nuevamente o póngase en contacto con el administrador del sistema");
								return $this->response->redirect("configuracion/indexpersonal");
							}

						}else{
							$this->flash->error("Error: todos los campos son obligatorios, revise e intente cargar de nuevo el archivo");
							return $this->response->redirect("configuracion/indexpersonal");
						}


					}


					/* ELIMINAR */

					public function delpersonalAction($id)
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
					public function updpersonalAction()
					{
						if (!$this->request->isPost()) {
							return $this->response->redirect('');
						}

						//Variables a actualizar en Personal Contratado
						$var = new PersonalContratado();
						$var->id = $this->request->getPost('id');
						$var->id_contrato = $this->request->getPost('id_contrato');
						$var->id_prestador = $this->request->getPost('id_prestador');
						$var->id_modalidad = $this->request->getPost('id_modalidad');
						$var->cedula = $this->request->getPost('cedula');
						$var->primer_nombre = $this->request->getPost('primer_nombre');
						$var->segundo_nombre = $this->request->getPost('segundo_nombre');
						$var->primer_apellido = $this->request->getPost('primer_apellido');
						$var->segundo_apellido = $this->request->getPost('segundo_apellido');
						$var->sexo = $this->request->getPost('sexo');
						$var->numero_telefono = $this->request->getPost('numero_telefono');
						$var->numero_celular = $this->request->getPost('numero_celular');
						$var->email = $this->request->getPost('email');
						$var->formacion_academica = $this->request->getPost('formacion_academica');
						$var->nombre_institucion = $this->request->getPost('nombre_institucion');
						$var->id_cargo = $this->request->getPost('id_cargo');
						$var->id_sede = $this->request->getPost('id_sede');
						$var->UDS = $this->request->getPost('UDS');
						$var->codigo_tipo_contrato = $this->request->getPost('codigo_tipo_contrato');
						$var->base_salario_honorarios = $this->request->getPost('base_salario_honorarios');
						$var->porcentaje_dedicacion = $this->request->getPost('porcentaje_dedicacion');
						$var->EPS = $this->request->getPost('EPS');
						$var->ARL = $this->request->getPost('ARL');
						$var->fecha_ingreso = $this->request->getPost('fecha_ingreso');
						$var->fecha_afiliacion_ss = $this->request->getPost('fecha_afiliacion_ss');
						$var->fecha_terminacion_contrato = $this->request->getPost('fecha_terminacion_contrato');
						$var->fecha_retiro = $this->request->getPost('fecha_retiro');
						$var->observaciones = $this->request->getPost('observaciones');
						$var->usuario = $this->request->getPost('usuario');
						$var->estado = $this->request->getPost('estado');


						//@daniel.gallo - validación para poder insertar historicos de fechas de retiro
						/*$id = $this->request->getPost('id');
						$query1 = PersonalContratado::findFirstById($id);

						$personalContratado = PersonalContratado::find(array("id = $id AND fecha_retiro != '0000-00-00' "));
						if (count($personalContratado) > 0) {
						//Insertar usando modelo
						if (!$var->save()) {
						foreach ($var->getMessages() as $message) {
						$this->flash->error($message);
					}
					return $this->response->redirect("configuracion/indexpersonal");
				}
			}
			else
			{*/

			//Insertar usando modelo
			if (!$var->update()) {
				foreach ($var->getMessages() as $message) {
					$this->flash->error($message);
				}
				return $this->response->redirect("configuracion/indexpersonal");
			}
			//}

			$this->flash->success("¡Registro actualizado Exitosamente!");
			return $this->response->redirect("configuracion/indexpersonal");
		}


	}
