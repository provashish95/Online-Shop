<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../classes/customer.php");
?>

        <?php
        if (!isset($_GET['custid']) || $_GET['custid']== NULL) {
            echo "<script>window.location='inbox.php';</script>";
        }else{
            $id = $_GET['custid'];
        }

        
        if ($_SERVER['REQUEST_METHOD']== 'POST') {
            echo "<script>window.location='inbox.php';</script>";
     }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Deteils</h2>
               <div class="block copyblock"> 
                <?php
                if (isset($updateCat)) {
                    echo $updateCat;
                }?>

                <?php
                    $cus = new Customer();
                    $getCustomer = $cus->getCustomerData($id);
                    if ($getCustomer) {
                    while ($result = $getCustomer->fetch_assoc()) {
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address'];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>City</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city'];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>Country</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['country'];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>Zip</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['zip'];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>Phone</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone'];?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>
                
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>

                <?php } }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>