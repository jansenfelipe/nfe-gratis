<?php

namespace JansenFelipe\NFeGratis\Contracts;

interface ProviderContract
{
    /**
     * @param HttpClientContract $client
     * @return array
     */
    public function getParams(HttpClientContract $client);

    /**
     * @param $key
     * @param array $params
     * @param HttpClientContract $client
     * @return string
     */
    public function getNFe($key, $params = [], HttpClientContract $client);
}