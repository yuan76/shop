<?php
	session_start();
	include "../koneksi.php";
	include "../cek.php";
	$toko=$_SESSION['toko'];
	
	//$toko=$_GET['toko'];
	//echo $toko;

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>List Barang</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">List Barang</h2>
    </div>
  </div>
 
<div class="row">		
	<?php	
		$qryTampil = mysqli_query($con,"select DISTINCT(kode),jenisBarang,merk,ukuran,harga from stok order by jenisBarang asc, merk asc, ukuran asc;");
	?>      
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
			<th>Kode</th>
            <th>Jenis Barang</th>
            <th>Merk Barang</th>
            <th>Ukuran Barang</th>
			<th>Harga Barang</th>			
          </tr>
        </thead>
        <tbody>
        <?php        
          while ($dta = mysqli_fetch_array($qryTampil)) {			
            echo '<tr>
			  <td>'.$dta['kode'].'</td>
              <td>'.$dta['jenisBarang'].'</td>
			  <td>'.$dta['merk'].'</td>
			  <td>'.$dta['ukuran'].'</td>
			  <td>Rp. '.number_format($dta['harga']).'</td>			  
            </tr>';
          }
		  
        ?>
        </tbody>
      </table>
</div>
</div>
</body>
</html>