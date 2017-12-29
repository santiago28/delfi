<?php

use Phalcon\Mvc\User\Component;

/**
 * Conversiones
 *
 * Conversión de caracteres de diferentes tipos
 */
class Conversiones extends Component
{

	/**
	 * multipleupdate
	 * @param $tabla String
	 * @param $elementos Array of Arrays
	 * @param $id_columna
	 *
	 * El array $elementos debe de tener el siguiente formato:
	 * $elementos = array ("id_columna" => array (id1, id2, id3...), "nombre_col2" => array(elemento1, elemento2, elemento3...));
	 * NOTA: El primer campo debe de ser el id de la tabla el resto pueden ser arrays o valores individuales
	 * @return string
	 * Produce un string similar a este:
	 * UPDATE categories SET
	 *	    	display_order = CASE id
	 *    	WHEN 1 THEN 32
	 *    	WHEN 2 THEN 33
	 *    	WHEN 3 THEN 34
	 *    	END,
	 *    	title = CASE id
	 *    	WHEN 1 THEN 'New Title 1'
	 *    	WHEN 2 THEN 'New Title 2'
	 *    	WHEN 3 THEN 'New Title 3'
	 *    	END
	 *    	WHERE id IN (1,2,3)
	 * @author Julián Camilo Marín Sánchez
	 */

	public function multipleupdate($tabla, $elementos, $id_columna){
		$sql = "";
		$sql .= "UPDATE $tabla SET ";
		for($i = 1; $i < count($elementos); $i++){
			$sql .= array_keys($elementos)[$i] . " = CASE " . $id_columna;
			$j = 0;
			if(is_array($elementos[array_keys($elementos)[$i]])){
				foreach($elementos[array_keys($elementos)[$i]] as $row){
					$sql .= " WHEN " . $elementos[array_keys($elementos)[0]][$j] . " THEN '" . $row . "'";
					$j++;
				}
			} else {
				foreach($elementos[array_keys($elementos)[0]] as $row){
					$sql .= " WHEN " . $row . " THEN '" . $elementos[array_keys($elementos)[$i]] . "'";
				}
			}
			$sql .= " END, ";
		}
		//Eliminamos la última coma
		$sql = substr($sql, 0, -2);
		$sql .= " WHERE " . $id_columna . " IN (" . implode(',', $elementos[array_keys($elementos)[0]]) . ")";
		return $sql;
	}

	/**
	 * multipleinsert
	 * @param $tabla String
	 * @param $elementos Array in Array
	 *
	 * @return string
	 * NOTA: El primer elemento debe de ser Array
	 * Produce un string similar a este:
	 * 	INSERT INTO example
	 *  (example_id, name, value, other_value)
	 *  VALUES
	 *	  (100, 'Name 1', 'Value 1', 'Other 1'),
	 *	  (101, 'Name 2', 'Value 2', 'Other 2'),
	 *	  (102, 'Name 3', 'Value 3', 'Other 3'),
	 *	  (103, 'Name 4', 'Value 4', 'Other 4');
	 * @author Julián Camilo Marín Sánchez
	 */

	public function multipleinsert($tabla, $elementos){
		$sql = "REPLACE INTO $tabla (".implode(",", array_keys($elementos)).") VALUES ";
		$i = 0;
		foreach($elementos[array_keys($elementos)[0]] as $row){
			$array = array();
			foreach(array_keys($elementos) as $row){
				if(is_array($elementos[$row])){
					$array[] = "'".$elementos[$row][$i]."'";
				} else {
					$array[] = "'".$elementos[$row]."'";
				}

			}
			$sql .= "(".implode(",", $array)."),";
			$i++;
		}
		return substr($sql, 0, -1);
	}

	/**
	 * multipledelete
	 * @param $tabla String
	 * @param id_columna String
	 * @param $elementos Array
	 *
	 * El parámetro $elementoso debe de enviarse en string separado por comas
	 * @return string
	 * @author Julián Camilo Marín Sánchez
	 */

	public function multipledelete($tabla, $id_columna, $elementos){
		return "DELETE FROM $tabla WHERE $id_columna IN (" . $elementos . ")";
	}


}
