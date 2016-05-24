<?php
	require_once("model_user.php");

	$valid = false;
	$captchaCHK = true;
	$fileUploaded = true;
	if ($_SERVER['REQUEST_METHOD']== "POST") {

		if ($_POST["submit"]) {
			print_r($_FILES);die("hhhhhh");
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
				// exit;
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
			} else {
				$fname = $_POST["first_name"];
			}
			if (empty($_POST["last_name"])) {
				$lnameError = "* Last name is required";
			} else {
				$lname = $_POST["last_name"];
			}
			if (empty($_POST["email"])) {
				$emailError = "* Email is required";
			} else if (!preg_match("/^([a-zA-Z]|[a-zA-Z][a-zA-Z0-9_\-\.]+)@[a-zA-Z0-9\-]+((\.[a-zA-Z]{2,3}){1}|(\.[a-zA-Z]{2,3}\.[a-zA-Z]{2}){1})$/", $_POST["email"])){
				$email = $_POST["email"];
				$emailError = "* Email isn't valid";
			} else {
				$email = $_POST["email"];
			}
			if (empty($_POST["address"])) {
				$addressError = "* Address is required";
			} else {
				$address = 	$_POST["address"];
			}
			if (empty($_POST["country"])) {
				$countryError = "* Country is required";
			} else {
				$country = $_POST["country"];
			}
			if (empty($_POST["gender"])) {
				$genderError = "* Gender is required";
			} else {
				$gender = $_POST["gender"];
			}
			if (empty($_POST["skills"])) {
				$skillsError = "* Skills is required";
			} else{
				$skills = $_POST["skills"];
			}
			if (empty($_POST["user_name"])) {
				$unameError = "* Username is required";
			} else {
				$uname = $_POST["user_name"];
			}
			if (empty($_POST["password"])) {
				$passwordError = "* Password is required";
			} else {
				$password = $_POST["password"];
			}
			if (empty($_POST["captcha"])) {
				$captchaError = "* Captcha is required";
				$captchaCHK = false;
			} elseif ($_POST["captcha"] != $_POST["generate"]) {
				$captchaError = "* Captcha isn't matched";
				$captchaCHK = false;
			}
			if (!empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["address"]) && !empty($_POST["country"]) && !empty($_POST["gender"]) && !empty($_POST["skills"]) && !empty($_POST["user_name"]) && !empty($_POST["password"]) && !empty($_POST["captcha"]) && !empty($_POST["email"]) && $captchaCHK && $fileUploaded) {
				$valid = true;
			}
		}
	}
?>


<html>
	<head>
		<title>Register</title>
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
		<form method="post" enctype="multipart/form-data">
			<label for="first_name">First Name</label>
			<input id="first_name" name="first_name" value="<?= isset($fname) ? $fname : "" ; ?>" />
			<span class="errorMsg"><? echo isset($fnameError) ? $fnameError : "" ; ?></span>
			<br /><br /><br />

			<label for="last_name">Last Name</label>
			<input id="last_name" name="last_name" value="<?= isset($lname) ? $lname : "" ; ?>" />
			<span class="errorMsg"><? echo isset($lnameError) ? $lnameError : "" ; ?></span>
			<br /><br /><br />

			<label for="profile_image">Upload a profile image:</label>
			<input type="file" name="profile_image" id="profile_image"/>
			<span class="errorMsg"><? echo isset($fileError) ? $fileError : "" ; ?></span>
			<br /><br /><br />

			<label for="email">Email</label>
			<input id="email" name="email" value="<?= isset($email) ? $email : "" ;?>" />
			<span class="errorMsg"><? echo isset($emailError) ? $emailError : "" ; ?></span>
			<br /><br /><br />

			<label for="address">Address</label>
			<textarea id="address" name="address"><?= isset($address) ? $address : "" ;?></textarea>
			<span class="errorMsg"><? echo isset($addressError) ? $addressError : "" ; ?></span>
			<br /><br /><br />

			<label for="country">Country</label>
			<select id="country" name="country">
				<option <?= isset($country) && $country == "Egypt" ? "selected" : "" ; ?>>Egypt</option>
				<option <?= isset($country) && $country == "USA" ? "selected" : "" ; ?>>USA</option>
				<option <?= isset($country) && $country == "UAE" ? "selected" : "" ; ?>>UAE</option>
			</select>
			<span class="errorMsg"><? echo isset($countryError) ? $countryError : "" ; ?></span>
			<br /><br /><br />

			<label>Gender</label>
			<input name="gender" type="radio" value="m" <?= isset($gender) && $gender == "m" ? "checked" : "" ; ?>/>Male
			<input name="gender" type="radio" value="f" <?= isset($gender) && $gender == "f" ? "checked" : "" ; ?>/>Female
			<span class="errorMsg"><? echo isset($genderError) ? $genderError : "" ; ?></span>
			<br /><br /><br />

			<label>Skills</label>
			<input name="skills[]" type="checkbox" value="PHP" <?= isset($skills) && in_array("PHP", $skills) ? "checked" : "" ; ?>/>PHP
			<input name="skills[]" type="checkbox" value="MySQL" <?= isset($skills) && in_array("MySQL", $skills) ? "checked" : "" ; ?>/>MySQL
			<input name="skills[]" type="checkbox" value="Javascript" <?= isset($skills) && in_array("Javascript", $skills) ? "checked" : "" ; ?>/>Javascript
			<input name="skills[]" type="checkbox" value="J2SE" <?= isset($skills) && in_array("J2SE", $skills) ? "checked" : "" ; ?>/>J2SE
			<span class="errorMsg"><? echo isset($skillsError) ? $skillsError : "" ; ?></span>
			<br /><br /><br />

			<label for="user_name">Username</label>
			<input id="user_name" name="user_name" value="<?= isset($uname) ? $uname : "" ; ?>" />
			<span class="errorMsg"><? echo isset($unameError) ? $unameError : "" ; ?></span>
			<br /><br /><br />

			<label for="password">Password</label>
			<input id="password" type="password" name="password" value="<?= isset($password) ? $password : "" ; ?>" />
			<span class="errorMsg"><? echo isset($passwordError) ? $passwordError : "" ; ?></span>
			<br /><br /><br />

			<label for="depart">Department</label>
			<input disabled="disabled" value="OpenSource" />
			<input name="depart" type="hidden" value="OpenSource" />
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

	<? } else { 
		$_POST["profile_image"] = $image_name;
		$user = new User();
		if(!$user->insert($_POST)){
			die("Error in insert");
		}

		##################
		#Insert Into File#
		##################
		// $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
		// // echo exec('whoami');die;
		// $fp = fopen("$DOCUMENT_ROOT/php/lab1/users.txt",'a+');

		// if (!$fp){
		// 	echo "<p><strong> Something went wrong!</strong></p></body></html>";
		// 	exit;
		// }
		// fwrite($fp, $_POST["first_name"] . ";" . $_POST["last_name"].";". $_POST["email"] .";". $_POST["user_name"] .";".md5($_POST["password"]) .";". $image_name."\n");
		?>
		<div>Thanks <? echo $_POST["gender"] == "m" ? "Mr.": "Miss"; ?> <?= $_POST["first_name"] ." ". $_POST["last_name"]; ?> </div>
		<div>
			Please Review Your Information<br/>
			<label>Username: </label><?= $_POST["user_name"]; ?><br/>
			<label>Email: </label><?= $_POST["email"]; ?><br/>
			<label>Address: </label><?= $_POST["address"]; ?><br/>
			<label>Skills: </label>
			<?
				for ($i=0; $i < count($_POST["skills"]); $i++) {
					echo "<div>".$_POST["skills"][$i]."</div>";
				}
			?>
			<label>Department:</label><?= $_POST["depart"] ?>
		</div>
	<? } ?>
	</body>
</html>