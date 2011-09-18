<?php
include_once dirname(__FILE__)."/Dao.php";
include_once dirname(__FILE__)."/../model/Ponencia.php";

class PonenciaDao implements Dao{
	
	public static function deleteAll($ponencias){
		foreach( $ponencias as $ponencia ){
			try{
				PonenciaDao::delete($ponencia);
			}catch(TransactionException $te){
				throw $te;
			}
		}
	}
	
	public static function save($ponencia){
		require dirname(__FILE__)."/../includes/db.php";
		
		try{
			$ponente = $ponencia->getPonente();
			$sql  = "insert into ponencias(ponencia_titulo, ponencia_resumen, ponencia_archivo1, ponencia_archivo2, ponencia_estado, ponencia_observaciones, usuario_id, ponencia_fecha, ponencia_ejetematico, ponencia_sala, ponencia_hora) ";
		  	$sql .= "values('$ponencia->getTitulo()','$ponencia->getResumen()' ";
		 	$sql .= ",'$ponencia->getArchivoConNombres()','$ponencia->getArchivoSinNombres()'";
			$sql .= ",'$ponencia->getStatus()','$ponencia->getObservaciones()'";
			$sql .= ",'$ponente->getId()','$ponencia->getFecha()'";
		 	$sql .= ",'$ponencia->getEjeTematico()','$ponencia->getSala()'";
		  	$sql .= ",'$ponencia->getHora()')";
			
			$db->query($sql);
		}catch(Exception $e){
    			throw new TransactionExcepion($e->getMessage(), $ponencia, TransactionExcepion::SAVE_CODE, $e);
    		}
	}
	
	public static function update($ponencia){
		require dirname(__FILE__)."/../includes/db.php";
		
		try{
			$ponente = $ponencia->getPonente();
			$sql  = "update ponencias set";
		  	$sql .= "       ponencia_titulo = '$ponencia->getTitulo()',";
		 	$sql .= "       ponencia_resumen = '$ponencia->getResumen()',";
			$sql .= "       ponencia_archivo1 = '$ponencia->getArchivoConNombres()',";
			$sql .= "       ponencia_archivo2 = '$ponencia->getArchivoSinNombres()',";
			$sql .= "       ponencia_estado = '$ponencia->getStatus()',";
			$sql .= "       ponencia_observaciones = '$ponencia->getObservaciones()',";
			$sql .= "       usuario_id = '$ponente->getId()',";
			$sql .= "       ponencia_fecha = '$ponencia->getFecha()',";
			$sql .= "       ponencia_ejetematico = '$ponencia->getEjeTematico()',";
			$sql .= "       ponencia_sala = '$ponencia->getSala()',";
			$sql .= "       usuario_hora = '$ponencia->getHora()'";
			$sql .= " where ponencia_id = $ponencia->getId()";
			
			$db->query($sql);
		}catch(Exception $e){
    			throw new TransactionExcepion($e->getMessage(), $ponencia, TransactionExcepion::UPDATE_CODE, $e);
    		}
	}
	
	public static function persist($ponencia){
		try{
			$id = $ponencia->getId();
			if( !empty($id) ){
				PonenciaDao::save($ponencia);
			}else{
				PonenciaDao::update($ponencia);
			}
		}catch(TransactionException $te){
			throw $te;
		}
	} 
	
	public static function delete($ponencia){
		require dirname(__FILE__)."/../includes/db.php";
		
		try {
			$id = $ponencia->getId();
			$db->query("delete from ponencias where ponencia_id=$id");
		}catch(Exception $e){
			throw new TransactionExcepion($e->getMessage(), $ponencia, TransactionExcepion::DELETE_CODE, $e);
		}
	}
	
	public static function findByQuery($query){
		require dirname(__FILE__)."/../includes/db.php";

		$ponencias = array();
		$sql = "select * from ponencias where $query";
		try{
			$rows = $db->get_results( $sql );
			if( $rows == NULL ){
	    			return array();
			}
			foreach( $rows as $row ){
				$ponencias[] = new Ponencia($row);
			}
		}catch(Exception $e){
			throw new QueryException($e->getMessage(), $sql, 0, $e);
		}
		return $ponencias;
	} 
	
	public static function merge($ponencia){
		echo "Merge [Ponencia]: Not Implemented";
	}
	
	public static function findAll(){
		$ponencias = array();
		try{
			$ponencias = PonenciaDao::findByQuery( "1=1" );
		}catch(QueryException $qe){
			throw $qe;
		}
		return $ponencias;
	}
	
	public static function findById($id){
		require dirname(__FILE__)."/../includes/db.php";
		
		$sql = "select * from ponencias where ponencia_id=$id";
		$ponencia = new Ponencia();
		try{
			$row = $db->get_row( $sql );
			$ponencia = new Ponencia($row);
		}catch(Exception $e){
			throw new QueryException($e->getMessage(), $sql, 0, $e);
		}
		return $ponencia;
	}
}
