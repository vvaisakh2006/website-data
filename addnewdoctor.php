<?php
require('check_recp.php');
require('db.php');
if(isset($_POST['submit']))
{
	$doc_id=$_POST['doc_id'];
	$password=$_POST['password'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$gender=$_POST['gender'];
	$mobile=$_POST['mobile'];
	$department=$_POST['department'];
	$email=$_POST['email'];
	$str="insert into doctor values	('$doc_id','$password','$fname','$lname','$gender','$mobile','$department','email')";
	$res=@mysql_query($str)or die(mysql_error());
	if($res>=0)
		{
		echo'<br><br><b>Doctor added !!<br>';
		}
}
?>

<body style="background-image: url(images/background4.jpg);">
<br>
<br>
<form method="post" action="" ><big><big>Doctor
Information :<br>
  <br>
  </big></big>
  <table width:="50%">
    <tbody>
      <tr>
        <td>Doctor ID : <br>
        </td>
        <td><input name="doc_id" type="text"><br>
        </td>
      </tr>
      
      <tr>
        <td>Password : <br>
        </td>
        <td><input name="password" type="password"><br>
        </td>
      </tr>
      
      
      <tr>
        <td>First Name : <br>
        </td>
        <td><input name="fname" type="text"><br>
        </td>
      </tr>
      <tr>
        <td>Last Name : <br>
        </td>
        <td><input name="lname" type="text"><br>
        </td>
       </tr>
      <tr>
        <td>Gender : <br>
        </td>
        <td><input name="gender" type="text"><br>
        </td>
        </tr>
      <tr>
        <td>Department : <br>
        </td>
        <td><input name="department" type="text"><br>
        </td>
      </tr>
      <tr>
        <td>Mobile : <br>
        </td>
        <td><input name="mobile" type="integer"><br>
        </td>
      </tr>
      <tr>
        <td>Email Address :<br>
        </td>
        <td><input name="email" type="email"><br>
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <br>
  <input name="submit" value="ADD" type="submit">&nbsp; &nbsp; <input name="reset" value="RESET" type="reset"> <big><big><br>
  </big></big></form>
