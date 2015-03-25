<?php
require('db.php');
require('check_doc.php');
if(isset($_POST['submit']))
{
class GCMPushMessage {
	var $url = 'https://android.googleapis.com/gcm/send';
	var $serverApiKey = "AIzaSyCtjWocq11Cr_gMnFwiRMaaoYm_Mu2ixzs";
	var $devices = 0;
	
	/*
		Constructor
		@param $apiKeyIn the server API key
	*/
	function GCMPushMessage(){
		//$this->serverApiKey = $apiKeyIn;
	}

	/*
		Set the devices to send to
		@param $deviceIds array of device tokens to send to
	*/
	function setDevices($deviceIds){
	
		if(is_array($deviceIds)){
			$this->devices = $deviceIds;
		} else {
			$this->devices = array($deviceIds);
		}
	
	}


	/*
		Send the message to the device
		@param $message The message to send
		@param $data Array of data to accompany the message
	*/
	function send($message, $data = false){
		//echo $this->serverApiKey.$this->devices[0];
		if(!is_array($this->devices) || count($this->devices) == 0){
			$this->error("No devices set");
		}
		
		if(strlen($this->serverApiKey) < 8){
			$this->error("Server API Key not set");
		}
		
		$fields = array(
			'registration_ids'  => $this->devices,
			'data'              => array( "message" => $message ),
		);
		
		if(is_array($data)){
			foreach ($data as $key => $value) {
				$fields['data'][$key] = $value;
		}
		}
		$headers = array( 
			'Authorization: key=' . $this->serverApiKey,
			'Content-Type: application/json'
		);
		// Open connection
		$ch = curl_init();
		
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch, CURLOPT_URL, $this->url );
		
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
		
		// Avoids problem with https certificate
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
		
		// Execute post
		$result = curl_exec($ch);
		
		// Close connection
		curl_close($ch);
		
		return $result;
	}

	
	function error($msg){
		echo "Android send notification failed with error:";
		echo "\t" . $msg;
		exit(1);
	}
}





	$id=$_POST['id'];
	$diagnosis=$_POST['diagnosis'];
	$instructions=$_POST['instructions'];
	$doc_name=$_POST['doc_name'];
	$med_id=time().rand(11,99).time();
	$str="insert into prescription values('$id','$diagnosis','$instructions','$doc_name','$med_id')";
	$res=@mysql_query($str)or die(mysql_error());
	$nf=$_POST['nf'];
	$i=1;
	while($i<=$nf)
		{
		$medicine=' ';
		$tm1=$tm2=$tm3=0;
		$medicine=$_POST['medicine_'.$i];
		$tm='';
		if(isset($_POST['tm_1_'.$i]))
			{$tm1=1;}
	 	if(isset($_POST['tm_2_'.$i]))
			{$tm2=1;}
		if(isset($_POST['tm_3_'.$i]))
			{$tm3=1;}
		$dosage=$_POST['dosage_'.$i];
		$str="insert into medicine values('$med_id','$dosage','$medicine','$tm1','$tm2','$tm3')";
		$res=@mysql_query($str)or die(mysql_error());
		$i++;
		}
	$id = $_POST['id']; 
        $gcpm = new GCMPushMessage();
$sql=mysql_query("select token from device where id=".$id);
$rs=mysql_fetch_assoc($sql);
$gcpm->setDevices($rs['token']);
$query1=mysql_query("select * from medicine,prescription where med_id=mid and id=".$id);
while($rs1=mysql_fetch_assoc($query1))
{
$rows[]['tm_1']=$rs['tm_1'];
$rows[]['tm_2']=$rs['tm_2'];
$rows[]['tm_2']=$rs['tm_3'];
$rows[]['diagnosis']=$rs['diagnosis'];
$rows[]['instructions']=$rs['instructions'];
$rows[]['medicine_name']=$rs['medicine_name'];
$rows[]['dosage']=$rs['dosage'];
}
$response = $gcpm->send($message, $rows);
	$sql="SELECT * FROM patients WHERE id='$id'";
	$retval = mysql_query( $sql);
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
		{
		echo "<big><b>PRESCRIPTION : </b></big><br><br><br>";
		echo "DOCTOR NAME : $doc_name<br>"; 
		echo "<b>Patient Details : </b><br>";
    		echo "PATIENT ID : {$row['id']}  <br><br> ".
         	"NAME 		 : {$row['name']} <br><br> ".
         	"AGE		 : {$row['age']} <br><br> ".
         	"GENDER	 : {$row['gender']} <br><br> ".
         	"MOBILE	 : {$row['mobile']} <br><br> ".
       	"--------------------------------<br><hr>";
		} 
	$query1=mysql_query("select * from prescription,medicine 	where id=".$id." and med_id=mid");
	$i=1;
	while($rs1=mysql_fetch_assoc($query1))
		{
		echo 'MEDICINE '.$i.': '.$rs1['medicine_name'].' <br><br>';
		echo 'Dosage '.$i.':'. $rs1['dosage'].' <br><br>';
		echo 'Time '.$i.':'; 
		if($rs1['tm_1']==1)
			{echo ' Morning ';}
		if ($rs1['tm_2']==1)
			{echo ' Afternoon ';}
		if ($rs1['tm_3']==1)
			{echo ' Night';}
		echo '<br><br>';
		$i++;
		}
 	echo "DIAGNOSIS : $diagnosis <br><br>".	
	"ADDITIONAL INSTRUCTIONS : $instructions <br><br>".
	     "--------------------------------<br>";
}

	
?>
<html>
<input type="button" onclick="window.print();" value="Print Prescription"/><br><br>
<a href="home.html"><b>HOME</b></a>
</html>

<?php
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
  <title></title>
<script>
function noffields()
{
	var nof=document.getElementById('med_sel').value;
	window.location='prescription.php?nf='+nof;
}
</script>  
</head>
<body style="background-image: url(images/background4.jpg);">
<br>

<br>

<form method="post" action=""><big><big>PRESCRIPTION :<br>
  <br>
  </big></big>
  <table width:="50%">
    <tbody>
		<tr>
        <td>Doctor Name : <br>
        </td>
        <td><input name="doc_name" type="text"><br>
        </td>
      </tr>
      <tr>
        <td>Patient ID : <br>
        </td>
        <td><input name="id" type="text"><br>
        </td>
      </tr>
      <tr>
      <td>Number of Medicines : <br>
      </td>
      <td>
      <select name="med_sel" id="med_sel" onChange="noffields()">
      <?php
      $i=1;
      while($i<=10)
      {
      echo '<option value="'.$i.'" ';
	  if(@$_GET['nf']==$i)
	  {echo 'selected';}
	  echo '>'.$i.'</option>';
	  $i++;
      }
      ?>
      </select>
      </td>
      <?php
	  if(isset($_GET['nf']))
	  {
		  $no=$_GET['nf'];
		 $i=1;
		 echo '<input type="hidden" name="nf" value="'.$no.'"/>';
		 while($i<=$no)
		 { 
        echo '<tr><td>Medicine : '.$i.' <br>
        </td>
        <td><input type="text" name="medicine_'.$i.'" />
        </td>
      
        <td>Time : <br>
        </td>
        <td>
		<input name="tm_1_'.$i.'" type="checkbox"> Morning</td><td>
        <input name="tm_2_'.$i.'" type="checkbox"> Afternoon</td><td>
        <input name="tm_3_'.$i.'" type="checkbox"> Night</td><td>
        </td>
		<td></td><td></td>
      <td>
	  Dosage:
	  </td>
	  <td>
	  <input type="text" name="dosage_'.$i.'" />
	  </td>	  
	  </tr>';
	  $i++;
		 }
	  ?>
      <tr>
        <td>Diagnosis :<br>
        </td>
        <td><textarea cols="30" rows="3" name="diagnosis"></textarea><br>
        </td>
      </tr>
      <tr>
        <td>Additional Instructions :<br>
        </td>
        <td><textarea cols="30" rows="3" name="instructions"></textarea> </td>
      </tr>
   
  <br>
  <br>
  <?php

	  }
	  
	  ?>
  <tr><td><input name="submit" value="Generate Prescription" type="submit"></td><td> <input name="reset" value="RESET" type="reset"></td></tr></form>
   </tbody>
  </table> 
</body>
</html>