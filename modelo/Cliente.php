<?php
class Cliente {
    private $no_cliente;
    private $telefono;
    private $nombre;
    private $apellidospama;
    private $correo;
    private $contrasena;
    private $estatus;
    private $origen;
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    // Setters y Getters
    public function setTelefono($t) { $this->telefono = $t; }
    public function getTelefono() { return $this->telefono; }
    public function setNombre($n) { $this->nombre = $n; }
    public function getNombre() { return $this->nombre; }
    public function setApellidospama($a) { $this->apellidospama = $a; }
    public function getApellidospama() { return $this->apellidospama; }
    public function setCorreo($c) { $this->correo = $c; }
    public function getCorreo() { return $this->correo; }
    public function setContrasena($c) { $this->contrasena = $c; }
    public function getContrasena() { return $this->contrasena; }
    public function setOrigen($o) { $this->origen = $o; }
    public function getOrigen() { return $this->origen; }

    public function iniciarSesion(){
        $query = 'SELECT * FROM "Veracruz".cliente WHERE correo = :correo AND estatus=:estatus';
        $params = [
            ":correo" => $this->correo,
            ":estatus"=>'true'
        ];
        $resultado = $this->conexion->ejecutarConsulta($query, $params);
        $cuenta = $resultado->fetchAll(PDO::FETCH_ASSOC);
        if (!$cuenta) {
            return false;
        }
        if (
            md5($this->contrasena) ===
            $cuenta[0]["contrasena"]
        ) {
            return $cuenta;
        }
        return false;
    }

    public function actualizarDatos(){
        $query = 'UPDATE "Veracruz".cliente SET nombre=:nombre, apellidospama=:ape, telefono=:telefono, correo=:correo WHERE no_cliente=:no_cliente';
        $params = [
            ":nombre"=>$this->nombre,
            ":ape"=>$this->apellidospama,
            ":telefono"=>$this->telefono,
            ":correo"=>$this->correo,
            ":no_cliente"=>$_SESSION["NoCliente"]
        ];
        return $this->conexion->ejecutarConsulta($query, $params)->rowCount()>0;
    }

    public function actualizarContra(){
        $query = 'UPDATE "Veracruz".cliente SET contrasena=:contra WHERE no_cliente=:no_cliente';
        $params = [
            ":contra"=>md5($this->contrasena),
            ":no_cliente"=>$_SESSION["NoCliente"]
        ];
        return $this->conexion->ejecutarConsulta($query, $params)->rowCount()>0;
    }

    public function buscar($tabla, $opciones = []) {
        
        $select = $opciones['select'] ?? '*';
        $join = $opciones['join'] ?? '';
        $where = $opciones['where'] ?? '';
        $group = $opciones['group'] ?? '';
        $orderBy = $opciones['order'] ?? '';
        $params = $opciones['params'] ?? [];
        
        $query = 'SELECT '.$select.' FROM '.$tabla.'';

        if ($join != '') {
            $query .= ' '. $join;
        }

        if($where != ''){
            $query .= ' WHERE ' . $where;
        }

        if($group != ''){
            $query .= ' GROUP BY ' . $group;
        }

        if ($orderBy != '') {
            $query .= ' ORDER BY ' . $orderBy;
        }
        $resultado = $this->conexion->ejecutarConsulta($query, $params);

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    
    }

    public function insertar() {
        $query = 'INSERT INTO "Veracruz".cliente (telefono, nombre, apellidospama, correo, contrasena, estatus, origen) 
                  VALUES (:tel, :nom, :ape, :cor, :con, :est, :ori) RETURNING no_cliente';
        $params = [
            ":tel" => $this->telefono,
            ":nom" => $this->nombre,
            ":ape" => $this->apellidospama,
            ":cor" => $this->correo,
            ":con" => $this->contrasena,
            ":est" => 'true',
            ":ori" => $this->origen
        ];
        
        $stmt = $this->conexion->ejecutarConsulta($query, $params);
        if ($stmt) {
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            return $fila['no_cliente'] ?? false;
        }
        return false;
    }

    public function insertarDireccion($no_cliente, $datos) {
        $query = 'INSERT INTO "Veracruz".clientedireccion (no_cliente, calle_numero, colonia, ciudad, cp, estado, pais) 
                  VALUES (:no_cli, :calle, :col, :ciu, :cp, :est, :pais)';
        $params = [
            ":no_cli" => $no_cliente,
            ":calle"  => empty($datos['calle_numero']) ? null : trim($datos['calle_numero']),
            ":col"    => empty($datos['colonia']) ? null : trim($datos['colonia']),
            ":ciu"    => empty($datos['ciudad']) ? null : trim($datos['ciudad']),
            ":cp"     => empty($datos['cp']) ? null : trim($datos['cp']),
            ":est"    => empty($datos['estado']) ? null : trim($datos['estado']),
            ":pais"   => empty($datos['pais']) ? 'México' : trim($datos['pais'])
        ];
        return $this->conexion->ejecutarConsulta($query, $params)->rowCount() > 0;
    }

    public function asociarCarritoAnonimo($no_cliente, $session_id) {
        $query = 'UPDATE "Veracruz".carrito_reserva 
                SET no_cliente = ? 
                WHERE session_id = ? AND expiracion > NOW()';
        return $this->conexion->ejecutarConsulta($query, [$no_cliente, $session_id]);
    }

    public function eliminarDireccion($direccion){
        $query = 'DELETE FROM "Veracruz".clientedireccion WHERE no_dirección=:dire'; 
        $params = [
            ":dire" => $direccion,
        ];
        return $this->conexion->ejecutarConsulta($query, $params)->rowCount() > 0;  
    }

    public function actualizarDireccion($no_direccion, $no_cliente, $datos) {
        $query = 'UPDATE "Veracruz".clientedireccion 
                  SET calle_numero = :calle, 
                      colonia = :col, 
                      ciudad = :ciu, 
                      cp = :cp, 
                      estado = :est, 
                      pais = :pais
                  WHERE no_dirección = :no_dir AND no_cliente = :no_cli';
                  
        $params = [
            ":calle"  => empty($datos['calle_numero']) ? null : trim($datos['calle_numero']),
            ":col"    => empty($datos['colonia']) ? null : trim($datos['colonia']),
            ":ciu"    => empty($datos['ciudad']) ? null : trim($datos['ciudad']),
            ":cp"     => empty($datos['cp']) ? null : trim($datos['cp']),
            ":est"    => empty($datos['estado']) ? null : trim($datos['estado']),
            ":pais"   => empty($datos['pais']) ? 'México' : trim($datos['pais']),
            ":no_dir" => $no_direccion,
            ":no_cli" => $no_cliente
        ];
        
        return $this->conexion->ejecutarConsulta($query, $params)->rowCount() > 0;
    }
}
?>