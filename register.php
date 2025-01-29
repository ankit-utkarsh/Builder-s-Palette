<?php

session_start();

include('server/connection.php');

  //if user is already logged in, redirect to account page  
if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
}

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    

    //check if the password and confirm password match
    if($password !== $confirmPassword){
      header('location: register.php?error=Passwords do not match');
  
    } else if(strlen($password) < 6){
        header('location: register.php?error=Password must be at least 6 characters long');
    } else {
        // check whether there is a user with the same email or not
$stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
$stmt1->bind_param('s', $email);
$stmt1->execute();
$stmt1->bind_result($num_rows);
$stmt1->fetch();
$stmt1->close(); // Close the statement

//create a new user
$stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password) VALUES(?, ?, ?)");
$stmt->bind_param('sss', $name, $email, md5($password));


// if account was created successfully execute the INSERT statement
if($stmt->execute()){
    $user_id - $stmt->insert_id;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $name;
    $_SESSION['logged_in'] = true;
    header('location: account.php?register_success=You registered successfully!');
} else {  //account could not be created
    header('location: register.php?error=Account could not be created at the moment. Please try again later.');
}

$stmt->close(); // Close the statement after execution

    }
}

?>

<?php include('layouts/header.php'); ?>

    <!--Register Form-->
    <section class="my-5 py-5" style="font-weight: 600;">
        <div class="container text-center mt-3 pt-3">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
              <p style="color: red;"><?php if (isset($_GET['error'])){echo $_GET['error']; }?></p>

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Enter your name" required/>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="Enter your email" required/>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required/>
              </div>

                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirmPassword" placeholder="Confirm Password" required/>
                  </div>


                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
                </div>

                <div class="form-group">
                    <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
                </div>

            </form>
        </div>

    </section>

<?php include('layouts/footer.php'); ?>