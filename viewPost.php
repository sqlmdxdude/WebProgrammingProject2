<?php 
    include_once "sessionManager.php";
    include_once "dataaccess.php";
    include_once "constants.php";
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title>Bad Ass Blogs, Inc.</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="badass.css" type="text/css" rel="Stylesheet" media="screen" />
    </head>
    <body>
        <div id="main">
            <div id="header"><div id="loginstatus"><?php echo "Logged in as Snarf"; ?></div>
            <div id="logout"><a href="logout.php">Log Out</a></div><h2>Available Blogs</h2></div>
            <div id="blogcontainermain">
                <table id="availableblogs" name="availableblogs" class="bloglistings">
                    <tr><th>Blog Name</th><th>Blog Owner</th></tr>
                <?php 
					if (isset($_GET['postID'])){
						$postID = $_GET['postID'];
						$result = viewPost($postID);
						echo "<div>";
						echo '<div class="posttitle">'.$result['title']."</div>";
						echo '<div class="postcontent">' .$result['content'] . "</div>";
						// SQL to get username
						// echo '<div class="author">' . runSelectSQL("SELECT username WHERE id=''"), '</div>';
						echo '</div>';
					}
					
					include_once('comments.php');
                ?>
                </table>
            </div>
        </div>
    </body>
</html>