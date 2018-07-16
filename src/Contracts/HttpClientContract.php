<?php

namespace JansenFelipe\NFeGratis\Contracts;

use JansenFelipe\NFeGratis\Response;

interface HttpClientContract
{
    /**
     * Send GET request.
     *
     * @return Response
     */
    public function get($url);

    /**
     * Send POST request.
     *
     * @return Response
     */
    public function post($url, $data = []);

    /**
     * Set headers request.
     *
     * @param array $headers
     */
    public function setHeaders(array $headers);
}