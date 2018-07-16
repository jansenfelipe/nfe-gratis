<?php

use JansenFelipe\NFeGratis\Clients\CurlHttpClient;
use JansenFelipe\NFeGratis\NFeGratis;
use JansenFelipe\NFeGratis\Providers\FSistProvider;

require_once './vendor/autoload.php';

$nfeGratis = new NFeGratis(new CurlHttpClient(), new FSistProvider());

if(isset($_POST['captcha']) && isset($_POST['key'])) {

    $result = $nfeGratis->getNFe($_POST['key'], [
        'captcha' => $_POST['captcha'],
        'usuarioID' => $_POST['usuarioID']
    ]);

    var_dump($result);

    die;
}

$params = $nfeGratis->getParams();


?>

<form method="POST">
    <img src="data:image/png;base64,<?php echo $params['captchaBase64']?>" />

    <input type="text" name="captcha" placeholder="Informe o captcha" />

    <input type="text" name="key" placeholder="Informe a chave de acesso" />

    <input type="text" name="usuarioID" placeholder="Usuario ID" value="<?php echo $params['usuarioID']?>" />

    <button type="submit">Consultar</button>
</form>