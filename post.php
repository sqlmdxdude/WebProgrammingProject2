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
        <?php   
            $results = getAllPosts($_SESSION["AUTHENTICATED_BLOGID"]);
            if(mysqli_num_rows($results)>0){
            ?><table id="userposts"><tr><th>Post Title</th><th>Edit</th><th>Delete</th></tr><?php
            while($row=mysqli_fetch_assoc($results)){
                echo "<tr><td>".$row["title"]."</td><td>".$row["postID"]."</td><td>".$row["postID"]."</td></tr>";
                }
            ?></table><?php
            }
         ?>
		<form name="form_post" action="" method="post" onsubmit="validate()">
		
		<?php 
			if(isset($_GET['postID'])){
				$postID = $_GET['postID']; 
				$result = viewPost($postID);
				if ($result == null){
					echo "<h2>Sorry we couldn't find the requested blog post. Please check back later</h2>";
					return;
				}
				echo "Title:" ;
				echo '<h2>'. $result['title'].'<h2><br>';
				echo '<textarea id="content" name="content" rows="10" cols="10" form="form_post" value ="'. $result['content'] .'" ></textarea><br>';
				echo '<input type="submit" name="submit" value="edit"> <input type="submit" name="submit" value="delete"><br>';
				echo '<input type="hidden" value="' . $_GET['postID'] . '" name="postID"  />';
			} else {
				echo "Title: <br>";
				echo '<input type="text" maxlength = 50 name = "title" id = "title"><br>';
				echo '<textarea id="content" name="content" rows="10" cols="10" form="form_post" ></textarea><br>';
				echo '<input type="submit" name="submit" value="create">';
			}
			
			?>
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
				if ($submit == 'edit'){
					edit();
				}else if ($submit == 'create'){
					echo '<h1>';
					print_r($_POST);
					echo '</h1>';
					//create();
				} else if($submit== 'delete'){
					delete();
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
        </div>
	</body>
</html>