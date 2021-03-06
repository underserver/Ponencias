<?php
include_once "../model/Evaluacion.php";
class EvaluacionDao implements Dao{
	
	public static function deleteAll($evaluaciones){
		foreach( $evaluaciones as $evaluacion ){
			try{
				delete($evaluacion);
			}catch(TransactionException $te){
				throw $te;
			}
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
    		throw new TransactionExcepion($e->getMessage(), $evaluacion, TransactionExcepion::SAVE_CODE, $e);
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
    		throw new TransactionExcepion($e->getMessage(), $evaluacion, TransactionExcepion::UPDATE_CODE, $e);
    	}
	}
	
    public static function persist($evaluacion){
       try{
        	if( !isset($evaluacion->getId()) ){
    			save($evaluacion);
    		}else{
    			update($evaluacion);
    		}
		}catch(TransactionException $te){
		  throw $te;
		}
    } 
	
    public static function delete($evaluacion){
    	try {
    		$db->query("delete from evaluaciones where evaluacion_id=$evaluacion->getId()");
    	}catch(Exception $e){
    		throw new TransactionExcepion($e->getMessage(), $evaluacion, TransactionExcepion::DELETE_CODE, $e);
    	}
    }
	
    public static function findByQuery($query){
    	$evaluaciones = array();
    	$sql = "select * from evaluaciones where $query";
    	try{
	    	$rows = $db->get_results( $sql );
			foreach( $rows as $row ){
				$evaluaciones[] = new Evaluacion($row);
			}
		}catch(Exception $e){
    		throw new QueryException($e->getMessage(), $sql, 0, $e);
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
		}catch(QueryException $qe){
    		throw $qe;
    	}
		return $evaluaciones;
    }
	
    public static function findById($id){
       $sql = "select * from evaluaciones where evaluacion_id=$id";
       $evaluacion = new Evaluacion();
    	try{
	    	$row = $db->get_results( $sql );
			$evaluacion = new Evaluacion($row);
		}catch(Exception $e){
    		throw new QueryException($e->getMessage(), $sql, 0, $e);
    	}
    	return $evaluacion;
    }
}
?>