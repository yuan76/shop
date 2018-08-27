<?php
	include "../koneksi.php";
	$act=$_GET['act'];
	$toko=$_GET['toko'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Umi Collection | Stok</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Data Stok Barang</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
			<div class="row">
			<?php
			$exe  = mysqli_query($con,"SELECT * FROM $db.toko order by toko.nama asc");
			
			while ($res=mysqli_fetch_array($exe)){
				$sql=mysqli_query($con,"select sum(barang.jumlahBarang) from $db.barang where barang.toko='$res[idToko]';");
				$data = mysqli_fetch_row($sql);
						if (!empty($data[0])) {
							$jmlStok=$data[0];
						} else {
							$jmlStok="0";
						}
				echo '
				<div class="col-lg-6 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-book fa-4x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">											
											'.
											$jmlStok
											.'
											<sup style="font-size: 18px"> Baju</sup>
										</div>
										<div>
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
