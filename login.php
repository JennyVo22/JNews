<?php
	session_start();
	require("templates/header.php");

	$servername = "localhost";
	$user = "root";
	$pw = "";
	//define variables and set to empty values
	$username = $password = $err = "";



	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["username"])) {
	    	$usernameErr = "Username is required";
	  	} 
	  	else {
	    	$username = test_input($_POST["username"]);
		    //check if name only contains letters and whitespace
		    // if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		    //   $nameErr = "Only letters and white space allowed"; 
		    // }
	  	}

		if (empty($_POST["password"])) {
		    $passwordErr = "Password is required";
		 } 
		else {
		    $password = md5(test_input($_POST["password"])) ;
		 }


	  	//SQL 

	  	// Create connection
	  	if ($username && $password)
	  	{
			$conn = mysqli_connect($servername, $user, $pw);
			mysqli_select_db($conn,"jnews");

			// Check connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}


				$sql = $conn->query("SELECT * FROM user 
				WHERE username='$username' and password='$password'");

			if (mysqli_num_rows($sql) > 0) {
				$data = mysqli_fetch_assoc($sql);
				$_SESSION["level"] = $data["level"];
				if ($_SESSION["level"] ==2){
					header("location: admin/admin.php");
					exit();
				}
				else{
					$_SESSION["username"] = $username;
					header("location: index.php");					
				}

			} else {
			    $err = "Wrong username or password";
			}

			$conn->close();	  		
	  	}
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}	
?>

	<div id="container">
		<fieldset style="width: 290px; height: 120px; margin: 140px auto 170px;">
			<legend style="margin-left: 10px;">Login</legend>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<table>
					<tr>
						<td>Username</td>
						<td><input type="text" size="25" name="username" value="<?php echo $username; ?>"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="pass" size="25" name="password" value="<?php echo $password ?>"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Login" name=""></td>
					</tr>
					<span class="error"> <?php echo $err;?></span>
				</table>
			</form>
		</fieldset>
	</div>		

<?php
	require("templates/footer.php")
?>


