<?php
	session_start();
	include "../koneksi.php";
	include "../cek.php";
	$toko=$_SESSION['toko'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Penjualan Barang</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Jual Barang</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

			<div class="card">
				<div class="card-body">
                        <form action="?act=prosesJual" method="POST">     
							<div class="form-group row">
								<label for="kode" class="col-sm-2 col-form-label">Kode Barang</label>
								<div class="col-sm-5">
									<select class="form-control" name="kode">
										<option value="" selected>- Pilih Kode -</option>
										<?php
											$sql  = "SELECT DISTINCT(kode) as kode FROM barang where toko='$toko' order by kode asc";
											$exe  = mysqli_query($con,$sql);
											while ($res=mysqli_fetch_row($exe)){
												echo '<option value="'.$res[0].'">'.$res[0].'</option>';
											}
										?>
									</select>	
								</div>
							</div>
							<div class="form-group row">
								<label for="jumlah" class="col-sm-2 col-form-label">Jumlah Barang</label>
								<div class="col-sm-5">
									<input class="form-control" placeholder="Masukkan Jumlah" name="jumlah" type="text" required>
								</div>
							</div>		
							<div class="form-group row">
								<label for="lemari" class="col-sm-2 col-form-label">Lemari</label>
								<div class="col-sm-5">
									<select class="form-control" name="lemari">
										<option value="" selected>- Pilih Lemari -</option>
										<?php
											$sql  = "SELECT DISTINCT(lemari) as lemari FROM barang where toko='$toko' order by lemari asc";
											$exe  = mysqli_query($con,$sql);
											while ($res=mysqli_fetch_row($exe)){
												echo '<option value="'.$res[0].'">'.$res[0].'</option>';
											}
										?>
									</select>	
								</div>
							</div>
							<div class="form-group row">
								<label for="tawar" class="col-sm-2 col-form-label">Harga Tawar (Rp.)</label>
								<div class="col-sm-5">
									<input class="form-control" placeholder="Masukkan Harga Tawar" name="tawar" type="text"/>
								</div>
							</div>		
							<div class="form-group row">								
								<div class="col-sm-5">
									<input class="form-control" name="toko" type="hidden" value="<?php echo $toko; ?>" required>
								</div>
							</div>		
                                <button type="submit" class="btn btn-info pull-left" id="jual" name="jual">Jual</button>
								
                        </form>
                    </div>
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
