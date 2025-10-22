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
    <title>Gantarugavr Tech Shop - E-Commerce Laptop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <a href="#home">Beranda</a>
            <a href="#harga">Harga Laptop</a>
            <a href="#profil">Profil Penjual</a>
            <a href="#alamat">Alamat Toko</a>
            <a href="tambah.html" class="nav-jual">Jual Laptop</a>
            <a href="admin.php" class="nav-admin">Admin Menu</a>
        </nav>
    </header>

    <main>
        <section id="home">
            <h1>E-Commerce Laptop Online</h1>
            <p style="text-align:center;">Selamat datang di toko laptop kami. Pilih laptop favorit Anda dan lihat
                harganya!</p>

            <div class="product-grid">

                <?php if (empty($products)): ?>
                <p style="text-align:center; grid-column: 1 / -1;">Belum ada produk untuk ditampilkan.</p>
                <?php else: ?>
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?php echo htmlspecialchars($product['gambar']); ?>"
                        alt="<?php echo htmlspecialchars($product['nama_laptop']); ?>">
                    <h3><?php echo htmlspecialchars($product['nama_laptop']); ?></h3>
                    <div class="rating">
                        ★★★★★ (<?php echo htmlspecialchars($product['rating']); ?>)
                    </div>
                    <p class="specs"><?php echo htmlspecialchars($product['deskripsi']); ?></p>
                    <p class="price">Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
                    <a href="#harga" class="detail-btn">Lihat Detail</a>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </section>

        <section id="harga">
            <h2>Daftar Harga Laptop</h2>
            <table>
                <tr>
                    <th>Jenis Laptop</th>
                    <th>Spesifikasi Singkat</th>
                    <th>Harga</th>
                </tr>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['nama_laptop']); ?></td>
                    <td><?php echo htmlspecialchars($product['deskripsi']); ?></td>
                    <td>Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <div style="text-align:center; margin-top: 20px;">
                <a href="#home" class="detail-btn">- Kembali ke Beranda -</a>
            </div>
        </section>

        <section id="profil">
            <h2>Profil Penjual</h2>
            <div class="profile">
                <img src="profil.jpg" alt="Logo Gantarugavr">
                <div class="profile-info">
                    <h3>Gantarugavr Tech Shop</h3>
                    <p>Berdiri sejak 2024, Gantarugavr Tech Shop adalah pusat teknologi dan laptop terdepan. Kami
                        menyediakan produk orisinal dengan performa teruji, mengutamakan kualitas, kecepatan, dan
                        kepuasan pelanggan.</p>
                    <p><b>Kontak:</b> 0812-3456-XXXX | <b>Email:</b> admin@gantarugavr.com</p>
                </div>
            </div>
        </section>

        <section id="alamat">
            <h2>Alamat Toko Kami</h2>
            <p style="text-align: center;">Jl. Merdeka No. 45, Medan, Sumatera Utara</p>
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15928.71805722488!2d98.67201942691653!3d3.595167683733075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303131d2a3449c49%3A0x1115a31c1e55f05!2sMedan%2C%20Kota%20Medan%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1678888888888!5m2!1sid!2sid"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2025 Gantarugavr Tech Shop. Semua hak dilindungi.</p>
    </footer>

</body>

</html>