<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="includes.css">
  	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>

    <style>
    section{width:100%; float:left;}
    .banner-section{background-image:url("images/banner.jpeg"); background-size:cover; height: 380px; left: 0; position: absolute; top: 0; background-position:0;}
    .post-title-block{padding:100px 0;}
    .post-title-block h1 {color: #fff; font-size: 85px; font-weight: bold; text-transform: capitalize;}
    .post-title-block li{font-size:20px; color: #fff;}
    .image-block{float:left; width:100%; margin-bottom:10px;}

    </style>

</head>

<body>

     <?php include("header.php"); ?>

        <section class="banner-section">
       </section>
    <section class="post-content-section">
         <div class="container">

        <?php
          if($_GET['id'] != NULL){
            require("mysqli_connect.php");
            $pid = $_GET['id'];
            $query = "SELECT title, content,user_id, DATE_FORMAT(posted,'%M %e ,%Y') as date FROM post WHERE id=$pid";
            $result = mysqli_query($dbcon, $query)or die("Error: ".mysqli_error($dbcon));
          }
          else{
            header("Location: search.php");
            exit();

          }
            $row = mysqli_fetch_array($result);
               $name= "SELECT username FROM users WHERE id= ".$row['user_id']."";
          			 $result1 = mysqli_query($dbcon, $name);
          			 $row1 = mysqli_fetch_array($result1);

             if(isset($_SESSION['user_id'])){
                 $uid = $_SESSION['user_id'];
                 if($_SERVER['REQUEST_METHOD'] == 'POST'){
                     $content = $_POST['comment_content'];
                     $q = "INSERT INTO comment (post_id, user_id, content,time_posted) VALUES ($pid, $uid, '$content',NOW())";
                     $result = mysqli_query($dbcon, $q);
                 }
}
              $comment="SELECT p.content ,p.time_posted as date ,u.username  FROM comment as p INNER JOIN users as u  ON p.user_id=u.id  WHERE post_id=$pid ORDER BY date DESC";
              $result2=mysqli_query($dbcon,$comment);

            echo' <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 post-title-block">

                  <h1 class="text-center">'.$row['title'].'</h1>
                  <ul class="list-inline text-center">
                     <li>'.$row1['username'].'</li>
                     <li> |</li>
                     <li>'.$row['date'].'</li>
                 </ul>
                 </div>
                 <p class="lead">'.$row['content'].'</p>
                  <hr>';

              if(isset($_SESSION['user_id'])){
              /*  $uid = $_SESSION['user_id'];
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $content = $_POST['comment_content'];
                    $q = "INSERT INTO comment (post_id, user_id, content,time_posted) VALUES ($pid, $uid, '$content',NOW())";
                    $result = mysqli_query($dbcon, $q);
                }*/



              echo   ' <div class="well">
                      <h4>Leave a Comment:</h4>
                      <form role="form"  method="post" action="view1_post.php?id='.$pid.'">
                          <div class="form-group">
                              <textarea class="form-control" name="comment_content" rows="3"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                  </div>

                  <hr> ';
            }
             echo '<p><label for="comment">Comments:</label>';
            if(@mysqli_num_rows($result2) == 0){
        							echo 'No comments.';
        			}

            else{

                   while($row2 = mysqli_fetch_array($result2)){
                      $d=strtotime($row2['date']);

                      echo '

                      <div class="media">
                          <a class="pull-left" href="#">
                         <img class="media-object" src="images/we.png" alt="">
                         </a>
                         <div class="media-body">
                          <h4 class="media-heading">'.$row2['username'].'
                                <small>'.date("F j, Y \a\\t h:m:s A", $d).'</small>
                          </h4>'.$row2['content'].'
                          </div>
                        </div>';
                    }


      echo '</section>';
 }
 ?>



 <?php include("footer.php");?>

</body>

</html>
