<?php

@include 'Config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:Login.php');
}

if(isset($_POST['update_profile'])){

    $name = $_POST['name'];
    $name = filter_var($name , FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email , FILTER_SANITIZE_STRING);

    $update_profile = $conn -> prepare("UPDATE `users` SET name = ? , email = ? WHERE id = ?");
    $update_profile -> execute ([$name , $email ,$admin_id]);

    if($update_profile){
        $message[] = 'username/email updated!';
    }

    $old_pass = $_POST['old_pass'];
    $update_pass = $_POST['update_pass'];
    $update_pass = filter_var($update_pass,FILTER_SANITIZE_STRING);
    $new_pass = $_POST['new_pass'];
    $new_pass = filter_var($new_pass,FILTER_SANITIZE_STRING);
    $confirm_pass = $_POST['confirm_pass'];
    $confirm_pass = filter_var($confirm_pass,FILTER_SANITIZE_STRING);

    if(!empty($update_pass) OR !empty($new_pass) OR !empty($confirm_pass)){
            if($update_pass != $new_pass){
                $message[] = 'old password not matched';
            }
            elseif($new_pass != $confirm_pass){
                $message[] = 'confirm password not matched!';
            }else{
                $update_pass_query = $conn -> prepare ("UPDATE `users` SET PASSWORD = ? WHERE id = ?");
                $update_pass_query -> execute([$confirm_pass , $admin_id]);
                $message[] = ' updated successfuly';
            }
        }


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upadate Admin profile</title>

    <!-- fontawesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!--Css file link -->
    <link rel="stylesheet" href="css/Component.css">

    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&display=swap" rel="stylesheet">

    <style>
        body{
            background: #f1ebeb;
        }
    </style>
</head>
<body>

<?php include 'Admin_Header.php' ; ?>

<div class="update-profile">

    <p class="title">UPDATE PROFILE </p>

    <form action="" method="post">
        <div class="flex-btn">
            <div class="input-box">
                <span>Username: </span>
                <input type="text" name="name" value="<?= $fetch_profile['name'] ?>" placeholder="Update username" required class="box">
                <span>email: </span>
                <input type="email" name="email" value="<?= $fetch_profile['email'] ?>" placeholder="Update email" required class="box">
            </div>
            <div class="input-box">
                <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
                <span>old password: </span>
                <input type="password" name="update_pass" placeholder="Enter old password" class="box">
                <span>new password: </span>
                <input type="password" name="new_pass" value="" placeholder="Enter new password" class="box">
                <span>confirm password: </span>
                <input type="password" name="confirm_pass" value="" placeholder="Confirm password" class="box">
            </div>
        </div>
        <div class="flex-btn">
            <input type="submit" value="Update Profile" class="update-btn" name="update_profile">
        </div>
    </form>
</div>

<?php include 'Footer.php' ?>
    <script src="javascript/script.js"></script>
</body>
</html>