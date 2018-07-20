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

        $response = $client->get('https://server9.fsist.com.br/baixarxml.ashx?m=WEB&UsuarioID='.$usuarioID.'&cte=0&pub=&com=&t=captcha');

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
        $client->setHeaders([
            'Connection: keep-alive',
            'Upgrade-Insecure-Requests: 1',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36',
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Referer: https://www.fsist.com.br/',
            'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7,es;q=0.6,it;q=0.5'
        ]);

        $usuarioID = $params['usuarioID'];

        $response = $client->get("https://server9.fsist.com.br/baixarxml.ashx?m=WEB&UsuarioID=$usuarioID&cte=0&t=xmlsemcert&chave=$key");

        return $response->getBody();
    }
}