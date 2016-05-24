<?php
require_once("database.php");
class User
{
	private $id;
	private $fname;
	private $lname;
	private $uname;
	private $password;
	private $email;
	private $profile_image;
	private $gnder;
	private $conn = null;


	function __get($name)
	{
		return $this->$name;
	}
	function __set ($name, $value)
	{
		$this->$name = $value;
	}

	public function __construct(){

		$this->conn = Database::getInstance("blog");
	}

	public function insert($data){
		$query = "insert into user values(null, '".$data["first_name"]."', '".$data["last_name"]."', '".$data["user_name"]."', '".md5($data["password"])."', '".$data["email"]."', '".$data["gender"]."', '".$data["profile_image"]."')";

		mysqli_query($this->conn, $query );

		if(mysqli_affected_rows($this->conn) <= 0){
			return false;
		} else {
			return true;
		}
	}

	public function selectAll(){
		$query = "select * from user";

		$result = mysqli_query($this->conn, $query);

		$num_results = mysqli_num_rows($result);

		if($num_results <= 0){
			return false;
		}
		for ($i=0; $i < $num_results; $i++) {
			$row[] = mysqli_fetch_assoc($result);
		}
		return $row;
	}

	public function selectByID($id){
		$query = "select * from user where id=".$id;

		$result = mysqli_query($this->conn, $query );

		$num_results = mysqli_num_rows($result);

		if($num_results <= 0){
			return false;
		}
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	public function update($data){

		if (!empty($data["password"])) {
			$new_password = md5($_POST["password"]);
			$query = "update user set fname='".$data['first_name']."', lname ='".$data['last_name']."', uname='".$data['user_name']."', password = '".$new_password."', email='".$data["email"]."', gender='".$data["gender"]."', profile_image='".$data["profile_image"]."' where id=".$data['id'];
		} else {
			$query = "update user set fname='".$data['first_name']."', lname ='".$data['last_name']."', uname='".$data['user_name']."', email='".$data["email"]."', gender='".$data["gender"]."', profile_image='".$data["profile_image"]."' where id=".$data['id'];
		}

		// print_r($query);die("io");
		mysqli_query($this->conn, $query );
		$error = mysqli_error($this->conn);
		if(!empty($error)){
			return false;
		} else {
			return true;
		}
	}

	public function delete($id){
		if($id == 1 ){
			return false;
		}
		
		$query = "delete from user where id=".$id;

		mysqli_query($this->conn, $query );

		if(mysqli_affected_rows($this->conn) <= 0){
			return false;
		} else {
			return true;
		}
	}

	public function login($user_name, $password){
		// $password = "hello ' or '1'='1";
		// $user_name = "' or 1=1  union select * from user where '1'='1";
		$user_name = str_replace(" ","",$user_name);
		$query = "select * from user where uname='".$user_name."' and password = '".$password."'";


		// die($query);
		$result = mysqli_query($this->conn, $query );
		$row = mysqli_fetch_assoc($result);


		if(mysqli_num_rows($result) <= 0){
			return false;
		} else {
			return $row;
		}
	}
}
?>