<?php
	include "../koneksi.php";
	$act=$_GET['act'];
	$toko=$_GET['toko'];
	$query = mysqli_query($con,"select * from toko where idToko='$toko'");
	
	while ($data = mysqli_fetch_array($query)){
		$nama=$data['nama'];
	}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<!--<link href="../vendor/css/style.css" rel="stylesheet">-->
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">Penjualan Toko <?php echo $nama; ?> Bulan ini</h2>
    </div>
  </div>
 
<div class="row">		
	<?php
		$qryTampil = mysqli_query($con,"select * from penjualan where toko='$toko' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now()))) order by tglTransaksi, kode asc;");
		/*
		$qryTampil = mysqli_query($con,"
						select p.tglTransaksi as tglTransaksi,p.kode as kode,s.harga as hargaAwal,p.tawar as hargaTawar,p.jumlahJual as jumlahJual,p.total as total
						from penjualan as p join stok as s on p.kode=s.kode
						where(p.toko='$toko' and s.toko='$toko') and (month(p.tglTransaksi)=month(date(now())) and year(p.tglTransaksi)=year(date(now()))) order by p.tglTransaksi, p.kode asc;	
					");
		*/		
		$qryHitung = mysqli_query($con,"select count(idPenjualan),sum(total),sum(jumlahJual) from penjualan where toko='$toko' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())));");
		$dtaHit = mysqli_fetch_row($qryHitung);
		
	?>      
        <h4 class="col-lg-6">
          Total Transaksi: <?php echo $dtaHit[0]; ?>
        </h4>
     
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
            <th>Tanggal Transaksi</th>
            <th>Kode</th>
            <th>Harga Awal</th>
            <th>Harga Tawar</th>
			<th>Jumlah Barang</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
        <?php        
          while ($dta = mysqli_fetch_array($qryTampil)) {
            echo '<tr>
              <td>'.date("j F Y, g:i a",strtotime($dta['tglTransaksi'])).'</td>
              <td>'.$dta['kode'].'</td>		  
              <td>Rp. '.number_format($dta['harga']).'</td>
              <td>Rp. '.number_format($dta['tawar']).'</td>
			  <td>'.$dta['jumlahJual'].'</td>	
			  <td>Rp. '.number_format($dta['total']).'</td>
            </tr>';
          }
        ?>
        </tbody>
      </table>
	  <br>
      <h3>
        Total Penjualan :
        <span class="label label-success">
          <?php echo 'Rp '.number_format($dtaHit[1]);?>
        </span>
      </h3>
	  <h3>
        Jumlah Barang Terjual :
        <span class="label label-warning">
          <?php 
			if(isset($dtaHit[2])){
				echo $dtaHit[2]." Baju";
			} else {
				echo "0 Baju";
			}
			?>
        </span>
      </h3>
</div>
</div>
</body>
</html>

