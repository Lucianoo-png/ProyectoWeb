<?php 

class Empleado{
   private $rfc;
   private $nombre;
   private $apellidospama;
   private $correo;
   private $modalidad;
   private $empresa;
   private $telefono;
   private $tipousuario;
   private $contrasena;
   private $enlinea;
   private $ultimavez;
   private $estatus;
   private $conexion;
   
   public function __construct(){
        $this->conexion = new Conexion();
   }

   public function getRfc(){return $this->rfc;}

   public function setRfc($rfc){$this->rfc = $rfc;}

   public function getNombre(){return $this->nombre;}

   public function setNombre($nombre){$this->nombre = $nombre;}

   public function getApellidospama(){return $this->apellidospama;}

   public function setApellidospama($apellidospama){$this->apellidospama = $apellidospama;}

   public function getCorreo(){return $this->correo;}

   public function setCorreo($correo){$this->correo = $correo;}
 
   public function getModalidad(){return $this->modalidad;}

   public function setModalidad($modalidad){$this->modalidad = $modalidad;}

   public function getEmpresa(){return $this->empresa;}
 
   public function setEmpresa($empresa){$this->empresa = $empresa;}

   public function getTelefono(){return $this->telefono;}

   public function setTelefono($telefono){$this->telefono = $telefono;}

   public function getTipousuario(){return $this->tipousuario;}
 
   public function setTipousuario($tipousuario){$this->tipousuario = $tipousuario;}

   public function getContrasena(){return $this->contrasena;}

   public function setContrasena($contrasena){$this->contrasena = $contrasena;}

   public function getEnlinea(){return $this->enlinea;}

   public function setEnlinea($enlinea){$this->enlinea = $enlinea;}
 
   public function getUltimavez(){return $this->ultimavez;}
 
   public function setUltimavez($ultimavez){$this->ultimavez = $ultimavez;}

   public function getEstatus(){return $this->estatus;}

   public function setEstatus($estatus){$this->estatus = $estatus;}

   public function iniciarSesion(){
        $query = 'SELECT * FROM "Veracruz".empleado WHERE correo = :correo AND estatus=:estatus';
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

    public function createPassword($size){
        $word = "";
        $caracte="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $letter = 0;
        while($letter < $size){
            $word.=substr($caracte,rand(0,strlen($caracte)-1),1);
            $letter++;
        }//cierre while
        return $word;
    }

    public function reestablecerContra(){
        $query = 'UPDATE "Veracruz".empleado SET contrasena=:contrasena WHERE RFC=:rfc';
        $params = [
            ":contrasena" => md5($this->contrasena),
            ":rfc"=>$this->rfc
        ];
        $resultado = $this->conexion->ejecutarConsulta($query, $params);
        return $resultado->rowCount()==1;
    }

    public function insertar() {
        $query = 'INSERT INTO "Veracruz".empleado (rfc, nombre, apellidospama, correo, modalidad, empresa, telefono, tipousuario, contrasena, enlinea, estatus) 
                VALUES (:rfc, :nombre, :apellidospama, :correo, :modalidad, :empresa, :telefono, :tipousuario, :contrasena, :enlinea, :estatus)';
        $params = [
            ":rfc" => $this->rfc,
            ":nombre" => $this->nombre,
            ":apellidospama" => $this->apellidospama,
            ":correo" => $this->correo,
            ":modalidad" => $this->modalidad,
            ":empresa" => $this->empresa,
            ":telefono" => $this->telefono,
            ":tipousuario" => $this->tipousuario,
            ":contrasena" => md5($this->contrasena),
            ":enlinea" => $this->enlinea,
            ":estatus" => $this->estatus
        ];
        $resultado = $this->conexion->ejecutarConsulta($query, $params);
        return $resultado->rowCount() > 0;
    }

    public function editar(){
        $query = 'UPDATE "Veracruz".empleado SET nombre=:nombre, apellidospama=:apellidospama, correo=:correo, modalidad=:modalidad, empresa=:empresa, telefono=:telefono, tipousuario=:tipousuario WHERE rfc=:rfc';
        $params = [
            ":nombre" => $this->nombre,
            ":apellidospama" => $this->apellidospama,
            ":correo" => $this->correo,
            ":modalidad" => $this->modalidad,
            ":empresa" => $this->empresa,
            ":telefono" => $this->telefono,
            ":tipousuario" => $this->tipousuario,
            ":rfc" => $this->rfc
        ];
        $resultado = $this->conexion->ejecutarConsulta($query, $params);
        return $resultado->rowCount() > 0;
    }

    public function eliminar($borrar){
        $query = 'UPDATE "Veracruz".empleado SET estatus=:estatus WHERE rfc=:rfc';
        $params = [
            ":estatus"=>$borrar?'false':'true',
            ":rfc" => $this->rfc
        ];
        $resultado = $this->conexion->ejecutarConsulta($query, $params);
        return $resultado->rowCount() > 0;
    }

    public function actualizarUltimaVez($enlinea){
        if($enlinea){
            $query = 'UPDATE "Veracruz".empleado SET enlinea=:enlinea, ultimavez=:ultimavez WHERE RFC=:rfc';
            $params = [
                ":enlinea"=>'true',
                ":ultimavez"=>date('Y-m-d H:i:s'),
                ":rfc"=>$_SESSION["RFC"]
            ];
        }
        else{
            $query = 'UPDATE "Veracruz".empleado SET enlinea=:enlinea, ultimavez=:ultimavez WHERE RFC=:rfc';
            $params = [
                ":enlinea"=>'false',
                ":ultimavez"=>date('Y-m-d H:i:s'),
                ":rfc"=>$_SESSION["RFC"]
            ];
        }
        $resultado = $this->conexion->ejecutarConsulta($query, $params);
        return $resultado->rowCount() > 0;
        
    }
}

?>