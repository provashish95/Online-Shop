<?php include "inc/header.php"; ?>
<?php
$login = Session::get("custlog");
if ($login == false) {
	header("location: login.php");
}
?>
 <style>
.payment{width: 500px; height: 200px; text-align: center; border: 1PX solid #ddd; margin: 0 auto; padding: 50px;}
 .payment h2{border-bottom: 1px solid #ddd; margin-bottom: 40px; padding-bottom: 10px;}
 .payment a{background: #ff0000 none repeat scroll 0 0; border-radius: 3px; color: #fff; font-size: 25px; padding: 5px 30px;}
 .back a{width: 160px; margin: 25px auto 0; padding: 7px 0; text-align: center; display: block; background: #555; border: 1px solid #333; color: #fff; border-radius: 3px; font-size: 25px;}
 </style>

 <div class="main">
    <div class="content">
    	<div class="section gorup">
    		<div class="payment">
                <h2>Choose Your Payment Option</h2>
                <a href="paymentoffline.php">Offline Payment</a>
                <a href="paymentonline.php">Online Payment</a>
            </div>
            <div class="back">
                <a href="cart.php">Previous</a>
            </div>		
    	</div>
 	</div>
</div>

	<?php include "inc/footer.php"; ?>