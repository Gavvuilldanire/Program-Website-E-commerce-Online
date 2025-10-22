<?php
// File "database"
$dataFile = 'produk.json';

// Cek jika request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- 1. Proses Upload Gambar ---
    $target_dir = "uploads/";
    // Buat nama file unik untuk menghindari tumpukan
    $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . time() . '.' . $imageFileType;
    $uploadOk = 1;

    // Cek apakah file adalah gambar asli
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        die("Error: File bukan gambar.");
    }
    
    // Batasi ukuran file (misal: 5MB)
    if ($_FILES["gambar"]["size"] > 5000000) {
        die("Error: Ukuran file terlalu besar (maks 5MB).");
    }

    // Hanya izinkan format tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        die("Error: Hanya format JPG, JPEG, & PNG yang diizinkan.");
    }

    // Coba upload file
    if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        die("Error: Gagal mengupload file gambar.");
    }

    // --- 2. Ambil Data Form ---
    $new_product = [
        "id" => time(), // ID unik berdasarkan timestamp
        "nama_laptop" => htmlspecialchars($_POST['nama_laptop']),
        "harga" => (int)filter_var($_POST['harga'], FILTER_SANITIZE_NUMBER_INT),
        "rating" => (float)filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
        "deskripsi" => htmlspecialchars($_POST['deskripsi']),
        "gambar" => $target_file // Path gambar yang sudah diupload
    ];

    // --- 3. Simpan ke JSON ---
    $products = [];
    if (file_exists($dataFile)) {
        $products = json_decode(file_get_contents($dataFile), true);
    }
    
    // Tambahkan produk baru ke array
    $products[] = $new_product;
    
    // Tulis kembali ke file JSON
    file_put_contents($dataFile, json_encode($products, JSON_PRETTY_PRINT));

    // Redirect ke halaman admin setelah sukses
    header("Location: admin.php?status=sukses_tambah");
    exit;

} else {
    // Jika diakses langsung
    header("Location: tambah.html");
    exit;
}
?>