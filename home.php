<?php
require('check_recp.php');
require('db.php');
?>

<body style="background-image: url(images/background4.jpg);">
<center>
<br><br><br>
<br>
<br>
<big><big>DR.REMINDER WEBSITE<br>
<br>
WELCOME !!</big></big><br>
<br>
<br>
<form method="post" action="addnewpatient.php" name="addnewpatient">
  <input name="addnewpatient" value="ADD NEW PATIENT" type="submit"></form>
<br>
<br>
<form method="post" action="addnewdoctor.php" 
name="addnewdoctor">
<input name="addnewdoctor" value="ADD NEW DOCTOR" type="submit"></form>
<br>
<br>
<form method="get" action="viewpatients.php" name="viewpatients">
  <input name="viewpatients" value="VIEW PATIENTS DATABASE" type="submit"></form>
  <br>
<br>
 <form method="get" action="index.php?qs=logout">
  <input value="Logout" type="submit"></form> 
</center>