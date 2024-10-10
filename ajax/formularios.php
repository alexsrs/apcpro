<?php
require '../vendor/autoload.php'; // Inclua o autoload do Composer
include_once '../config.php'; // Inclua o config para autoload
include_once '../classes/Email.php'; // Inclua diretamente

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$data = [];
$assunto = 'Novo contato do site';
$corpo = '';

foreach ($_POST as $key => $value) {
    $corpo .= ucfirst($key) . ": " . htmlspecialchars($value) . "<hr>";
}

$info = ['assunto' => $assunto, 'corpo' => $corpo];

$mail = new Email('smtp.titan.email', 'site@apcpro.com.br', 'H@lf2500', 'APC Pro');
$mail->addAddress('alexsrs@gmail.com', 'ADM do Site');
$mail->formatarEmail($info);

try {
    if ($mail->enviarEmail()) {
        $data['sucesso'] = true;
    } else {
        $data['erro'] = true;
    }
} catch (Exception $e) {
    $data['erro'] = true;
    $data['mensagem'] = $e->getMessage();
}

header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON
echo json_encode($data);

?>