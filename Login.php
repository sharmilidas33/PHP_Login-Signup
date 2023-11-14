<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: Homepage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="Stylesheets/style.css">
    <!-- <link rel="stylesheet" href="../Stylesheets/responsive.css"> -->
    <!-- <link rel="stylesheet" href="../Stylesheets/login_style.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <nav class="nav">
            <div class="list">
                <ul>
                    <li><a href="Homepage.php">HOME</a></li>
                    <li><a href="About_us.php">ABOUT</a></li>
                    <li>
                        <div class="dropdown">
                        <button class="dropbtn" id="ocassion">EXPLORE MORE</button>
                        <div class="dropdown-content">
                            <a href="Cuisines.php">Cuisines</a>
                            <a href="Bakery.php">Bakery Items</a>
                            <a href="Desserts.php">Desserts</a>
                        </div>
                      </div>
                    </li>
                    <li><a href="Contact_us.php">CONTACT</a></li>
                </ul>
            </div>
            <div class="logo">
               <a href="#"><img src="Images/logo.png" alt="Logo"></a>
            </div>
            <div class="right_side">
                <div class="login"> <a href="Login.php"> <img src="Images/login.png"> </a></div>
                <div class="cart"> <a href="Cart.php"> <img src="Images/cart.png"> </a></div>
            </div>
        </nav>  
    </header> 
    <div class="login">
    <div class="wrapper">
        <?php
        if(isset($_POST["login"])){
            // $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            require_once "database.php";
            $sql = "SELECT * FROM user_form WHERE email='$email'";
            $result = mysqli_query($conn,$sql);
            $user= mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user){
                if(password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["user"] = true;
                    header("Location: Homepage.php");
                    die();
                }else{
                    echo "<div class='alert alert-success'>Invalid Password!</div>";
                }
            }else{
                echo "<div class='alert alert-success'>Email does not match!</div>";
            }
        }
        ?>
        <form action="Login.php" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <!-- <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forgot Password?</a>
                    </div> -->
                    <button type="submit" name="login" class="btn">Login</button>
                    <div class="signup-link">
                        <p>Don't have an account?
                        <a href="Sign_up.php">Sign Up</a></p>
                        </div>
             </form>
        </div>
    </div>
        <footer>
            <div class="footer_container">
                <div class="footer_logo">
                    <img src="Images/logo.png" alt="Logo">
                </div>
        
                <div class="footer_social">
                    <span id="follow">FOLLOW US ON</span>
                    <div class="social">
                        <i class='bx bxl-youtube'></i>                    
                        <i class='bx bxl-facebook'></i>
                        <i class='bx bxl-instagram'></i>
                    </div>
                    
                </div>
            </div>
            
            <div class="footer_copyright">
                &copy; 2023 Bite Delight. All rights reserved.
            </div>   
        </footer>
    
    </body>
    </html>
    </body>
    </html>
