<?php
include_once "../model/Ponencia.php";
class PonenciaDao implements Dao{
	
	public static function deleteAll($ponencias){
		foreach( $ponencias as $ponencia ){
			try{
				delete($ponencia);
			}catch(Exception $e){}
		}
	}
	
	public static function save($ponencia){
		try{
			$sql  = "insert into ponencias(ponencia_titulo, ponencia_resumen, ponencia_archivo2, ponencia_archivo2, ponencia_estado, ponencia_observaciones, usuario_id, ponencia_fecha, ponencia_ejetematico, ponencia_sala, ponencia_hora) ";
		  	$sql .= "values('$ponencia->getTitulo()','$ponencia->getResumen()' ";
		 	$sql .= ",'$ponencia->getArchivoConNombres()','$ponencia->getArchivoSinNombres()'";
			$sql .= ",'$ponencia->getStatus()','$ponencia->getObservaciones()'";
			$sql .= ",'$ponencia->getPonente()->getId()','$ponencia->getFecha()'";
		 	$sql .= ",'$ponencia->getEjeTematico()','$ponencia->getSala()'";
		  	$sql .= ",'$ponencia->getHora()')";
			
			$db->query($sql);
		}catch(Exception $e){
    		throw $e;
    	}
	}
	
	public static function update($ponencia){
		try{
			$sql  = "update ponencias set";
		  	$sql .= "       ponencia_titulo = '$ponencia->getTitulo()',";
		 	$sql .= "       ponencia_resumen = '$ponencia->getResumen()',";
			$sql .= "       ponencia_archivo1 = '$ponencia->getArchivoConNombres()',";
			$sql .= "       ponencia_archivo2 = '$ponencia->getArchivoSinNombres()',";
			$sql .= "       ponencia_estado = '$ponencia->getStatus()',";
			$sql .= "       ponencia_observaciones = '$ponencia->getObservaciones()',";
			$sql .= "       usuario_id = '$ponencia->getPonente()->getId()',";
			$sql .= "       ponencia_fecha = '$ponencia->getFecha()',";
			$sql .= "       ponencia_ejetematico = '$ponencia->getEjeTematico()',";
			$sql .= "       ponencia_sala = '$ponencia->getSala()',";
			$sql .= "       usuario_hora = '$ponencia->getHora()'";
			$sql .= " where ponencia_id = $ponencia->getId()";
			
			$db->query($sql);
		}catch(Exception $e){
    		throw $e;
    	}
	}
	
    public static function persist($ponencia){
    	if( !isset($ponencia->getId()) ){
			save($ponencia);
		}else{
			update($ponencia);
		}
    } 
	
    public static function delete($ponencia){
    	try {
    		$db->query("delete from ponencias where ponencia_id=$ponencia->getId()");
    	}catch(Exception $e){
    		throw $e;
    	}
    }
	
    public static function findByQuery($query){
    	$ponencias = array();
    	try{
	    	$rows = $db->get_results( "select * from ponencias where $query" );
			foreach( $rows as $row ){
				$ponencias[] = new Ponencia($row);
			}
		}catch(Exception $e){
    		throw $e;
    	}
		return $ponencias;
    } 
	
    public static function merge($ponencia){
    	echo "Merge [Ponencia]: Not Implemented";
    }
	
    public static function findAll(){
    	$ponencias = array();
    	try{
    		$ponencias = findByQuery( "1=1" );
		}catch(Exception $e){
    		throw $e;
    	}
		return $ponencias;
    }
	
    public static function findById($id){
    	try{
	    	$row = $db->get_results( "select * from ponencias where ponencia_id=$id" );
			return new Ponencia($row);
		}catch(Exception $e){
    		throw $e;
    	}
    }
}
