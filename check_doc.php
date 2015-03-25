<?php
session_start();
if(!isset($_SESSION['log_doc']))
{
echo '<script>location.href="index.php"</script>';
}
?>
