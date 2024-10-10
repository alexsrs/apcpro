<?php
require '../vendor/autoload.php'; // Inclua o autoload do Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    private $mailer;

    public function __construct($host, $username, $senha, $name)
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host       = $host;
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Username   = $username;
        $this->mailer->Password   = $senha;
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mailer->Port       = 465;
        $this->mailer->setFrom($username, $name);
        $this->mailer->isHTML(true);
        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->SMTPDebug = 0; // Ativar debug
    }

    public function addAddress($email, $nome)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->mailer->addAddress($email, $nome);
        } else {
            throw new Exception("Endereço de e-mail inválido: $email");
        }
    }

    public function formatarEmail($info)
    {
        $this->mailer->Subject = $info['assunto'];
        $this->mailer->Body    = $info['corpo'];
        $this->mailer->AltBody = strip_tags($info['corpo']);
    }

    public function enviarEmail()
    {
        try {
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Erro ao enviar e-mail: " . $e->getMessage());
            return $e->getMessage(); // Retorna a mensagem de erro
        }
    }
}

// Exemplo de uso
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
    $data['mensagem'] = $e->getMessage(); // Captura a mensagem de erro
}

die(json_encode($data));
