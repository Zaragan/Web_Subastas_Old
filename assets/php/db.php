<?php

class Database {
    private $db_data = ['host' => 'localhost','username' => 'root','password' => '','db' => 'proyectos'];
	private $conexion;
    
    public function __construct(){
        $this->conexion = new mysqli($this->db_data['host'], $this->db_data['username'], $this->db_data['password'], $this->db_data['db']);
        $this->conexion->set_charset("utf8");
        if ($this->conexion->connect_errno) {
            echo "Lo sentimos, este sitio web está experimentando problemas.";
            exit;
        }   
    }

	public function filtrar($valor){
		$valor = stripslashes($valor);
		$valor = ltrim($valor);
		$valor = rtrim($valor);
		return $valor;
	}

    public function setQuery($query){
		return mysqli_query($this->conexion, $query);
	}

    public function __destruct(){
        @mysqli_close($this->conexion);
    }
};	
?>
