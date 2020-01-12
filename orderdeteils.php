<?php include "inc/header.php";?>
<?php
$login = Session::get("custlog");
if ($login == false) {
	header("location: login.php");
}
?>
<style>
	.tblone tr td{text-align: justify;}
</style>
<div>
	<div class="main">
		<div class="content">
			<div class="section group">
				<div class="order">
					<h2>Your Order Deteils</h2>
					<table class="tblone">
							<tr>
								<th >NO</th>
								<th >Product Name</th>
								<th >Quantity</th>
								<th >Price</th>
								<th >Date</th>
								<th >Status</th>
								<th >Action</th>		
							</tr>
							<?php
							$cmrId = Session::get("cmrId");
							$getOrder = $ct->getOrderProduct($cmrId);
							if ($getOrder) {
								$i = 0;
								while ($result = $getOrder->fetch_assoc()) {
									$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'];?></td>
								
								<td><?php echo $result['quantity'];?></td>
							
								<td>Tk. 
									<?php
										$total = $result['price'];
								 		echo $total;
								 	?></td>
								 	<td><?php echo $fm->formatDate($result['date']);?></td>
								 	<td><?php
								 	 if ($result['status'] == 0) {
								 	 	echo "Pending";
								 	 }else{
								 	 	echo "Shift";
								 	 }
								 	 
								 	 ?></td>
								 	 <?php
								 	  if ($result['status'] == 1) {?>
								 	 		<td><a onclick="return confirm('Are you sure to delete');" href="">Delete</a></td>
							</tr>
								 	<?php }else{?>
								 		<td>Not available</td>
								 <?php	}?>
								 							
							<?php } }?>							
						</table>
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php include "inc/footer.php";?>