<div id="sidebar-wrapper">
	<nav id="sb">
		<ul class="sidebar-nav">
            <li>
				<a href="post.php" title="New Post">
					<span class="fa fa-anchor solo">New Post</span>
				</a>
			</li>
            <li>
				<a href="search.php" title="Search">
					<span class="fa fa-anchor solo">Search</span>
				</a>
			</li>
            <li>
				<a href="index.php" title="Return to Home Page">

					<span class="fa fa-anchor solo">Home Page</span>
				</a>
			</li>
          <?php
           if(isset($_SESSION['user_id'])){
               echo '<li><a href="members-page.php" title="Member\'s Page">My Page</a></li>';
            }
           if(isset($_SESSION['user_level']) && ($_SESSION['user_level'] == 2)){
               echo '<li><a href="admin-page.php" title="Admin Page">Admin Page</a></li>';
            }
          ?>
        </ul>
	</nav>
</div>
