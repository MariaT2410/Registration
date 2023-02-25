<?php


# form data
$submit = strip_tags($_POST['submit']);
$username = strip_tags($_POST['username']);
$choosepassword = strip_tags($_POST['choosepassword']);
$repeatpassword = strip_tags($_POST['repeatpassword']);
$date = date("Y-m-d");
if ($submit)
{
	$connect = mysqli_connect('localhost', 'root', '', 'phplogon');
	if ($connect == false){
    echo("Ошибка: Невозможно подключиться к MySQL ");
    }
    //ОШИБКА!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    //if($connect->query("SELECT * FROM users WHERE username ='$username'")==false){


		if($username&&$choosepassword&&$repeatpassword)
		{
			echo "$username/$choosepassword/$repeatpassword";


			if($choosepassword == $repeatpassword){

				//Check char length of username
				if(strlen($username)>25){
				echo "Length of username is too long";

				}
				else
				{
					if(strlen($choosepassword)>25||strlen($choosepassword)<6){
						echo "Password must be between 6 and 25 characters";
					}
					else{
						//register the user
						$choosepassword = md5($choosepassword);
						$repeatpassword = md5($repeatpassword);
						echo "Seccess!!";

						//open database
						//$connect = mysqli_connect('localhost', 'root', '', 'phplogon');
						//if ($connect == false){
	    				//	echo("Ошибка: Невозможно подключиться к MySQL ");
	    				//}
	    				$result = $connect->query("INSERT INTO users VALUES (NULL, '$username', '$choosepassword', '$date')");


						if ($result == false) {
	    					echo("Произошла ошибка при выполнении запроса");
	    				}
						die("You have been registered. <a href = 'index.html'>Return to logon page</a>");
					}
				}
			}
			else echo "Your password don't mach";
		}
		else echo "Please fill in all fields";
	//}
	//else echo "The user's name registered yet";

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="login_style.css">

</head>
<body>
	<main id="main-holder">
		<h1 id="login-helder">Register</h1>
		<form action='register.php' method='POST'>
			<input id="username-field" class="login-form-field" placeholder="Username" type="text" name="username" value='<?php echo $username; ?>'><br>
			<input id="choosepassword" class="login-form-field" placeholder="Password" type="password" name="choosepassword" value='<?php echo $choosepassword; ?>'><br>
			<input id="password"  class="login-form-field" placeholder="Repeat the password" type="password" name="repeatpassword" value='<?php echo $repeatpassword; ?>'><br>
			<input type="submit" name="submit" id="login-form-submit">
		</form>
</html>