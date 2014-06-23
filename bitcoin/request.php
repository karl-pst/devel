<?php	
	/**
	 * 
	 */
	
	include_once 'php-client/bp_lib.php';

	$response = bpCreateInvoice(1, 10.00, 'Test Order');
	echo '<pre>';
		var_dump($response);
	echo '</pre>';
?>