<?php
class RestClient {
    private $api_url = "http://localhost:8080";

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function get($endpoint, $params = []) {
        $query = http_build_query($params);
        $url = $this->api_url . $endpoint . '?' . $query;
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            throw new RuntimeException(curl_error($ch));
        }
        curl_close($ch);
    
        return json_decode($result, true);
    }

    public function post($endpoint, $data) {
        $url = $this->api_url . $endpoint;

        // Initialize cURL
        $ch = curl_init($url);

        // Set options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        ));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects

        // Execute and get the response
        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception('Curl error: ' . $error);
        }

        // Get response info
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        // Parse headers
        $headers = [];
        foreach (explode("\r\n", $header) as $line) {
            if (preg_match('/^([^:]+): (.+)$/', $line, $matches)) {
                $headers[$matches[1]] = $matches[2];
            }
        }

        curl_close($ch);

        return [
            'status_code' => $status_code,
            'headers' => $headers,
            'body' => $body
        ];
    }

    // You can add methods for PUT, DELETE, etc.
}
