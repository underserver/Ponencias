<?php
include_once "../model/Evaluacion.php";
class EvaluacionDao implements Dao{
	
	public static function deleteAll($evaluaciones){
		foreach( $evaluaciones as $evaluacion ){
			try{
				delete($evaluacion);
			}catch(Exception $e){}
		}
	}
	
	public static function save($evaluacion){
		try{
			$sql  = "insert into evaluaciones(evaluacion_calificacion, evaluacion_dictamen, evaluacion_fecha, evaluacion_observaciones, ponencia_id, evaluador_id) ";
		  	$sql .= "values('$evaluacion->getCalificacion()','$evaluacion->getDictamen()' ";
		 	$sql .= ",'$evaluacion->getFecha()','$evaluacion->getObservaciones()'";
		 	$sql .= ",$evaluacion->getPonencia()->getId(),$evaluacion->getEvaluador()->getId());";
			
			$db->query($sql);
		}catch(Exception $e){
    		throw $e;
    	}
	}
	
	public static function update($evaluacion){
		try{
			$sql  = "update evaluaciones set";
		  	$sql .= "       evaluacion_calificacion = '$evaluacion->getCalificacion()',";
		 	$sql .= "       evaluacion_dictamen = '$evaluacion->getDictamen()',";
			$sql .= "       evaluacion_fecha = '$evaluacion->getFecha()',";
			$sql .= "       evaluacion_observaciones = '$evaluacion->getObservaciones()',";
			$sql .= "       ponencia_id = $evaluacion->getPonencia()->getId(),";
			$sql .= "       evaluador_id = $evaluacion->getEvaluador()->getId()";
			$sql .= " where evaluacion_id=$evaluacion->getId()";
			
			$db->query($sql);
		}catch(Exception $e){
    		throw $e;
    	}
	}
	
    public static function persist($evaluacion){
    	if( !isset($evaluacion->getId()) ){
			save($evaluacion);
		}else{
			update($evaluacion);
		}
    } 
	
    public static function delete($evaluacion){
    	try {
    		$db->query("delete from evaluaciones where evaluacion_id=$evaluacion->getId()");
    	}catch(Exception $e){
    		throw $e;
    	}
    }
	
    public static function findByQuery($query){
    	$evaluaciones = array();
    	try{
	    	$rows = $db->get_results( "select * from evaluaciones where $query" );
			foreach( $rows as $row ){
				$evaluaciones[] = new Evaluacion($row);
			}
		}catch(Exception $e){
    		throw $e;
    	}
		return $evaluaciones;
    } 
	
    public static function merge($evaluacion){
    	echo "Merge [Evaluacion]: Not Implemented";
    }
	
    public static function findAll(){
    	$evaluaciones = array();
    	try{
    		$evaluaciones = findByQuery( "1=1" );
		}catch(Exception $e){
    		throw $e;
    	}
		return $evaluaciones;
    }
	
    public static function findById($id){
    	try{
	    	$row = $db->get_results( "select * from evaluaciones where evaluacion_id=$id" );
			return new Evaluacion($row);
		}catch(Exception $e){
    		throw $e;
    	}
    }
}
?>