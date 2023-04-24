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
<title>sign up</title>
</head>
<style>
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
    .signup{
        background-color: rgba(231, 225, 212,50%);
        justify-content: center;
        position: absolute;
        top: 10%;
        left: 30%;
        width: 40%;
    }
</style>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="navbar bg-dark" style="width:100%">
                <ul class="nav">
                    <li class="nav-link text-light">CAFE</li>
                    <div class="nav">
                    <li class="nav-link" ><a href="./login.php"><i class="fa fa-home" aria-hidden="true"></i>home</a></li>
                    <li class="nav-link" ><a href="./signup.html"><i class="fa fa-sign-out-alt" aria-hidden="true"></i>sign up</a></li>
                    </div>
                </ul>
            </div>
        </div>
        <div class="signup">
            <h1>signup</h1>
            <hr>
            <form action="./handler.php" method="post">
                <label for="fname">firstname</label>
                <input type="text" name="fname" id="fname" class="form-control">
                <label for="lname">lastname</label>
                <input type="text" name="lname" id="lname" class="form-control">
                <label for="username">username</label>
                <input type="text" name="username" id="username" class="form-control">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <label for="cpassword">Confirm password</label>
                <input type="password" name="cpassword" id="cpassword" class="form-control">
                <p id="password_validation"></p>
                <label for="email">email</label>
                <input type="email" name="email" id="email" class="form-control">
                <br>
                <input type="submit" value="signup" class="btn btn-warning btn-block" name="signup" id="signup">
                <br>
                <p><span style="color:rgb(110, 97, 97)">by clicking signup, You agree to our terms and conditions. already have an account </span><span><a href="./login.php">?login</a></span></p>

            </form>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script src="./assets/js/passwordvalidator.js"></script>
<script>
    $(document).ready(function() {
        $('#fname, #lname').on('keyup', function() {
        var val = $(this).val();
        $(this).val(val.charAt(0).toUpperCase() + val.slice(1));
        });  
    });

</script>
</body>
</html>