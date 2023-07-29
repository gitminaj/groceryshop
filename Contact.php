<?php

@include 'Config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:Login.php');
}

if(isset($_POST['send'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $msg = $_POST['msg'];
    $msg = filter_var($msg, FILTER_SANITIZE_STRING);
 
    $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
    $select_message->execute([$name, $email, $number, $msg]);
 
    if($select_message->rowCount() > 0){
       $message[] = 'already sent message!';
    }else{
 
       $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
       $insert_message->execute([$user_id, $name, $email, $number, $msg]);
 
       $message[] = 'sent message successfully!';
 
    }
 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

     <!-- fontawesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<!--Css file link -->
<link rel="stylesheet" href="css/Style.css">

<!-- font link -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">

<style type="text/css">
textarea {
   font-size: 20pt;
   font-family: Arial;
} 
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>

</head>
<body>
<?php include 'Header.php' ?>

<div class="contact">

   <h1 class="title">Get in touch</h1>

   <form action="" method="POST">
      <input type="text" name="name" class="con-box" required placeholder="enter your name">
      <input type="email" name="email" class="con-box" required placeholder="enter your email">
      <input type="number" name="number" min="0" class="con-box" required placeholder="enter your number">
      <textarea name="msg" class="con-box" required placeholder="enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" class="con-btn" name="send">
   </form>

</div>


<?php include 'Footer.php'?>
<script src="javascript/script.js"></script>
    
</body>
</html>