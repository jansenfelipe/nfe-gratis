<?php

namespace JansenFelipe\NFeGratis\Providers;

use JansenFelipe\NFeGratis\Contracts\HttpClientContract;
use JansenFelipe\NFeGratis\Contracts\ProviderContract;
use JansenFelipe\NFeGratis\NFe;

class FSistProvider implements ProviderContract
{

    /**
     * @param HttpClientContract $client
     * @return array
     */
    public function getParams(HttpClientContract $client)
    {
        $usuarioID = rand(100000000, 999999999);

        $response = $client->get('https://server7.fsist.com.br/baixarxml.ashx?m=WEB&UsuarioID='.$usuarioID.'&cte=0&pub=&com=&t=captcha');

        $captchaBase64 = base64_encode($response->getBody());

        return compact('captchaBase64', 'usuarioID');
    }

    /**
     * @param $key
     * @param array $params
     * @param HttpClientContract $client
     * @return string
     */
    public function getNFe($key, $params = [], HttpClientContract $client)
    {
        $usuarioID = $params['usuarioID'];

        $response = $client->get("https://server2.fsist.com.br/baixarxml.ashx?m=WEB&UsuarioID=$usuarioID&cte=0&t=xmlsemcert&chave=$key");

        return $response->getBody();
    }
}