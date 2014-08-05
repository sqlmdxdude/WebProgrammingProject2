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
        <link href="badass.css" type="text/css" rel="Stylesheet" media="Screen" />
    </head>
    <body>
        <?php  $blogExists = blogExists($_GET["blogID"]); ?>
        <div id="main">
            <div id="header"><div id="loginstatus"><?php echo "Logged in as " .$_SESSION["AUTHENTICATED_USER"] ; ?></div>
            <div id="logout"><a href="registerLogin.php">Log Out</a></div><?php if($blogExists){ ?><h2>Here are your posts.</h2><?php }  ?></div>
                

                 <?php   if($blogExists){ ?>
                            <div id="blogactions"><a href="post.php?blogID=<?php echo $_GET["blogID"]; ?>">Create A Post</a></div>
                <?php }
                ?>

            <div style="clear: both;"></div>
            <div id="blogcontainermain">
            <?php
                    $result=getAllPosts( $_GET["blogID"] );/*$_SESSION["AUTHENTICATED_BLOGID"]*/
                    if(mysqli_num_rows($result)>0){
                    ?>
                    <table id="userposts" class="postlistings">
                        <tr><th>Title</th><th>Date</th></tr>
                        <?php 
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo "<tr>";
                                echo"<td><a href='viewPost.php?postID=".$row['postID']."'>".$row['title']."</a></td><td>".$row['date']."</td>";
                                echo "</tr>";
                            }
                            
                            mysqli_free_result($result);
                        ?>
                    </table>
                    <?php
                    } else {
                        
                        if($blogExists){
                            echo "<div><h3>Why don't you go ahead and create some posts since you don't have any!</h3></div>";
                        } else {
                            echo "<div style='margin-top: 25px;'><h3>The requested blog could not be found. Go <a href='index.php'>here</a> and try again.</h3></div>";
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>