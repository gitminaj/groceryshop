<?php
require("./configpay.php");
require("config.php");

// \Stripe\Stripe::setVerifySslCerts(false);

$token = $_POST['stripeToken'];
$name = $_POST['name'];
$name = filter_var($name, FILTER_SANITIZE_STRING);
$number = $_POST['number'];
$number = filter_var($number, FILTER_SANITIZE_STRING);
$email = $_POST['email'];
$email = filter_var($email, FILTER_SANITIZE_STRING);
$method = $_POST['method'];
$method = filter_var($method, FILTER_SANITIZE_STRING);
$address = 'flat no. '. $_POST['flat'] .' '. $_POST['street'] .' '. $_POST['city'] .' '. $_POST['state'] .' '. $_POST['country'] .' - '. $_POST['pin_code'];
$address = filter_var($address, FILTER_SANITIZE_STRING);
$placed_on = date('d-M-Y');
$amount = $_POST['']

$charge=\Stripe\PaymentIntent::create(array(
    "amount"=>,
    "currency"=>"inr",
));

if($charge){
    header("Location:Submit.php?amount=$amount");
  }


?>