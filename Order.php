<?php include "inc/header.php";?>
<?php
$login = Session::get("custlog");
if ($login == false) {
	header("location: login.php");
}
?>
<div>
	<div class="main">
		<div class="content">
			<div class="section group">
				<div class="order">
					<h2>Order page</h2>
					
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php include "inc/footer.php";?>