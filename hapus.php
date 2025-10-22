<?php
// File "database"
$dataFile = 'produk.json';

// Cek apakah ID ada di URL
if (!isset($_GET['id'])) {
    die("Error: ID produk tidak ditemukan.");
}

$id_to_delete = $_GET['id'];
$products = [];

if (file_exists($dataFile)) {
    $products = json_decode(file_get_contents($dataFile), true);
}

// Buat array baru untuk data yang tidak dihapus
$updated_products = [];
$file_to_delete = null;

foreach ($products as $product) {
    if ($product['id'] == $id_to_delete) {
        // Tandai file gambar untuk dihapus
        $file_to_delete = $product['gambar'];
    } else {
        // Simpan produk yang tidak dihapus
        $updated_products[] = $product;
    }
}

// Hapus file gambar dari server jika ada
if ($file_to_delete && file_exists($file_to_delete)) {
    // Cek agar tidak menghapus gambar default (jika Anda menggunakannya)
    if (!strstr($file_to_delete, '_default.png')) {
        unlink($file_to_delete);
    }
}

// Tulis kembali data yang sudah update ke JSON
file_put_contents($dataFile, json_encode($updated_products, JSON_PRETTY_PRINT));

// Redirect kembali ke halaman admin
header("Location: admin.php?status=sukses_hapus");
exit;
?>