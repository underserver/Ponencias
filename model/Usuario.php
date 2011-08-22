<?php
class Usuario{
	
	private $id;
	private $nombre;
	private $apellidos;
	private $correo;
	private $alias;
	private $password;
	private $tipo;
	private $fechaNacimiento;
	private $telefono;
	private $direccion;
	
	public function __construct($row = NULL){
		if( $row != NULL ){
			$this->id = $row["usuario_id"];
			$this->nombre = $row["usuario_nombre"];
			$this->apellidos = $row["usuario_apellidos"];
			$this->correo = $row["usuario_correo"];
			$this->alias = $row["usuario_alias"];
			$this->password = $row["usuario_password"];
			$this->tipo = $row["usuario_tipo"];
			$this->fechaNacimiento = $row["usuario_nacimiento"];
			$this->telefono = $row["usuario_telefono"];
			$this->direccion = $row["usuario_direccion"];
		}
	}
	
	public function setId($id){ $this->id = $id; }
	public function setNombre($nombre){ $this->nombre = $nombre; }
	public function setApellidos($apellidos){ $this->apellidos = $apellidos; }
	public function setCorreo($correo){ $this->correo = $correo; }
	public function setAlias($alias){ $this->alias = $alias; }
	public function setPassword($password){ $this->password = $password; }
	public function setTipo($tipo){ $this->tipo = $tipo; }
	public function setFechaNacimiento($fechaNacimiento){ $this->fechaNacimiento = $fechaNacimiento; }
	public function setTelefono($telefono){ $this->telefono = $telefono; }
	public function setDireccion($direccion){ $this->direccion = $direccion; }
	
	public function getId(){ return $id; }
	public function getNombre(){ return $nombre; }
	public function getApellidos(){ return $apellidos; }
	public function getCorreo(){ return $correo; }
	public function getAlias(){ return $alias; }
	public function getPassword(){ return $password; }
	public function getTipo(){ return $tipo; }
	public function getFechaNacimiento(){ return $fechaNacimiento; }
	public function getTelefono(){ return $telefono; }
	public function getDireccion(){ return $direccion; }
	
}
?>