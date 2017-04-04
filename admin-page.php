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
    <div id="container">
        <div id="content">
            <?php
            if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 2))
            {
                header("Location: login.php");
                exit();
            }
            echo '<h2>Welcome to the administrator page ';
            if (isset($_SESSION['username'])){
                echo "{$_SESSION['username']}";
            }
            echo '</h2>';
            ?>
            <h3>Users:-</h3>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>e-mail ID</th>
                    <th>Joined</th>
                    <th>Admin</th>
                </tr>
                <?php
                require("mysqli_connect.php");
                $query="SELECT username, id, join_date, email, user_level FROM users";
                $result = mysqli_query($dbcon, $query);
                while($row=mysqli_fetch_array($result)){
                    echo '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['join_date'] . '</td>
                        <td>' . ($row['user_level']==2? 'Yes':'No') . '</td>
                    </tr>';
                }
                 ?>
            </table>
        </div>
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
