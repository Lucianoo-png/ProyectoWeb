<?php 
class Bitacora {
    private $no_bitacora;
    private $rfc;
    private $descripcion;
    private $fechayhora;
    private $estado;
    private $conexion;
   
    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function setNoBitacora($id) { $this->no_bitacora = $id; }
    public function getNoBitacora() { return $this->no_bitacora; }
    
    public function setRfc($rfc) { $this->rfc = $rfc; }
    public function getRfc() { return $this->rfc; }
    
    public function setDescripcion($desc) { $this->descripcion = $desc; }
    public function getDescripcion() { return $this->descripcion; }
    
    public function setFechaYHora($fecha) { $this->fechayhora = $fecha; }
    public function getFechaYHora() { return $this->fechayhora; }
    
    public function setEstado($est) { $this->estado = $est; }
    public function getEstado() { return $this->estado; }

    public function insertar() {
        $query = 'INSERT INTO "Veracruz".bitacora (rfc, descripcion, fechayhora, estado) 
                  VALUES (:rfc, :desc, NOW(), :est)';
        
        $params = [
            ":rfc" => $this->rfc,
            ":desc" => $this->descripcion,
            ":est" => $this->estado
        ];
        
        $stmt = $this->conexion->ejecutarConsulta($query, $params);
        return $stmt && $stmt->rowCount() > 0;
    }

    public function buscar($tabla, $opciones = []) {
        $select = $opciones['select'] ?? '*';
        $join = $opciones['join'] ?? '';
        $where = $opciones['where'] ?? '';
        $group = $opciones['group'] ?? '';
        $orderBy = $opciones['order'] ?? '';
        $limit = $opciones['limit'] ?? '';
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
        if ($limit != '') {
            $query .= ' LIMIT ' . $limit;
        }
        
        $resultado = $this->conexion->ejecutarConsulta($query, $params);
        return $resultado ? $resultado->fetchAll(PDO::FETCH_ASSOC) : [];
    }
}
?>