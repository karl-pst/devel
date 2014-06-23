<?php

require_once __DIR__ . '/../bootstrap.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {	
	$order = $_REQUEST['order'];

	if($order['payment_method'] == 'credit_card') {		

		// Make a payment using credit card.
		$user = getUser(getSignedInUser());
		$payment = makePaymentUsingCC($user['creditcard_id'], $order['amount'], 'USD', $order['description']);
		$orderId = addOrder(getSignedInUser(), $payment->getId(), $payment->getState(),
				$order['amount'], $order['description']);
		$message = "Your order has been placed successfully. Your Order id is <b>$orderId</b>";
		$messageType = "success";

	} else if($order['payment_method'] == 'paypal') {			

		$orderId = addOrder(getSignedInUser(), NULL, NULL, $order['amount'], $order['description']);
		// Create the payment and redirect buyer to paypal for payment approval. 
		$baseUrl = getBaseUrl() . "/order_completion.php?orderId=$orderId";
		$payment = makePaymentUsingPayPal($order['amount'], 'USD', $order['description'],
				"$baseUrl&success=true", "$baseUrl&success=false");
		updateOrder($orderId, $payment->getState(), $payment->getId());			
		header("Location: " . getLink($payment->getLinks(), "approval_url") );
		exit;			
	}