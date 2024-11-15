<?php

class ConexionAPI {
    private $baseUrl;

    public function __construct() {
        // Configura la URL base de la API
        $this->baseUrl = "https://821e-181-78-20-113.ngrok-free.app/api";
    }

    // Método para hacer solicitudes GET
    public function get($endpoint) {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error de cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }

        curl_close($ch);
        return json_decode($response, true);
    }

    // Método para hacer solicitudes POST
    public function post($endpoint, $data) {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init($url);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if (curl_errno($ch)) {
            echo 'Error de cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }
    
        curl_close($ch);
        return [
            'body' => json_decode($response, true),
            'status_code' => $httpCode
        ];
    }
    
    

    // Método para hacer solicitudes PUT
    public function put($endpoint, $data) {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            echo 'Error de cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }

        curl_close($ch);

        // Devuelve tanto el contenido de la respuesta como el código de estado
        return ['body' => json_decode($response, true), 'status_code' => $httpCode];
    }

    public function delete($endpoint) {
        $url = $this->baseUrl . $endpoint;
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'DELETE'
            )
        );

        $context = stream_context_create($options);
        try {
            $response = @file_get_contents($url, false, $context);
            if ($response === FALSE) {
                throw new Exception("Error al realizar la solicitud DELETE a $url");
            }

            // Capturar código de estado HTTP
            $http_response_code = intval(explode(' ', $http_response_header[0])[1]);

            // Retornar tanto la respuesta como el código de estado
            return ['response' => json_decode($response, true), 'status_code' => $http_response_code];
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }
    public function login($correo, $contrasena) {
        $endpoint = "/login"; // Asegúrate de que este sea el endpoint correcto para tu API
        $data = [
            'Correo' => $correo,
            'Contrasena' => $contrasena
        ];
        
        return $this->post($endpoint, $data);
    }
    
}
?>
