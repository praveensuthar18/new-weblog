<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Post</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="includes.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("header.php"); ?>
	<?php include("nav.php"); ?>
    <div id="container1">
        <div id="content">
            <!--<?php
                if($_GET['id'] != NULL){
                    require("mysqli_connect.php");
                    $pid=$_GET['id'];
                    $query = "SELECT title, content FROM post WHERE id=$pid";
                    $result = mysqli_query($dbcon, $query);
                    if(mysqli_num_rows($result) == 0){
                        echo 'The post you are looking for does not exist.';
                        echo '<p>Possible reasons for this:-';
                        echo '<br>1. A post with this ID never existed.';
                        echo '<br>2. The post was taken down by an admin.';
                    }
                    $row = mysqli_fetch_array($result);
                }
                else{
                    header("Location: search.php");
                    exit();
                }
            ?>-->
          <!--  <p style="font-size:30px"><label for="title">
              <?php echo $row['title'] ?>
            </label></p>
            <p><label for="content">
                <?php echo $row['content']?>
            </label></p>
            <br><br>
            <p style="font-size:20px"><label for="comments">Comments:-</label></p>-->
            <?php
            if(isset($_SESSION['user_id'])){
                $uid = $_SESSION['user_id'];
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $content = $_POST['comment_content'];
                    $q = "INSERT INTO comment (post_id, user_id, content,time_posted) VALUES ($pid, $uid, '$content',NOW())";
                    $result = mysqli_query($dbcon, $q);
                }
            }
              /*  $query = "SELECT content, username, time_posted FROM comment, users WHERE post_id=$pid AND user_id=users.id ORDER BY time_posted ASC";
                $result = mysqli_query($dbcon, $query);
                while($rows = mysqli_fetch_array($result)){
                    echo '<p> ' . $rows['username'] . ': ' . $rows['content'];
                    echo ' ('. $rows['time_posted'] . ')</p>';
                }*/
              /*  if(isset($_SESSION['user_id'])){
                    echo '
                    <br>
                    <p><label for="comment">Comment:</label>
                        <form method="post" action="view_post.php?id=' . $pid . '" id="comment_form">
                         <div class="col-xs-7" >
                            <input type="text" class="form-control" name="comment_content" size="100"></input></div>
                            <input type="submit" id="submit" class="btn btn-primary" name="Comment" value="Comment">
                        </form>
                    ';
                }*/
            ?>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
