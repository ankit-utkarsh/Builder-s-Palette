<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Builder's Pallete</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" href="assests/css/style.css"/>
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
                      <i class="fa fa-shopping-cart">
                        <?php if(isset($_SESSION['qunatity']) && $_SESSION['quantity']!=0) {?>
                          <span><?php echo $_SESSION['quantity']; ?></span>
                        <?php } ?>
                      </i>
                    </a><!-- Shopping cart icon -->
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