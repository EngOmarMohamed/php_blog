<?php
$hash = "#my-nav";
$header = '<html>
	<head>
		<title>Blog</title>
		<link rel="stylesheet" type="text/css" href="layout/css/bootstrap/css/bootstrap.min.css">
	</head>
	<body>
	<div class="container-fluid">
		<header class="row header">
	        <nav class="navbar navbar-default " style="background-color:dodgerblue;padding-right: 20px">
	            <div class="">
	                <button class="btn navbar-toggle" data-toggle="collapse" data-target='.$hash.'>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="/php/lab1/blog.php"><i class="glyphicon glyphicon-home"></i>Blogy</a>

                    <ul class="nav navbar-nav collapse navbar-collapse" id="my-nav">
                    <?if ($_SESSION["userID"] == 1) {?>
		                <li><a href="/php/lab1/admin.php">Manage Users</a></li>
		            <?}?>
		                <li><a href="/php/lab1/add_topic.php">Add Topic</a></li>
		            </ul>

		           
	                    <ul class="nav navbar-nav navbar-right">
	                        <li><a href="/php/lab1/edit.php?op=edit&id=<?=$_SESSION[userID]?>"><i class="glyphicon glyphicon-user"></i><?= $_SESSION[username];?></a></li>
	                        <li><a href="/php/lab1/admin.php?logout=true"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
	                    </ul>
	                

	            </div>
	        </nav>
	    </header>
	    <main>';
	    
$footer = '</main>
		<footer class="row content" style="background-color:dodgerblue;">
	        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
	            <h5>About us</h5>
	        </div>
	        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
	            <h5>Team</h5>
	        </div>
	        <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4">
	            <h5><i class="glyphicon glyphicon-copyright-mark"></i> Copyright 2016 Blogy All Rights Reserved</h5>
	        </div>
    	</footer>
		</div>
	</body>
	
</html>';
?>