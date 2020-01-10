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
			$msg = "<span class='success'>Product Not Deleted Successfully....</span>";
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

	public function latestFromIphone(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '11' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function latestFromAcer(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '12' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function latestFromSamsung(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '13' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function latestFromCanon(){
		$query = "SELECT * FROM tbl_product WHERE brandId = '14' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function productByCat($id){
		$catid = mysqli_real_escape_string($this->db->link, $id);
		$query = "SELECT * FROM tbl_product WHERE catId = '$id'";
		$result = $this->db->select($query);
		return $result;
	}
	
}

?>