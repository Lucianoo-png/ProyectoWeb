<?php 
class ClienteControlador {
    private Cliente $cliente;

    public function __construct() {
        $this->cliente = new Cliente();
    }

    public function getCliente() { return $this->cliente; }

    public function validarSesion($datos = array()){
        if(trim($datos[0]) == '' || trim($datos[1])==''){
            return ["error","Ingrese su correo y contraseña."];
        }

        $this->cliente->setCorreo(mb_strtolower(trim($datos[0])));
        $this->cliente->setContrasena(trim($datos[1]));

        $datos = $this->cliente->iniciarSesion();

        if($datos==false){
            return array("error","Correo y/o contraseña incorrectos.");
        }
        else{
            $_SESSION['NoCliente'] = $datos[0]['no_cliente'];
            $_SESSION['Tipo'] = 'C';
            if (isset($_SESSION['url_retorno']) && str_contains(mb_strtolower($_SESSION["url_retorno"]),"producto")) {
                $destino = $_SESSION['url_retorno'];
                unset($_SESSION['url_retorno']);
                header("location: $destino");
            } else {
                header('location:/proyectoweb/mi-perfil/inicio');
            }
        }
    }

    public function actualizarDatos($datos){
        if (empty($datos['nombre']) || empty($datos['apellidos']) ||  empty($datos['correo']) || empty($datos['telefono'])) {
            return ["error", "Todos los campos obligatorios deben estar llenos."];
        }
        $this->cliente->setNombre(trim(mb_strtoupper($datos['nombre'])));
        $this->cliente->setApellidospama(trim(mb_strtoupper($datos['apellidos'])));
        $this->cliente->setCorreo(trim(mb_strtolower($datos['correo'])));
        $this->cliente->setTelefono(trim($datos['telefono']));

         $existeCorreo = $this->cliente->buscar('"Veracruz".cliente', ["where" => "correo = :cor AND no_cliente<>".$_SESSION["NoCliente"], "params" => [":cor" => $datos['correo']]]);
        if (count($existeCorreo) > 0) {
            return ["error", "Ya existe una cuenta vinculada a este correo."];
        }
        
        $existeTel = $this->cliente->buscar('"Veracruz".cliente', ["where" => "telefono = :tel AND no_cliente<>".$_SESSION["NoCliente"], "params" => [":tel" => $datos['telefono']]]);
        if (count($existeTel) > 0) {
            return ["error", "Este número de teléfono ya está registrado."];
        }

        $this->cliente->actualizarDatos();

        return ["exito","Datos guardados correctamente."];

    }

    public function actualizarContra($datos){
        $this->cliente->setContrasena($datos['password']);
        $contra_actual = $this->cliente->buscar('"Veracruz".cliente',["select"=>"contrasena","where"=>"no_cliente=".$_SESSION["NoCliente"]])[0]['contrasena'];
        if(md5($this->cliente->getContrasena())==$contra_actual){
            return ["error","La nueva contraseña no puede ser la misma que la anterior"];
        }
        $this->cliente->actualizarContra();
        return ["exito","Contraseña actualizada correctamente"];
    }

    public function registrarCliente($datos) {
        if (empty($datos['nombre']) || empty($datos['apellidos']) || empty($datos['correo']) || empty($datos['telefono']) || empty($datos['calle_numero']) || empty($datos['colonia']) || empty($datos['ciudad']) || empty($datos['cp']) || empty($datos['estado'])) {
            return ["error", "Todos los campos obligatorios deben estar llenos."];
        }
        $existeCorreo = $this->cliente->buscar('"Veracruz".cliente', ["where" => "correo = :cor", "params" => [":cor" => $datos['correo']]]);
        if (count($existeCorreo) > 0) {
            return ["error", "Ya existe una cuenta vinculada a este correo."];
        }
        
        $existeTel = $this->cliente->buscar('"Veracruz".cliente', ["where" => "telefono = :tel", "params" => [":tel" => $datos['telefono']]]);
        if (count($existeTel) > 0) {
            return ["error", "Este número de teléfono ya está registrado."];
        }

        $this->cliente->setNombre(trim(mb_strtoupper($datos['nombre'])));
        $this->cliente->setApellidospama(trim(mb_strtoupper($datos['apellidos'])));
        $this->cliente->setCorreo(trim(mb_strtolower($datos['correo'])));
        $this->cliente->setTelefono(trim($datos['telefono']));
        $this->cliente->setContrasena(md5($datos['password']));
        $this->cliente->setOrigen('L');

        $body = '<!DOCTYPE html>
        <html lang="es">
        <head><meta charset="UTF-8"></head>
        <body style="margin:0; padding:0; background-color:#f4f4f4; font-family:\'Segoe UI\',Helvetica,Arial,sans-serif;">
            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:40px 0;">
                <tr>
                    <td align="center">
                        <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
                        <tr>
                            <td style="background-color:#002347; padding:30px; text-align:center; border-bottom:5px solid #008C9E;">
                                <h1 style="color:#ffffff; margin:0; font-size:28px; font-weight:700;">Luchanos<span style="color:#008C9E;">Corp</span></h1>
                                <p style="color:#a8b2bd; margin-top:5px; margin-bottom:0; font-size:14px;">Bienvenido a nuestra tienda</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:40px;">
                                <p style="color:#333333; font-size:18px; margin-top:0;">Hola, <strong>'.$this->cliente->getNombre()." ".$this->cliente->getApellidospama().'</strong></p>
                                <p style="color:#666666; font-size:15px; line-height:1.6;">
                                    Te damos la bienvenida. Has creado tu cuenta de cliente exitosamente en la plataforma de <strong>LuchanosCorp</strong>. A continuación, te recordamos tus credenciales de acceso:
                                </p>
                                <div style="background-color:#f0f8f9; border:1px solid #c2e2e6; border-left:6px solid #008C9E; border-radius:6px; padding:20px; margin:30px 0;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="padding-bottom:12px;">
                                                <span style="display:block; font-size:12px; color:#008C9E; font-weight:bold; text-transform:uppercase; letter-spacing:1px;">Correo de Acceso</span>
                                                <span style="display:block; font-size:18px; color:#333333; font-weight:600;">'.$this->cliente->getCorreo().'</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span style="display:block; font-size:12px; color:#008C9E; font-weight:bold; text-transform:uppercase; letter-spacing:1px;">Contraseña Elegida</span>
                                                <span style="display:inline-block; font-size:20px; color:#002347; font-weight:800; letter-spacing:1px; background-color:rgba(255,255,255,0.8); padding:6px 12px; border-radius:4px; margin-top:6px;">'.$datos['password'].'</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div style="text-align:center; margin-top:30px;">
                                    <p style="font-size:12px; color:#999999; margin-bottom:0; margin-top:15px;">Si tienes algún problema para acceder, por favor contacta a soporte@luchanoscorp.com.</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color:#002347; color:#ffffff; padding:15px; text-align:center; font-size:12px;">
                                &copy; '.date("Y").' LuchanosCorp. Todos los derechos reservados.
                            </td>
                        </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>';

        if (sent_email('L22020742@veracruz.tecnm.mx', "Soporte técnico Luchanos Corp", $this->cliente->getCorreo(), $this->cliente->getNombre()." ".$this->cliente->getApellidospama(), 'Bienvenido a LuchanosCorp', $body)) {
            
            $id_cliente = $this->cliente->insertar();
            
            if ($id_cliente) {
                $this->cliente->insertarDireccion($id_cliente, $datos);
                return ["exito", "Cuenta creada exitosamente. Revisa tu bandeja de entrada o spam para ver tus datos."];
            } else {
                return ["error", "Ocurrió un error al crear la cuenta. Intente más tarde."];
            }

        } else {
            return ["error", "Ocurrió un error al verificar tu correo electrónico. Intenta de nuevo."];
        }
    }

    public function guardarDireccion($datos){
        if (empty($datos['calle_numero']) || empty($datos['colonia']) || empty($datos['ciudad']) || empty($datos['cp']) || empty($datos['estado'])) {
            return ["error", "Todos los campos obligatorios deben estar llenos."];
        }

        if (!empty($datos['no_direccion'])) {
            $actualizado = $this->cliente->actualizarDireccion($datos['no_direccion'], $_SESSION["NoCliente"], $datos);
            if ($actualizado) {
                return ["exito", "Dirección actualizada correctamente."];
            } else {
                return ["info", "No se hicieron cambios o hubo un error al actualizar."];
            }
        } 
        else {
            $insertado = $this->cliente->insertarDireccion($_SESSION["NoCliente"], $datos);
            if ($insertado) {
                return ["exito", "Dirección guardada correctamente."];
            } else {
                return ["error", "Ocurrió un error al guardar la dirección."];
            }
        }
    }

    public function eliminarDireccion($datos){
        $this->cliente->eliminarDireccion($datos['no_direccion']);
        return ["exito","Dirección eliminada correctamente"];
    }
}
?>