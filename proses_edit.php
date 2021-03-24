<?php
	include('koneksi.php');

	$id = $_POST['id'];
	$nama_produk = $_POST['nama_produk'];
	$deskripsi = $_POST['deskripsi'];
	$harga_beli  = $_POST['harga_beli'];
	$harga_jual  = $_POST['harga_jual'];
	$gambar_produk = $_FILES['gambar_produk']['name'];

	if ($gambar_produk !="") {
		 $ekstensi_diperbolehkan = array('png', 'jpg');
		 $x = explode('.', $gambar_produk);
		 $ekstensi = strtolower(end($x));
		 $file_tmp = $_FILES['gambar_produk']['tmp_name'];
		 $angka_acak = rand(1, 999);
		 $nama_gambar_baru = $angka_acak. '-'.$gambar_produk;

		 if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		 	move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru);

		 	$query = "UPDATE produk SET nama_produk = '$nama_produk',deskripsi = '$deskripsi',harga_beli = '$harga_beli',harga_jual = '$harga_jual',gambar_produk = '$nama_gambar_baru'";
		 	$query .= "WHERE id = '$id'";
		 	$result = mysqli_query($koneksi, $query);

		 	if (!$result) {
					die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
				} else {
					echo "<script>alert('Data berhasil ditambahkan!');window.location='index.php';</script>";
				}

		 } else {
		 	echo "<script>alert('Ekstensi gambar hanya bisa jpg dan png!');window.location='edit_produk.php'</script>";
		 }
	} else {
		 $query = "UPDATE produk SET nama_produk = '$nama_produk',deskripsi = '$deskripsi',harga_beli = '$harga_beli',harga_jual = '$harga_jual'";
		 	$query .= "WHERE id = '$id'";
		 	$result = mysqli_query($koneksi, $query);

		 	if (!$result) {
					die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
				} else {
					echo "<script>alert('Data berhasil ditambahkan!');window.location='index.php';</script>";
				}
	}

?>