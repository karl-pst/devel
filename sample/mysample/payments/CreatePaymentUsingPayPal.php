<?php

// # Create Payment using PayPal as payment method
// This sample code demonstrates how you can process a 
// PayPal Account based Payment.
// API used: /v1/payments/payment

require __DIR__ . '/../bootstrap.php';
use PayPal\Api\Address;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\FundingInstrument;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
session_start();

$item_price = str_replace('$', '', $_POST['price']);
$item_name = $_POST['name'];
$item_quantity = $_POST['quantity'];
$item_currency = 'USD';
$item_amount = (string)($item_quantity * $item_price);

// ### Payer
// A resource representing a Payer that funds a payment
// Use the List of `FundingInstrument` and the Payment Method
// as 'credit_card'
$payer = new Payer();
$payer->setPayment_method("paypal");

// ### Amount
// Let's you specify a payment amount.
$amount = new Amount();
$amount->setCurrency($item_currency);
$amount->setTotal($item_amount);


$item = new Item();
$item->setQuantity($item_quantity);
$item->setName($item_name);
$item->setPrice($item_price);
$item->setCurrency($item_currency);

$item_list = new ItemList();
$item_list->setItems(array($item));
// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. Transaction is created with
// a `Payee` and `Amount` types
$transaction = new Transaction();
$transaction->setAmount($amount);
$transaction->setItemList($item_list);
$transaction->setDescription("VC payment.");

// ### Redirect urls
// Set the urls that the buyer must be redirected to after 
// payment approval/ cancellation.
$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturn_url("$baseUrl/ExecutePayment.php?success=true");
$redirectUrls->setCancel_url("$baseUrl/ExecutePayment.php?success=false");

// ### Payment
// A Payment Resource; create one using
// the above types and intent as 'sale'
$payment = new Payment();
$payment->setIntent("sale");
$payment->setPayer($payer);
$payment->setRedirect_urls($redirectUrls);
$payment->setTransactions(array($transaction));

/*echo '<pre>';
	var_dump($payment);	
echo '</pre>';*/


// ### Create Payment
// Create a payment by posting to the APIService
// using a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the status and the
// url to which the buyer must be redirected to
// for payment approval
try {
	$payment->create($apiContext);
} catch (\PPConnectionException $ex) {
	echo "Exception: " . $ex->getMessage() . PHP_EOL;
	var_dump($ex->getData());	
	exit(1);
}

// ### Redirect buyer to paypal
// Retrieve buyer approval url from the `payment` object.
foreach($payment->getLinks() as $link) {
	if($link->getRel() == 'approval_url') {
		$redirectUrl = $link->getHref();
	}
}
// It is not really a great idea to store the payment id
// in the session. In a real world app, please store the
// payment id in a database.
$_SESSION['paymentId'] = $payment->getId();
if(isset($redirectUrl)) {
	header("Location: $redirectUrl");
	exit;
}
