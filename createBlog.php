<?php
    /* This page requires that the userID of the logged on user
       be passed to the page as a session variable $_SESSION["userID"]
       which will be used to validate if they already have a blog or not
       If they have a blog different content will be written to the page
    */
    include_once "sessionManager.php";
    include_once "dataaccess.php";
    $_SESSION["userID"]=2;
    if(isset($_POST["blogname"])){
        $blogID = createBlog($_SESSION["userID"], $_POST["blogname"]);
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head profile="http://www.w3.org/2005/10/profile">
        <title>Create A Blog</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="badass.css" type="text/css" rel="Stylesheet" media="Screen" />
        <script src="badass.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="main">
            <div id="header"><h2>Create A Blog</h2></div>
            <div>
                <form id="createblog" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateCreateBlog();" >
                    <?php 
                        if(userAlreadyOwnsBlog($_SESSION["userID"])){ ?>
                            <p>You may only have one blog. We found your blog. Click <a href="<?php echo "#"; /* put a reference to the blog here for the link */ ?>">here</a> to go to your blog</p>
                        <?php } else { ?>
                            <span class="label">Enter a blog name: </span><input type="text" name="blogname" id="blogname" placeholder="enter blog name" /> <input type="submit" value="Create Blog" />
                            <div id="notification"><?php if(isset($_POST["blogname"]) && $blogID != null){ echo "Your blog titled '".$_POST["blogname"]."' was created successfully. <a href=''>Goto your blog</a>";} ?></div>
                       <?php } ?>
                </form>
            </div>
        </div>
    </body>
</html
