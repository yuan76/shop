<?php

	include "../koneksi.php";
	$act=$_GET['act'];
  $toko=$_GET['toko'];
  $lemari=$_GET['lemari'];
$query = mysqli_query($con,"select * from toko where idToko='$toko'");
	
	while ($data = mysqli_fetch_array($query)){
		$namaToko=$data['nama'];
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
      <h2 class="page-header">Penjualan Toko <?php echo $namaToko; ?> Bulan ini</h2>
    </div>
  </div>
 
<div class="row">		
	<?php
		$qryTampil = mysqli_query($con,"select * from barang where toko='$toko' and lemari='$lemari'");
	
	$qryHitung = mysqli_query($con,"select sum(jumlahBarang) from barang where toko='$toko' and lemari='$lemari'");
	$dtaHit = mysqli_fetch_row($qryHitung);
		
	?>      
       
     
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
         
            <th>Kode</th>
          
		      	<th>Jumlah Barang</th>
            
          </tr>
        </thead>
        <tbody>
        <?php        
          while ($dta = mysqli_fetch_array($qryTampil)) {
            echo '<tr>
              <td>'.$dta['kode'].'</td>		  
			        <td>'.$dta['jumlahBarang'].'</td>	
            </tr>';
          }
        ?>
        </tbody>
      </table>
	 
	  <h3>
        Jumlah Barang :
        <span class="label label-warning">
          <?php 
			if(isset($dtaHit[0])){
				echo $dtaHit[0]." Baju";
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

