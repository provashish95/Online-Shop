<?php include "inc/header.php"; ?>
<?php
$login = Session::get("custlog");
if ($login == false) {
	header("location: login.php");
}
?>
 <style>
.psuccess{width: 500px; height: 200px; text-align: center; border: 1PX solid #ddd; margin: 0 auto; padding: 20px;}
 .psuccess h2{border-bottom: 1px solid #ddd; margin-bottom: 20px; padding-bottom: 10px;}
 .psuccess p{line-height: 25px; text-align: justify; font-size: 20px;}
 
 </style>

 <div class="main">
    <div class="content">
    	<div class="section gorup">
    		<div class="psuccess">
                <h2>Payment Successfully</h2>
                <?php
                $cmrId = Session::get("cmrId");
                $amount = $ct->paybleAmount($cmrId);
                if ($amount) {
                	$sum = 0;
                	while ($result = $amount->fetch_assoc()) {
                		$price = $result['price'];
                		$sum = $sum + $price;
                	}
                }


                ?>
                 <p style="color: green">Total payble amount (Including vat): $
                 	<?php
                 	$vat = $sum * 0.1;
                 	$total = $vat + $sum;
                 	echo $total;
                 	?>
                 </p>
                <p>Thanks for purchase. Recieve your order successfully. We will contact you ASAP with delivery deteils.Here is your order deteils.........<a href="orderdeteils.php">Visit here....</a></p>
            </div>		
    	</div>
 	</div>
</div>

	<?php include "inc/footer.php"; ?>