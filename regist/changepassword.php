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
		<h1 id="login-helder">Change password</h1>
		<link rel="stylesheet" href="login_style.css">

<?php
session_start();

$user = $_SESSION['username'];

if($user){
	$submit = strip_tags($_POST['submit']);
	$oldpassword = strip_tags($_POST['oldpassword']);
	$newpassword = strip_tags($_POST['newpassword']);
	$repeatnewpassword = strip_tags($_POST['repeatnewpassword']);

	if ($submit)
	{
		$connect = mysqli_connect('localhost', 'root', '', 'phplogon');
		if ($connect == false){
		   	echo("Ошибка: Невозможно подключиться к MySQL ");
		}

		$result = $connect->query("SELECT password FROM users WHERE username='$user'") or die("Query didnt work");
		$num_rom = $result->num_rows;
    	//echo $num_rom;
    	if ($num_rom!=0){
        	while ($row = $result->fetch_array()) {
        		$password = $row['password'];
        		if ($password == md5($oldpassword)){
        			//change password
        			if($newpassword == $repeatnewpassword){
        				$query = $connect->query("UPDATE users SET password = 'md5($newpassword)' WHERE username='$user'");
        				session_destroy();
        				die("Your password has been change. <a href = 'index.html'>Return to logon page</a>");

        			}else
        				echo "Your password don't mach";
        		}
        		else
        			die("Old password doesn't match");
        	}
        }




		//}
	}
	else
	{

		//user is logged in
		?>
			<form action='changepassword.php' method='POST'>
				<input id="oldpassword" class="login-form-field" placeholder="Old password" type="password" name="oldpassword"><br><p>
				<input id="newpassword"  class="login-form-field" placeholder="New password" type="password" name="newpassword" ><br><p>
				<input id="repeatpassword"  class="login-form-field" placeholder="Repeat the new password" type="password" name="repeatnewpassword" ><br><p>
				<input type="submit" name="submit" id="login-form-submit" value="Change password">
			</form>
		<?php
	}


}
else
	die("You must be logged in to change your password. <a href = 'index.html'>Return to logon page</a>");
?>
</main>
</body>
</html>