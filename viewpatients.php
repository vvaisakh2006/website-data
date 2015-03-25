<?php
require('check_recp.php');
require('db.php');
$sql = 'SELECT * from patients';
$retval = mysql_query( $sql );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    echo "PATIENT ID :{$row['id']}  <br> ".
         "NAME 		 : {$row['name']} <br> ".
         "AGE		 : {$row['age']} <br> ".
         "GENDER	 : {$row['gender']} <br> ".
         "OCCUPATION : {$row['occupation']} <br> ".
         "MOBILE	 : {$row['mobile']} <br> ".
         "ADDRESS	 : {$row['address']} <br> ".
         "--------------------------------<br>";
} 

?>
