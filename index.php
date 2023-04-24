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

if ($user_id == null){
    redirect_to("./login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="./assets/css/style.css">

<title>cafe</title>
<style>
@media (max-width: 768px) {
    #side {/*to change the side nav to a fixed position on smaller screens */
        position: fixed;
        z-index: 888; /*to bring forward the the items as position fixed tend to place the div behind other divs */
        
    }.navbar-collapse.collapse.show + * {/*to move text downward when the collapse button is toggled */
        margin-top: 45%;
    }
    
}
.overlay{
  position: absolute;
  top:10% ;
  left: 20%;
}
#close{
  border: 1px solid black;
  border-radius: 5px;
  margin-left: 80%;
}





</style>
</head>
<body style="background-color: green;">
    <div class="container-fluid">
        <div class="row">
            <div class="navbar " style="z-index: 888;" style="width: 100%;">
                <nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top" >
                    <button  class="navbar-toggler d-lg-none" style="background-color: yellow;" type="button" data-target="#side" aria-controls="side" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-arrow-circle-down" aria-hidden="true"  style="color: rgb(43, 103, 194);"></i></button>
                    <a class="navbar-brand" href="#" id="brand"> Ken's Cafe </a>
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="collapsibleNavId">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mx-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">categories</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="./index.php?#coffee">Coffee</a>
                                    <a class="dropdown-item" href="./index.php?#tea">Tea</a>
                                    <a class="dropdown-item" href="./index.php?#snacks">Snacks</a>

                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">about us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./login.php"><?php loginchecker();?></a>
                            </li>
                            
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row" style="margin-top: 40px;">
        <div class="col-sm-1 d-md-block collapse navbar-collapse bg-dark" id="side"><!--side navigation-->
            <h1 >items</h1>
            <hr>
            <ul class="navbar-nav bg-dark" id="sidebar" style="position: sticky;top:10%">
              <li  class="nav-link"><a href="./index.php?#coffee">Coffee </a></li>
              <li class="nav-link"><a href="./index.php?#tea">Tea</a></li>
              <li class="nav-link"><a href="./index.php?#snacks">Snacks </a></li>
            </ul>
        </div>

            <div class="col-sm-8">
                <div class="message">
                    <?php echo SuccessMessage();echo Message(); ?>
                </div>
                <h1 id="coffee" ><i class="fa fa-coffee" aria-hidden="true"></i>coffee</h1>
                <hr>
                <div class="coffee owl-carousel"><!--start of coffee-->
                    <?php 
                    $query = "select * from products where category='coffee'";
                    $execute = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($execute)){
                        $id = $row['id'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $image = $row['image'];
                    
                    ?>
                    <div class="item">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1><?php echo $name;?></h1>
                                <div class="product">
                                    
                                    <div class="image">
                                        <img src="./assets/images/coffee/<?php echo $image;?>" alt="<?php echo $name;?>">
                                    </div>
                                    <div class="details">
                                        <p>price kshs: <span class="p-price"><?php echo $price; ?></span></p>
                                        
                                    </div>
                                </div>
                                <hr class="my-2">
                                <p class="lead">
                                <label for="quantity">quantity</label>
                                <!--quantity-->
                                <input type="number" class="quantity form-control" value="1" min="1" max="10"><br>
                                <button class="btn btn-warning btn-block orderbtn" data-user="<?php echo $user_id; ?>" data-id="<?php echo $id; ?>"  role="button">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i> price kshs: <span class="btnprice"> <?php echo $price; ?></span>
                                </button>
                                </p>
                            </div>
                        </div>
                    </div><!--end of coffee-->
                    <?php }?>
                    
                </div>
                <h1 id="tea">Tea</h1>
                <hr>
                <div class="tea owl-carousel"><!--tea start-->
                    <?php
                    $query = "select * from products where category='tea'";
                    $execute = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($execute)){
                        $id = $row['id'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $image = $row['image'];
                    
                    ?>
                    <!--inside the while loop to loop the .item based on the items in the database eg if 4 rows , 4 item classes-->
                    <div class="item">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1><?php echo $name; ?></h1>
                                <div class="product">
                                    
                                    <div class="image">
                                        <img src="./assets/images/tea/<?php echo $image;?>" alt="<?php echo $name; ?>">
                                    </div>
                                    <div class="details">
                                        <p >price <span class="p-price"><?php echo $price; ?></span></p>
                                        
                                    </div>
                                </div>
                                <hr class="my-2">
                                <p class="lead">
                                <label for="quantity">quantity</label>
                                <!--quantity-->
                                <input type="number" class="quantity form-control" value="1" min="1" max="10"><br>
                                <button class="btn btn-warning btn-block orderbtn"data-user="<?php echo $user_id; ?>" data-id="<?php echo $id; ?>"  role="button">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i> price kshs: <span class="btnprice"> <?php echo $price; ?></span>
                                </button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div><!--tea end -->
                <h1 id="snacks">snacks</h1>
                <hr>
                <div class="snacks owl-carousel"><!--snacks start-->
                <?php
                    $query = "select * from products where category='snacks'";
                    $execute = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_array($execute)){
                        $id = $row['id'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $image = $row['image'];
                    
                    ?>
                    
                    <div class="item">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1><?php echo $name; ?></h1>
                                <div class="product">
                                    
                                    <div class="image">
                                        <img src="./assets/images/snacks/<?php echo $image;?>" alt="<?php echo $name; ?>">
                                    </div>
                                    <div class="details">
                                        <p>price <span class="p-price"><?php echo $price; ?></span></p>
                                        
                                    </div>
                                </div>
                                <hr class="my-2">
                                <p class="lead">
                                <label for="quantity">quantity</label>
                                <!--quantity-->
                                <input type="number" class="quantity form-control" value="1" min="1" max="10"><br>
                                <button class="btn btn-warning btn-block orderbtn" data-user="<?php echo $user_id; ?>" data-id="<?php echo $id; ?>" role="button">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i> price kshs:<span class="btnprice"> <?php echo $price; ?></span>
                                </button>



                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
            <div class="col-sm " style="background-color: aqua;" >
                <h1 >order</h1>
                <hr>
                <div class="tbl" id="order" style="position: sticky;top:10%">
                    <table border="1" class="table-dark table-responsive table-hover">
                        <tr>
                            <th>Name</th>
                            <th>price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>delete</th>
                        </tr>
                        <tr>
                            <td>Latte</td>
                            <td>500</td>
                            <td>2</td>
                            <td>1000</td>
                            <td><button  class="btn btn-warning">delete</button></td>
                        </tr>
                        <tr>
                            <th colspan="3">Grand Total</th>
                            <th>1000</th>
                        </tr>
                    </table>
                </div>
            </div>
            
        </div>
        <div  class="overlay  col-sm-4" id="overlay" >
        <table class="table bg-dark" style="color:white">
          <tr>
            <th colspan="4">order placement</th>
            <th colspan="1"><button id="close" style="color: white;background-color: red;">x</button></th>
          </tr>
        </table>
        </div>
    </div>

<script src="./node_modules/jquery/dist/jquery.min.js"></script>
<script src="./node_modules/popper.js/"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/js/style.js?4"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<script>
    $(document).ready(function(){
        retrievetable();
        //changing the owl carousel default nav buttons
        $('.owl-prev').find('span').html('<img src="./assets/images/icons/previous.png" alt="Previous" width=50%> ');
        $('.owl-next').find('span').html('<img src="./assets/images/icons/previous.png" alt="Next" width="50%" style="transform: scaleX(-1);">');//the css transform to mirror the previous button ,so as to have 2 matching buttons
        $("#order").on("click", function(){
    
          $("#overlay").fadeIn(1000);
          $("#overlay").prop('hidden', false);


        });
        $("#close").on("click", function(){
          $("#overlay").fadeOut(1000, function(){
            $("#overlay").prop('hidden', true);
          });


        });

    });
    
    function retrievetable(){
        $.ajax({
            url:'./handler.php',
            method: 'GET',
            data:{retrieve:1},
            success: function(response){
                //alert(response);
                $('#order').html(response);
            }
            

        });

    }
    function deleteitem(delete_id){
      $.ajax({
        url: './handler.php',
        method: 'GET',
        data:{delete_id:delete_id},
        /*success: function(response){
          alert(response);

        }*/
      });
      retrievetable();
    }
    function sum(){
        // get the elements
        // get the elements
        const quantityElements = document.querySelectorAll('.quantity');
        const priceElements = document.querySelectorAll('.p-price');
        const btnPriceElements = document.querySelectorAll('.btnprice');

        // loop through each element
        quantityElements.forEach((quantityElement, i) => {
          // add event listener to quantity input field
          quantityElement.addEventListener('input', () => {
            // calculate the total price
            const totalPrice = parseFloat(priceElements[i].textContent) * parseInt(quantityElement.value);
        
            // set the total price to btnprice
            btnPriceElements[i].textContent = totalPrice.toFixed(2);
          });
        });

        
        
    }
    sum();
    
    $(".orderbtn").click(function() {
      var quantity = $(this).closest(".item").find(".quantity").val();
      var productid = $(this).attr("data-id");
      var userid = $(this).attr("data-user")
      order(productid,quantity);
      
      function order(id,quantity){
        $.ajax({
            url:'./handler.php',
            method: 'GET',
            data:{addorder:1, quantity:quantity, productid:id},
            success: function(response){
                //alert(response);
                // $('#order').html(response);
                retrievetable();
            }
            

        });

        
    }

    });

    
    

    



</script>
</body>
</html>
<?php ob_end_flush(); ?>