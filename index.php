<?php 
    include_once "dataaccess.php";
    include_once "constants.php";
    include_once "sessionManager.php";
    
    if(!$_SESSION["AUTHENTICATION_TICKET"])
        redirect('registerLogin.php', false);

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
            <div id="header"><div id="loginstatus"><?php echo "Logged in as ".  $_SESSION["AUTHENTICATED_USER"]; ?></div>
            <div id="logout"><a href="registerLogin.php">Log Out</a></div><h2>Available Blogs</h2></div>
            <div id="blogcontainermain">
                <table id="availableblogs" name="availableblogs" class="bloglistings">
                    <tr><th>Blog Name</th><th>Blog Owner</th></tr>
                <?php 
                    $result = getBlogs();
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        $title=$row["title"]; 
                        $name=$row["name"];
                        $blogID=$row["blogID"];
                        echo "<td><a href='blogMain.php?blogID=$blogID' class='bloglink'>$title</a></td><td>$name</td>";
                        
                        echo "</tr>";
                    }
                ?>
                </table>
            </div>
        </div>
    </body>
</html>