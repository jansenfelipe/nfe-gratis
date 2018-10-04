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
        $server = rand(2, 9);

        $response = $client->get('https://server'.$server.'.fsist.com.br/baixarxml.ashx?m=WEB&UsuarioID='.$usuarioID.'&cte=0&pub=&com=&t=captcha');

        $captchaBase64 = base64_encode($response->getBody());

        return compact('captchaBase64', 'usuarioID', 'server');
    }

    /**
     * @param $key
     * @param array $params
     * @param HttpClientContract $client
     * @return string
     */
    public function getNFe($key, $params = [], HttpClientContract $client)
    {
        $client->setHeaders([
            'Connection: keep-alive',
            'Upgrade-Insecure-Requests: 1',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36',
            'Accept: */*',
            'Origin: https://www.fsist.com.br',
            'Referer: https://www.fsist.com.br/',
            'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7,es;q=0.6,it;q=0.5'
        ]);

        $usuarioID = $params['usuarioID'];
        $server = $params['server'];

        $response = $client->get("https://server$server.fsist.com.br/baixarxml.ashx?m=WEB&UsuarioID=$usuarioID&cte=0&pub=6b70817f696b&com=6b70817f696b&t=xmlsemcert&chave=$key");

        return $response->getBody();
    }
}