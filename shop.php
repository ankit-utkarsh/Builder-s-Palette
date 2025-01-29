<?php

include('server/connection.php');

if(isset($_POST['search'])){

$category = $_POST['category'];
$price = $_POST['price'];  

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price <= ?");

$stmt->bind_param("si", $category, $price);

$stmt->execute();

$products = $stmt->get_result();



}else{ //return all the products if the user does not choose to use the search bar

  if(isset($_GET['page_no']) && $_GET['page_no']!=""){
    //if the user had already visited the page and clicked on the pagination links, then the page number will be set to the page number that the user clicked on
    $page_no = $_GET['page_no'];
  }else{
    //if user just entered the page then the default page number will be 1
    $page_no = 1;
  
  }
  //return number of products
  $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");

  $stmt1->execute();

  $stmt1->bind_result($total_records);

  $stmt1->store_result();

  $stmt1->fetch();

  //total number of products per page

  $total_records_per_page = 12;

  $offset = ($page_no-1) * $total_records_per_page; //offset is the number of products that will be skipped

  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjacents = "2";

  $total_no_of_pages = ceil($total_records/$total_records_per_page); //total number of pages
  
  //get all the products

  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
  $stmt2->execute();
  $products = $stmt2->get_result();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" href="assests/css/style.css"/>

     <style>
    /*    .product img{
            width: 100%;
            height: auto;
            box-sizing: border-box;
            object-fit: cover;
        } */

        .pagination a{
            color:blueviolet;
            font-weight: 600;
        }

        .pagination li:hover a{
            color: #fff;
            background-color: blueviolet;
        }

        #shop{
            background-image: url('../assests/imgs/shopbanner.jpg');
              font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; 
                color:rgb(246, 218, 181);
                max-width: 100%;
                width: 100%;
                height: 80vh;
                background-size: cover;
                background-position-y: 50px ;
                flex-direction: column;
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
        }
    </style>
    </head>
<body>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-white bg-white py-3 fixed-top">
      <div class="container">
        <img class ="logo" src="assests/imgs/logo.png" alt="logo"/>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>

              <li class="nav-item">
                  <a class="nav-link" href="shop.php">Shop</a>
              </li>

              <li class="nav-item">
                      <a class="nav-link" href="#">Blog</a>
              </li>
              
              <li class="nav-item">
                      <a class="nav-link" href="contact.php">Contact Us</a>
              </li>
                      
                      
              <li class="nav-item">
                <a class="nav-link" href="cart.php">
                    <i class="fa fa-shopping-cart"></i> <!-- Shopping cart icon -->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="account.php">
                    <i class="fa fa-user"></i> <!-- User icon -->
                </a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

      <section id="shop">
        <div class="container">
          <h3><b>COLOUR IDEAS FOR YOUR HOME</b></h3>
          <br>
          <h1><b>Choose the best colours for your from our wide range of colours</b></h1>
          <p></p>
      </section>

    <!--Search-->
    
  <!--  <section id="search" class="my-5 py-5 ms-2">
      <div class="container mt-5 py-5">
        <p>Search Products</p>
        <hr>
      </div>

      <form action="shop.php" method="POST">
        <div class="row mx-auto container">
          <div class="col lg-12 col-md-12 col-sm-12">

          <p>Category</p>
          <div class="form-check">
            <input class="form-check-input" value="paints"type="radio" name="category" id="category_one">
            <label class="form-check-label" for="flexRadioDefault1">
              Paints
      </label>
      </div>

      <div class="form-check">
            <input class="form-check-input" value ="wallpapers" type="radio" name="category" id="category_two" checked>
            <label class="form-check-label" for="flexRadioDefault2">
              Wallpapers
      </label>
      </div>

      <div class="form-check">
            <input class="form-check-input" value = "textures" type="radio" name="category" id="category_three" checked>
            <label class="form-check-label" for="flexRadioDefault2">
              Textures
      </div>
      </div>
      </div>

      <div class="row mx-auto container mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12">

        <p>Price</p>
        <input type="range" class="form-range w-50" name="price" value="1000" min="1" max="10000" id="customRange2">
        <div class="w-50">
          <span style="float: left;">1</span>
          <span style="float: right;">10000</span>
        </div>
      </div>
      </div>

      <div class="form-group my-3 mx-3">
        <input type="submt" name="search" value="Search" class="btn btn-primary">
      </div>

      </form>
      </section> -->

    <!--Shop-->
  
    <section id="featured" class="my-5 pb-5">
        <div class="container mt-5 py-5">
        <h3>Our Products</h3>
        <hr>
        <p>Here we can check out our products</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php while($row = $products->fetch_assoc()) { ?>

          <div onclick="window.location.href='single_product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">

            <img class="img-fluid mb-3" src="assests/imgs/<?php echo $row['product_image']; ?>"/>
            <div class="star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">Rs. <?php echo $row['product_price']; ?></h4>
            <a class="btn shop-buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id'];?>">Buy Now</a>
            <br>
          </div>

          <?php } ?>

 
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-5">
                  
                    <li class="page-item<?php if($page_no<=1){echo 'disabled';}?>">
                    <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{echo "?page_no=".($page_no-1);} ?>">Previous</a>
                  </li>


                    <li class="page-item"><a class="page-link" href="?page_no = 1">1</a></li>
                    <li class="page-item"><a class="page-link" href="?page_no = 2">2</a></li>

                    <?php if($page_no >= 3){ ?>
                      <li class="page-item"><a class="page-link" href="#">...</a></li>
                      <li class="page-item"><a class="page-link" href="<?php echo"?page_no".$page_no;?>"><?php echo $page_no;?></a></li>


                    <?php } ?>
                    

                    <li class="page-item<?php if($page_no >= $total_no_of_pages){echo 'disabled';}?>">
                    <a class="page-link" href="<?php if($page_no >= $total_no_of_pages){echo '#';}else{ echo "?page_no=".($page_no + 1);}?>">Next</a></li>
            
                </ul>
            </nav>
                    

        </div>
      </section>

      

      <!--Footer-->
      <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class ="logo" src="assests/imgs/logo.png" alt="logo"/>
                <p class="pt-3">Builder's Pallete is a one step solution for all your home and house decors. </p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">Paints</a></li>
                    <li><a href="#">Wallpapers</a></li>
                    <li><a href="#">Textures</a></li>
                    <li><a href="#">Modular Kitchen</a></li>
                </ul>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>SRM Institute of Science and Technology, Chennai</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>123456789</p>
                </div>
                <div>
                  <h6 class="text-uppercase">Email</h6>
                  <p>info@email.com</p>
              </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                  <img src="assests/imgs/featured1.png" class="img-fluid w-25 h-10 m-2"></img>
                  <img src="assests/imgs/featured2.png" class="img-fluid w-25 h-10 m-2"></img>
                  <img src="assests/imgs/featured3.png" class="img-fluid w-25 h-10 m-2"></img>
                  <img src="assests/imgs/featured4.jpg" class="img-fluid w-25 h-10 m-2"></img>
                  <img src="assests/imgs/brand1.png" class="img-fluid w-25 h-10 m-2"></img>
                </div>
        </div>
    </div>

    <div class="copyright mt-5">
      <div class="row container mx-auto">
        <div class="col-lg-3 col-md-5 col-sm-12 md-4 text-nowrap mb-2">
          <img src="assests/imgs/payment.jpg" alt="payment" />
          </div>
          <div class="col-lg-3 col-md-5 col-sm-12 md-4">
            <p>© 2024 Builder's Pallete. All Rights Reserved</p>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 md-4">

          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>
</footer>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>