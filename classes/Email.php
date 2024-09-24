<?php
	/**
	 * 
	 */
	class Email
	{
		private $mailer;

		public function __construct($host,$username,$senha,$name)
		{
			// code...
			//Create an instance; passing `true` enables exceptions
			$this->mailer = new PHPMailer();
		
			    //Server settings
			   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			    $this->mailer->isSMTP(); //Send using SMTP
			    $this->mailer->Host       = $host; //Set the SMTP server to send through
			    $this->mailer->SMTPAuth   = true; //Enable SMTP authentication
			    $this->mailer->Username   = $username; //SMTP username
			    $this->mailer->Password   = $senha; //SMTP password
			    $this->mailer->SMTPSecure = 'ssl'; //Enable implicit TLS encryption
			    $this->mailer->Port       = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
			    $this->mailer->setFrom($username,$name);
			    $this->mailer->isHTML(true); //Set email format to HTML
			    $this->mailer->CharSet = 'UTF-8';
			}

			public function addAddress($email,$nome){
				$this->mailer->addAddress($email,$nome);     //Add a recipient
			}

			public function formatarEmail($info){	
				$this->mailer->Subject = $info['assunto'];
			    $this->mailer->Body    = $info['corpo'];
			    $this->mailer->AltBody = strip_tags($info['corpo']);
			}

			public function enviarEmail(){
				if ($this->mailer->send()) {
					return true;
					// code...
				} else {
					return false;
				}
			}


		}
	
?>
