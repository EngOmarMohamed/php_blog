<?php
	require_once("model_topic.php");
	session_start();

	$valid = false;
	$captchaCHK = true;
	$fileUploaded = true;
	if ($_SERVER['REQUEST_METHOD']== "POST") {

		if ($_POST["submit"]) {
			if (empty($_POST["title"])) {
				$titleError = "* Title is required";
			}
			if (empty($_POST["content"])) {
				$contentError = "* Content is required";
			}
			if (!empty($_POST["title"]) && !empty($_POST["content"])) {
				$valid = true;
			}
		}
	}
?>


<html>
	<head>
		<title>Add Topic</title>
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
	<? if(!$valid){ ?>
		<form method="post">
			<label for="title">Title:</label><br/>
			<input id="title" name="title" value="<?= isset($_POST['title']) ? $_POST['title'] : "" ; ?>" />
			<span class="errorMsg"><? echo isset($titleError) ? $titleError : "" ; ?></span>
			<br /><br /><br />

			<label for="content">Content:</label><br/>
			<textarea id="content" name="content"><?= isset($_POST['content']) ? $_POST['content'] : "" ;?></textarea>
			<span class="errorMsg"><? echo isset($contentError) ? $contentError : "" ; ?></span>
			<br /><br /><br />

			<input type="submit" name="submit" value="Publish" /><input type="reset" name="reset" value="Reset" />
		</form>

	<? } else { 
		$_POST["user_id"] = $_SESSION["userID"];
		$topic = new Topic();
		if(!$topic->insert($_POST)){
			die("Error in insert");
		}
		
		header("Location: http://localhost/php/lab1/blog.php");
	} ?>
	</body>
</html>