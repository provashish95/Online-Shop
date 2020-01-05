<?php
  include_once "../lib/Database.php";
  include_once "../helpers/Format.php";
?>

<?php
class Brand{
	
	private $db;
	private $fm;
	
	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function brandInsert($brandName){
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);

		if (empty($brandName)) {
			$msg = "<span class='error'>Category feild Not empty.....</span>";
			return $msg;
		}else{
			$query = "INSERT INTO  tbl_brand (brandName)VALUES ('$brandName')";
			$brandinsert = $this->db->insert($query);

			if ($brandinsert){
				$msg = "<span class='success'>Brand Insert Successfully....</span>";
				return $msg; 
			}else{
			$msg = "<span class='error'>Brand Not Insert Successfully....</span>";
			 return $msg;
			
			}
		}
	}
}

?>