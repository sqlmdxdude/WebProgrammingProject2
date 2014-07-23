<?php 
    include_once "sessionManager.php";
    include_once "dataaccess.php";
?>
<html>
	<head>
		<title>
			Register & Login
		</title>
	</head>
	<body>
		<h2>Register:</h2><hr>
		<form id="form_register" action="" method="post">
			First Name: <input type="text" name="firstName"></input><br>
			Last Name: <input type="text" name="lastName"></input><br>
			Username: <input type="text" name="registerUsername"></input><br>
			Password: <input type="password" name="registerPassword"></input><br><br>
			<button type="submit">Register</button>
		</form>
		<h2>Already Registered? Login Here:</h2><hr>
		<form id="form_login" action="" method="post">
			Username: <input type="text" name="loginUsername"></input><br>
			Password: <input type="password" name="loginPassword"></input><br><br>
			<button type="submit">Login</button>
		</form>
		<?php
			$connection = mysqli_connect("localhost", "admin", "", "test"); //host, username, pw, dbname
			if (mysqli_connect_errno())
  			{
  				echo "Failed to connect to MySQL: " . mysqli_connect_error();
  			}

			if(isset($_POST["firstName"]) 
				&& isset($_POST["lastName"])
				&& isset($_POST["registerUsername"])
				&& isset($_POST["registerPassword"]))
			{
				
				$newFirstName = $_POST["firstName"];
				$newLastName = $_POST["lastName"];
				$newUserName = $_POST["registerUsername"];
				$newPassword = $_POST["registerPassword"];
				$sql_insertUser = " INSERT INTO users ( FirstName, LastName, Username, Password ) 
									VALUES ( '$newFirstName', '$newLastName', '$newUserName', '$newPassword' ) ";
				$insert = mysqli_query($connection, $sql_insertUser);
				//testing
				if(!$insert){
					printf("Error: %s\n", mysqli_error($connection));
    				exit();
				}
			}

			if(isset($_POST["loginUsername"]) && isset($_POST["loginPassword"]))
			{
				$username = $_POST["loginUsername"];
				$password = $_POST["loginPassword"];
				$sql_checkUser = "  SELECT Username, Password, FirstName 
									FROM users 
									WHERE Username = '$username' 
									AND Password = '$password'";
				$searchResult = mysqli_query($connection, $sql_checkUser);
				if(mysqli_num_rows($searchResult) == 0){
					echo "<p id='userNotFoundError'>Username or password not found</p>";
				}	
				else{
					$row = mysqli_fetch_array($searchResult);
					$_SESSION["username"] = $username;
					$_SESSION["firstName"] = $row['FirstName'];
                    $_SESSION["AUTHENTICATED_USER"] = $row['FirstName'];
					$_SESSION["AUTHENTICATION_TICKET"] = TRUE;
					echo "<p>You are now logged in.</p>";
					redirect('index.php', false);
				}
					
			}
				
			mysqli_close($connection);
		?>
	</body>
</html>
