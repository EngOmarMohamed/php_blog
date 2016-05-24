<?php
require_once("database.php");
class Comment
{
	private $id;
	private $content;
	private $publishing_date;
	private $user_id;
	private $topic_id;

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
		// print_r($data);
		$query = "insert into comment values(null, '".$data["content"]."', null,'".$data["user_id"]."', '".$data["topic_id"]."')";

		mysqli_query($this->conn, $query );
		// print_r(mysqli_affected_rows($this->conn) );
		// print_r(mysqli_error($this->conn) );

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
			return false;
		}
		for ($i=0; $i < $num_results; $i++) {
			$row[] = mysqli_fetch_assoc($result);
		}
		return $row;
	}

	public function selectByID($id){
		$query = "select * from comment where id=".$id;

		$result = mysqli_query($this->conn, $query );

		$num_results = mysqli_num_rows($result);

		if($num_results <= 0){
			return false;
		}
		$row = mysqli_fetch_assoc($result);
		return $row;
	}

	public function selectBytopicID($topic_id){
		$query = "select * from comment where topic_id =".$topic_id;

		$result = mysqli_query($this->conn, $query );

		$num_results = mysqli_num_rows($result);

		if($num_results <= 0){
			return $row=[""];
		}
		for ($i=0; $i < $num_results; $i++) {
			$row[] = mysqli_fetch_assoc($result);
		}
		return $row;
	}

	public function selectByuserID_topicID($user_id, $topic_id){
		$query = "select * from comment where user_id=".$id." and topic_id =".$topic_id;

		$result = mysqli_query($this->conn, $query );

		$num_results = mysqli_num_rows($result);

		if($num_results <= 0){
			return false;
		}
		for ($i=0; $i < $num_results; $i++) {
			$row[] = mysqli_fetch_assoc($result);
		}
		return $row;
	}

	#TODO
	public function update($data){

		$query = "update comment set content ='".$data['content']."' where id=".$data['id'];

		mysqli_query($this->conn, $query );

		if(mysqli_affected_rows($this->conn) != 0){
			return false;
		} else {
			return true;
		}
	}

	public function delete($id){
		$query = "delete from comment where id=".$id;

		mysqli_query($this->conn, $query );

		if(mysqli_affected_rows($this->conn) <= 0){
			return false;
		} else {
			return true;
		}
	}
}
?>