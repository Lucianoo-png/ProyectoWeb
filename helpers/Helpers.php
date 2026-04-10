<?php 

class Helpers{
    public static function obtenerTiempoRelativo($timestamp) {
        if ($timestamp == null || $timestamp == '') {
            return "Nunca";
        }
        $ahora = new DateTime(); 
        $fecha = new DateTime($timestamp);
        $minutos_totales = floor(($ahora->getTimestamp() - $fecha->getTimestamp()) / 60);
        $hoy_medianoche = (clone $ahora)->setTime(0, 0, 0);
        $fecha_medianoche = (clone $fecha)->setTime(0, 0, 0);
        $diferencia_dias = $hoy_medianoche->diff($fecha_medianoche)->days;
        $hora_texto = $fecha->format('h:i A');
        if ($diferencia_dias == 0) {
            // Es hoy
            if ($minutos_totales < 1) {
                return "hace unos segundos";
            } elseif ($minutos_totales < 60) {
                return "hace " . $minutos_totales . " " . ($minutos_totales == 1 ? "min" : "mins");
            } else {
                $horas = floor($minutos_totales / 60);
                return "hace " . $horas . " " . ($horas == 1 ? "hora" : "horas");
            }
        } elseif ($diferencia_dias == 1) {
            return "ayer a las $hora_texto";
        } elseif ($diferencia_dias == 2) {
            return "antier a las $hora_texto";
        } else {
            $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
            $dia = $fecha->format('j');
            $mes = $meses[(int)$fecha->format('n') - 1];
            $anio_str = ($ahora->format('Y') != $fecha->format('Y')) ? " del " . $fecha->format('Y') : "";

            return "el $dia de $mes$anio_str a las $hora_texto";
        }
    }
}

?>