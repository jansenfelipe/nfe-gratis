<?php

require '../vendor/autoload.php';

$client = new JansenFelipe\NFeGratis\Clients\CurlHttpClient();
$provider = new \JansenFelipe\NFeGratis\Providers\FSistProvider();

$nfeGratis = new \JansenFelipe\NFeGratis\NFeGratis($client, $provider);

if(isset($_POST['captcha']) && isset($_POST['usuarioID']) && isset($_POST['access_key']) && isset($_POST['server'])){

    $xml = $nfeGratis->getNFe($_POST['access_key'], [
        'captcha' => $_POST['captcha'],
        'usuarioID' => $_POST['usuarioID'],
        'server' => $_POST['server']
    ]);

    var_dump($xml);
    die;

} else
    $params = $nfeGratis->getParams();

?>

<img src="data:image/png;base64,<?php echo $params['captchaBase64'] ?>" />

<form method="POST">
    <input type="text" name="usuarioID" value="<?php echo $params['usuarioID'] ?>" />
    <input type="text" name="server" value="<?php echo $params['server'] ?>" />

    <input type="text" name="captcha" placeholder="Captcha" />
    <input type="text" name="access_key" placeholder="Chave de Acesso" />

    <button type="submit">Consultar</button>
</form>
