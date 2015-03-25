<?php
session_start();
if(!isset($_SESSION['log']))
{
echo '<script>location.href="index.php"</script>';
}
?>