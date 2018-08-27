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

    <title>Umi Collection | List Batal Penjualan</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">List Batal Penjualan</h2>
    </div>
  </div>
 
<div class="row">		
	<?php	
	include '../koneksi.php';

	$kode = $_POST['kode'];
	$toko = $_POST['toko'];
		$qryTampil = mysqli_query($con,"select * from penjualan where kode='$kode' and toko='$toko';");
		/*				
		$qryTampil = mysqli_query($con,"
					select p.tglPinjam as tglPinjam,p.kode as kode,p.jumlahPinjam as jumlahPinjam,t.nama as tokoAsal,p.idPinjam as idPinjam 
						from pinjam as p join toko as t on p.toko1=t.idToko
						where p.toko2='$toko' and p.status='menunggu';
					");
		*/			
	?>      
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
			<th>Tanggal Transaksi</th>
            <th>Kode</th>
            <th>Jumlah Barang</th>
			<th>Total</th>
			<th>Lemari</th>
			<th>Action</th>			
          </tr>
        </thead>
        <tbody>
        <?php        
          while ($dta = mysqli_fetch_array($qryTampil)) {
            echo '<tr>
			<td>'.date("j F Y, g:i a",strtotime($dta['tglTransaksi'])).'</td>
			  <td>'.$dta['kode'].'</td>
              <td>'.$dta['jumlahJual'].'</td>
			  <td>Rp. '.number_format($dta['total']).'</td>
			  <td>'.$dta['lemari'].'</td>
			  <td> <a href="index.php?act=prosesBatal&id='.$dta['idPenjualan'].'"> <button class="btn btn-danger"> Batalkan </button> </a> </td>
            </tr>';
          }		  
		  
        ?>
        </tbody>
      </table>
</div>
</div>
</body>
</html>