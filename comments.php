
<html>
	<head>
	</head>
	<body>
		<form name='contentForm' action="" method="post" align='center'>
			<textarea align='center 'rows='10' cols='50' name='contentBox'></textarea>
			<br><br>
			<button type="submit" align='center'>Add Comment</button>
		</form>
		
		<?php
			if(isset($_POST["contentBox"])){
				$comContent = $_POST["contentBox"];
				$userId = getUserId($_SESSION["USERID"]);
				$postId = $_SESSION["POSTID"];
				addComment($postId, $userId, $comContent);

				echo "<table align='center'>";
				$result = getComments($postId);
				if($result == TRUE){
					while($row = mysqli_fetch_array($result)) {
						echo "<tr><td>Comment by $userId:<br><hr width='50%'> " . $row['content'] . "</td></tr>";
      				}
				}
			}
		?>
	</body>
</html>