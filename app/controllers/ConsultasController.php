<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Mvc\Model\Query;

class ConsultasController extends ControllerBase
{

	public function initialize()
	{
		$this->tag->setTitle("Consultas"); //Titulo de la pagina
		$this->sesauth = $this->session->get('auth'); //Valores de la sesion auth
		if(!$this->sesauth['username']){
			$this->flash->error('¡No se ha iniciado Sesión!');
			return $this->response->redirect('');
		}
		parent::initialize();
	}



	public function indexsedesAction()
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

		$id_contrato= $this->request->getPost("id_contrato");
		$querysedes = ContratoXSede::find(
			array(
				"id_contrato='$id_contrato' AND estado= '1' ",
				"order"=> "id_contrato, id_sede"
			)
		);
		if (count($querysedes) == 0) {
			//$this->flash->error("Mensaje de Error");  // se quita para que muestre las administrativas JSLL AND id_sede NOT LIKE '80___'
			$querysedes = null;
		}

		$this->view->querysedes = $querysedes;
		$this->view->querycontratos = $querycontratos;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');

	}


	public function indexcargosAction()
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
					"id_modalidad IN (1,13,6,7,11,5) AND estado= '1' ",
					"group"=> "id_contrato",
				)
			);
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

		}

		$id_contrato   = $this->request->getPost("id_contrato");
		$datoscontrato = ContratoXSede::findFirst( " id_contrato='$id_contrato' ");
		$id_modalidad  = $datoscontrato->id_modalidad;

		$querycargos = Cargo::find(	array(	"id_modalidad='$id_modalidad' AND estado= '1' "	));
		if (count($querycargos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$querycargos = null;
		}

		$this->view->querycargos    = $querycargos;
		$this->view->contrato_select= $id_contrato;
		$this->view->querycontratos = $querycontratos;
		$this->view->cantidadcargos = count($querycargos);
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');
	}

	public function indexcategoriasAction()
	{

		$queryconceptos = Concepto::find(	array(	" estado= '1' "	));
		if (count($queryconceptos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$queryconceptos = null;
		}

		$this->view->queryconceptos = $queryconceptos;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');

	}


	public function indexinformemensualAction()
	{

		$id_group = $this->sesauth['id_group'];

		//Query para el select de los contratos
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
					"id_modalidad IN (1,5,6,7,11,13) AND estado= '1' ",
					"group"=> "id_contrato",
				)
			);
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

		}

		//Query para el select de los años
		$anos = Ano::find(	array(	"estado= '1' " ));
		if (count($anos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$anos = null;
		}

		//Query para el select de los años
		//$meses = Mes::find(	array("id_mes <= MONTH(NOW())")); // Se quita el estado = 1 para que aparezcan los meses independientemente si esta bloueado o no (06/05/2016)-- JSLL
		$meses = Mes::find(	array("id_mes <= 12"));
		if (count($meses) == 0) {
			//$this->flash->error("Mensaje de Error");
			$meses = null;
		}

		//consulta para hallar los valores de ief
		$id_contrato= $this->request->getPost("id_contrato");
		$id_ano= $this->request->getPost("id_ano");
		$id_mes= $this->request->getPost("id_mes");

		$sum_rh = MatrizEjecucionRh::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='1' ", 'column' => 'valor_total_ejecutado'));
		if (count($sum_rh) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_rh = null;
		}

		$sum_dotacion = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='2' ", 'column' => 'valor'));
		if (count($sum_dotacion) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_dotacion = null;
		}

		$sum_servicios_grales = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='3' ", 'column' => 'valor'));
		if (count($sum_servicios_grales) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_servicios_grales = null;
		}

		$sum_material_didactico = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='4' ", 'column' => 'valor'));
		if (count($sum_material_didactico) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_material_didactico = null;
		}

		$sum_alimentacion = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='5' ", 'column' => 'valor'));
		if (count($sum_alimentacion) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_alimentacion = null;
		}

		$sum_costos = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='6' ", 'column' => 'valor'));
		if (count($sum_costos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_costos = null;
		}

		//Query para llevar los datos del contrato
		$datoscontrato = ContratoXSede::findFirst( " id_contrato='$id_contrato' ");


		$this->view->querycontratos = $querycontratos;
		$this->view->datoscontrato = $datoscontrato;
		$this->view->anos = $anos;
		$this->view->meses = $meses;
		$this->view->recurso_humano = $sum_rh;
		$this->view->dotacion = $sum_dotacion;
		$this->view->servicios_grales = $sum_servicios_grales;
		$this->view->material_didactico = $sum_material_didactico;
		$this->view->alimentacion = $sum_alimentacion;
		$this->view->costos_admin = $sum_costos;
		$this->view->totales = $sum_rh+$sum_dotacion+$sum_servicios_grales+$sum_material_didactico+$sum_alimentacion+$sum_costos;
		$this->view->id_contrato = $id_contrato;
		$this->view->id_ano = $id_ano;
		$this->view->id_mes = $id_mes;
		//$this->assets
		//->addJs('js/filtros-tablesorter.min.js');

	}


	public function indexinformeconsolidadoAction()
	{

		$id_group = $this->sesauth['id_group'];

		//Query para el select de los contratos
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
					"id_modalidad IN (1,5,6,7,11,13) AND estado= '1' ",
					"group"=> "id_contrato",
				)
			);
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

		}

		//Query para el select de los años
		$anos = Ano::find(	array(	"estado= '1' " ));
		if (count($anos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$anos = null;
		}


		//Variables para consultas de IEF
		//$db = $this->getDI()->getDb();
		//$config = $this->getDI()->getConfig();


		$id_contrato= $this->request->getPost("id_contrato");
		$id_ano= $this->request->getPost("id_ano");


		//CATEGORIAS POR MES

		//Mes
		$meses= Mes::find(
			array(
				"id_mes != 0 and id_mes != 13"
			)
		);

		//Recurso Hno
		$query1 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionRh::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='1' AND id_mes='$i'",
				'column' => 'valor_total_ejecutado',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query1[] = 0;
			}else{
				foreach ($consulta as $x){
					$query1[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_RH = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7001' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_RH[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_RH[] = $x->sumatory;
				}
			}
		}

		$query_total_RH = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_RH[$i] = $query1[$i] + $query_ajuste_RH[$i];
		}


		//Dotacion
		$query2 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='2' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query2[] = 0;
			}else{
				foreach ($consulta as $x){
					$query2[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Dotacion = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7002' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Dotacion[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Dotacion[] = $x->sumatory;
				}
			}
		}

		$query_total_Dotacion = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Dotacion[$i] = $query2[$i] + $query_ajuste_Dotacion[$i];
		}

		//Servicios Grales
		$query3 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='3' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query3[] = 0;
			}else{
				foreach ($consulta as $x){
					$query3[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Servicios = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7003' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Servicios[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Servicios[] = $x->sumatory;
				}
			}
		}

		$query_total_Servicios = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Servicios[$i] = $query3[$i] + $query_ajuste_Servicios[$i];
		}

		//Material Didáctico
		$query4 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='4' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query4[] = 0;
			}else{
				foreach ($consulta as $x){
					$query4[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Material_D = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7004' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Material_D[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Material_D[] = $x->sumatory;
				}
			}
		}

		$query_total_Material_D = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Material_D[$i] = $query4[$i] + $query_ajuste_Material_D[$i];
		}

		//Alimentación
		$query5 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='5' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query5[] = 0;
			}else{
				foreach ($consulta as $x){
					$query5[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Alimentacion = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7005' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Alimentacion[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Alimentacion[] = $x->sumatory;
				}
			}
		}

		$query_total_Alimentacion = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Alimentacion[$i] = $query5[$i] + $query_ajuste_Alimentacion[$i];
		}

		//Costos
		$query6 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='6' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query6[] = 0;
			}else{
				foreach ($consulta as $x){
					$query6[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Costos = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7006' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Costos[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Costos[] = $x->sumatory;
				}
			}
		}

		$query_total_Costos = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Costos[$i] = $query6[$i] + $query_ajuste_Costos[$i];
		}

		//Ajustes
		$query7 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='7' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query7[] = 0;
			}else{
				foreach ($consulta as $x){
					$query7[] = $x->sumatory;
				}
			}
		}

		//Totales sin ajustes
		$querytotales_sinajustes = array();

		for ($i=1; $i <= 12 ;$i++){

			//Borrar y crear los array temporales para que no acumulen datos
			unset($temp_rh);
			unset($temp_co);
			$temp_rh = array();
			$temp_co = array();

			$sum_rh = MatrizEjecucionRh::sum(array(" id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria='1' ", 'column' => 'valor_total_ejecutado', 'group' =>'id_mes' ));
			$sum_co = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria IN (2,3,4,5,6) ", 'column' => 'valor', 'group' =>'id_mes'));

			foreach ($sum_rh as $x){
				$temp_rh[] = $x->sumatory;
			}

			foreach ($sum_co as $x){
				$temp_co[] = $x->sumatory;
			}


			if (count($sum_rh) == 0 && count($sum_co) == 0 ) {
				$querytotales_sinajustes[] = 0;
			}else{
				$querytotales_sinajustes[] = array_sum($temp_rh) + array_sum($temp_co) ;
			}
		}




		//Totales con ajustes
		$querytotales = array();

		for ($i=1; $i <= 12 ;$i++){

			//Borrar y crear los array temporales para que no acumulen datos
			unset($temp_rh);
			unset($temp_co);
			unset($temp_aj);
			$temp_rh = array();
			$temp_co = array();
			$temp_aj = array();

			$sum_rh = MatrizEjecucionRh::sum(array(" id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria='1' ", 'column' => 'valor_total_ejecutado', 'group' =>'id_mes' ));
			$sum_co = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria IN (2,3,4,5,6) ", 'column' => 'valor', 'group' =>'id_mes'));
			$sum_aj = MatrizAjuste::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria='7' ", 'column' => 'valor_ajuste', 'group' =>'id_mes'));

			foreach ($sum_rh as $x){
				$temp_rh[] = $x->sumatory;
			}

			foreach ($sum_co as $x){
				$temp_co[] = $x->sumatory;
			}

			foreach ($sum_aj as $x){
				$temp_aj[] = $x->sumatory;
			}

			if (count($sum_rh) == 0 && count($sum_co) == 0 && count($sum_aj) == 0  ) {
				$querytotales[] = 0;
			}else{
				//foreach ($consulta as $x){
				$querytotales[] = array_sum($temp_rh) + array_sum($temp_co) + array_sum($temp_aj) ;
				//}
			}
		}

		/*
		$conceptos = $db->query("
		SELECT
		A.id_mes, A.nombre_mes, A.id_contrato,
		SUM(IF(conceptos.id_categoria = '2',conceptos.valor,0)) AS dotacion,
		SUM(IF(conceptos.id_categoria = '3',conceptos.valor,0)) AS servicios_generales,
		SUM(IF(conceptos.id_categoria = '4',conceptos.valor,0)) AS material_didactico,
		SUM(IF(conceptos.id_categoria = '5',conceptos.valor,0)) AS alimentacion,
		SUM(IF(conceptos.id_categoria = '6',conceptos.valor,0)) AS costos_administrativos
		FROM (
		SELECT
		id_mes,
		nombre_mes,
		4600063322 as id_contrato
		FROM
		mes
		) AS A
		LEFT JOIN matriz_ejecucion_financiera conceptos ON conceptos.id_mes = A.id_mes AND conceptos.id_contrato = A.id_contrato
		GROUP BY A.id_mes,A.id_contrato
		");
		*/

		/*
		// Consultar usando PHQL
		$phql="
		SELECT
		id_mes,
		SUM(valor) costos_administrativos
		FROM
		matriz_ejecucion_financiera
		WHERE
		id_contrato='4600063322' AND
		id_categoria='6' AND
		id_ano='2016'
		GROUP BY id_mes
		UNION ALL SELECT
		id_mes,0
		FROM
		mes
		WHERE
		id_mes NOT IN (
		SELECT id_mes FROM matriz_ejecucion_financiera GROUP BY id_mes
		)
		ORDER BY 1
		";
		$query = new Query($phql, $this->getDI());
		$cat_6 = $query->execute();
		*/


		//Query para llevar los datos del contrato
		$infocontrato = ContratoXSede::findFirst( " id_contrato='$id_contrato' ");

		//Query para mostrar los ajustes por mes (solo para los interventores)
		$detalle_ajustes = MatrizAjuste::find(array(	"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='7' ", 'order' => 'id_concepto,id_mes' ));
		if (count($detalle_ajustes) == 0) {
			//$this->flash->error("Mensaje de Error");
			$detalle_ajustes = null;
		}

		//Sumatorias de las categorias
		$sum_conceptos = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria IN (2,3,4,5,6) ", 'column' => 'valor'));
		if (count($sum_conceptos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_conceptos = null;
		}

		$sum_rh = MatrizEjecucionRh::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='1' ", 'column' => 'valor_total_ejecutado'));
		if (count($sum_rh) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_rh = null;
		}

		$sum_ajustes = MatrizAjuste::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='7' ", 'column' => 'valor_ajuste'));
		if (count($sum_ajustes) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_ajustes = null;
		}


		$this->view->querycontratos = $querycontratos;
		$this->view->anos = $anos;
		$this->view->id_contrato = $id_contrato;
		$this->view->id_ano = $id_ano;
		$this->view->infocontrato = $infocontrato;
		$this->view->meses = $meses;
		$this->view->query1 = $query1;
		$this->view->query_ajuste_RH = $query_ajuste_RH;
		$this->view->query_total_RH = $query_total_RH;
		$this->view->query2 = $query2;
		$this->view->query_ajuste_Dotacion = $query_ajuste_Dotacion;
		$this->view->query_total_Dotacion = $query_total_Dotacion;
		$this->view->query3 = $query3;
		$this->view->query_ajuste_Servicios = $query_ajuste_Servicios;
		$this->view->query_total_Servicios = $query_total_Servicios;
		$this->view->query4 = $query4;
		$this->view->query_ajuste_Material_D = $query_ajuste_Material_D;
		$this->view->query_total_Material_D = $query_total_Material_D;
		$this->view->query5 = $query5;
		$this->view->query_ajuste_Alimentacion = $query_ajuste_Alimentacion;
		$this->view->query_total_Alimentacion = $query_total_Alimentacion;
		$this->view->query6 = $query6;
		$this->view->query_ajuste_Costos = $query_ajuste_Costos;
		$this->view->query_total_Costos = $query_total_Costos;
		$this->view->query7 = $query7;
		$this->view->querytotales_sinajustes = $querytotales_sinajustes;
		$this->view->querytotales = $querytotales;
		$this->view->detalle_ajustes = $detalle_ajustes;
		$this->view->totales = $sum_conceptos+$sum_rh+$sum_ajustes;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');
		$this->assets
		->addJs('js/bootstrap-modal.js');
		//$this->assets
		//->addJs('js/filtros-tablesorter.min.js');

	}


	public function indexinstructivosAction()
	{

		//Base Path para descargar archivos
		$db = $this->getDI()->getDb();
		$config = $this->getDI()->getConfig();

		$instructivo_delfi = $config->application->baseUri ."/public/instructivos/Instructivo_General_delFI.pdf";
		$instructivo_rh = $config->application->baseUri ."/public/instructivos/Instructivo_Generacion_CSV_RecursoHumano.pdf";
		$instructivo_conceptos = $config->application->baseUri ."/public/instructivos/Instructivo_Generacion_CSV_ConceptosCanasta.pdf";
		$instructivo_personal_contratado = $config->application->baseUri ."/public/instructivos/Instructivo_Generacion_CSV_PersonalContratado.pdf";

		$plantilla_rh = $config->application->baseUri ."/public/instructivos/Plantilla_RecursoHumano.xlsm";
		$plantilla_conceptos = $config->application->baseUri ."/public/instructivos/Plantilla_ConceptosCanasta.xlsm";
		$plantilla_personal_contratado = $config->application->baseUri ."/public/instructivos/Plantilla_PersonalContratado.xlsm";

		$this->view->instructivo_delfi = $instructivo_delfi;
		$this->view->instructivo_rh = $instructivo_rh;
		$this->view->instructivo_conceptos = $instructivo_conceptos;
		$this->view->instructivo_personal_contratado = $instructivo_personal_contratado;
		$this->view->plantilla_rh = $plantilla_rh;
		$this->view->plantilla_conceptos = $plantilla_conceptos;
		$this->view->plantilla_personal_contratado = $plantilla_personal_contratado;
		$this->assets
		->addJs('js/filtros-tablesorter.min.js');
		$this->assets
		->addJs('js/bootstrap-modal.js');

	}

	/* PRINT */

	public function printinformemensualAction()
	{

		$id_group = $this->sesauth['id_group'];
		$usuario = $this->sesauth['username'];


		//Query para el select de los contratos
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
					"id_modalidad IN (1,6,7,8,11,12,13) AND estado= '1' ",
					"group"=> "id_contrato",
				)
			);
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

		}

		//Query para el select de los años
		$anos = Ano::find(	array(	"estado= '1' " ));
		if (count($anos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$anos = null;
		}

		//Query para el select de los años
		$meses = Mes::find(	array(	"estado= '1' " ));
		if (count($meses) == 0) {
			//$this->flash->error("Mensaje de Error");
			$meses = null;
		}

		//consulta para hallar los valores de ief
		$id_contrato= $this->request->getPost("id_contrato");
		$id_ano= $this->request->getPost("id_ano");
		$id_mes= $this->request->getPost("id_mes");

		$sum_rh = MatrizEjecucionRh::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='1' ", 'column' => 'valor_total_ejecutado'));
		if (count($sum_rh) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_rh = null;
		}

		$sum_dotacion = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='2' ", 'column' => 'valor'));
		if (count($sum_dotacion) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_dotacion = null;
		}

		$sum_servicios_grales = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='3' ", 'column' => 'valor'));
		if (count($sum_servicios_grales) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_servicios_grales = null;
		}

		$sum_material_didactico = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='4' ", 'column' => 'valor'));
		if (count($sum_material_didactico) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_material_didactico = null;
		}

		$sum_alimentacion = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='5' ", 'column' => 'valor'));
		if (count($sum_alimentacion) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_alimentacion = null;
		}

		$sum_costos = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$id_mes' AND id_categoria='6' ", 'column' => 'valor'));
		if (count($sum_costos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_costos = null;
		}

		//Query para llevar los datos del contrato
		$datoscontrato = ContratoXSede::findFirst( " id_contrato='$id_contrato' ");


		$this->view->querycontratos = $querycontratos;
		$this->view->datoscontrato = $datoscontrato;
		$this->view->anos = $anos;
		$this->view->meses = $meses;
		$this->view->recurso_humano = $sum_rh;
		$this->view->dotacion = $sum_dotacion;
		$this->view->servicios_grales = $sum_servicios_grales;
		$this->view->material_didactico = $sum_material_didactico;
		$this->view->alimentacion = $sum_alimentacion;
		$this->view->costos_admin = $sum_costos;
		$this->view->totales = $sum_rh+$sum_dotacion+$sum_servicios_grales+$sum_material_didactico+$sum_alimentacion+$sum_costos;
		$this->view->id_contrato = $id_contrato;
		$this->view->id_ano = $id_ano;
		$this->view->id_mes = $id_mes;
		$this->view->usuario = $usuario;
		//$this->assets
		//->addJs('js/filtros-tablesorter.min.js');

	}

	public function printinformeconsolidadoAction()
	{

		$id_group = $this->sesauth['id_group'];
		$usuario = $this->sesauth['username'];

		//Query para el select de los contratos
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
					"id_modalidad IN (1,6,8,11,12,13) AND estado= '1' ",
					"group"=> "id_contrato",
				)
			);
			if (count($querycontratos) == 0) {
				//$this->flash->error("Mensaje de Error");
				$querycontratos = null;
			}

		}

		//Query para el select de los años
		$anos = Ano::find(	array(	"estado= '1' " ));
		if (count($anos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$anos = null;
		}


		//Variables para consultas de IEF
		//$db = $this->getDI()->getDb();
		//$config = $this->getDI()->getConfig();


		$id_contrato= $this->request->getPost("id_contrato");
		$id_ano= $this->request->getPost("id_ano");


		//CATEGORIAS POR MES

		//Mes
		$meses= Mes::find(
			array(
				"id_mes !=0 and id_mes != 13"
			)
		);

		//Recurso Hno
		$query1 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionRh::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='1' AND id_mes='$i'",
				'column' => 'valor_total_ejecutado',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query1[] = 0;
			}else{
				foreach ($consulta as $x){
					$query1[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_RH = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7001' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_RH[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_RH[] = $x->sumatory;
				}
			}
		}

		$query_total_RH = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_RH[$i] = $query1[$i] + $query_ajuste_RH[$i];
		}


		//Dotacion
		$query2 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='2' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query2[] = 0;
			}else{
				foreach ($consulta as $x){
					$query2[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Dotacion = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7002' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Dotacion[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Dotacion[] = $x->sumatory;
				}
			}
		}

		$query_total_Dotacion = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Dotacion[$i] = $query2[$i] + $query_ajuste_Dotacion[$i];
		}

		//Servicios Grales
		$query3 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='3' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query3[] = 0;
			}else{
				foreach ($consulta as $x){
					$query3[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Servicios = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7003' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Servicios[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Servicios[] = $x->sumatory;
				}
			}
		}

		$query_total_Servicios = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Servicios[$i] = $query3[$i] + $query_ajuste_Servicios[$i];
		}

		//Material Didáctico
		$query4 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='4' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query4[] = 0;
			}else{
				foreach ($consulta as $x){
					$query4[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Material_D = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7004' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Material_D[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Material_D[] = $x->sumatory;
				}
			}
		}

		$query_total_Material_D = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Material_D[$i] = $query4[$i] + $query_ajuste_Material_D[$i];
		}

		//Alimentación
		$query5 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='5' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query5[] = 0;
			}else{
				foreach ($consulta as $x){
					$query5[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Alimentacion = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7005' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Alimentacion[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Alimentacion[] = $x->sumatory;
				}
			}
		}

		$query_total_Alimentacion = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Alimentacion[$i] = $query5[$i] + $query_ajuste_Alimentacion[$i];
		}

		//Costos
		$query6 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizEjecucionFinanciera::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='6' AND id_mes='$i'",
				'column' => 'valor',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query6[] = 0;
			}else{
				foreach ($consulta as $x){
					$query6[] = $x->sumatory;
				}
			}
		}

		$query_ajuste_Costos = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_concepto='7006' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query_ajuste_Costos[] = 0;
			}else{
				foreach ($consulta as $x){
					$query_ajuste_Costos[] = $x->sumatory;
				}
			}
		}

		$query_total_Costos = array();
		for ($i=0; $i <= 11 ;$i++) {
			$query_total_Costos[$i] = $query6[$i] + $query_ajuste_Costos[$i];
		}

		//Ajustes
		$query7 = array();
		for ($i=1; $i <= 12 ;$i++){
			$consulta= MatrizAjuste::sum(array(
				"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='7' AND id_mes='$i'",
				'column' => 'valor_ajuste',
				'group' =>'id_mes'
			));
			if (count($consulta) == 0) {
				$query7[] = 0;
			}else{
				foreach ($consulta as $x){
					$query7[] = $x->sumatory;
				}
			}
		}

		//Totales sin ajustes
		$querytotales_sinajustes = array();

		for ($i=1; $i <= 12 ;$i++){

			//Borrar y crear los array temporales para que no acumulen datos
			unset($temp_rh);
			unset($temp_co);
			$temp_rh = array();
			$temp_co = array();

			$sum_rh = MatrizEjecucionRh::sum(array(" id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria='1' ", 'column' => 'valor_total_ejecutado', 'group' =>'id_mes' ));
			$sum_co = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria IN (2,3,4,5,6) ", 'column' => 'valor', 'group' =>'id_mes'));

			foreach ($sum_rh as $x){
				$temp_rh[] = $x->sumatory;
			}

			foreach ($sum_co as $x){
				$temp_co[] = $x->sumatory;
			}


			if (count($sum_rh) == 0 && count($sum_co) == 0 ) {
				$querytotales_sinajustes[] = 0;
			}else{
				$querytotales_sinajustes[] = array_sum($temp_rh) + array_sum($temp_co) ;
			}
		}




		//Totales con ajustes
		$querytotales = array();

		for ($i=1; $i <= 12 ;$i++){

			//Borrar y crear los array temporales para que no acumulen datos
			unset($temp_rh);
			unset($temp_co);
			unset($temp_aj);
			$temp_rh = array();
			$temp_co = array();
			$temp_aj = array();

			$sum_rh = MatrizEjecucionRh::sum(array(" id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria='1' ", 'column' => 'valor_total_ejecutado', 'group' =>'id_mes' ));
			$sum_co = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria IN (2,3,4,5,6) ", 'column' => 'valor', 'group' =>'id_mes'));
			$sum_aj = MatrizAjuste::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_mes='$i' AND id_categoria='7' ", 'column' => 'valor_ajuste', 'group' =>'id_mes'));

			foreach ($sum_rh as $x){
				$temp_rh[] = $x->sumatory;
			}

			foreach ($sum_co as $x){
				$temp_co[] = $x->sumatory;
			}

			foreach ($sum_aj as $x){
				$temp_aj[] = $x->sumatory;
			}

			if (count($sum_rh) == 0 && count($sum_co) == 0 && count($sum_aj) == 0  ) {
				$querytotales[] = 0;
			}else{
				//foreach ($consulta as $x){
				$querytotales[] = array_sum($temp_rh) + array_sum($temp_co) + array_sum($temp_aj) ;
				//}
			}
		}

		/*
		$conceptos = $db->query("
		SELECT
		A.id_mes, A.nombre_mes, A.id_contrato,
		SUM(IF(conceptos.id_categoria = '2',conceptos.valor,0)) AS dotacion,
		SUM(IF(conceptos.id_categoria = '3',conceptos.valor,0)) AS servicios_generales,
		SUM(IF(conceptos.id_categoria = '4',conceptos.valor,0)) AS material_didactico,
		SUM(IF(conceptos.id_categoria = '5',conceptos.valor,0)) AS alimentacion,
		SUM(IF(conceptos.id_categoria = '6',conceptos.valor,0)) AS costos_administrativos
		FROM (
		SELECT
		id_mes,
		nombre_mes,
		4600063322 as id_contrato
		FROM
		mes
		) AS A
		LEFT JOIN matriz_ejecucion_financiera conceptos ON conceptos.id_mes = A.id_mes AND conceptos.id_contrato = A.id_contrato
		GROUP BY A.id_mes,A.id_contrato
		");
		*/

		/*
		// Consultar usando PHQL
		$phql="
		SELECT
		id_mes,
		SUM(valor) costos_administrativos
		FROM
		matriz_ejecucion_financiera
		WHERE
		id_contrato='4600063322' AND
		id_categoria='6' AND
		id_ano='2016'
		GROUP BY id_mes
		UNION ALL SELECT
		id_mes,0
		FROM
		mes
		WHERE
		id_mes NOT IN (
		SELECT id_mes FROM matriz_ejecucion_financiera GROUP BY id_mes
		)
		ORDER BY 1
		";
		$query = new Query($phql, $this->getDI());
		$cat_6 = $query->execute();
		*/


		//Query para llevar los datos del contrato
		$infocontrato = ContratoXSede::findFirst( " id_contrato='$id_contrato' ");

		//Query para mostrar los ajustes por mes (solo para los interventores)
		$detalle_ajustes = MatrizAjuste::find(array(	"id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='7' ", 'order' => 'id_concepto,id_mes' ));
		if (count($detalle_ajustes) == 0) {
			//$this->flash->error("Mensaje de Error");
			$detalle_ajustes = null;
		}

		//Sumatorias de las categorias
		$sum_conceptos = MatrizEjecucionFinanciera::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria IN (2,3,4,5,6) ", 'column' => 'valor'));
		if (count($sum_conceptos) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_conceptos = null;
		}

		$sum_rh = MatrizEjecucionRh::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='1' ", 'column' => 'valor_total_ejecutado'));
		if (count($sum_rh) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_rh = null;
		}

		$sum_ajustes = MatrizAjuste::sum(array("id_contrato='$id_contrato' AND id_ano='$id_ano' AND id_categoria='7' ", 'column' => 'valor_ajuste'));
		if (count($sum_ajustes) == 0) {
			//$this->flash->error("Mensaje de Error");
			$sum_ajustes = null;
		}


		$this->view->querycontratos = $querycontratos;
		$this->view->anos = $anos;
		$this->view->id_contrato = $id_contrato;
		$this->view->id_ano = $id_ano;
		$this->view->infocontrato = $infocontrato;
		$this->view->meses = $meses;
		$this->view->query1 = $query1;
		$this->view->query_ajuste_RH = $query_ajuste_RH;
		$this->view->query_total_RH = $query_total_RH;
		$this->view->query2 = $query2;
		$this->view->query_ajuste_Dotacion = $query_ajuste_Dotacion;
		$this->view->query_total_Dotacion = $query_total_Dotacion;
		$this->view->query3 = $query3;
		$this->view->query_ajuste_Servicios = $query_ajuste_Servicios;
		$this->view->query_total_Servicios = $query_total_Servicios;
		$this->view->query4 = $query4;
		$this->view->query_ajuste_Material_D = $query_ajuste_Material_D;
		$this->view->query_total_Material_D = $query_total_Material_D;
		$this->view->query5 = $query5;
		$this->view->query_ajuste_Alimentacion = $query_ajuste_Alimentacion;
		$this->view->query_total_Alimentacion = $query_total_Alimentacion;
		$this->view->query6 = $query6;
		$this->view->query_ajuste_Costos = $query_ajuste_Costos;
		$this->view->query_total_Costos = $query_total_Costos;
		$this->view->query7 = $query7;
		$this->view->querytotales_sinajustes = $querytotales_sinajustes;
		$this->view->querytotales = $querytotales;
		$this->view->detalle_ajustes = $detalle_ajustes;
		$this->view->totales = $sum_conceptos+$sum_rh+$sum_ajustes;
		$this->view->usuario = $usuario;

		//$this->assets
		//->addJs('js/filtros-tablesorter.min.js');

	}




}
