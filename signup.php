<?php
 session_start();
	include("config.php");

	
$name = $gender = $birth = $email= $pwd = "";
	
	$err1="";
	$err2="";
	$err3="";
	$flag=false;
	
	if(isset($_POST["submit"]))
	{
		if(!empty($_POST["user_name"]) && $_POST["user_birth_day"]&& $_POST["user_email"]&& $_POST["user_password"])
		{

			if (!preg_match("/^[a-zA-Z .]{2,20}$/",$_POST["user_name"])) {
		  $err1.= "You must put character <br/>";
		$flag=true;
		}
				
		if(!preg_match("/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/",$_POST["user_email"])){
			$err2.="Please type a valid Email address.<br/>";
			 $flag=true;
		}	
			if(!preg_match("/^[A-Za-z0-9]{6,}$/",$_POST["user_password"])){
			$err3.="Only letters and number allowed.(min 6 digits).<br/>";	
			 $flag=true;
		}
	
		if( $flag==false)
		{
			$name=$_POST["user_name"];
			$gender=$_POST["user_gender"];
			$birth=$_POST["user_birth_day"];
			$email=$_POST["user_email"];
			$pwd=md5($_POST["user_password"]); 
			
			$sql="INSERT INTO users(user_name,user_email,user_gender,user_birth_day,user_password)VALUES('$name','$email','$gender','$birth','$pwd')";
			 if(mysql_query($sql,$con))
				 {
					//echo "<script>window.location='login.php'</script>";
					echo "Congrats!!! you can Login now";
				 }
			 else
				 {
					 echo "Error" .mysql_error();
				 }
		}
		
		}
		else
		{
		if ($_POST["user_name"]=="") {
		  $err1.= "First name is required. <br/>";
		
		}
				
		if($_POST["user_email"]==""){
			$err2.="Please type a valid Email address.<br/>";
		
		}	
		if($_POST["user_password"]==""){
			$err3.="Only letters and number allowed.(min 6 digits).<br/>";	
			
		}
		}

	}
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>
<body>

<div id="wrapper">

	
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
   
<form name="login-form" class="login-form" action="#" method="post">
	
    <div class="header">
    <h1>Signup Form</h1>
    <span>Fill out the form below to join us</span>
    </div>
    <div class="content">
    
	<input name="user_name" type="text" class="input username" placeholder="YOUR NAME" />		<br />
    <?php
		if(!$err1==""){
			echo "<font color='#FF0000'>" .$err1."</font>";
		}
    ?>
    <br>
    <label>Gender:</label><br />
    <input type="radio" name="user_gender" value="Male" checked/>Male<br>
    <input type="radio" name="user_gender" value="Female"/>Female<br>
    
    <input name="user_birth_day" type="date" class="input username" placeholder="YOUR DATE OF BIRTH" /><br>
    
     <input name="user_email" type="email" class="input username" placeholder="YOUE EMAIL" /><br />
     <?php
		if(!$err2==""){
			echo "<font color='#FF0000'>" .$err2."</font>";
		}
    ?>
     <br>
    
    <input name="user_password" type="password" class="input password" placeholder="Password"  /><br />
     <?php
		if(!$err3==""){
			echo "<font color='#FF0000'>" .$err3."</font>";
		}
    ?>
    </div>

   <input type="submit" name="submit" value="Signup" class="button" /><br/><br/><br/>
     
    </div>
</form>

</div>

<div class="gradient"></div>

</body>
</html>