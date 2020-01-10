<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");
?>

<?php
class Customer{
	
	private $db;
	private $fm;
	
	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function customersRegistration($data){
		$name    = mysqli_real_escape_string($this->db->link, $data['name']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city    = mysqli_real_escape_string($this->db->link, $data['city']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$zip     = mysqli_real_escape_string($this->db->link, $data['zip']);
		$phone   = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email   = mysqli_real_escape_string($this->db->link, $data['email']);
		$pass    = mysqli_real_escape_string($this->db->link, md5($data['pass']));

		 if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $pass == "") {

			    	$msg = "<span class='error'>Feild must Not be empty.....</span>";
					return $msg;
	    }
	    //here mail check for customers........PROVASHISH ROY....
	    $mailQuery = "SELECT * FROM  tbl_customer WHERE email = '$email' LIMIT 1";
	    $mailCheck = $this->db->select($mailQuery);
	    if ($mailCheck != false ) {
			    	$msg = "<span class='error'>This Email Already Exited.....</span>";
					return $msg;
	    }else{
	    	 $query = "INSERT INTO  tbl_customer (name, address, city, country, zip, phone, email, pass)VALUES('$name','$address','$city','$country','$zip','$phone','$email','$pass')";
	    	 $customerInsert = $this->db->insert($query);

			if ($customerInsert){
				$msg = "<span class='success'>Customer data Insert Successfully....</span>";
				return $msg; 
			}else{
			$msg = "<span class='error'>Customer data Not Insert Successfully....</span>";
			 return $msg;
			
			}
	    }
		
	}
	public function customersLogin($data){
		$email   = mysqli_real_escape_string($this->db->link, $data['email']);
		$pass    = mysqli_real_escape_string($this->db->link, md5($data['pass']));

		if (empty($email) || empty($pass)) {
			$msg = "<span class='error'>Feild must not be empty...</span>";
			 return $msg;
		}
		$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$pass'";
		$result = $this->db->select($query);
		if ($result != false) {
			$value = $result->fetch_assoc();
			Session::set("custlog", true);
			Session::set("cmrId", $value['id']);
			Session::set("cmrName", $value['name']);
			header("location:cart.php");
		}else{
			$msg = "<span class='error'>Email or password not matched</span>";
			 return $msg;
		}
	}
	public function getCustomerData($id){
		$query     = "SELECT * FROM tbl_customer WHERE id = '$id'";
		$result = $this->db->select($query);
		return $result;
	}

	//Update customer Data...........................
	public function updateCustomer($data, $cmrid){
		$name    = mysqli_real_escape_string($this->db->link, $data['name']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city    = mysqli_real_escape_string($this->db->link, $data['city']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$zip     = mysqli_real_escape_string($this->db->link, $data['zip']);
		$phone   = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email   = mysqli_real_escape_string($this->db->link, $data['email']);

		 if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" ) {

			    	$msg = "<span class='error'>Feild must Not be empty.....</span>";
					return $msg;
	    }else{
	    	 $query = "INSERT INTO  tbl_customer (name, address, city, country, zip, phone, email)VALUES('$name','$address','$city','$country','$zip','$phone','$email')";
	  

			$query = "UPDATE  tbl_customer
					SET 
					name 	= '$name',
					address = '$address',
					city 	= '$city',
					country = '$country',
					zip 	= '$zip',
					phone 	= '$phone',
					email 	= '$email',
					phone 	= '$phone'

					WHERE id='$cmrid' ";
			$updated_row = $this->db->update($query);
			if ($updated_row) {
				$msg = "<span class='success'>Customer data update Successfully....</span>";
				return $msg;
			}else{
				$msg = "<span class='success'>Category data not update Successfully....</span>";
				return $msg;
			}
	    }
	}


}

?>