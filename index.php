<?php 
include 'config/database.php'; // Pastikan path-nya benar
include 'components/header.php';

// Ambil data produk terbaru/best seller (Limit 3 sesuai grid kamu)
$query = "SELECT * FROM products ORDER BY id DESC LIMIT 3";
$result = mysqli_query($conn, $query);
?>

<section class="h-screen flex items-center justify-center bg-white relative overflow-hidden">
    <div class="text-center z-10">
        <h1 id="hero-title" class="text-8xl font-bold tracking-tighter mb-4 opacity-0">
            Crafted <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-400 to-gray-900">for You.</span>
        </h1>
        <p id="hero-sub" class="text-gray-500 text-lg mb-8 opacity-0">
            Lorem, ipsum dolor sit amet consectetur adipisicing.
        </p>
        <a href="#product" id="hero-btn" class="mt-5 px-10 py-4 bg-black text-white rounded-md hover:brightness-85 transition duration-500 opacity-0  inline-block">
            Explore Collection
        </a>
    </div>
    
    <div class="absolute inset-0 opacity-[30%] bg-grain pointer-events-none"></div>
    <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-gray-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
    <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-yellow-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
</section>

<section class="py-24 px-8" id="product">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-16">
            <h2 class="text-4xl font-semibold tracking-tight">Collections</h2>
            <a href="products.php" class="text-sm underline underline-offset-8 hover:brightness-75 transition">View All</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-card group cursor-pointer">
                <a href="product_detail.php?id=<?= $row['id']; ?>">
                    <div class="aspect-[3/4] bg-gray-50 mb-6 overflow-hidden relative rounded-md border border-gray-100">
                        <?php if($row['image']): ?>
                            <img src="assets/img/products/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" class="w-full h-full object-cover group-hover:brigtness-110 transition duration-700">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-300 italic">No Image</div>
                        <?php endif; ?>
                        
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors"></div>
                    </div>
                    
                    <div class="space-y-1">
                        <h3 class="text-lg font-medium tracking-tight"><?= $row['name']; ?></h3>
                        <p class="text-gray-400 font-light italic text-sm"><?= $row['category'] ?? 'Curated Object'; ?></p>
                        <p class="text-black font-bold pt-2">Rp <?= number_format($row['price'], 0, ',', '.'); ?></p>
                    </div>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php include 'components/footer.php' ?>