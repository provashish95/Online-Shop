<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class Product{
	private $db;
	private $fm;
	
	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function productInsert($data, $file){
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body = mysqli_real_escape_string($this->db->link, $data['body']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName == "" || $catId == "" || $brandId == "" || $file_name == "" || $body == "" || $price == "" || $type == "") {

	    	$msg = "<span class='error'>Feild must Not be empty.....</span>";
			return $msg;
	    }else{
	    	 move_uploaded_file($file_temp, $uploaded_image);
	    	 $query = "INSERT INTO tbl_product (productName, catId, brandId, body, price, image, type)VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
	    	 $productinsert = $this->db->insert($query);

			if ($productinsert){
				$msg = "<span class='success'>Brand Insert Successfully....</span>";
				return $msg; 
			}else{
			$msg = "<span class='error'>Brand Not Insert Successfully....</span>";
			 return $msg;
			
			}
	    }
	}
	
	public function getAllProduct(){
		$query = "SELECT p.*, c.catName, b.brandName
					FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b
					WHERE p.catId = c.catId AND p.brandId = b.brandId
					ORDER BY p.productId DESC ";

		/*
		$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
					FROM tbl_product
						INNER JOIN tbl_category
							ON tbl_product.catId = tbl_category.catId
							INNER JOIN tbl_brand
							ON tbl_product.brandId = tbl_brand.brandId
							ORDER BY tbl_product.productId DESC";
							*/
		$result = $this->db->select($query);
		return $result;
		
	}
	public function getProductById($id){
		$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function productUpdate($data, $file, $id){
		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body = mysqli_real_escape_string($this->db->link, $data['body']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {

	    	$msg = "<span class='error'>Feild must Not be empty.....</span>";
			return $msg;
	    }else{
	    	 move_uploaded_file($file_temp, $uploaded_image);
	    	
	    	 $query = "UPDATE tbl_product
	    	 			SET 
	    	 			productName = '$productName',
	    	 			catId = '$catId',
	    	 			brandId = '$brandId',
	    	 			body = '$body',
	    	 			price = '$price',
	    	 			image = '$uploaded_image',
	    	 			type = '$type'
	    	 			WHERE productId = '$id'
	    	 			";
	    	 $productUpdate = $this->db->update($query);

			if ($productUpdate){
				$msg = "<span class='success'>Product UPDATE Successfully....</span>";
				return $msg; 
			}else{
			$msg = "<span class='error'>Product Not UPDATE Successfully....</span>";
			 return $msg;
			
			}
	    }
	}
	public function delProductById($id){
		$query  = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$getData = $this->db->select($query);
		if ($getData) {
			while ($delImg = $getData->fetch_assoc()) {
				$delLink = $delImg['image'];
				unlink($delLink);
			}
		}
		$delQuery = "DELETE FROM tbl_product WHERE productId = '$id'";
		$deldata = $this->db->delete($delQuery);
		if ($deldata) {
			$msg = "<span class='success'>Product Deleted Successfully....</span>";
				return $msg;
		}else{
			$msg = "<span class='error'>Product Not Deleted Successfully....</span>";
				return $msg;
		}
	}
	public function getFetureProduct(){
		$query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}
	public function getNewProduct(){
		$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}
	public function getSingleProduct($id){
		$query = "SELECT p.*, c.catName, b.brandName
					FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b
				WHERE p.catId = c.catId AND p.brandId = b.brandId AND productId='$id'";

		$result = $this->db->select($query);
		return $result;
	}
//LATEST PRODUCT HERE WILL BE SHOW BY BARND ID........
//LATEST PRODUCT HERE WILL BE SHOW BY BARND ID........
	public function latestFromIphone(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '15' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function latestFromAcer(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '16' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function latestFromSamsung(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '17' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function latestFromCanon(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '18' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
//LATEST PRODUCT HERE WILL BE SHOW BY BARND ID........
//LATEST PRODUCT HERE WILL BE SHOW BY BARND ID........

	public function productByCat($id){
		$catid = mysqli_real_escape_string($this->db->link, $id);
		$query = "SELECT * FROM tbl_product WHERE catId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function inserCompareData($cmpId, $cmrId){
		$cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
		$productId = mysqli_real_escape_string($this->db->link, $cmpId);

		$cquery= "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' AND productId ='$productId'";
		$check = $this->db->select($cquery);
		if ($check) {
			$msg = "<span class='error'>Already Added to compare...</span>";
				return $msg;
		}

		$query  = "SELECT * FROM tbl_product WHERE productId = '$productId'";
		$result = $this->db->select($query)->fetch_assoc();

		if ($result) {
		  
		  	$productId = $result['productId'];
		  	$productName = $result['productName'];
		  
		  	$price = $result['price'];
		  	$image = $result['image'];

		  	$query ="INSERT INTO tbl_compare (cmrId, productId, productName, price, image)VALUES('$cmrId','$productId','$productName','$price','$image')";
	    	$inserted_row= $this->db->insert($query);

	    	if ($inserted_row) {
	    		$msg = "<span class='success'>Added & Check compare Page....</span>";
				return $msg;
	    	}else{
	    		$msg = "<span class='error'>Not Added to compare...</span>";
				return $msg;
	    	}
		}
	}
	public function getCompareData($cmrId){
		$query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}
	public function delCompareData($cmrId){
		$query = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId'";
		$deldata = $this->db->delete($query);
	}
	public function saveWlistData($id, $cmrId){
		$cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
		$id = mysqli_real_escape_string($this->db->link, $id);
		$cquery= "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId ='$id'";
		$check = $this->db->select($cquery);
		if ($check) {
			$msg = "<span class='error'>Already Added to Wlist...</span>";
				return $msg;
		}
		$pquery     = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result = $this->db->select($pquery)->fetch_assoc();

		if ($result) {
		  	$productId = $result['productId'];
		  	$productName = $result['productName'];
		  	$price = $result['price'];
		  	$image = $result['image'];

		  	$query ="INSERT INTO tbl_wlist (cmrId, productId, productName, price, image)VALUES('$cmrId','$productId','$productName','$price','$image')";
	    	$inserted_row= $this->db->insert($query);
	    	if ($inserted_row) {
	    		$msg = "<span class='success'>Check Wlist page...</span>";
				return $msg;
	    	}else{
	    		$msg = "<span class='error'>Not Added to Wlist...</span>";
				return $msg;
	    	}
		  }
		}

		public function chekcwlist($cmrId){
			  $query = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' ORDER BY id DESC";
				$result = $this->db->select($query);
				return $result;
		}
		public function delWlistData($cmrId, $productId){
			$query = "DELETE FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$productId'";
			$deldata = $this->db->delete($query);
		}
   }

?>