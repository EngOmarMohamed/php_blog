<?php
require_once("database.php");
class Topic
{
	private $id;
	private $title;
	private $content;
	private $publishing_date;
	private $user_id;
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
		$query = "insert into topic values(null, '".$data["title"]."', '".$data["content"]."', null, '".$data["user_id"]."')";

		mysqli_query($this->conn, $query );

		if(mysqli_affected_rows($this->conn) <= 0){
			return false;
		} else {
			return true;
		}
	}

	public function selectAll(){
		$query = "select * from topic";

		$result = mysqli_query($this->conn, $query);

		$num_results = mysqli_num_rows($result);

		if($num_results <= 0){
			return $row=[""];
		}
		for ($i=0; $i < $num_results; $i++) {
			$row[] = mysqli_fetch_assoc($result);
		}
		return $row;
	}

	public function selectByID($id){
		$query = "select * from topic where id=".$id;

		$result = mysqli_query($this->conn, $query );

		$num_results = mysqli_num_rows($result);

		if($num_results <= 0){
			return false;
		}
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	#TODO
	public function update($data){

		$query = "update topic set title='".$data['title']."', content ='".$data['content']."' where id=".$data['id'];

		mysqli_query($this->conn, $query );

		if(mysqli_affected_rows($this->conn) != 0){
			return false;
		} else {
			return true;
		}
	}

	public function delete($id){
		$query = "delete from topic where id=".$id;

		mysqli_query($this->conn, $query );

		if(mysqli_affected_rows($this->conn) <= 0){
			return false;
		} else {
			return true;
		}
	}
}
?>