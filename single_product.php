<?php

include('server/connection.php');

if(isset($_GET['product_id'])){

  $producit_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");

  $stmt->bind_param("i", $_GET['product_id']);

  $stmt->execute();

  $product = $stmt->get_result(); 

}else{          //no product id was given
    header('Location: index.html');
} 

?>

<?php include('layouts/header.php'); ?>

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

      <!--Single Product-->
    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">

        <?php while($row = $product->fetch_assoc()){ ?>

            <div class="col-lg-5 col-md-12 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assests/imgs/<?php echo $row['product_image']; ?>" id="mainImg"/>
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assests/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assests/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assests/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img"/>
                    </div>
                    <div class="small-img-col">
                        <img src="assests/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img"/>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm12">
                <h6>Premmium Paints</h6>
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h2>Rs. <?php echo $row['product_price']; ?></h2>

                <form method="POST" action="cart.php">
                  <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                  <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                  <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                  <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>

                  <input type="number" name="product_quantity" value="1"/>
                  <button class="buy-btn" type="submit" name="add_to_cart">Add to Cart</button>
                </form>

                <h4 class="mt-5 mb-5">Product details</h4>
                <span><?php echo $row['product_description']; ?>
                </span>
            </div>

            <?php } ?>

        </div>
    </section>

    <!--Related Products-->
    <section id="related products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
        <h3>Related Products</h3>
        <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid">
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assests/imgs/featured1.png"/>
            <div class="star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            
            <h5 class="p-name">Royale Aspira</h5>
            <h4 class="p-price">Rs. 1250</h4>
            <button class="buy-btn">Buy Now</button>
          </div>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assests/imgs/featured2.png"/>
            <div class="star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            
            <h5 class="p-name">Royale Glitz</h5>
            <h4 class="p-price">Rs. 650</h4>
            <button class="buy-btn">Buy Now</button>
          </div>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assests/imgs/featured3.png"/>
            <div class="star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            
            <h5 class="p-name">Royale Luxury Emulsion</h5>
            <h4 class="p-price">Rs. 454</h4>
            <button class="buy-btn">Buy Now</button>
          </div>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assests/imgs/featured4.jpg"/>
            <div class="star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            
            <h5 class="p-name">Royale Luxury Matt</h5>
            <h4 class="p-price">Rs. 471</h4>
            <button class="buy-btn">Buy Now</button>
          </div>

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

    <script>
      var mainImg = document.getElementById("mainImg");
      var smallImg = document.getElementsByClassName("small-img");

      for(let i=0; i<6; i++){
        smallImg[i].onclick = function() {
        mainImg.src = smallImg[i].src;

                  }
      }

    </script>
</body>
</html>