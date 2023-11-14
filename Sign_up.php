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
    <!-- <link rel="stylesheet" href="../Stylesheets/signup_style.css"> -->
    <!-- <link rel="stylesheet" href="../Stylesheets/responsive.css"> -->
    <link rel="stylesheet" href="Stylesheets/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
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
    <div class="signup">
    <div class="wrapper">
        <?php
            if(isset($_POST["submit"])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirmPassword'];

                //  Password Hashing
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Checking for empty fields in the form
                $errors = array();
                
                if(empty($name) OR empty($email) OR empty($password) OR empty($confirmPassword)){
                    array_push($errors,"All fields are required");
                }
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($errors,"Email is not valid");
                }
                if(strlen($password)<8){
                    array_push($errors,"Password should be at least 8 characters long");
                }
                if ($password != $confirmPassword){
                    array_push($errors,"Passwords do not match");
                }

                require_once "database.php";
                $sql= "SELECT * FROM user_form WHERE email='$email'";
                $result = mysqli_query($conn,$sql);
                $rowCount = mysqli_num_rows($result);
                if($rowCount >0){
                    array_push($errors,"Email already exists");
                }
                if(count($errors)>0){
                    foreach($errors as $errors){
                        echo "<div class='alert alert-danger'>$errors</div>";
                    }
                }else{
                    $sql = "INSERT INTO user_form (name, email, password) VALUES (?,?,?)";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if($prepareStmt){
                        mysqli_stmt_bind_param($stmt,'sss',$name,$email,$passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Signing Up Succesfull!</div>";
                        header("Location: Login.php");
                    }else{
                        die("Something went wrong");
                    }
                }
            }
        
        ?>
        <form action="Sign_up.php" method="post">
            <h1>Sign Up</h1>
            <a>Name </a>
            <div class="input-box">
                <input type="text" name="name" placeholder="Enter Your Name" required>
                <i class='bx bxs-user'></i>
                </div>
                <a>E-mail address</a>
                  <div class="input-box">
                <input type="email" name="email" placeholder="Enter your e-mail address" required>
                <i class='bx bxs-envelope'></i>
                </div>
                <a>Password</a>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Create-Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <a>Confirm Password</a>
                <div class="input-box">
                    <input type="text" name="confirmPassword" placeholder="Confirm-Password" required>
                    <i class='bx bxs-lock-alt'></i>
                    </div>
                <!-- <div class="remember-forgot">
                    <label><input type="checkbox">I accept all terms and conditions</label>
                    
                    </div> -->
                    <button type="submit" name="submit" class="btn">Sign-up</button>
                    <div class="login-link">
                        <p>Already have an account?
                        <a href="Login.php">Login</a></p>
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
