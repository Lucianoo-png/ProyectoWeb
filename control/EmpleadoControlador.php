<?php

class EmpleadoControlador{
    private Empleado $empleado;
    private BitacoraControlador $log;

    public function __construct(){
        $this->empleado = new Empleado();
        $this->log = new BitacoraControlador();
    }

    public function getEmpleado(){return $this->empleado;}
    public function getBitacora(){return $this->log;}

    public function validarSesion($datos = array()){
        if(trim($datos[0]) == '' || trim($datos[1])==''){
            return ["error","Ingrese su correo y contraseña."];
        }

        $this->empleado->setCorreo(mb_strtolower(trim($datos[0])));
        $this->empleado->setContrasena(trim($datos[1]));

        $datos = $this->empleado->iniciarSesion();

        if($datos==false){
            return array("error","Correo y/o contraseña incorrectos.");
        }
        else{
            $_SESSION['RFC'] = $datos[0]['rfc'];
            $_SESSION['Tipo'] = $datos[0]['tipousuario'];
            $this->empleado->actualizarUltimaVez(true);
            $usuario = '';
            if($_SESSION["Tipo"]=='A'){$usuario='Administrador';}else if($_SESSION["Tipo"]=='E'){$usuario='Vendedor';}else if($_SESSION["Tipo"]=='R'){$usuario='Repartidor';}else if($_SESSION["Tipo"]=='P'){$usuario = 'Proveedor';};
            $this->log->registrarLog($_SESSION['RFC'], "Inicio de sesión exitoso (".$usuario.")", "C");//listo
            if($datos[0]['tipousuario']=='A'){
                header('location:/proyectoweb/admin/inicio');
            }
            else if($datos[0]['tipousuario']=='E'){
                header('location:/proyectoweb/vendedor/inicio');
            }
            else if($datos[0]['tipousuario']=='R'){
                header('location:/proyectoweb/repartidor/inicio');
            }
            else if($datos[0]['tipousuario']=='P'){
                header('location:/proyectoweb/proveedor/inicio');
            }
        }
    }

    public function recuperarCuenta($datos = array()){
        if(trim($datos[0]) == ''){
            return ["error","Ingrese su correo para recuperación."];
        }

        $this->empleado->setCorreo(mb_strtolower(trim($datos[0])));

        $existe = $this->empleado->buscar('"Veracruz".empleado',["where"=>"correo='".$this->empleado->getCorreo()."'"]);
        if(count($existe)==1){
            $nombre = $existe[0]['nombre']." ".$existe[0]['apellidospama'];
            $nuevaContra=  $this->getEmpleado()->createPassword(5);
            $body = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:\'Segoe UI\',Helvetica,Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border-radius:12px; overflow:hidden;
                           box-shadow:0 4px 15px rgba(0,0,0,0.1);">

                <tr>
                    <td style="background-color:#002347; padding:30px;
                               text-align:center; border-bottom:5px solid #008C9E;">
                        <h1 style="color:#ffffff; margin:0; font-size:28px; font-weight:700;">
                            Luchanos<span style="color:#008C9E;">Corp</span>
                        </h1>
                        <p style="color:#a8b2bd; margin-top:5px; margin-bottom:0; font-size:14px;">
                            Recuperación de Cuenta
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:40px;">

                        <p style="color:#333333; font-size:18px; margin-top:0;">
                            Hola, <strong>'.$nombre.'</strong>
                        </p>

                        <p style="color:#666666; font-size:15px; line-height:1.6;">
                            Hemos recibido una solicitud para restablecer el acceso a tu cuenta en <strong>LuchanosCorp</strong>. A continuación, te proporcionamos tus nuevas credenciales generadas por el sistema:
                        </p>

                        <div style="background-color:#f0f8f9;
                                    border:1px solid #c2e2e6;
                                    border-left:6px solid #008C9E;
                                    border-radius:6px;
                                    padding:20px;
                                    margin:30px 0;">

                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding-bottom:12px;">
                                        <span style="display:block;
                                                     font-size:12px;
                                                     color:#008C9E;
                                                     font-weight:bold;
                                                     text-transform:uppercase;
                                                     letter-spacing:1px;">
                                            Correo
                                        </span>
                                        <span style="display:block;
                                                     font-size:18px;
                                                     color:#333333;
                                                     font-weight:600;">
                                            '.mb_strtolower(trim($datos[0])).'
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span style="display:block;
                                                     font-size:12px;
                                                     color:#008C9E;
                                                     font-weight:bold;
                                                     text-transform:uppercase;
                                                     letter-spacing:1px;">
                                            Nueva Contraseña
                                        </span>
                                        <span style="display:inline-block;
                                                     font-size:24px;
                                                     color:#002347;
                                                     font-weight:800;
                                                     letter-spacing:1px;
                                                     background-color:rgba(255,255,255,0.8);
                                                     padding:6px 12px;
                                                     border-radius:4px;
                                                     margin-top:6px;">
                                            '.$nuevaContra.'
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div style="text-align:center; margin-top:30px;">
                            <p style="font-size:12px; color:#999999; margin-bottom:0; margin-top:15px;">
                                Si no solicitaste este cambio, por favor contacta inmediatamente a soporte@luchanoscorp.com.
                            </p>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td style="background-color:#002347;
                               color:#ffffff;
                               padding:15px;
                               text-align:center;
                               font-size:12px;">
                        &copy; '.date("Y").' LuchanosCorp. Todos los derechos reservados.
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>';

        try{
                    if(sent_email(
                                'L22020742@veracruz.tecnm.mx',
                                "Soporte técnico Luchanos Corp",
                                $this->empleado->getCorreo(),
                                $nombre,
                                'Contraseña reestablecida',
                                $body
                            )){
                                $this->getEmpleado()->setRfc($existe[0]["rfc"]);
                                $this->getEmpleado()->setContrasena($nuevaContra);
                            if($this->getEmpleado()->reestablecerContra()){
                                $this->log->registrarLog($existe[0]['rfc'], "Recuperación de cuenta exitosa", "C");
                                return ["exito","Contraseña reestablecida exitosamente, revisa tu bandeja de entrada o spam."];
                            }
                            else{
                                $this->log->registrarLog($existe[0]['rfc'], "Correo no enviado", "E");
                                return ["error","Ocurrió un error al enviar el correo electrónico. Intenta de nuevo."];
                            }
                    }
                    else{
                        $this->log->registrarLog($existe[0]['rfc'], "Correo no enviado", "E");
                        return ["error","Ocurrió un error al enviar el correo electrónico. Intenta de nuevo."];
                    }
                }
                catch(Exception $e){
                    $this->log->registrarLog($existe[0]['rfc'], "Correo no enviado", "E");
                    return ["error","Ocurrió un error al enviar el correo electrónico. Intenta de nuevo."];
                }

        }
        else{
            $this->log->registrarLog(null, "Usuario no encontrado con el correo: ".$this->empleado->getCorreo(), "E");
            return ["error","No existe ningún usuario con este correo ingresado."];
        }
    }

    public function generarRFC($nombre, $apellidos, $fecha_nacimiento) {
        $apellidos_arr = explode(' ', trim($apellidos));
        $paterno = mb_strtoupper($apellidos_arr[0] ?? 'X', 'UTF-8');
        $materno = mb_strtoupper($apellidos_arr[1] ?? 'X', 'UTF-8');
        $nombre_str = mb_strtoupper(explode(' ', trim($nombre))[0], 'UTF-8');
        preg_match_all('/[AEIOUÁÉÍÓÚ]/u', mb_substr($paterno, 1, null, 'UTF-8'), $matches);
        $primera_vocal_paterna = $matches[0][0] ?? 'X';
        $letras = mb_substr($paterno, 0, 1, 'UTF-8') . 
                  $primera_vocal_paterna . 
                  mb_substr($materno, 0, 1, 'UTF-8') . 
                  mb_substr($nombre_str, 0, 1, 'UTF-8');
        
        $fecha = date('ymd', strtotime($fecha_nacimiento));
        $homoclave = strtoupper(substr(md5(uniqid(rand(), true)), 0, 3));

        $rfc = $letras . $fecha . $homoclave;
        $rfc = str_replace(['Á','É','Í','Ó','Ú','Ñ'], ['A','E','I','O','U','X'], $rfc);
        
        return mb_substr($rfc, 0, 13, 'UTF-8');
    }

    public function eliminarPersonal($datos = array()){
        $this->empleado->setRfc($datos['rfc']);
        $this->empleado->eliminar(true);
        $nombre = $this->empleado->buscar('"Veracruz".empleado',["select"=>"CONCAT(nombre,' ',apellidospama) as nombre","where"=>"rfc='".$this->empleado->getRfc()."'"])[0]['nombre'];
        $this->log->registrarLog($_SESSION['RFC'], "Empleado ".$nombre."(".$datos['rfc'].") dado de baja", "C");
        return ["exito","Empleado eliminado correctamente"];
    }

    public function activarPersonal($datos = array()){
        $this->empleado->setRfc($datos['rfc']);
        $this->empleado->eliminar(false);
        $nombre = $this->empleado->buscar('"Veracruz".empleado',["select"=>"CONCAT(nombre,' ',apellidospama) as nombre","where"=>"rfc='".$this->empleado->getRfc()."'"])[0]['nombre'];
        $this->log->registrarLog($_SESSION['RFC'], "Empleado ".$nombre."(".$datos['rfc'].") reactivado", "C");
        return ["exito","Empleado activado correctamente"];
    }

    public function editarPersonal($datos = array()){
        if(trim($datos['nombre']) == '' || trim($datos['apellidos']) == '' || trim($datos['correo']) == '' || trim($datos['telefono']) == '' || !isset($datos['tipo_usuario'])) {
            return ["error", "Todos los campos obligatorios deben ser llenados."];
        }
        $modalidad = ($datos['tipo_usuario'] === 'R') ? 'E' : 'I';
        $empresa = ($datos['tipo_usuario'] === 'R' && isset($datos['empresa']) && trim($datos['empresa']) != '') ? trim($datos['empresa']) : 'LuchanosCorp';
        if($datos['tipo_usuario'] === 'R'){
            $empresa_limpia = trim($datos['empresa']);
            if($empresa_limpia == ''){
                return ["error", "Debes colocar la empresa a la que pertenece el repartidor."];
            }
            if(stripos($empresa_limpia, 'luchanos') !== false){
                return ["error", "El repartidor debe pertenecer a una empresa de paquetería externa (No puede ser LuchanosCorp)."];
            }
        }

        $this->empleado->setRfc(mb_strtoupper($datos['rfc']));
        $this->empleado->setNombre(trim(mb_strtoupper($datos['nombre'])));
        $this->empleado->setApellidospama(trim(mb_strtoupper($datos['apellidos'])));
        $this->empleado->setCorreo(mb_strtolower(trim(mb_strtolower($datos['correo']))));
        $this->empleado->setModalidad($modalidad);
        $this->empleado->setEmpresa(mb_strtoupper(trim($empresa)));
        $this->empleado->setTelefono(trim($datos['telefono']));
        $this->empleado->setTipousuario($datos['tipo_usuario']);
        $existe_correo = $this->empleado->buscar('"Veracruz".empleado',["where"=>"correo='".$this->empleado->getCorreo()."' AND rfc<>'".$this->empleado->getRfc()."'"]);
        if(count($existe_correo)>0){
            return ["error","Ya existe un usuario con este correo registrado."];
        }

        $existe_telefono = $this->empleado->buscar('"Veracruz".empleado',["where"=>"telefono='".$this->empleado->getTelefono()."' AND rfc<>'".$this->empleado->getRfc()."'"]);

        if(count($existe_telefono)>0){
            return ["error","Ya existe un usuario con este número telefónico registrado."];
        }

        if($this->empleado->editar()) {
            $this->log->registrarLog($_SESSION['RFC'], "Información de usuario ".($this->empleado->getNombre()." ".$this->empleado->getApellidospama())."(".$this->empleado->getRfc().") editada correctamente", "C");
            return ["exito", "Información del empleado editada exitosamente."];
        }
    }

    public function agregarPersonal($datos = array()) {
        if(trim($datos['nombre']) == '' || trim($datos['apellidos']) == '' || trim($datos['correo']) == '' || trim($datos['telefono']) == '' || trim($datos['fecha_nacimiento']) == '' || !isset($datos['tipo_usuario'])) {
            return ["error", "Todos los campos obligatorios deben ser llenados."];
        }

        $rfc = $this->generarRFC($datos['nombre'], $datos['apellidos'], $datos['fecha_nacimiento']);
        $modalidad = ($datos['tipo_usuario'] === 'R') ? 'E' : 'I';
        $empresa = ($datos['tipo_usuario'] === 'R' && isset($datos['empresa']) && trim($datos['empresa']) != '') ? trim($datos['empresa']) : 'LuchanosCorp';
        $password = $this->empleado->createPassword(5);

        if($datos['tipo_usuario'] === 'R'){
            $empresa_limpia = trim($datos['empresa']);
            if($empresa_limpia == ''){
                return ["error", "Debes colocar la empresa a la que pertenece el repartidor."];
            }
            if(stripos($empresa_limpia, 'luchanos') !== false){
                return ["error", "El repartidor debe pertenecer a una empresa de paquetería externa (No puede ser LuchanosCorp)."];
            }
        }



        $this->empleado->setRfc(mb_strtoupper($rfc));
        $this->empleado->setNombre(trim(mb_strtoupper($datos['nombre'])));
        $this->empleado->setApellidospama(trim(mb_strtoupper($datos['apellidos'])));
        $this->empleado->setCorreo(mb_strtolower(trim(mb_strtolower($datos['correo']))));
        $this->empleado->setModalidad($modalidad);
        $this->empleado->setEmpresa(mb_strtoupper(trim($empresa)));
        $this->empleado->setTelefono(trim($datos['telefono']));
        $this->empleado->setTipousuario($datos['tipo_usuario']);
        $this->empleado->setContrasena($password);
        $this->empleado->setEnlinea('false');
        $this->empleado->setEstatus('true');
        $existe_correo = $this->empleado->buscar('"Veracruz".empleado',["where"=>"correo='".$this->empleado->getCorreo()."'"]);
        if(count($existe_correo)>0){
            return ["error","Ya existe un usuario con este correo registrado."];
        }

        $existe_telefono = $this->empleado->buscar('"Veracruz".empleado',["where"=>"telefono='".$this->empleado->getTelefono()."'"]);

        if(count($existe_telefono)>0){
            return ["error","Ya existe un usuario con este número telefónico registrado."];
        }

        $fecha_nac = new DateTime($datos['fecha_nacimiento']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha_nac)->y;

            if ($edad < 18) {
                return ["error", "El empleado debe ser mayor de edad."];
            }
        $tipo_usuario = '';
        if($this->empleado->getTipousuario()=='A'){
            $tipo_usuario = 'Administrador';
        }
        else if($this->empleado->getTipousuario()=='E'){
            $tipo_usuario ='Vendedor';
        }
        else if($this->empleado->getTipousuario()=='P'){
            $tipo_usuario = 'Proveedor';
        }
        else{
            $tipo_usuario = 'Repartidor';
        }

        $body = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:\'Segoe UI\',Helvetica,Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border-radius:12px; overflow:hidden;
                           box-shadow:0 4px 15px rgba(0,0,0,0.1);">

                <tr>
                    <td style="background-color:#002347; padding:30px;
                               text-align:center; border-bottom:5px solid #008C9E;">
                        <h1 style="color:#ffffff; margin:0; font-size:28px; font-weight:700;">
                            Luchanos<span style="color:#008C9E;">Corp</span>
                        </h1>
                        <p style="color:#a8b2bd; margin-top:5px; margin-bottom:0; font-size:14px;">
                            Registro de Nuevo Usuario
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:40px;">

                        <p style="color:#333333; font-size:18px; margin-top:0;">
                            Hola, <strong>'.$this->empleado->getNombre()." ".$this->empleado->getApellidospama().'</strong>
                        </p>

                        <p style="color:#666666; font-size:15px; line-height:1.6;">
                            Te damos la bienvenida. Se ha creado una cuenta de acceso para ti en la plataforma de <strong>LuchanosCorp</strong> con el rol de <strong>'.$tipo_usuario.'</strong>. A continuación, te proporcionamos tus datos de registro y credenciales de acceso:
                        </p>

                        <div style="background-color:#f0f8f9;
                                    border:1px solid #c2e2e6;
                                    border-left:6px solid #008C9E;
                                    border-radius:6px;
                                    padding:20px;
                                    margin:30px 0;">

                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding-bottom:12px;">
                                        <span style="display:block;
                                                     font-size:12px;
                                                     color:#008C9E;
                                                     font-weight:bold;
                                                     text-transform:uppercase;
                                                     letter-spacing:1px;">
                                            RFC
                                        </span>
                                        <span style="display:block;
                                                     font-size:18px;
                                                     color:#333333;
                                                     font-weight:600;">
                                            '.$this->empleado->getRfc().'
                                        </span>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style="padding-bottom:12px;">
                                        <span style="display:block;
                                                     font-size:12px;
                                                     color:#008C9E;
                                                     font-weight:bold;
                                                     text-transform:uppercase;
                                                     letter-spacing:1px;">
                                            Correo de Acceso
                                        </span>
                                        <span style="display:block;
                                                     font-size:18px;
                                                     color:#333333;
                                                     font-weight:600;">
                                            '.$this->empleado->getCorreo().'
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <span style="display:block;
                                                     font-size:12px;
                                                     color:#008C9E;
                                                     font-weight:bold;
                                                     text-transform:uppercase;
                                                     letter-spacing:1px;">
                                            Contraseña
                                        </span>
                                        <span style="display:inline-block;
                                                     font-size:24px;
                                                     color:#002347;
                                                     font-weight:800;
                                                     letter-spacing:1px;
                                                     background-color:rgba(255,255,255,0.8);
                                                     padding:6px 12px;
                                                     border-radius:4px;
                                                     margin-top:6px;">
                                            '.$this->empleado->getContrasena().'
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div style="text-align:center; margin-top:30px;">
                            <p style="font-size:12px; color:#999999; margin-bottom:0; margin-top:15px;">
                                Si tienes algún problema para acceder, por favor contacta a soporte@luchanoscorp.com.
                            </p>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td style="background-color:#002347;
                               color:#ffffff;
                               padding:15px;
                               text-align:center;
                               font-size:12px;">
                        &copy; '.date("Y").' LuchanosCorp. Todos los derechos reservados.
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>';

                    if(sent_email(
                                'L22020742@veracruz.tecnm.mx',
                                "Soporte técnico Luchanos Corp",
                                $this->empleado->getCorreo(),
                                $this->empleado->getNombre()." ".$this->empleado->getApellidospama(),
                                'Cuenta asignada',
                                $body
                            )){
                         if($this->empleado->insertar()) {
                            $this->log->registrarLog($_SESSION['RFC'], "Usuario ".($this->empleado->getNombre()." ".$this->empleado->getApellidospama())."(".$this->empleado->getRfc().") agregado correctamente, el correo se ha enviado a su bandeja de entrada o spam", "C");
                            return ["exito", "Usuario registrado exitosamente, favor de indicarle que revise su bandeja de entrada o spam."];
                        } else {
                            $this->log->registrarLog($_SESSION["RFC"],"Error al registrar al usuario", "E");
                            return ["error", "Ocurrió un error al registrar al usuario. Intente más tarde."];
                        }
                    }
                    else{
                        $this->log->registrarLog($_SESSION["RFC"], "Correo no enviado al usuario ".($this->empleado->getNombre()." ".$this->empleado->getApellidospama())."(".$this->empleado->getRfc().")", "E");
                        return ["error","Ocurrió un error al enviar el correo electrónico. Intenta de nuevo."];
                    }
    }

    public function actualizarPerfilPersonal($datos = array()) {
        if(trim($datos['nombre']) == '' || trim($datos['apellidos']) == '' || trim($datos['correo']) == '' || trim($datos['telefono']) == '') {
            return ["error", "Todos los campos de datos personales son obligatorios."];
        }

        $this->empleado->setRfc($_SESSION['RFC']);
        $this->empleado->setNombre(trim(mb_strtoupper($datos['nombre'])));
        $this->empleado->setApellidospama(trim(mb_strtoupper($datos['apellidos'])));
        $this->empleado->setCorreo(mb_strtolower(trim($datos['correo'])));
        $this->empleado->setTelefono(trim($datos['telefono']));

        $existe_correo = $this->empleado->buscar('"Veracruz".empleado', ["where" => "correo='".$this->empleado->getCorreo()."' AND rfc<>'".$this->empleado->getRfc()."'"]);
        if(count($existe_correo) > 0){
            return ["error", "Ya existe una cuenta con este correo registrado."];
        }

        $existe_telefono = $this->empleado->buscar('"Veracruz".empleado', ["where" => "telefono='".$this->empleado->getTelefono()."' AND rfc<>'".$this->empleado->getRfc()."'"]);
        if(count($existe_telefono) > 0){
            return ["error", "Ya existe una cuenta con este número telefónico registrado."];
        }
        if($this->empleado->actualizarPerfilPersonal()) {
            $this->log->registrarLog($_SESSION['RFC'], "Actualización de datos personales exitosa", "C");
            return ["exito","Datos guardados correctamente."];
        } else {
            return ["info", "No se detectaron cambios o hubo un error al actualizar."];
        }
    }

    public function actualizarContra($datos){
        $this->empleado->setContrasena($datos['password']);
        $contra_actual = $this->empleado->buscar('"Veracruz".empleado',["select"=>"contrasena","where"=>"rfc='".$_SESSION["RFC"]."'"])[0]['contrasena'];
        if(md5($this->empleado->getContrasena())==$contra_actual){
            return ["error","La nueva contraseña no puede ser la misma que la anterior"];
        }
        $this->empleado->actualizarContra();
        return ["exito","Contraseña actualizada correctamente"];
    }
}

?>