<?php

require_once "../vendor/swiftmailer/swiftmailer/lib/swift_required.php";
require_once "../vendor/swiftmailer/swiftmailer/lib/classes/Swift/SmtpTransport.php";
require_once "../vendor/swiftmailer/swiftmailer/lib/classes/Swift/Mailer.php";
require_once "../vendor/swiftmailer/swiftmailer/lib/classes/Swift/Message.php";
require_once "../vendor/swiftmailer/swiftmailer/lib/classes/Swift/Attachment.php";
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;
use Swift_Attachment;
use GUMP;

echo "oui";
exit;
		try {
			$gump  = new GUMP('fr');
			$_post = $gump->sanitize($_POST, ['name', 'email', 'message']);

			CustomGump::set_field_names([
				'name'      => 'Nom',
				'email'     => 'Email',
				'message'   => 'Message',
			]);

	/*		$gump->filter_rules(array(
				'name'     => 'trim|sanitize_string',
				'email'    => 'trim|sanitize_string',
				'message'  => 'trim|sanitize_string',
			));*/

			$gump->validation_rules(array(
				'name'    => 'required|alpha_blabla',
				'email'   => 'required|valid_email',
				'message' => 'required|max_len,500|min_len,6|alpha_blabla',
			));
			$data = $gump->run($_post);

var_dump($data);
exit;

			// Si les données ne sont pas validées par Gump, on retourne un message d'erreur
			if ($data === false) :
				$this->return_string($gump->set_fields_error_messages("Les données sont mal entrées"));
			endif;
					 //envoi d'identifiants pour connexion
      $identifiants = $data['name']. '. '. ' '. $data['email'] ' .';
			      // Create the SMTP configuration
        $transport =  (new Swift_SmtpTransport('localhost', 25))
                     ->setUsername('gyerbanga@innosys.fr')
                     ->setPassword('Pauline73');

        // Create the message
        $message = new Swift_Message('Message de contact !');
        $message->setTo(array(
           'yerbangag@yahoo.fr' => "Yerbanga Gaston",
           $data['email'] => "Nouveau membre"
        ));

        $message->setCc(array("yerbangag@yahoo.fr" => "yerbanga"));
        //$message->setBcc(array("boss@bank.com" => "Bank Boss"));
        $message->setSubject("Message de contact");
        $message->setBody($identifiants);
        $message->setFrom("gyerbanga@innosys.fr", "innosys");
        //$message->attach(Swift_Attachment::fromPath("../docs/Questions_Assurmix.docx"));

          // Send the email
        $mailer = new Swift_Mailer($transport);
        $mailer->send($message, $failedRecipients);
/*	}
}*/