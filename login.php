
<?php
	require_once("model_user.php");
	session_start();

	if (!empty($_SESSION)) {
		header("Location: http://localhost/php/lab1/blog.php");
	}

	$valid = false;
	if ($_SERVER['REQUEST_METHOD']== "POST") {
		
		if ($_POST["submit"]) {
			if (empty($_POST["uname"])) {
				$unameError = "* Username is required";
			}
			if (empty($_POST["password"])) {
				$passwordError = "* Password is required";
			}

			if (!empty($_POST["uname"]) && !empty($_POST["password"])) {
				$valid = true;
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="layout/css/bootstrap/css/bootstrap.min.css">
		<style>
			span.errorMsg {
			    color: red;
			}
			label{
				font: italic bold 15px Georgia, serif;
			}
		</style>
	</head>
	<body style="background-color:dodgerblue;">

	<? if(!$valid){ ?>
		<div align="center" style="background-color:#fff; width:50%;  margin:100px auto;" >
			<? if (isset($_GET["error"])) { ?>
				<span class="errorMsg">Error in Username or Password !!</span>
			<? } ?>
			
			
			<form method="post">
				<label for="uname">Username</label>
				<input id="uname" name="uname" value="<?= isset($_POST["uname"]) ? $_POST["uname"] : "" ; ?>" />
				<span class="errorMsg"><? echo isset($unameError) ? $unameError : "" ; ?></span>
				<br /><br /><br />

				<label for="password">Password</label>
				<input id="password" name="password" type="password" />
				<span class="errorMsg"><? echo isset($passwordError) ? $passwordError : "" ; ?></span>
				<br /><br /><br />

				<input class="btn btn-primary" type="submit" name="submit" value="Login" /><br/><br/>

				<a  class="btn btn-info"  href='/php/lab1/index.php'>Sign up to have an account</a>

			</form>
		</div>
	<?} else {

		$user = new User();
		$loginUser = $user->login($_POST["uname"], md5($_POST["password"]));
		if(!$loginUser){
			header("Location: http://localhost/php/lab1/login.php?error=true");
		} else {
			$_SESSION["username"] = $_POST['uname'];
			$_SESSION["userID"] = $loginUser["id"];
			header("Location: http://localhost/php/lab1/blog.php");
		}



		##################
		#Select from File#
		##################

		// $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
		// $file_contents = file("$DOCUMENT_ROOT/php/lab1/users.txt");
		// $row = explode(";", $file_contents[0]);

		// if ($row[3] == $_POST["uname"] && md5($_POST["password"]) == trim($row[4])) {
		// 	$_SESSION["username"] = $_POST['uname'];
		// 	header("Location: http://localhost/php/lab1/admin.php");
		// }  else {
		// 	header("Location: http://localhost/php/lab1/login.php?error=true");
		// }
		
	}?>

	</body>
</html>
