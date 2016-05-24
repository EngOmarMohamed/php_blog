<?
	require_once("model_user.php");
	session_start();
	if (empty($_SESSION) || $_SESSION["userID"] != 1) {
		header("Location: http://localhost/php/lab1/login.php");
	}

	if(isset($_GET["logout"])){
		$_SESSION = [];
		session_destroy();
		header("Location: http://localhost/php/lab1/login.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin panel</title>
	<link rel="stylesheet" type="text/css" href="layout/css/bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div>Welcome, <?= $_SESSION["username"];?></div>
	<a class="btn btn-primary" href='/php/lab1/index.php'>Add new user</a><br/><br/><br/>
	<a class="btn btn-danger" href='/php/lab1/admin.php?logout=true'>logout</a>
	<table border="1" width="75%" align="center">
		<thead align="center">
			<td>Name</td>
			<td>Email</td>
			<td>Username</td>
			<td>Profile Image</td>
			<td colspan="2">Action</td>
		</thead>
		<tbody align="center">
		<?
			$user = new User();
			$row = $user->selectAll();
			if(!$row){
				die("Error in selection");
			}

			foreach ($row as $value) {

				$image = $value["profile_image"];
				$id = $value["id"];
				$fname = $value['fname'];
				$lname = $value['lname'];
				$uname = $value['uname'];
				$email = $value['email'];

				if ($id == 1) {
					echo "<tr><td>$fname $lname</td><td>$email</td><td>$uname</td><td><img width='150px' height='100px' src='images/$image'/></td><td colspan='2'><a href='/php/lab1/edit.php?op=edit&id=$id'>Edit</a></td></tr>";
				} else {
					echo "<tr><td>$fname $lname</td><td>$email</td><td>$uname</td><td><img width='150px' height='100px' src='images/$image'/></td><td colspan='2'><a href='/php/lab1/edit.php?op=edit&id=$id'>Edit</a>   <a href='/php/lab1/edit.php?op=delete&id=$id'>Delete</a></td></tr>";
				}
			}
			


			##########################
			#Show All Users from file#
			##########################
			// $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
			// $file_contents = file("$DOCUMENT_ROOT/php/lab1/users.txt");

			// if (!$file_contents){
			// 	echo "<p><strong> Something went wrong!</strong></p></body></html>";
			// 	exit;
			// }
			// for($i=0;$i<count($file_contents);$i++){

			// 	$row = explode(";", $file_contents[$i]);
			// 	if ($i == 0) {
			// 		echo "<tr><td>$row[0] $row[1]</td><td>$row[2]</td><td>$row[3]</td><td><img width='150px' height='100px' src='images/$row[5]'/></td><td colspan='2'><a href='/php/lab1/edit.php?op=edit&id=$i'>Edit</a></td></tr>";
			// 	} else {
			// 		echo "<tr><td>$row[0] $row[1]</td><td>$row[2]</td><td>$row[3]</td><td><img width='150px' height='100px' src='images/$row[5]'/></td><td colspan='2'><a href='/php/lab1/edit.php?op=edit&id=$i'>Edit</a>   <a href='/php/lab1/edit.php?op=delete&id=$i'>Delete</a></td></tr>";
			// 	}
			// }
		?>
		</tbody>
	</table>	
</body>
</html>
