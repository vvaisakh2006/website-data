<?php
require('check_recp.php');
require('db.php');
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$age=$_POST['age'];
	$gender=$_POST['gender'];
	$occupation=$_POST['occupation'];
	$mobile=$_POST['mobile'];
	$address=$_POST['address'];
	$str="insert into patients(`name`,`age`,`gender`,	`occupation`,`mobile`,`address`) values	('$name','$age','$gender','$occupation','$mobile','$address')";
	$res=@mysql_query($str)or die(mysql_error());
	$id=mysql_insert_id();
	if($res>=0)
		{
		echo'<br><br><b>Patient added !!<br>Patient Id:'.$id.'<br />';
		}

}	
?>

<body style="background-image: url(images/background4.jpg);">
<br>
<br>
<form method="post" action="" ><big><big>Patient
Info :<br>
  <br>
  </big></big>
  <table width:="50%">
    <tbody>
      <tr>
        <td>Full Name : <br>
        </td>
        <td><input name="name" type="text"><br>
        </td>
      </tr>
      <tr>
        <td>Age : <br>
        </td>
        <td><input name="age" type="text"><br>
        </td>
      </tr>
      <tr>
        <td>Gender : <br>
        </td>
        <td><input name="gender" type="text"><br>
        </td>
      </tr>
      <tr>
        <td>Occupation : <br>
        </td>
        <td><input name="occupation" type="text"><br>
        </td>
      </tr>
      <tr>
        <td>Contact Number<br>
        </td>
        <td><input name="mobile" type="text"><br>
        </td>
      </tr>
      <tr>
        <td>Address<br>
        </td>
        <td><textarea cols="30" rows="3" name="address"></textarea> </td>
      </tr>
    </tbody>
  </table>
  <br>
  <br>
  <input name="submit" value="ADD" type="submit">&nbsp; &nbsp; <input name="reset" value="RESET" type="reset"> <big><big><br>
  </big></big></form>
