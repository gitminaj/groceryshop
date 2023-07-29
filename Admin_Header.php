
<header class="header">

    <div class="flex">
        <a href="Admin_Page.php" class="logo">Admin<span>Panel</span></a>

        <nav>
            <a href="Admin_Page.php">Home</a>
            <a href="Admin_Products.php">Product</a>
            <a href="Admin_Users.php">Users</a>
            <a href="Admin_Orders.php">Orders</a>
            <a href="Admin_Contacts.php">messages</a>
        </nav>
        <div class="icons">
          <!-- <i id="menu" class="fa-solid fa-bars"></i> -->
          <i id="user" class="fa-solid fa-user"></i>
        </div>
        <div class="profile">
            <?php
            $select_profile = $conn -> prepare ("SELECT * FROM `users` WHERE id = ?");
            $select_profile -> execute([$admin_id]);
            $fetch_profile = $select_profile -> fetch(PDO::FETCH_ASSOC);
            ?>
            <p><?= $fetch_profile['name'] ?></p>
            <a href="Admin_Update_Profile.php" class="updtprofile-btn">Update Profile </a>
            <a href="Login.php" class="logout-btn">Logout</a>
            <div class="flex-btn">
                <a href="Login.php" class="login-btn">Login</a>
                <a href="Register.php" class="register-btn">Register</a>
            </div>
        </div>

    </div>
</header>

<?php

if(isset($message)){
    foreach($message as $message){
        echo '   <div class="message">
                     <span>'.$message.'</span>
                     <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                 </div>
        ';
    }
}

?> 
