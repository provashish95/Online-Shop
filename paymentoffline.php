<?php include "inc/header.php"; ?>
<?php
$login = Session::get("custlog");
if ($login == false) {
	header("location: login.php");
}
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $cmrId = Session::get("cmrId");
    $insertOrder = $ct->orderProduct($cmrId);
    $delData = $ct->delCustomerCart();
    header('Location:success.php');
}

?>
 <style>
    .division{width: 50%; float: right;}
    .tblone{width: 500px; margin: 0 auto; border: 2px solid #ddd;}
    .tblone tr td{text-align: justify;}

    .tbltwo{float:right;text-align:left; width: 60%; border: 2px solid #ddd; margin-right: 40px; margin-top: 12px;}
    .tbltwo tr td{text-align: justify; padding: 15px 30px; }
    .ordernow{border-bottom: 30px;}
    .ordernow a{width: 200px; margin: 20px auto 0; text-align: center; padding: 5px; font-size: 30px; display: block; background: #ff0000; color: white; border-radius: 15px;}
 </style>
 <div class="main">
    <div class="content">
    	<div class="section gorup">
    		<div class="division">
                <table class="tblone">
                            <tr>
                                <th>NO</th>
                                <th>Product </th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            <?php
                            $getPro = $ct->getcartProduct();
                            if ($getPro) {
                                $i = 0;
                                $sum = 0;
                                $quantity = 0;
                                while ($result = $getPro->fetch_assoc()) {
                                    $i++;                           
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productName'];?></td>
                                <td>Tk.<?php echo $result['price'];?></td>
                                <td><?php echo $result['quantity'];?></td>
                                
                                <td>Tk. 
                                    <?php
                                        $total = $result['price'] * $result['quantity'];
                                        echo $total;
                                    ?></td>
                            </tr>
                            <?php
                            $quantity = $quantity + $result['quantity']; 
                            $sum = $sum + $total;
                           
                            ?>
                            <?php } }?>                         
                        </table>
                      
                        <table class="tbltwo" style=";" width="40%">
                            <tr>
                                <td>Sub Total</td>
                                <td>:</td>
                                <td>TK.<?php echo $sum; ?></td>
                            </tr>
                            <tr>
                                <td>VAT</td>
                                <td>:</td>
                                <td>10% (<?php echo $vat = $sum * 0.1;?>)</td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td>:</td>
                                <td><?php
                                    $vat = $sum * 0.1;
                                    $gtotal = $sum + $vat;
                                    echo $gtotal;
                                    ?>
                                </td>
                            </tr>
                       </table>
            </div>

            <div class="division1">
                <?php
            $id  = Session::get("cmrId");
            $getData = $cmr->getCustomerData($id);
            if ($getData) {
                while ($result =  $getData->fetch_assoc()) {
   
            ?>
        <table class="tblone">
            <tr>
                <td colspan="3"><h2>Your Profile Deteils</h2></td>
            </tr>
            <tr>
                <td width="20%">Name</td>
                <td width="5%">:</td>
                <td><?php echo $result['name'];?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><?php echo $result['phone'];?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $result['email'];?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $result['address'];?></td>
            </tr>
            <tr>
                <td>City</td>
                <td>:</td>
                <td><?php echo $result['city'];?></td>
            </tr>
            <tr>
                <td>Zip Code</td>
                <td>:</td>
                <td><?php echo $result['zip'];?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td><?php echo $result['country'];?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><a href="editprofile.php">Update Deteils</a></td>
            </tr>
        </table>
        <?php } } ?>
            </div>               		
    	</div>
 	</div>
    <div class="ordernow"><a href="?orderid=order">Order Now</a></div>
</div>

	<?php include "inc/footer.php"; ?>