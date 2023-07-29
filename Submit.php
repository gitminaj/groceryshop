<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>success</title>
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");
        .success-container {
            width:50%;
            position:absolute;
            top:30%;
            left:50%;
            transform:translate(-50%,-50%);
            color:#bdc3c7;
            font-weight:bold;
            font-family: "Poppins", sans-serif;
        }
    </style>
</head>
<body>
    <?php require "config.php" ?>
      <div class="success-container">
        <h3>done</h3>
        <a href="Home.php">continue shopping</a>
        
<?php 

session_start();

$user_id = $_SESSION['user_id'];

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

$cart_total = 0;
$cart_products[] = '';

$cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$cart_query->execute([$user_id]);
if($cart_query->rowCount() > 0){
   while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
      $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
      $sub_total = ($cart_item['price'] * $cart_item['quantity']);
      $cart_total += $sub_total;
   };
};

$total_products = implode(', ', $cart_products);

$order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
$order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

if($cart_total == 0){
   $message[] = 'your cart is empty';
}elseif($order_query->rowCount() > 0){
   $message[] = 'order placed already!';
}else{
   $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
   $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$user_id]);
   $message[] = 'order placed successfully!';
}


?>
</div>  
</body>
</html>
