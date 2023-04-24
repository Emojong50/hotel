<?php 
include "include/db.php";
include "include/session.php";
include "include/functions.php";
include "include/datetime.php";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>customer login </title>
<style>
    /*body{
        background-image: linear-gradient(to right ,rgb(45, 45, 110),green);
    }*/
    body {
	background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab,rgb(57, 57, 212),rgb(37, 212, 37));
	background-size: 400% 400%;
	animation: gradient 15s ease infinite;
	height: 100vh;
    }

    @keyframes gradient {
    	0% {
    		background-position: 0% 50%;
    	}
    	50% {
    		background-position: 100% 50%;
    	}
    	100% {
    		background-position: 0% 50%;
    	}
    }

    .login{
        justify-content: center;
        position: absolute;
        top: 35%;
        left: 30%;
        width: 40%;
    }.login form{
        background-color: rgba(192, 208, 223,50%);
    }
    .center{
        text-align: center;
    }
</style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="navbar bg-dark" style="width:100%">
                <ul class="nav">
                    <li class="nav-link text-light">CAFE</li>
                    <div class="nav">
                    <li class="nav-link" ><a href="./login.php"><i class="fa fa-home" aria-hidden="true"></i>home</a></li>
                    <li class="nav-link" ><a href="./signup.php"><i class="fa fa-sign-out-alt" aria-hidden="true"></i>sign up</a></li>
                    </div>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="login ">
                
                <form action="./handler.php" method="post">
                    <h1 class="center">login</h1>
                    <div class="message">
                        <?php echo SuccessMessage();echo Message(); ?>
                    </div>
                    <hr>
                    <label for="username">username</label>
                    <input type="text" name="username" id="username" class="form-control">
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <br>
                    <input type="submit" value="login" class="btn btn-primary btn-block" name="login">
                    <p><span style="color:rgb(110, 97, 97)">by clicking Login, You agree to our terms and conditions. Don't have an account </span><span><a href="./signup.php">?signup</a></span></p>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>