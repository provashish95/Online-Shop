<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Product.php";?>
<?php include_once "../helpers/Format.php"; ?>
<?php 
$pd = new Product();
$fm = new Format();

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>

				<?php
				$getPd = $pd->getAllProduct();
				if ($getPd) {
					$i = 0;
					while ($result = $getPd->fetch_assoc()) {
						$i++;

				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catId'];?></td>
					<td><?php echo $result['brandId'];?></td>
					<td><?php echo $fm->textShorten($result['body'], 50);?></td>
					<td>$<?php echo $result['price'];?></td>
					<td><img src="<?php echo $result['image'];?>" height="50px" width="60px"></td>
					<td>
						<?php 
						 if ($result['type']== 0) {
						 	echo "Feture";
						 }else{
						 	echo "General";
						 }
						?>
							
						</td>
					<td><a href="">Edit</a> || <a href="">Delete</a></td>
				</tr>
			<?php } } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
