<?php
	require_once("model_topic.php");
	require_once("model_comment.php");
	require_once("model_user.php");
	session_start();

	$ID = $_GET["id"];
	$valid = false;

	$user = new User();

	$topic = new Topic();
	$topic_row = $topic->selectByID($ID);
	if(!$topic_row){
		die("Error in selection topic");
	}

	$comment = new Comment();
	$comment_rows = $comment->selectBytopicID($ID);
	if(!$comment_rows){
		die("Error in selection comment");
	}

	if(isset($_GET["op"]) && $_GET["op"] == "delete_topic"){

		$topic = new Topic();
		$deleteTopic = $topic->delete($ID);
		if(!$deleteTopic){
			die("Error in delete");
		}
		header("Location: http://localhost/php/lab1/blog.php");

	} elseif (isset($_GET["op"]) && $_GET["op"]  == "delete_comment") {

		$comment = new Comment();
		$deleteComment = $comment->delete($_GET['cid']);
		if(!$deleteComment){
			die("Error in delete");
		}
		header("Location: http://localhost/php/lab1/topic.php?id=$ID");

	}

	if ($_SERVER['REQUEST_METHOD']== "POST") {
		if (isset($_POST["submit"])) {

			if (empty($_POST["content"])) {
				$contentError = "* Comment can't be empty !!";
			}

			if (!empty($_POST["content"])) {
				$valid = true;
			}

			if($valid){
				$user = new Comment();
				$_POST['user_id'] = $_SESSION['userID'];
				$_POST['topic_id'] = $ID;

				if(!$user->insert($_POST)){
					die("Error in insert");
				}

				header("Location: http://localhost/php/lab1/topic.php?id=$ID");
			}
		}
	}
?>

<html>
	<head>
		<title><?=$topic_row["title"]?></title>
		<style>
			span.errorMsg {
			    color: red;
			}
			label{
				font: italic bold 15px Georgia, serif;
			}
		</style>
	</head>
	<body>
		<?

		if($topic_row["user_id"] == $_SESSION["userID"] || $_SESSION["userID"] == 1){
			echo "<a href='/php/lab1/topic.php?op=delete_topic&id=$ID'><img title='delete this topic' width='50px' height='50px' src='layout/img/delete.png'></a><br/>";
		}

		?>
		<b><?=$topic_row["title"]?></b><br/>
		<div>
			<?
			$uid = $topic_row["user_id"];
			$user_row = $user->selectByID($uid);

			echo $topic_row["content"]."<br/><br/>";
			echo "published by <i>".$user_row["uname"]."</i>";
			?>
		</div><br/><br/><br/>
		<?
		if(!empty($comment_rows[0])){
			foreach ($comment_rows as $value) {

		?>
			<div style="width:50%;">
				<? 
				$uid = $value["user_id"];
				$user_row = $user->selectByID($uid);
				echo "<i>".$user_row["uname"]."</i><br/>";
				?>
				<?=$value["content"]?>
				<?
				if($value["user_id"] == $_SESSION["userID"] || $_SESSION["userID"] == 1){
					echo "<a href='/php/lab1/topic.php?op=delete_comment&cid=$value[id]&id=$ID'><img title='delete this comment' width='30px' height='20px' src='layout/img/delete.png'></a><br/>";
				}?>
			<hr/>
			</div>
		<?
			}
		}?>
		<form method="post">
			<input id="content" name="content" />
			
			<input type="submit" name="submit" value="Comment" /><span class="errorMsg"><? echo isset($contentError) ? $contentError : "" ; ?></span>
		</form>
	</body>
</html>


