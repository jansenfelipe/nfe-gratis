<?php

namespace JansenFelipe\NFeGratis\Clients;

use JansenFelipe\NFeGratis\Contracts\HttpClientContract;
use JansenFelipe\NFeGratis\Response;

class CurlHttpClient implements HttpClientContract
{
    /**
     * @var string[]
     */
    private $headers = [];

    /**
     * Send GET request.
     *
     * @return Response
     */
    public function get($url)
    {
        $curl = $this->createCurl($url);

        $result = curl_exec($curl);

        return $this->createResponse($curl, $result);
    }

    /**
     * Send POST request.
     *
     * @return Response
     */
    public function post($url, $data = [])
    {
        $curl = $this->createCurl($url);

        $result = curl_exec($curl);

        return $this->createResponse($curl, $result);
    }

    /**
     * Cria resource cURL.
     *
     * @param $url
     * @param array $data
     *
     * @return resource
     */
    private function createCurl($url, array $data = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_HEADER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true
        ]);

        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        return $curl;
    }

    /**
     * Set headers request.
     *
     * @param string $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param $curl
     * @param $result
     * @return Response
     */
    private function createResponse($curl, $result)
    {
        $size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);

        curl_close($curl);

        $headers = [];

        foreach (explode(PHP_EOL, substr($result, 0, $size)) as $i) {
            $t = explode(':', $i, 2);
            if (isset($t[1]))
                $headers[trim($t[0])] = trim($t[1]);
        }

        $response = new Response();
        $response->setBody(substr($result, $size));
        $response->setHeaders($headers);

        return $response;
    }
}
