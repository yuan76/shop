<?php
include '../koneksi.php'; 
include 'lib/lib.php'; 

$isRequest=false;

if (isset($_POST['mode'])) {
	$isRequest=true;
	$returns = [];
	$returns['getparam']=false;
	
	switch ($_POST['mode']) {
		case 'combotoko':
			if (isset($_POST['kode'])) {
				$returns['getparam']=true;
				$sql= ' select DISTINCT(b.toko) as id,t.nama as nama
						from toko as t join barang as b on t.idToko=b.toko
						WHERE b.kode = "'.$_POST['kode'].'" order by t.nama asc';
				$exe   = mysqli_query($con,$sql);

				if (!$exe) { // failed query 
					$returns['queried'] = false;
				}else{ // success query 
					$returns['queried'] = true;
					$returns['total']   = mysqli_num_rows($exe);
				
					// pr($res);
					while ($res=mysqli_fetch_assoc($exe)){
						$returns['data'][]=array(
							'id'     =>$res['id'],
							'nama' =>$res['nama'],
						);
					}
				}
			}
		break;
		
	}

}

echo json_encode([
	'request' =>$isRequest,
	'returns' =>$returns
]);

?>