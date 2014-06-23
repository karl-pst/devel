<?php
	$email    = "bryan.serad@powerstormtech.com";//or user@domain.com
	$password = "@y4n072590"; //bigdog33$

	//$imap_host = "{imap.gmail.com:993/imap/ssl}";
	$imap_host = "{host.pstserver.com:993/imap/ssl/novalidate-cert}";

	$imap_folder = "INBOX"; 

	$conn = imap_open($imap_host . $imap_folder,$email,$password) or die('Failed to open connection with Gmail: ' . imap_last_error());

	$emails = imap_search( $conn, 'SUBJECT "with attachment"');	

	if( $emails ){		
	    foreach( $emails as $email_id){

	        /*$email_info = imap_fetch_overview($conn,$email_id,0);
	        $message = imap_fetchbody($conn,$email_id,2);
	        echo "Subject: " . $email_info[0]->subject . "\n";
	        echo "Message: " . $message . "\n";*/


	        $structure = imap_fetchstructure($conn,$email_id);
	         
			if(isset($structure->parts)){
				// echo '<pre>';
				// 	print_r($structure->parts);	
				// echo '</pre>';
				
				parse_parts($structure->parts, $email_id, $conn);
			} 
			
	    }

	
	}

	function parse_parts($parts, $email_id, $conn, $parentsection = ""){
				
	    foreach($parts as $subsection => $part){

	        $section = $parentsection . ($subsection + 1);

	        if(isset($part->parts)){

	            // some mails have one extra dimension
	            parse_parts($part->parts, $email_id, $section . "." );

	        }
	        elseif(isset($part->disposition)){
	            if(in_array(strtolower($part->disposition), array('attachment','inline'))){	            	

	            	$saveDirPath = "/tmp";

	                $data = imap_base64(imap_fetchbody( $conn, $email_id, $section ));
	                
	                $filename = $part->dparameters[0]->value;

	                $write_result = file_put_contents($saveDirPath.'/'.$filename, $data);

	                echo $write_result;
	            }
	        }
	    }
		
	}

?>

