<?php

define("MUSER","bubla_t_admin");
define("MPASS","xew56baz");
define("MSERVER","cnmtsrv1.uwsp.edu");
define("MDB","bubla_t");
$con = new mysqli(MSERVER, MUSER, MPASS, MDB);
 
if (basename($_SERVER['PHP_SELF']) == "const.php") {
  die(header("HTTP/1.0 404 Not Found"));
}



?>
