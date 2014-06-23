<?php

require_once __DIR__ . '/db.php';

function addTransaction($transaction_date, $transaction_user_id, $transaction_vc, $transaction_amount, transaction_type) {
	$conn = getConnection();
	$query = sprintf("INSERT INTO %s(transaction_id, transaction_date, transaction_user_id, transaction_vc, transaction_amount, transaction_type) 
			VALUES('', NOW(), '%s', '%s', '%s', '%s')",
			ORDERS_TABLE,						
			mysql_real_escape_string($transaction_user_id),
			mysql_real_escape_string($transaction_vc),
			mysql_real_escape_string($transaction_amount),	
			mysql_real_escape_string($transaction_type));

	$result = mysql_query($query, getConnection());
	if(!$result) {
		$errMsg = "Error creating new transaction: " . mysql_error($conn);
		mysql_close($conn);
		throw new Exception($errMsg);
	}
	$orderId = mysql_insert_id($conn);
	mysql_close($conn);

	return $orderId;
}