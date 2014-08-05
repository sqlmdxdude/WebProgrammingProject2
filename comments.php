
    <div id="addacomment">
        <p>Add a comment</p>
		<form name='contentForm' action="" method="post" align='center'>
			<textarea align='center 'rows='10' cols='50' name='contentBox'></textarea>
			<br><br>
			<button type="submit" align='center'>Add Comment</button>
		</form>
    </div>
    <div id="allcomments" class="user comments">
		<?php
            // save the last comment so it can be loaded when we get all of the comments
			if(isset($_POST["contentBox"])){
				$comContent = $_POST["contentBox"];
				$userId = $_SESSION["USERID"];
				$postId = $_GET["postID"];
				addComment($postId, $userId, $comContent);
			}

                if(isset($_POST["commentID"])){
                $deletedComment=deleteComment($_POST["commentID"]);
                }
            $comments = getAllComments($_GET["postID"]);
            if(mysqli_num_rows($comments)>0){
                while($row = mysqli_fetch_assoc($comments)){;
                echo "<div class='singleComment'>";
                echo "<div class='commentheader'>".$row["user"]." - " . $row["date"]."</div>";
                echo "<div class='commentcontent'>".$row["content"]."</div>";
                echo "<form id='deletepost' action='viewPost.php?postID=".$_GET["postID"] ."' method='post'><input type='hidden' name='commentID' value='".$row["commentID"]."' /><input type='hidden' name='postID' value='".$_GET["postID"] ."'/><input type='submit' value='Delete this comment' /></form>";
                echo "</div>";
                
                }
            }
            releaseSQLResource($comments);

		?>
    </div>
