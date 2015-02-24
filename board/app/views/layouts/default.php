<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> Board <?php
				if (isset($thread)) {
				echo " - ";
				eh($thread->title);
				}
		?>
		</title>

<!-- Bootstrap Core CSS -->
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
	body {
		padding-top: 60px;
	}
</style>
</head>

<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
	<a class="brand" href="<?php eh(url('thread/index')) ?>">Mara's Thread List</a>
			</div>
		</div>
	</div>
	
	<div class="container">
<?php if (isset($_SESSION['user_id'])):?>
	 <nav class="navbar">
	 	<div class="container-fluid">
	 		 <ul class="nav navbar-nav">
	 		 	<li><a href="<?php eh(url('user/home')) ?>">Home</a></li>
	 		 	 <li><a href="<?php eh(url('thread/index')) ?>">All Threads</a></li>
	 		 	  <li><a href="<?php eh(url('thread/create')) ?>">Create New Thread</a></li>
	 		 </ul>

	 		 <ul class="nav navbar-nav pull-right">
	 		 	 <li><a href="<?php eh(url('user/logout')) ?>">Logout</a></li>
	 		 	  </ul>
	 		 	   </div>
	 		 	   </nav>
 <?php endif ?>
	 		 	  


	<?php echo $_content_ ?>
	</div>

	<script>
	console.log(<?php eh(round(microtime(true) - TIME_START, 3)) ?> + 'sec');
	</script>

</body>
</html>