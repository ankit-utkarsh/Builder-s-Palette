<?php
session_start();

include('server/connection.php');

//if user is not logged in, redirect to login page
if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        header('location: login.php');
    }
}

if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    // Check if the password and confirm password match
    if ($password !== $confirmPassword) {
        header('location: account.php?error=Passwords do not match');
        exit;
    } else if (strlen($password) < 6) {
        header('location: account.php?error=Password must be at least 6 characters long');
        exit;
    }

    // Update the password
    $hashedPassword = md5($password);
    $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
    $stmt->bind_param('ss', $hashedPassword, $user_email);

    if ($stmt->execute()) {
        header('location: account.php?message=Password changed successfully!');
        exit;
    } else {
        header('location: account.php?error=Password could not be changed at the moment. Please try again later.');
        exit;
    }
}

//get orders
if (isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

?>

<?php include('layouts/header.php'); ?>

    <!--Account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <p class="text-center" style="color: green;"><?php if (isset($_GET['register_success'])) {
                                                                    echo $_GET['register_success'];
                                                                } ?></p>
                <p class="text-center" style="color: green;"><?php if (isset($_GET['login_success'])) {
                                                                    echo $_GET['login_success'];
                                                                } ?></p>
                <h3 class="font-weight-bold">Account info</h3>
                <hr class="mx-auto">
                <div class="account-info" style="font-weight: 600;">
                    <p>Name <span><?php if (isset($_SESSION['user_name'])) {
                                        echo $_SESSION['user_name'];
                                    } ?></span></p>
                    <p>Email: <span><?php if (isset($_SESSION['user_email'])) {
                                            echo $_SESSION['user_email'];
                                        } ?></span></p>
                    <p><a href="#orders" id="orders-btn">Your orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST" action="account.php" style="font-weight: 600;>
                    <p class="text-center" style="color: red"><?php if (isset($_GET['error'])) {
                                                                    echo $_GET['error'];
                                                                } ?></p>
                    <p class="text-center" style="color: green;"><?php if (isset($_GET['message'])) {
                                                                        echo $_GET['message'];
                                                                    } ?></p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required />
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password" required />
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password" class="btn" id="change-password-btn" />
                    </div>
                </form>
            </div>
        </div>

    </section>

    <!--Orders-->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-2">
            <h2 class="font-weight-bold text-center">Your Orders</h2>
        </div>

        <table class="mt-5 pt-5">
            <tr>
                <th>Order ID</th>
                <th>Order Cost</th>
                <th>Order status</th>
                <th>Order date</th>
                <th>Order Details</th>

            </tr>

            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <!-- <img src="assests/imgs/featured1.png" alt="product" /> -->
                            <div>
                                <p class="mt-3"><?php echo $order['order_id']; ?></p>

                            </div>
                        </div>

                    </td>

                    <td>
                        <span><?php echo $order['order_cost']; ?> </span>
                    </td>

                    <td>
                        <span><?php echo $order['order_status']; ?> </span>
                    </td>

                    <td>
                        <span class="text-center"><?php echo $order['order_date']; ?> </span>
                    </td>

                    <td>
                        <form method="POST" action="order_details.php">
                            <input type="hidden" value="<?php echo $order['order_status']; ?>" name="order_status" />
                            <input type="hidden" value="<?php echo $order['order_id']; ?>" name="order_id" />
                            <input class="btn order-details-btn" name="order_details_btn" type="submit" value="Details" />
                        </form>
                    </td>

                </tr>
            <?php } ?>

        </table>

    </section>


<?php include('layouts/footer.php'); ?>