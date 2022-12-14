<?php
use Database\ConfigController;

require_once("../phpmailer/src/Exception.php");
require_once("../phpmailer/src/PHPMailer.php");
require_once("../phpmailer/src/SMTP.php");
require_once("../_db/database.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer {
  public string $targetEmail;
  public PHPMailer $mailer;

  function __construct($targetEmail)
  {
    global $pdo;
    $configController = new ConfigController($pdo);
    $config = $configController->get();
    
    $mailer = new PHPMailer(true);

    $mailer->isSMTP();
    
    $mailer->SMTPDebug = SMTP::DEBUG_OFF;
    $mailer->Host = $config->smtp_host;
    $mailer->Port = $config->smtp_port;
    
    switch ($config->smtp_encryption_type) {
        case "SMTPS":
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            break;
        default:
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    }
    
    $mailer->SMTPAuth = true;
    $mailer->Username = $config->smtp_username;
    $mailer->Password = $config->smtp_password;
    $mailer->CharSet = "UTF-8";
    
    $mailer->setFrom($config->smtp_from_address);
    $mailer->addAddress($targetEmail);

    $this->mailer = $mailer;
    $this->targetEmail = $targetEmail;
  }

  /**
   * Envia um e-mail de registro de confirmação.
   * @return bool o e-mail foi enviado com sucesso?
   */
  public function sendRegisterConfirmation(string $participanteNome): bool {
    $body = file_get_contents(__DIR__ . "/registerConfirmation.html");

    // Variáveis de template  
    $body = str_replace('$nome', $participanteNome, $body);
    
    $this->mailer->msgHTML($body);
    $this->mailer->Subject = 'Confirmação de inscrição - Faculdades da Indústria';
    $this->mailer->AltBody = "Sua inscrição para o vestibular das Faculdades da Indústria foi confirmada!";

    $this->mailer->addEmbeddedImage(__DIR__ . "/../assets/logo-faculdadesdaindustria.png", "logo-faculdades-industria");

    return $this->mailer->send() ? true : false;
  }
}