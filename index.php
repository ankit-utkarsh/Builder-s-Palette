<?php include('layouts/header.php'); ?> 
    
    <!--HOME-->
      <section id="home">
        <div class="container">
          <h2><b>We deliver to you</b></h2>
          <h1><b><span>the very best</b></span></h1>
          <p></p>
          <a href="index.php"><button>Shop Now</button></a>
      </section>

      <!--BRAND-->

      <section id="brand" class="container1" style="padding-top: 40px; background-color: rgb(250, 249, 246);">
        <h1 style="text-align: center;">Our most famous partners</h1>
        <div class="row1">
          <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assests/imgs/brand1.png" alt="brand1" style="height: 10%; width: 10%;"/>
          <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assests/imgs/brand2.png" alt="brand2" style="height: 10%; width: 10%;"/>
          <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assests/imgs/brand3.jpg" alt="brand3" style="height: 10%; width: 10%;"/>
          <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assests/imgs/brand4.jpg" alt="brand4" style="height: 10%; width: 10%;"/>

        </div>
      </section>


      <!--NEW-->
      <section id="new" class="w-100">
          <div class="row p- m-0">
              <!--One-->
              <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                  <img class="img-fluid" src="assests/imgs/paint and wallpapers.png" alt="new1" />
                  <div class="details">
                      <h2>Paints</h2>
                      <a href="shop.php"><button class="text-uppercase">Shop Now</button></a>
                  </div>
              </div>
              <!--Two-->

              <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                  <img class="img-fluid" src="assests/imgs/texture.png" alt="new1" />
                  <div class="details">
                      <h2>Textures</h2>
                      <a href="shop.php"><button class="text-uppercase">Shop Now</button></a>
                  </div>
              </div>

              <!--Three-->
              <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                  <img class="img-fluid" src="assests/imgs/Interior Designing.jpeg" alt="new1" />
                  <div class="details">
                      <h2>Wallpapers</h2>
                      <a href="shop.php"><button class="text-uppercase">Shop Now</button></a>
                  </div>
              </div>
          </div>
      </section>


      <!--FEATURED-->
      <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
        <h3>Featured Products</h3>
        <hr class="mx-auto">
        <p>Here we can check out our featured products</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_featured_products.php'); ?>

        <?php while($row = $featured_products->fetch_assoc()){ ?>
          
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assests/imgs/<?php echo $row['product_image']?>" />
            <div class="star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
            <a href = "<?php echo  "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
          </div>

          <?php } ?>

        </div>
      </section>

      <!--Banner-->
      <section id="banner" class="my-5 py-5">
        <div class="container">
          <h3>Unable to decide upon a colour?</h3>
          <br>
          <button class="text-uppercase">Explore more</button> 
          <h1>Discover colours for your walls</h1>
          <h2>that suit your personality!</h2>  
        </div>
      </section>

      <!--Paints and colors-->
      <section id="paints" class="my-5">
        <div class="container text-center mt-5 py-5">
        <h3>Paints and colors</h3>
        <hr class="mx-auto">
        <p>Here we can check out our best quality paints</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_colors.php'); ?>

        <?php while($row = $colors_products->fetch_assoc()){ ?>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assests/imgs/<?php echo $row['product_image'];?>"/>
            <div class="star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price">Rs. <?php echo $row ['product_price'];?></h4>
            <a href = "<?php echo  "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
          </div>

          <?php } ?>

        </div>
      </section>

      <!--Wallpapers-->

      <section id="wallpapers" class="my-5">
        <div class="container text-center mt-5 py-5">
        <h3>Wallpapers</h3>
        <hr class="mx-auto">
        <p>Here you can check out our amazing wallpapers</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_wallpapers.php'); ?>
        <?php while($row = $Wallpapers->fetch_assoc()){ ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assests/imgs/<?php echo $row['product_image'];?>"/>
            <div class="star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
            <a href = "<?php echo  "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
          </div>

          <?php } ?>

        </div>
      </section>

      <!--Textures-->

      <section id="textures" class="my-5">
        <div class="container text-center mt-5 py-5">
        <h3>Textures</h3>
        <hr class="mx-auto">
        <p>Here you can check out our all new unique and best-selling textures</p>
        </div>
        <div class="row mx-auto container-fluid">

          <?php include('server/get_texture.php'); ?>
        <?php while($row = $texture->fetch_assoc()){ ?>

          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assests/imgs/<?php echo $row['product_image'];?>"/>
            <div class="star">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            
            <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
            <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
            <a href = "<?php echo  "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
          </div>

          <?php } ?>

        </div>
      </section>

<?php include('layouts/footer.php'); ?>