<?php

require_once("../phpmailer/src/Exception.php");
require_once("../phpmailer/src/PHPMailer.php");
require_once("../phpmailer/src/SMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer {
  public string $targetEmail;
  public PHPMailer $mailer;

  function __construct($targetEmail)
  {
    $mailer = new PHPMailer(true);

    $mailer->isSMTP();
    
    $mailer->SMTPDebug = SMTP::DEBUG_OFF;
    $mailer->Host = $_ENV["SMTP_HOST"];
    $mailer->Port = $_ENV["SMTP_PORT"];
    
    switch ($_ENV["SMTP_ENCRYPTION_TYPE"]) {
        case "SMTPS":
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            break;
        default:
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    }
    
    $mailer->SMTPAuth = true;
    $mailer->Username = $_ENV["SMTP_USERNAME"];
    $mailer->Password = $_ENV["SMTP_PASSWORD"];
    $mailer->CharSet = "UTF-8";
    $mailer->setFrom($_ENV["SMTP_FROM_ADDRESS"]);
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