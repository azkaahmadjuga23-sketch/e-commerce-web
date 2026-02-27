<?php
include 'config/database.php';
session_start();

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");

include 'components/header.php';
?>

<section class="min-h-screen bg-white pt-32 pb-24 px-8 relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.02] pointer-events-none bg-grain"></div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-20 gap-8">
            <div class="space-y-4">
                <h1 class="text-6xl md:text-7xl font-black tracking-tighter leading-none">All Collections.</h1>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-20">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-card group">
                <div class="aspect-[3/4] bg-gray-50 mb-8 overflow-hidden relative rounded-md border border-gray-100 shadow-sm">
                    <?php if($row['image']): ?>
                        <img src="assets/img/products/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" class="w-full h-full object-cover transition-transform duration-1000">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-gray-300 italic text-xs tracking-widest uppercase">No Image</div>
                    <?php endif; ?>

                    <div class="absolute bottom-6 right-6 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <?php if (isset($_SESSION['login'])): ?>
                            <a href="cart_process.php?id=<?= $row['id']; ?>" class="bg-black text-white p-4 rounded-full flex items-center justify-center shadow-xl hover:brightness-75 transition-colors">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        <?php else: ?>
                            <a href="auth/login.php?msg=login_to_purchase" class="bg-white/90 backdrop-blur-md text-black p-4 rounded-full flex items-center justify-center shadow-xl hover:bg-black hover:text-white transition-colors">
                                <i class="bi bi-lock-fill"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="space-y-3 px-2">
                    <div class="flex justify-between items-start">
                        <div class="space-y-1">
                            <h3 class="text-[22.5px] font-bold tracking-tight leading-tight"><?= $row['name']; ?></h3>
                        </div>
                        <p class="text-lg font-light tracking-tighter">Rp <?= number_format($row['price'], 0, ',', '.'); ?></p>
                    </div>

                    <div class="pt-4 flex items-center gap-6">
                        <a href="product_detail.php?id=<?= $row['id']; ?>" class="text-[13px] font-semibold tracking-wider text-black border-b border-black/10 hover:border-black transition-all pb-1">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>