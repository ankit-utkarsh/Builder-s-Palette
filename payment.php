<?php
session_start();

if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
}

?>
<?php include('layouts/header.php'); ?>

    <!--Payment-->
    
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-3">
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">

            <?php if(isset($_SESSION['total']) && $_SESSION['total'] !=0 ){?>
            <p>Total payment: Rs. <?php echo $_SESSION['total']; ?></p>
            <!-- <input class="btn btn-primary" type="submit" value="Pay Now"> -->
            </p>Order successfully placed. Please pay to the our delivery executive at the the time of delivery</p>


            <?php } else if(isset($order_status) && $order_status == "not paid"){ ?>
            <p>Total payment: Rs. <?php echo $order_total_price; ?></p>
            </p>Order successfully placed. Please pay to the our delivery executive at the the time of delivery</p>
           <!-- <input class="btn btn-primary" value="Pay Now" type="submit"> -->
            <?php }else { ?>
                <p>You don't have any pending payment/orders</p>
                <?php } ?>
        </div>

    </section>

<?php include('layouts/footer.php'); ?>
