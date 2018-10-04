# NFe Grátis

Com esse pacote você poderá realizar consultas de NFe no site da Receita Federal do Brasil gratuitamente.

Atenção: Esse pacote não possui leitor de captcha, mas captura o mesmo para ser digitado pelo usuário

### Changelog

* 1.0.1 - Add headers + fix server
* 1.0.0 - Criação da lib + provider FSist

### Como utilizar

Adicione a library

```sh
$ composer require jansenfelipe/nfe-gratis
```

Adicione o autoload.php do composer no seu arquivo PHP.

```php
require_once 'vendor/autoload.php';  
```

Primeiro chame o método `getParams()` para retornar os dados necessários para enviar no método `getNFe()` 

```php
use JansenFelipe\NFeGratis\Clients\CurlHttpClient;
use JansenFelipe\NFeGratis\NFeGratis;
use JansenFelipe\NFeGratis\Providers\FSistProvider;

$nfeGratis = new NFeGratis(new CurlHttpClient(), new FSistProvider());

$params = $nfeGratis->getParams();
```

Agora basta chamar o método `getNFe()` passando o chave de acesso da NFe e os parâmetros

```php
$xml = $nfeGratis->getNFe('CHAVE_ACESSO_NFE', [
   'captcha' => 'INFORME_AS_LETRAS_DO_CAPTCHA',
   'usuarioID' => '<usuarioID>' //Retornado no método getParams()
   'server' => '<server>' //Retornado no método getParams()
]);
```

### Gostou? Conheça também

* [CnpjGratis](https://github.com/jansenfelipe/cnpj-gratis)
* [CpfGratis](https://github.com/jansenfelipe/cpf-gratis)
* [CepGratis](https://github.com/jansenfelipe/cep-gratis)
* [CidadesGratis](https://github.com/jansenfelipe/cidades-gratis)
* [NFePHPSerialize](https://github.com/jansenfelipe/nfephp-serialize)

### License

The MIT License (MIT)
