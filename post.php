<?php
    include_once "sessionManager.php";
 	include_once "dataaccess.php";
	include_once "constants.php";
// Authenticate user

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
		<form name="form_post" action="post.php" method="post" onsubmit="validate()">
		Title: <br>
		<input type="text" maxlength ="50" name="title" id="title"/><br/>
		<textarea id="content" name="content" rows="10" cols="10" ></textarea><br/>
        <input type="submit" name="submit" value="create"/>
		</form>
		
		
		<script type="text/javascript">
			function validate() {
				if (document.getElementById("content").value.length == 0 || document.getElementById("content").value.length == null) {
					alert("No input in text box");
					return false;
				}
				return true;
			}
		</script>
		<?php

            if (isset($_POST['submit'])){
				$submit = $_POST['submit'];
				$content = $_POST['content'];
				if ($submit == 'edit'){
					edit();
				}else if ($submit == 'create'){
					echo '<h1>';
					createPost($_SESSION["AUTHENTICATED_BLOGID"], $_POST['title'], $content);
					echo '</h1>';
				} else if($submit== 'delete'){
					delete();
				}
			}
            if(isset($_POST["action"])){
                if($_POST["action"]=="delete"){
                $deletedPost = deletePost($_POST["postID"]);
                }
            }
			function create(){
				if (!isset($_POST['blogID'])){
					echo "<h1> Sorry, we are experiencing technical difficulties</h1>";
				}
				$blogID = isset($_POST['blogID']);
				$content = htmlspecialchars($_POST['content']);
				$title = htmlspecialchars($_POST['title']);
				$result = createPost($blogID, $title, $content);
				if($result == $GLOBALS['POST_CREATED_SUCCESSFULLY']){
					header("Location: blogMain.php");
				} else {
					echo "<h1>Sorry we are experiencing technical difficulties now</h1>";
				}
			}
			
			function edit(){
				if (isset($_POST['postID']) && isset($_POST['content'])) {
				$return = editPost($_POST['postID'], $_POST['content']);
				if ($return == $GLOBALS['POST_EDITED_SUCCESSFULLY']){
					header("Location: blogMain.php");
				} else if ($return == $GLOBALS['POST_EDIT_FAILED']){
					echo "Sorry we are experiencing technical difficulties now";
				}				

			}
			}
			
			function delete(){
				if(isset($_POST['postID'])){
					$result = deletePost($_POST['postID']);
					if ($return == $GLOBALS['POST_DELETED_SUCCESSFULLY']){
						header("Location: blogMain.php");
					} else if ($return == $GLOBALS['POST_DELETE_FAILED']){
						echo "Sorry we are experiencing technical difficulties now";
					}		
				}
			}
		?>
        <?php   


            $results = getAllPosts($_SESSION["AUTHENTICATED_BLOGID"]);

            if(mysqli_num_rows($results)>0){
            ?><table id="userposts"><tr><th>Post Title</th><th>Edit</th><th>Delete</th></tr><?php
            while($row=mysqli_fetch_assoc($results)){
                echo "<tr><td>".$row["title"]."</td><td><form name='edit' method='post' action=''><input type='hidden' name='action' value='edit'/><input type='hidden' name='postID' value='".$row["postID"]."'/><input type='submit' value='Edit Post' /></form></td><td><form name='delete' method='post' action=''><input type='hidden' name='action' value='delete'/><input type='hidden' name='postID' value='".$row["postID"]."'/><input type='submit' value='Delete Post' /></form></td></tr>";
                }
            ?></table><?php
            }
         ?>
        </div>
	</body>
</html>