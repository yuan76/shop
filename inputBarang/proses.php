<html>
<head>
	<title> Berhasil </title>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
include '../koneksi.php';

$jenis = $_POST['jenis'];
$merk = $_POST['merk'];
$ukuran = $_POST['ukuran'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$toko = $_POST['toko'];

$jenis = preg_replace('/[^A-Za-z0-9\  ]/', '', $jenis);
$merk = preg_replace('/[^A-Za-z0-9\  ]/', '', $merk);

function createKode($length){
	$data = '1234567890';
	$string = '';
	for($i = 0; $i < $length; $i++) {
		$pos = rand(0, strlen($data)-1);
		$string .= $data{$pos};
	}
	return $string;
}
$kodeBaru="899".createKode(10);

$cekKode = mysqli_query($con, "select * from stok where kode='$kodeBaru'");
$ceKo=mysqli_num_rows($cekKode);
if ($ceKo <= 0) {
	$cekBarang = mysqli_query($con, "select * from stok where (merk='$merk' and ukuran='$ukuran') and (toko='$toko' and jenisBarang='$jenis')");
	$cekBar = mysqli_query($con, "select * from stok where (merk='$merk' and jenisBarang='$jenis') and ukuran='$ukuran'");
	
	$tambah=mysqli_num_rows($cekBarang);
	$tambahBar=mysqli_num_rows($cekBar);
	
	$ukuran=strtoupper($ukuran);
	$toko=strtoupper($toko);
/*
	if ($tambahBar > 0) {
		while ($ambilKode = mysqli_fetch_array($cekBar)){
			$kodeLama=$ambilKode['kode'];
			$hargaLama=$ambilKode['harga'];			
		}
	}	
	*/
	if ($tambah > 0) {
		while ($ambilJumlah = mysqli_fetch_assoc($cekBarang)){
			$jumlahLama=$ambilJumlah['jumlah'];
			$kodeLm=$ambilJumlah['kode'];
		}
		$jumlahBaru=$jumlahLama+$jumlah;
		$sql = "update $db.stok set stok.jumlah='$jumlahBaru' where (stok.merk='$merk' and stok.ukuran='$ukuran') and (stok.toko='$toko' and stok.jenisBarang='$jenis');";

		$sql = $sql."insert into $db.riwayat (riwayat.idRiwayat,riwayat.kode,riwayat.tglMasuk,riwayat.toko,riwayat.jumlahStok)
			values (NULL,'$kodeLm',NOW(),'$toko','$jumlah');";	
	} else {
		if ($tambahBar > 0) {
			while ($ambilKode = mysqli_fetch_array($cekBar)){
				$kodeLama=$ambilKode['kode'];
				$hargaLama=$ambilKode['harga'];
			}
			$sql = "insert into $db.stok (stok.idStok,stok.kode,stok.jenisBarang,stok.merk,stok.ukuran,stok.jumlah,stok.harga,stok.toko)
			values (NULL,'$kodeLama','$jenis','$merk','$ukuran','$jumlah','$hargaLama','$toko');";
			$sql = $sql."insert into $db.riwayat (riwayat.idRiwayat,riwayat.kode,riwayat.tglMasuk,riwayat.toko,riwayat.jumlahStok)
			values (NULL,'$kodeLama',NOW(),'$toko','$jumlah');";	
		} else {	
			$sql = "insert into $db.stok (stok.idStok,stok.kode,stok.jenisBarang,stok.merk,stok.ukuran,stok.jumlah,stok.harga,stok.toko)
				values (NULL,'$kodeBaru','$jenis','$merk','$ukuran','$jumlah','$harga','$toko');";
			$sql = $sql."insert into $db.riwayat (riwayat.idRiwayat,riwayat.kode,riwayat.tglMasuk,riwayat.toko,riwayat.jumlahStok)
			values (NULL,'$kodeBaru',NOW(),'$toko','$jumlah');";		
		}	
	}		
			
	$query=mysqli_multi_query($con,$sql);
			if($query){
				echo "<script> alert('Barang berhasil ditambahkan');
				window.location='?act=tambah'</script>";
			} else {
				echo "<script> alert('Barang gagal ditambahkan');
				window.location='?act=tambah'</script>";
			}
}
?>
</body>
</html>
