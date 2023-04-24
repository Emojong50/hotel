<?php 
ob_start();
include "include/db.php";
include "include/session.php";
include "include/functions.php";
include "include/datetime.php";  
//username and id
$userData = login();
// Split the user data string into an array
$userDataArray = explode(',', $userData ?? '');
// Get the individual values from the array
$username = $userDataArray[0] ?? '';
$user_id = $userDataArray[1] ?? '';


if(isset($_GET['addorder'])){
    $product_id = $_GET['productid'];
    $quantity = $_GET['quantity'];
    
    echo "product_id: ".$product_id."user_id: ".$user_id."quantity: ".$quantity;
    $query = "INSERT INTO orders(product_id, user_id, quantity) VALUES ($product_id,$user_id, $quantity)";
    if(mysqli_query($conn,$query)){
        echo "success";
    }else{
        echo error_get_last();
    }
}
elseif(isset($_GET['retrieve'])){?>
    <div class="container-fluid" id="#order" >
        <table class="bg-light text-dark table-hover table-responsive">
            <tr>
                <th >Sn</th>
                <th >Name</th>
                <th >Price</th>
                <th >Qty</th>
                <th >total</th>
                <th >Delete</th>
            </tr>
            <?php
            $query = "SELECT * FROM orders where user_id = $user_id";
            $execute = mysqli_query($conn, $query);
            $totalprice=0;
            $count=0;
            while($row = mysqli_fetch_array($execute)){
                $id= $row['id'];
                $product_id = $row['product_id'];
                //retrieve product price
                $query1 = "SELECT * FROM products WHERE id='$product_id' ORDER BY datetime DESC";
                $execute1 = mysqli_query($conn, $query1);
                while($row1 = mysqli_fetch_array($execute1)){
                    $name = $row1['name'];
                    $category = $row1['category']; 
                    $price = $row1['price'];
                    $image = $row1['image'];
                    
                }
                $user_id = $row['user_id'];
                $quantity = $row['quantity'];
                $totalprice = $price * $quantity; 
                $grandtotal += $totalprice;
                $count++;
                
                 
                

            
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $quantity;?></td>
                <td><?php echo $totalprice;?></td>
                <td><button class="btn btn-warning" onclick="deleteitem(<?php echo $id; ?>)" >delete</button></td>
            </tr>
            <?php } ?>
            <tr>
                <th colspan="3"><b>Grand Total</b></th>
                <th style="color: red;" colspan="3"><?php echo $grandtotal;?></th>
            </tr>
            <tr>
                <td colspan="6"><button class="btn btn-success btn-block">place order</button></td>
            </tr>
        </table>
        
    </div>
<?php 
}elseif(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];
        $query = "DELETE FROM orders WHERE id='$delete_id'";
        mysqli_query($conn,$query);
    
}elseif(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username= '$username'";
    $execute = mysqli_query($conn,$query);
    while($row = mysqli_fetch_array($execute)){
        $username1 = $row['username'];
        $password1 = $row['password'];
        $id = $row['id'];
        $firstname = $row['firstname'];
    }
    if($username1 ==null){
        $_SESSION["ErrorMessage"] = "user does not exist press signup to continue";
        redirect_to("./login.php");
    }
    elseif(password_verify($password, $password1)){
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username1;
        $_SESSION["SuccessMessage"] = "welcome $firstname ";
        redirect_to("./index.php");
    }else{
        $_SESSION["ErrorMessage"] ="wrong password please check your password";

        redirect_to("./login.php");
    }


}elseif(isset($_POST['signup'])){
    // prevent sql injection we sanitize the code

    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
    //chech whether the user exists
    $query = "SELECT * FROM users WHERE username=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        $_SESSION["ErrorMessage"] ="account creation failed, account already exists";
        redirect_to("./login.php");
    }
    else{


        // Prepare the statement
        $stmt = $conn->prepare("INSERT INTO users (firstname,lastname,username,password) VALUES (?,?,?,?)");
        
        // Bind the parameters s rep strings and 4 s  rep all the 4 columns to be added
        $stmt->bind_param("ssss", $firstname, $lastname, $username, $passwordhash);
        
        // Execute the statement
        $stmt->execute();
        
        // Check if the insert was successful
        if ($stmt->affected_rows > 0) {
            $_SESSION["SuccessMessage"]= "account creation successfull login to continue";
            redirect_to("./login.php");
        } else {
            $_SESSION["ErrorMessage"] ="account creation failed, account already exists";
            redirect_to("./login.php");
        }
    
        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }



}

ob_end_flush();
?>
