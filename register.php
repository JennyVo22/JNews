<?php
	require("templates/header.php");

	$servername = "localhost";
	$user = "root";
	$pw = "";
	//define variables and set to empty values
	$usernameErr = $passwordErr = $emailErr = $birthdayErr = $genderErr = "";
	$username = $password = $email = $day = $month = $year = $birthday =  $gender = "";



	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["username"])) {
	    	$usernameErr = "Name is required";
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
		    $password = md5(test_input($_POST["password"]));
		 }

		if (empty($_POST["email"])) {
		    $emailErr = "Email is required";
		 }
		else {
		    $email = test_input($_POST["email"]);
		    // check if e-mail address is well-formed
		    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      $emailErr = "Invalid email format"; 
		    }
		 }  


		 	$day = $_POST["day"];
		 	$month = $_POST["month"];
		 	$year = $_POST["year"];
		 	$birthday = $year."/".$month ."/". $day;

	  	if (empty($_POST["gender"])) {
	    	$genderErr = "Gender is required";
	  	} 
	  	else {
	    	$gender = test_input($_POST["gender"]);
	  	}

	  	//SQL 

	  	// Create connection
	  	if ($username && $password && $email && $birthday && $gender)
	  	{
			$conn = mysqli_connect($servername, $user, $pw);
			mysqli_select_db($conn,"jnews");

			// Check connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "INSERT INTO user (username, password, email, birthday, gender)
			VALUES ('$username', '$password', '$email','$birthday', $gender)";

			if ($conn->query($sql) === TRUE) {
			    echo "New account created successfully";
				header("location: login.php");
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
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
		<fieldset style="width: 430px; height: 140px; margin: 140px auto 170px;">
			<legend style="margin-left: 10px;">Login</legend>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<table>
					<tr>
						<td>Username</td>
						<td>
							<input type="text" size="25" name="username" value="<?php echo $username ?>"  > 
							<span class="error">* <?php echo $usernameErr;?></span>
						</td>
					</tr>
					<tr>
						<td>Password</td>
						<td>
							<input type="Password" size="25" name="password" value="<?php echo $password ?>">
							<span class="error">* <?php echo $passwordErr;?></span>
						</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>
							<input type="text" size="25" name="email" value="<?php echo $email ?>">
						  	<span class="error">* <?php echo $emailErr;?></span>
						</td>
					</tr>
					<tr>
						<td>Birthday</td>
						<td>
							<select name="day">
								<option value=""><?php echo $day ?></option>
								<?php 
									for($i=1;$i<=31;$i++)
									{
										echo "<option value='$i'>$i</option>";
									}
									;
								 ?>
							</select>
							<select name="month">
								<option value=""><?php echo $month ?></option>
								<?php 
									$month = array(1=>"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Now","Dec");
									foreach ($month as $key=> $m) {
										echo "<option value='$key'>$m</option>";
									}

								 ?>
							</select>
							<select name="year">
								<option value="year"><?php echo $year ?></option>
								<?php 
								for($j=1950; $j<=date("Y"); $j++)
								{
									 echo "<option value='$j'>$j</option>";
								} ?>
							</select>
							<span class="error">* <?php echo $birthdayErr;?></span>

						</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td>
							<input type="radio" name="gender" value="1" <?php if(isset($gender) && $gender==1) echo "checked" ?> >Male
							<input type="radio" name="gender" value="2" <?php if(isset($gender) && $gender==2) echo "checked" ?> >Female
							<span class="error">* <?php echo $genderErr;?></span>

						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="ok" value="Register"></td>
					</tr>
				</table>
			</form>
		</fieldset>
	</div>			

<?php
	require("templates/footer.php")
?>


