<?php
	require_once("model_user.php");
	session_start();

	$ID = $_GET["id"];

	if ($ID != $_SESSION['userID']) {
		header("Location: http://localhost/php/lab1/blog.php");
	}
	###############
	#Used for File#
	###############
	// $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
	// $file_contents = file("$DOCUMENT_ROOT/php/lab1/users.txt");
	// $row = explode(";", $file_contents[$ID]);
	// $data = [];
	// $data = $row;
	$user = new User();
	$row = $user->selectByID($ID);
	if(!$row){
		die("Error in selection");
	}
	$data = $row;

	if($_GET["op"] == "delete"){

		$user = new User();
		$deleteUser = $user->delete($ID);
		if(!$deleteUser){
			die("Error in delete");
		}
		header("Location: http://localhost/php/lab1/admin.php");

		##################
		#Delete from File#
		##################
		// $contents = file_get_contents("$DOCUMENT_ROOT/php/lab1/users.txt");

		// $contents = str_replace($file_contents[$_GET["id"]], '', $contents);
		// file_put_contents("$DOCUMENT_ROOT/php/lab1/users.txt", $contents);
		// echo "The Record has been deleted";
		// header("Location: http://localhost/php/lab1/admin.php");

	} elseif ($_GET["op"] == "edit" || $_SERVER['REQUEST_METHOD']== "POST") {
		$valid = false;
		$captchaCHK = true;
			if (isset($_POST["submit"])) {
				// print_r($_FILES);die("===");
				if ($_FILES['profile_image']['error'] > 0)
				{
					$fileUploaded = false;
					switch ($_FILES['profile_image']['error'])
					{
						case 1: $fileError = 'File exceeded upload_max_filesize';
						break;
						case 2: $fileError = 'File exceeded max_file_size';
						break;
						case 3: $fileError = 'File only partially uploaded';
						break;
						case 4: $fileError = 'No file uploaded';
						break;
						case 6: $fileError = 'Cannot upload file: No temp directory specified';
						break;
						case 7: $fileError = 'Upload failed: Cannot write to disk';
						break;
					}
				} else {
					


					$imageRegex = "/^(image)/";
					if (!preg_match($imageRegex, $_FILES['profile_image']['type']))
					{
						$fileError = 'Problem: file is not image';
						$fileUploaded = false;
					}
					if (is_uploaded_file($_FILES['profile_image']['tmp_name']))
					{
						$image_name = time().$_FILES['profile_image']['name'] ;
						$upfile = 'images/'.$image_name;

						if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $upfile))
						{
							$fileError = 'Problem: Could not move file to destination directory';
							$fileUploaded = false;
						} 
					} else {
						$fileError = 'Problem: Error in uploading the file';
						$fileUploaded = false;
					}
				}




				if (empty($_POST["first_name"])) {
					$fnameError = "* First name is required";
				}

				$data["fname"] = $_POST["first_name"];
				
				if (empty($_POST["last_name"])) {
					$lnameError = "* Last name is required";
				}

				$data["lname"] = $_POST["last_name"];

				if (empty($_POST["gender"])) {
					$genderError = "* Gender is required";
				}

				$data["gender"] = $_POST["gender"];

				if (empty($_POST["email"])) {
					$emailError = "* Email is required";
				} else if (!preg_match("/^([a-zA-Z]|[a-zA-Z][a-zA-Z0-9_\-\.]+)@[a-zA-Z0-9\-]+((\.[a-zA-Z]{2,3}){1}|(\.[a-zA-Z]{2,3}\.[a-zA-Z]{2}){1})$/", $_POST["email"])){
					$emailError = "* Email isn't valid";
				}

				$data["email"] = $_POST["email"];

				if (empty($_POST["user_name"])) {
					$unameError = "* Username is required";
				}

				$data["uname"] = $_POST["user_name"];
				
				if (empty($_POST["captcha"])) {
					$captchaError = "* Captcha is required";
					$captchaCHK = false;
				} elseif ($_POST["captcha"] != $_POST["generate"]) {
					$captchaError = "* Captcha isn't matched";
					$captchaCHK = false;
				}
				if (!empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["user_name"]) && !empty($_POST["email"]) && $captchaCHK) {
					$valid = true;
				}
			}
?>

<html>
	<head>
		<title>Edit Info</title>
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
	<?php if(!$valid){ ?>
		<form method="post" enctype="multipart/form-data">
			<label for="first_name">First Name</label>
			<input id="first_name" name="first_name" value="<?= isset($data['fname']) ? $data['fname'] : "" ; ?>" />
			<span class="errorMsg"><? echo isset($fnameError) ? $fnameError : "" ; ?></span>
			<br /><br /><br />

			<label for="last_name">Last Name</label>
			<input id="last_name" name="last_name" value="<?= isset($data['lname']) ? $data['lname'] : "" ; ?>" />
			<span class="errorMsg"><? echo isset($lnameError) ? $lnameError : "" ; ?></span>
			<br /><br /><br />

			<label>Gender</label>
			<input name="gender" type="radio" value="m" <?= isset($data['gender']) && $data['gender'] == "m" ? "checked" : "" ; ?>/>Male
			<input name="gender" type="radio" value="f" <?= isset($data['gender']) && $data['gender'] == "f" ? "checked" : "" ; ?>/>Female
			<span class="errorMsg"><? echo isset($genderError) ? $genderError : "" ; ?></span>
			<br /><br /><br />

			<img width='150px' height='100px' src="images/<?= isset($data['profile_image']) ? $data['profile_image'] : "" ; ?>"/><br />

			<label for="profile_image">Upload a profile image:</label>
			<input type="file" name="profile_image" id="profile_image"/>
			<span class="errorMsg"><? echo isset($fileError) ? $fileError : "" ; ?></span>
			<br /><br /><br />


			<label for="email">Email</label>
			<input id="email" name="email" value="<?= isset($data['email']) ? $data['email'] : "" ;?>" />
			<span class="errorMsg"><? echo isset($emailError) ? $emailError : "" ; ?></span>
			<br /><br /><br />

			<label for="user_name">Username</label>
			<input id="user_name" name="user_name" value="<?= isset($data['uname']) ? $data['uname'] : "" ; ?>" />
			<span class="errorMsg"><? echo isset($unameError) ? $unameError : "" ; ?></span>
			<br /><br /><br />

			<label for="password">New Password(Optional)</label>
			<input id="password" type="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : "" ; ?>" />
			<span class="errorMsg"><? echo isset($passwordError) ? $passwordError : "" ; ?></span>
			<br /><br /><br />

			<label>Enter the captcha</label>
			<?php 
				function generateRandomString($length = 10) {
				    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				    $charactersLength = strlen($characters);
				    $randomString = '';
				    for ($i = 0; $i < $length; $i++) {
				        $randomString .= $characters[rand(0, $charactersLength - 1)];
				    }
				    return $randomString;
				}
				$generateCode = generateRandomString(5);
				echo "<span>".$generateCode."</span><br/>";
			?>
			<input name="generate" type="hidden" value="<?= $generateCode ?>" />
			
			<input name="captcha" />
			<span class="errorMsg"><? echo isset($captchaError) ? $captchaError : "" ; ?></span>
			<br /><br /><br />
			<input type="submit" name="submit" value="Submit" /><input type="reset" name="reset" value="Reset" />
		</form>

	<?php } else {
		if($_SESSION["userID"] == $ID){
			$_SESSION["username"] = $_POST["user_name"];
		}

		if (!empty($image_name)) {
			$_POST["profile_image"] = $image_name;
		} else {
			$_POST["profile_image"] = $data['profile_image'];
		}
		$_POST["id"] = $ID;


		$user = new User();
		if(!$user->update($_POST)){
			die("Error in update");
		}
		if($_SESSION["userID"] == 1){
			header("Location: http://localhost/php/lab1/admin.php");
		} else {
			header("Location: http://localhost/php/lab1/blog.php");
		}

		################
		#Update In File#
		################
		// if (!empty($_POST["password"])) {
		// 	$new_password = md5($_POST["password"]);
		// } else {
		// 	$new_password = trim($row[4]);
		// }

		// $updated_line = $_POST["first_name"] . ";" . $_POST["last_name"].";". $_POST["email"].";". $_POST["user_name"] .";".$new_password ."\n";

		// $contents = file_get_contents("$DOCUMENT_ROOT/php/lab1/users.txt");
		// $contents = str_replace($file_contents[$_GET["id"]], $updated_line, $contents);
		// file_put_contents("$DOCUMENT_ROOT/php/lab1/users.txt", $contents);
		// header("Location: http://localhost/php/lab1/admin.php");
	 } ?>
	</body>
</html>
<?php } ?>


