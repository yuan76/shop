<html>
<head>
	<title> Berhasil Pinjam </title>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include '../koneksi.php';

$kode = $_POST['kode'];
$toko = $_POST['toko'];
$jumlah = $_POST['jumlah'];
$tokoPinjam = $_POST['tokoPinjam'];

$qryCek = mysqli_query($con, "select sum(jumlahBarang) as total from barang where kode='$kode' and toko='$toko';");
$cek=mysqli_num_rows($qryCek);
if ($cek > 0) {
	while ($ambilBarang = mysqli_fetch_array($qryCek)){
		$jumlahAwal=$ambilBarang['total'];	
	}
	if ( $jumlahAwal > 0 )  {
		if ($jumlah <= $jumlahAwal){	
			/*
			$jumlahBaru=$jumlahAwal-$jumlah;
			$sql = "update $db.barang set barang.jumlahBarang='$jumlahBaru' where kode='$kode' and toko='$toko';";
			
			$cekToko = mysqli_query($con, "select * from barang where kode='$kode' and toko='$tokoPinjam';");
			$ceTo=mysqli_num_rows($cekToko);
			while ($ambilToko = mysqli_fetch_array($cekToko)){
					$jmlAwal=$ambilToko['jumlahBarang'];					
				}
			$jmlBaru=$jmlAwal+$jumlah;	
			
			if ($ceTo > 0) {
				$sql = $sql."update $db.barang set barang.jumlahBarang='$jmlBaru' where kode='$kode' and toko='$tokoPinjam';";
			} else {
				$sql = $sql."insert into $db.barang (barang.idBarang,barang.kode,barang.jumlahBarang,barang.toko,barang.lemari)
			values (NULL,'$kode','$ukuran','$jumlah','$harga','$jenis','$tokoPinjam','$merk');";
				
			}
			*/
			
			$sql = "insert into $db.pinjam (pinjam.idPinjam,pinjam.kode,pinjam.jumlahPinjam,pinjam.tglPinjam,pinjam.toko1,pinjam.toko2,pinjam.status)
			values (NULL,'$kode','$jumlah',NOW(),'$toko','$tokoPinjam','menunggu');";
			
			$query=mysqli_query($con,$sql);
			if($query){
				echo "<script> alert('Berhasil di pesan, harap segera mengambil barangnya');
				window.location='?act=pinjamBarang'</script>";
			} else {
				echo "<script> alert('Gagal di pesan, Mohon ulangi');
				window.location='?act=pinjamBarang'</script>";
			}	
		} else {
			echo "<script> alert('Persediaan barang tidak cukup');
					window.location='?act=pinjamBarang'</script>";
		}
	} else {
		echo "<script> alert('Persediaan barang sudah habis');
				window.location='?act=pinjamBarang'</script>";
	}	
}	
?>
</body>
</html>
