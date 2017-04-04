<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="includes.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</head>
<body>
	<?php include("header.php"); ?>
  <!--  <?php include("nav.php"); ?>-->

		<!--<div id="content">
			<h2>This is the Home Page</h2>
			<p>The home page content.</p>
		</div>-->
		<div class="container">

			<?php
					require("mysqli_connect.php");
				//	$uid = $_SESSION['user_id'];
					$query = "SELECT title, content,user_id,id , DATE_FORMAT(posted,'%M %e ,%Y') as date FROM post   ORDER BY posted DESC";
					$result = mysqli_query($dbcon, $query);
					if(@mysqli_num_rows($result) == 0){
							echo 'You have not posted anything yet.';
					}
	while($row = mysqli_fetch_array($result)){
     $name= "SELECT username FROM users WHERE id=".$row['user_id']."";
			 $result1 = mysqli_query($dbcon, $name);
			 $row1 = mysqli_fetch_array($result1);

     $comment ="SELECT COUNT(content)as total FROM comment WHERE post_id=".$row['id']." ";
		 $result2=mysqli_query($dbcon,$comment);
		 $row2 = mysqli_fetch_array($result2);


	  /* echo ' <div class="row">
		    <div class="span12">
			     <div class="row">
				     <div class="span8">
					<h4><strong><a href="#">'. $row['title']. '</a></strong></h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2">
					<a href="#" class="thumbnail">
							<img src="images/logo.png" alt="">
					</a>
				</div>
				<div class="span10">
					<p>'. $row['content'].'</p>

				</div>
			</div>
			<div class="row">
				<div class="span8">
					<p></p>
					<p>
						<i class="icon-user"></i> by <a href="#">'.$row1['username'].'</a>
						| <i class="icon-calendar"></i>'.$row['date'].'
		           </p>
				</div>
			</div>
		</div>
	</div>
	<hr> ';
*/

echo '<div class="well">
      <div class="media">
      	<a class="pull-left" href="#">
    		<img class="media-object" src="images/Weblog.jpg">
  		</a>
  		<div class="media-body">
    		<a href="view1_post.php?id='.$row['id'] .' "><h4 class="media-heading">'. $row['title']. '</h4></a>
          <p class="text-right">By '. $row1['username']. '</p>
          <p>'. $row['content']. '.</p>
          <ul class="list-inline list-unstyled">
  			<li><span><i class="glyphicon glyphicon-calendar"></i>'. $row['date']. ' </span></li>
            <li>|</li><li> </li>
            <span><i class="glyphicon glyphicon-comment"></i>'.$row2['total'].'</span>
            </ul>
       </div>
    </div>
  </div>';






}
	//	echo '<a href="view_post.php?id=' . $row['id'] . '">' . $row['title'] . '</a><br>';
					//}
			?>





<?php include("footer.php");?>
		</div>



	<!--</div>-->
</body>
</html>
