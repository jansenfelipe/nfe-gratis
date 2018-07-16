<?php

namespace JansenFelipe\NFeGratis;

use JansenFelipe\NFeGratis\Contracts\HttpClientContract;
use JansenFelipe\NFeGratis\Contracts\ProviderContract;

class NFeGratis
{
    /**
     * @var ProviderContract
     */
    private $provider;

    /**
     * @var HttpClientContract
     */
    private $httpClient;

    /**
     * NFeGratis constructor.
     */
    public function __construct(HttpClientContract $httpClientContract, ProviderContract $provider)
    {
        $this->httpClient = $httpClientContract;
        $this->provider = $provider;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->provider->getParams($this->httpClient);
    }

    /**
     * @return string
     */
    public function getNFe($key, $params = [])
    {
        return $this->provider->getNFe($key, $params, $this->httpClient);
    }
}