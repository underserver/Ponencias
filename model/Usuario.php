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
			$this->id = $row->usuario_id;
			$this->nombre = $row->usuario_nombre;
			$this->apellidos = $row->usuario_apellidos;
			$this->correo = $row->usuario_correo;
			$this->alias = $row->usuario_alias;
			$this->password = $row->usuario_password;
			$this->tipo = $row->usuario_tipo;
			$this->fechaNacimiento = $row->usuario_nacimiento;
			$this->telefono = $row->usuario_telefono;
			$this->direccion = $row->usuario_direccion;
		} else {
			$this->id = 0;
			$this->alias = 'Usuario';
			$this->tipo = UsuarioType::$PUBLICO;
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
	
	public function getId(){ return $this->id; }
	public function getNombre(){ return $this->nombre; }
	public function getApellidos(){ return $this->apellidos; }
	public function getCorreo(){ return $this->correo; }
	public function getAlias(){ return $this->alias; }
	public function getPassword(){ return $this->password; }
	public function getTipo(){ return $this->tipo; }
	public function getFechaNacimiento(){ return $this->fechaNacimiento; }
	public function getTelefono(){ return $this->telefono; }
	public function getDireccion(){ return $this->direccion; }
	public function isWired(){ return (!empty($this->id) && $this->id > 0); }
}
?>