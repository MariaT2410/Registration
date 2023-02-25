<?php

session_start();

 $username = $_POST['username'];
 $password = $_POST['password'];

 if($username&&$password){

    //версия до PHP7
 	//$connect = mysqli_connect("localhost", "root", "") or die("Couldn't connect");
    // //mysql_select_db("phplogon") or die("Couldn't find db");


 	$connect = mysqli_connect('localhost', 'root', '', 'phplogon') or die("Couldn't connect");
    $result = $connect->query("SELECT * FROM users WHERE username='$username'");
    $num_rom = $result->num_rows;
    //echo $num_rom;
    if ($num_rom!=0){
        while ($row = $result->fetch_array()) {

            $dbusername =$row["username"];
            $dbpassword = $row["password"];



            //check to see the match
            if($username==$dbusername&&md5($password)==$dbpassword){
                echo "You're in! <a href ='member.php'>Click</a> here to enter the member page. ";
                $_SESSION['username'] = $username;
            }
            else echo "Incorrect password";
        }

    }
    else die("That user doesn't exist");

 }
 else die("Please enter username and password");
?>