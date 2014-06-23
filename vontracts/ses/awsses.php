<?php
require_once('src/SimpleEmailService.php');
require_once('src/SimpleEmailServiceMessage.php');
require_once('src/SimpleEmailServiceRequest.php');

Class awsSes{

	private $ses;

	function __construct(){
		
		$this->ses = new SimpleEmailService('AKIAJD7L2PLIRAJNS6DQ', 'pcros6X7+L/1XDWNGiEGxBaJqP5ujG2fkGf/zj+Y');

		// Disable checking of SSL cert
		$this->ses->enableVerifyPeer(false);
	}

	/**
	* Verify an email address 
	*
	* @param string email The email address to be verified
	* @return The request ID for this request
	**/
	public function verifyEmail($email){
		return $ses->verifyEmailAddress($email);
	}

	/**
	* Show verified Email Addresses 
	*
	* @return An array containing list of verified email addresses and the request ID
	**/
	public function listVerifiedEmail(){
		return $ses->listVerifiedEmailAddresses();
	}

	/**
	* Send simple email 
	*
	* @param array recipient Array of receving email addresses
	* @param string sender Sender email address
	* @param string subject Subject of the email
	* @param string body Body of the email
	* @param array attachment Array containing 3 items, filename of attachment(e.g. 'my_PDF_file.pdf'), path of attachment(e.g. 'path/to/pdf/file'), type of attachment (e.g. 'application/pdf')
	* @return An array containing unique identifier of the message and the request ID. Returns false if a field is missing.
	**/
	public function sendMail($recipient, $sender, $subject, $body, $attachment){
		$mail = new SimpleEmailServiceMessage();
		$mail->addTo($recipient);
		$mail->setFrom($sender);
		$mail->setSubject($subject);
		$mail->setMessageFromString($body);

		//add attachment if there is attachment
		if(!empty($attachment)){		
			$mail->addAttachmentFromFile($attachment['filename'], $attachment['path'], $attachment['type']);
			//$mail->addAttachmentFromFile('catface.PNG', './catface.PNG', 'image/png');
			//return $attachment['filename'];
			//return $test;
		}		
		
		return $this->ses->sendEmail($mail);
		
	}

	/**
	* Get send email quota	
	**/
	public function getQuota(){
		return $ses->getSendQuota();
	}

	/**
	* Get send email statistics
	**/
	public function getStatistics(){
		return $ses->getSendStatistics();
	}
}


