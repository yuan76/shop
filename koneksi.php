<?php
	//mysql_connect('localhost','root','','showroo2_qurban');
	$con = mysqli_connect('localhost:3306','root','oemi1996','tokoumi');
	//$con = mysqli_connect($host_p, $usernm_p, $pass_p, $db);
	$now = date('Y-m-d');
	$db ='tokoumi';
	date_default_timezone_set('Asia/Jakarta');
/*
	if ($con->connect_error) {
  echo $con->connect_error;
} else {
  echo "konek";
}
*/
	?>
