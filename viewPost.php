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
            <div id="header"><div id="loginstatus"><?php echo "Logged in as " .$_SESSION["AUTHENTICATED_USER"] ; ?></div>
            <div id="logout"><a href="registerLogin.php">Log Out</a></div><h2>Available Blogs</h2></div>
            <div id="blogcontainermain">
                <?php 
					if (isset($_GET['postID'])){
						$postID = $_GET['postID'];
						$result = viewPost($postID);
                        $rows = mysqli_fetch_array($result);
                        
					
                ?>
				<div id="posttitle" class="posttitle"><?php echo $rows['title']; ?></div>	
                <div id="postcontent" class="postcontent"><?php echo $rows['content']; ?>
                    <?php }
                    ?>
                </div>
                <div id="comments"><?php include_once('comments.php');?></div>
                
            </div>
        </div>
    </body>
</html>