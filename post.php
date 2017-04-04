<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>New Post</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="includes.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

 <style>
 .post-form{ margin-top:15px;}
 .post-form .textarea{ min-height:220px; resize:none;}
 .form-control{ box-shadow:none; border-color:#eee; height:49px;}
 .form-control:focus{ box-shadow:none; border-color:#00b09c;}
 .form-control-feedback{ line-height:50px;}
 .main-btn{ background:#00b09c; border-color:#00b09c; color:#fff;}
 .main-btn:hover{ background:#00a491;color:#fff;}
 .form-control-feedback {
 line-height: 50px;
 top: 0px;
 }
</style>

</head>



<body>
    <?php include("header.php"); ?>
    <?php include("nav.php"); ?>
    <div id="container1">
        <div id="content">
            <?php
            if(!isset($_SESSION['user_id'])){
                echo 'Only registered users can create new posts. <a href="login.php">Login</a> to continue';
                exit();
            }
            else{
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    require("mysqli_connect.php");
                    if(!empty($_POST['title'])){
                        $id = $_SESSION['user_id'];
                        $title = $_POST['title'];
                        $content = $_POST['content'];
                        $query = "INSERT INTO post (user_id, title, content,posted) VALUES ($id, '$title', '$content',NOW())";
                        $result = mysqli_query($dbcon, $query);
                        if($result){
                            echo 'Success!';
                        }
                    }
                }
            }
            ?>
        </div>
      <!--  <div id="loginfields">
            <form method="post" action="post.php" id="post_form">
                <p><label class="label" for="title">Title:</label></p>
                <input type="text" name="title" size="100" font-size="1"></input>
                <p><label class="label" for="content">Content:</label></p>
                <textarea form="post_form" name="content" rows="20" cols="90"> </textarea>
                <p>&nbsp;</p>
                <p><input type="submit" id="submit" name="post" value="Post"></p>
            </form>
        </div>-->
        <div class="row">
      		<form role="form" id="post_form" class="post-form" method="post" action="post.php">
                          <div class="row">
                      		<div class="col-md-6">
                        		<div class="form-group">
                                  <input type="text" class="form-control" name="title" autocomplete="off" id="title" placeholder="Title">
                        		</div>
                        	</div>

                        	</div>
                        	<div class="row">
                        		<div class="col-md-10">
                        		<div class="form-group">
                                  <textarea class="form-control textarea" rows="3" name="content" id="content" placeholder="Content"></textarea>
                        		</div>
                        	</div>
                          </div>
                          <div class="row">
                          <div class="col-md-1">
                        <button type="submit" id="submit" name="post" class="btn main-btn ">Post</button>
                        </div>
                        </div>
                      </form>
      	</div>

      <?php include("footer.php"); ?>
    </div>
</body>
</html>
