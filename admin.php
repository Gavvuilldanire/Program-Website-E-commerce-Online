<?php
// Baca data dari database JSON
$dataFile = 'produk.json';
$products = [];
if (file_exists($dataFile)) {
    $products = json_decode(file_get_contents($dataFile), true);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu - Gantarugavr Tech Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav>
            <a href="laptopku.php#home">Beranda</a>
            <a href="laptopku.php#harga">Harga Laptop</a>
            <a href="tambah.html" class="nav-jual">Tambah Laptop Baru</a>
        </nav>
    </header>

    <main>
        <section class="admin-container">
            <h2>Admin Menu - Daftar Produk</h2>
            
            <?php if (isset($_GET['status'])): ?>
                <div class="status-message">
                    <?php if ($_GET['status'] == 'sukses_tambah'): ?>
                        Produk berhasil ditambahkan!
                    <?php elseif ($_GET['status'] == 'sukses_hapus'): ?>
                        Produk berhasil dihapus!
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Laptop</th>
                        <th>Harga</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak ada produk.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><img src="<?php echo htmlspecialchars($product['gambar']); ?>" alt="thumbnail" class="admin-thumb"></td>
                                <td><?php echo htmlspecialchars($product['nama_laptop']); ?></td>
                                <td>Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="hapus.php?id=<?php echo $product['id']; ?>" 
                                       class="btn-hapus" 
                                       onclick="return confirm('Anda yakin ingin menghapus produk ini?');">
                                       Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>© 2025 Gantarugavr Tech Shop. Semua hak dilindungi.</p>
    </footer>

</body>
</html>