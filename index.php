<?php
session_start();
require('db.php');
if(isset($_POST['sub_recp']))
{
	$username = $_POST['un'];
	$password = $_POST['pw'];
	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count == 1){
		$_SESSION['username'] = $username;
		$_SESSION['log']='true';
		echo '<script>location.href="home.php"</script>';
	} else {
		?>
		<script>
		alert('Wrong username or password!!');
		</script>
		<?php
	}
}
if(isset($_POST['sub_doc']))
{	
	$doc_id = $_POST['un'];
	$password = $_POST['pw'];
	$sql = "SELECT * FROM doctor WHERE doc_id='$doc_id' AND password='$password'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count == 1){
		$_SESSION['doc_id'] = $doc_id;
		$_SESSION['log_doc']='true';	
		echo '<script>location.href="doc_home.php"</script>';
	} else {
		?>
		<script>
		alert('Wrong Username or Password');
		</script>
		<?php
	}
	
}
if(isset($_GET['qs']))
{
	unset($_SESSION['username']);
	unset($_SESSION['log']);
	unset($_SESSION['doc_id']);
}
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Dr.Reminder Website</title>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css"/>

</head>

<body>
  <div class="login-wrap">
    <h2>Doctor Login</h2>
    <div class="form">
    <form method="post" action="">
    <input type="text" placeholder="Doctor ID" name="un" />
    <input type="password" placeholder="Password" name="pw" />
    <input type="Submit" name="sub_doc" />
    </form>
    </div>
    </div>
   <div class="login-wrap2">
     <h2>Receptionist Login</h2>
     <div class="form">
     <form method="post" action="">
     <input type="text" placeholder="Receptionist ID" name="un" />
    <input type="password" placeholder="Password" name="pw" />
    <input type="Submit" name="sub_recp" />
    
</form>
</div>  
  </div>
  
</div>

</body>

</html>