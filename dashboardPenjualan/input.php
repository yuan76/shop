<?php
	include "../koneksi.php";
	/*			
	$qry1 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='A' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data1 = mysqli_fetch_row($qry1);
	$qry2 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='B' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data2 = mysqli_fetch_row($qry2);
	$qry3 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='C' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data3 = mysqli_fetch_row($qry3);
	$qry4 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='D' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data4 = mysqli_fetch_row($qry4);
	$qry5 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='E' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data5 = mysqli_fetch_row($qry5);
	$qry6 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='F' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data6 = mysqli_fetch_row($qry6);
	$qry7 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='G' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data7 = mysqli_fetch_row($qry7);
	$qry8 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='H' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data8 = mysqli_fetch_row($qry8);
	$qry9 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='I' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data9 = mysqli_fetch_row($qry9);
	$qry10 = mysqli_query($con,"select sum(jumlah),sum(total) from penjualan where toko='J' and (month(tglTransaksi)=month(date(now())) and year(tglTransaksi)=year(date(now())))");
	$data10 = mysqli_fetch_row($qry10);
	*/
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Penjualan</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Dashboard Penjualan</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
			<div class="row">
			<?php
			$exe  = mysqli_query($con,"SELECT * FROM $db.toko order by toko.nama asc");
			
			while ($res=mysqli_fetch_array($exe)){
				$sql=mysqli_query($con,"select sum(penjualan.jumlahJual),sum(penjualan.total) from $db.penjualan where penjualan.toko='$res[idToko]' and (month(penjualan.tglTransaksi)=month(date(now())) and year(penjualan.tglTransaksi)=year(date(now())));");
				$data = mysqli_fetch_row($sql);
						if (!empty($data[1])) {
							$ambil=number_format($data[1]);
						} else {
							$ambil="0";
						}
						if (!empty($data[0])) {
							$jml=$data[0]." Baju";
						} else {
							$jml="0 Baju";
						}
				echo '
				<div class="col-lg-6 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-book fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">
											<sup style="font-size: 18px">Rp. </sup>
											'.
											$ambil
											.'
										</div>
										<div>
											'.
											$jml
											.'
										</div>
									</div>
								</div>
							</div>
							<a href="?act=jualDetail&toko='.$res['idToko'].'">
								<div class="panel-footer">
									<span class="pull-left">Penjualan Toko '.$res['nama'].'</span>
									<span class="pull-right">Lihat Detail</span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				';
			}
			?>
			</div>
    
</div>
  
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
