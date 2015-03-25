<?php
require('db.php');
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$str="insert into users values('$username','$password')";
	$res=@mysql_query($str)or die(mysql_error());
	if($res>=0)
		{
		echo'<br><br><b>Thank you for registeration !! <br><a href="index.php"><b>Click here to return to the main page</b></a>
';
		}
}
?>
<body style="background-image: url(images/background4.jpg);">
<div style="text-align: center;"><br>
<br>
<br>
<br>
<big><big>HOSPITAL MANAGEMENT SYSTEM<br>
<br>
New User Registeration<br>
<br>
</big></big>
<form method="post" action="">
  <center>
  <table width="30%">
    <tbody>
      <tr>
        <td style="text-align: left;">USERNAME<br>
        </td>
        <td><input name="username" type="text"><br>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;">PASSWORD<br>
        </td>
        <td><input name="password" type="password"><br>
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <br>
  <input value="REGISTER" name="submit" type="submit"><br>
  <br>
  </center>
</form>
<big><big><br>
</big></big>
</div>
