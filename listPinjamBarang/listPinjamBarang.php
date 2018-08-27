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

    <title>List Pinjam Barang</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">List Pinjam Barang</h2>
    </div>
  </div>
 
<div class="row">		
	<?php	
						
		$qryTampil = mysqli_query($con,"
					select p.tglPinjam as tglPinjam,p.kode as kode,p.jumlahPinjam as jumlahPinjam,t.nama as tokoAsal,p.idPinjam as idPinjam 
						from pinjam as p join toko as t on p.toko1=t.idToko
						where p.toko2='$toko' and p.status='menunggu';
					");
	?>      
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
			<th>Tanggal Pinjam</th>
            <th>Kode</th>
            <th>Jumlah</th>
			<th>Asal Toko</th>
			<th>Action</th>			
          </tr>
        </thead>
        <tbody>
        <?php        
          while ($dta = mysqli_fetch_array($qryTampil)) {
            echo '<tr>
			<td>'.date("j F Y, g:i a",strtotime($dta['tglPinjam'])).'</td>
			  <td>'.$dta['kode'].'</td>
              <td>'.$dta['jumlahPinjam'].'</td>
			  <td>'.$dta['tokoAsal'].'</td>
			  <td> <a href="index.php?act=ambil&id='.$dta['idPinjam'].'"> <button class="btn btn-success"> Sudah di ambil </button> </a> </td>
            </tr>';
          }		  
		  
        ?>
        </tbody>
      </table>
</div>
</div>
</body>
</html>