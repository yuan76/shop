<?php
	session_start();
	include "../koneksi.php";
	include "../cek.php";
	$toko=$_SESSION['toko'];
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>List Riwayat Pinjam</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">List Riwayat Pinjam</h2>
    </div>
  </div>
 
<div class="row">		
	<?php	
		$qryTampil = mysqli_query($con,"select * from pinjam where toko1='$toko' or toko2='$toko' order by tglPinjam ASC;");
	?>      
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
			<th>Tanggal Pinjam</th>
            <th>Kode</th>
            <th>Jumlah</th>
			<th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php        
          while ($dta = mysqli_fetch_array($qryTampil)) {
			if ($dta['toko1'] == $toko){
				$status="keluar";
			} else if ($dta['toko2'] == $toko){
				$status="masuk";
			}
            echo '<tr>
			<td>'.date("j F Y, g:i a",strtotime($dta['tglPinjam'])).'</td>
			  <td>'.$dta['kode'].'</td>
			  <td>'.$dta['jumlahPinjam'].'</td>
			  <td>'.
				$status
			  .'</td>
            </tr>';
          }
		  
        ?>
        </tbody>
      </table>
</div>
</div>
</body>
</html>