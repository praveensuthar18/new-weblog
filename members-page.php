<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Page</title>
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
            <?php
            if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] == 0))
            {
                header("Location: login.php");
                exit();
            }
            echo '<h2>Welcome to your page ';
            if (isset($_SESSION['username'])){
                echo "{$_SESSION['username']}!";
            }
            echo '</h2>';
            ?>
            <div id="midcol">
                <div id="mid-left-col">
                    <h4>Your Posts:-</h4>
                    <?php
                        require("mysqli_connect.php");
                        $i=1;
                        $uid = $_SESSION['user_id'];
                        $query = "SELECT title, id, DATE_FORMAT(posted,'%M %e ,%Y') as date  FROM post WHERE user_id=$uid";
                        $result = mysqli_query($dbcon, $query);
                        if(@mysqli_num_rows($result) == 0){
                            echo 'You have not posted anything yet.';
                        }

                      echo'  <table class="table table-condensed table-striped"  >
                        <thead>
                                 <tr >
                                     <th>#</th>
                                     <th  >Title</th>
                                     <th >Posted On</th>

                                 </tr>
                        </thead>';

                   while($row = mysqli_fetch_array($result)){
                          //  echo '<a href="view_post.php?id=' . $row['id'] . '">' . $row['title'] . '</a><br>';

                        echo'<tbody>
                                    <tr>
                                       <th scope="row">'.$i++.'</th>
                                       <td ><a href="view1_post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></td>
                                       <td >'.$row['date'].'</td>
                                       </tr>

                          </tbody>';
                        }
                    echo '</table>';

                    ?>
                </div>
                <div id="mid-right-col">
                    <h3></h3>
                    <p><b></b></p>
                    <br>
                    <br>
                </div>
            </div>
        </div>







        <?php include("footer.php"); ?>
    </div>
</body>
</html>
