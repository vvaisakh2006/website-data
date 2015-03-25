<?php
require('db.php');
require('check_recp.php');
?>
<body>
<form action="disp_prescription.php" method="post">
<table>
<tr><td>Enter Patient Id:</td><td><input type="text" name="id" /></td></tr>
<tr><td colspan="2"><input type="submit" name="sub_id" /></td></tr>
</table>
</form>


</body>