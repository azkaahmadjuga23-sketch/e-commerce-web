<?php
include 'config/database.php';
session_start();

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) { header("Location: index.php"); exit; }

include 'components/header.php';
?>

<section class="min-h-screen pt-32 pb-20 px-10 md:px-20 relative overflow-hidden">
    
    <div class="absolute inset-0 opacity-[0.02] pointer-events-none bg-grain"></div>

    <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24">
        
        <div class="relative group">
            <div class="aspect-[4/5] bg-[#f9f9f9] rounded-md overflow-hidden border border-gray-100 relative shadow-sm">
                <?php if($product['image']): ?>
                    <img src="assets/img/products/<?= $product['image']; ?>" 
                         alt="<?= $product['name']; ?>" 
                         class="w-full h-full object-cover transition-transform duration-1000">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center text-gray-300 italic tracking-widest text-xs">No Image Available</div>
                <?php endif; ?>
            </div>
            
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-indigo-50/50 rounded-md blur-3xl pointer-events-none"></div>
        </div>

        <div class="flex flex-col justify-center">
            

            <div class="mb-12">
                <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-black leading-[0.9] mb-6">
                    <?= $product['name']; ?>
                </h1>
                <p class="text-4xl font-light text-gray-400 tracking-tight italic">
                    Rp <?= number_format($product['price'], 0, ',', '.'); ?>
                </p>
            </div>

            <div class="max-w-md mb-16">
                <h3 class="text-[10px] uppercase font-bold tracking-widest text-black mb-4">Description</h3>
                <p class="text-gray-500 leading-relaxed font-light text-lg">
                    <?= $product['description'] ?? 'No description provided for this curated piece. Experience the purity of form and function in every detail.'; ?>
                </p>
            </div>

            <div class="flex flex-col gap-6">
                <?php if (isset($_SESSION['login'])): ?>
                    <a href="cart_process.php?id=<?= $product['id']; ?>" 
                       class="group relative w-full md:w-fit bg-black text-white px-16 py-6 rounded-md overflow-hidden transition-all duration-500 hover:shadow-[0_20px_40px_rgba(0,0,0,0.1)] active:scale-95 text-center tracking-wide">
                        <span class="relative z-10 text-[15px] font-bold">Add to Cart</span>
                        <div class="absolute inset-0 bg-black brightness-75 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </a>
                <?php else: ?>
                    <div class="space-y-4">
                        <a href="auth/login.php?msg=login_to_purchase" 
                           class="inline-block w-full md:w-fit border border-black text-black px-16 py-6 rounded-md text-[11px] font-bold tracking-wide hover:bg-black hover:text-white transition-all duration-500 text-center">
                           Login to Purchase
                        </a>
                        <p class="text-[9px] text-gray-400 tracking-wider italic ml-2">Authentication required for checkout.</p>
                    </div>
                <?php endif; ?>

                <a href="index.php" class="text-[12px] tracking-wide text-gray-400 hover:text-black transition-colors flex items-center gap-4 group">
                    <div class="h-[1px] w-6 bg-gray-300 group-hover:w-10 transition-all"></div>
                    Back to Homepage
                </a>
            </div>
        </div>

    </div>
</section>

<?php include 'components/footer.php'; ?>