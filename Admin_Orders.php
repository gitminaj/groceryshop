<?php

@include 'Config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:Login.php');
}

if(isset($_POST['update_order'])){

    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
    $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_orders->execute([$update_payment, $order_id]);
    $message[] = 'payment has been updated!';
 
 };
 
 if(isset($_GET['delete'])){
 
    $delete_id = $_GET['delete'];
    $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_orders->execute([$delete_id]);
    header('location:Admin_Orders.php');
 
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- fontawesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!--Css file link -->
    <link rel="stylesheet" href="css/Admin_style.css">

    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">

    <style>
        body {
            background: white;
        }
    </style>
</head>

<body>
    <?php include 'Admin_Header.php' ; ?>
    <div class="placed-orders">

        <div class="box-container">

            <?php 
               $select_orders = $conn -> prepare("SELECT * FROM `orders`");
               $select_orders -> execute();
               if($select_orders->rowCount() > 0){
                 while($fetch_orders = $select_orders -> fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">
                <p>user id : <span><?= $fetch_orders['user_id']; ?></span></p>
                <p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
                <p>name : <span><?= $fetch_orders['name']; ?></span></p>
                <p>email : <span><?= $fetch_orders['email']; ?></span></p>
                <p>number : <span><?= $fetch_orders['number']; ?></span></p>
                <p>address : <span><?= $fetch_orders['address']; ?></span></p>
                <p>total products : <span><?= $fetch_orders['total_products']; ?></span></p>
                <p>total price : <span><?= $fetch_orders['total_price']; ?></span></p>
                <p>Payment method : <span><?= $fetch_orders['method']; ?></span></p>

                <form action="" method="post">
                    <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?> ">
                    <select name="update_payment" class="drop-down">
                        <option value="" selected disabled><?= $fetch_orders['payment_status']; ?> </option>
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                    </select>
                    <div class="flex-box">
                        <input type="submit" value="update" name="update_order" class="option-btn aoubtn">
                        <a href="Admin_Orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn aodbtn" onclick="return confirm('delete this order?');">delete</a>
                    </div>
                </form>
            </div>
            <?php
                 }
               }else{
                  echo'<p class="empty">No orders placed yet!</p>';
               }
            ?>

        </div>
    </div>


        <script src="javascript/script.js"></script>
</body>

</html>