<?php 

    function sent_email($corEnv, $usuEnv, $corEnt, $usuEnt, $sub, $msg, $imagenPath = null, $codigoQR = null) {
        $apiKey = ''; // La obtienes gratis en su panel
        $url = 'https://api.brevo.com/v3/smtp/email';

        // Preparamos el JSON para la API
        $data = [
            "sender" => ["name" => $usuEnv, "email" => "jesusantonio.laralopez@gmail.com"],
            "to" => [["email" => $corEnt, "name" => $usuEnt]],
            "subject" => $sub,
            "htmlContent" => $msg
        ];

        // Manejo de imágenes embebidas (Si las necesitas)
        if ($imagenPath && file_exists($imagenPath)) {
            $content = base64_encode(file_get_contents($imagenPath));
            $data["inline"][] = [
                "content" => $content,
                "name" => "logo_sakywalker"
            ];
        }
        
        // Lo mismo para el QR
        if ($codigoQR && file_exists($codigoQR)) {
            $contentQR = base64_encode(file_get_contents($codigoQR));
            $data["inline"][] = [
                "content" => $contentQR,
                "name" => "qr_code"
            ];
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'api-key: ' . $apiKey,
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Si el código es 201, se envió correctamente
        return $httpCode === 201;
}
?>