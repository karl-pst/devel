<?php

/**
 * 
 * Common DB utilities
 */

define('TRANSCTIONS_TABLE', 'transaction_logs');

/**
 * Returns a new mysql conncetion
 * @throws Exception
 * @return unknown
 */
function getConnection() {

	$transactionTableCreateQuery = "CREATE TABLE 'transaction_logs' ('transaction_id' INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 'transaction_date' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 'transaction_user_id' INT(11) NOT NULL, 'transaction_vc' INT(11) NOT NULL DEFAULT '0', 'transaction_amount' DECIMAL(16, 2) NOT NULL DEFAULT '0.00', 'transaction_type' ENUM('charge', 'refund') NOT NULL DEFAULT 'charge');";
	

	$link = @mysql_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD);
	if(!$link) {
		throw new Exception('Could not connect to mysql ' . mysql_error() . PHP_EOL . 
				'. Please check connection parameters in app/bootstrap.php');
	}
	if(!mysql_select_db(MYSQL_DB, $link)) {
		throw new Exception('Could not select database ' . mysql_error() . PHP_EOL . 
				'. Please check connection parameters in app/bootstrap.php');
	}
	
	mysql_query($transactionTableCreateQuery, $link);
	return $link;
}