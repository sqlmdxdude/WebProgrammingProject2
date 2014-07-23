<?php 
    include_once "dataaccess.php";
    include_once "sessionManager.php";
?>
<html>
	<head>
	</head>
	<body>
		<form name='contentForm' action="" method="post">
			<textarea rows='10' cols='50' name='contentBox'></textarea>
			<br><br>
			<button type="submit">Add Comment</button>
		</form>
		
		<?php
			if(isset($_POST["contentBox"])){
				$comContent = $_POST["contentBox"];
				$userId = getUserId($_SESSION["username"]);
				$postId = $_SESSION["POSTID"];
				addComment($postId, $userId, $comContent);
			}
		?>
		
	</body>
</html>