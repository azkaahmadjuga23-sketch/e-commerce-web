<?php
include 'config/database.php';
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $new_qty = (int)$_POST['quantity'];
    if($new_qty > 0) {
        mysqli_query($conn, "UPDATE cart SET quantity = '$new_qty' WHERE id = '$cart_id'");
    }
}

$result = mysqli_query($conn, "SELECT cart.*, products.name, products.price, products.image, products.description
                               FROM cart 
                               JOIN products ON cart.product_id = products.id 
                               WHERE cart.user_id = '$user_id'");

include 'components/header.php';
?>

<section class="min-h-screen bg-white pt-40 pb-32 px-8">
    <div class="max-w-4xl mx-auto"> <div class="mb-20 text-center md:text-left">
            <h1 class="text-6xl md:text-7xl font-black tracking-tighter leading-none">
                Your Cart
            </h1>
        </div>

        <?php if(mysqli_num_rows($result) > 0): ?>
            <div class="space-y-12"> <?php 
                $total_price = 0;
                while($item = mysqli_fetch_assoc($result)): 
                    $subtotal = $item['price'] * $item['quantity'];
                    $total_price += $subtotal;
                ?>
                <div class="flex flex-col md:flex-row gap-8 pb-12 border-b border-gray-100 group">
                    <div class="w-full md:w-40 aspect-[3/4] bg-gray-50 rounded-md overflow-hidden flex-shrink-0">
                        <img src="assets/img/products/<?= $item['image']; ?>" class="w-full h-full object-cover grayscale-[0.3] group-hover:grayscale-0 transition-all duration-700">
                    </div>

                    <div class="flex-1 flex flex-col justify-between py-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-2xl font-bold tracking-tight"><?= $item['name']; ?></h3>
                                <p class="text-[13px] text-gray-400 tracking-widest mt-3"><?= $item['description']; ?></p>
                            </div>
                            <p class="text-xl font-bold tracking-tighter">Rp <?= number_format($item['price'], 0, ',', '.'); ?></p>
                        </div>

                        <div class="flex justify-between items-end mt-12">
                            <form method="POST" class="flex items-center gap-6">
                                <input type="hidden" name="cart_id" value="<?= $item['id']; ?>">
                                <div class="flex items-center border border-gray-200 rounded-full px-6 py-3 gap-4">
                                    <span class="text-[10px] uppercase font-bold text-gray-300 tracking-widest">Qty</span>
                                    <input type="number" name="quantity" value="<?= $item['quantity']; ?>" min="1" 
                                           class="w-10 text-sm font-bold bg-transparent focus:outline-none text-center">
                                </div>
                                <button type="submit" name="update_qty" class="text-[10px] uppercase tracking-[0.3em] font-black hover:gray-500 transition cursor-pointer">Update</button>
                            </form>
                            <div class="text-right">
                                <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-1">Subtotal</p>
                                <p class="text-lg font-bold tracking-tighter">Rp <?= number_format($subtotal, 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>

                <div class="pt-12 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div>
                        <p class="text-[10px] uppercase tracking-[0.5em] text-gray-400 mb-2">Grand Total Payment</p>
                        <p class="text-5xl font-black tracking-tighter italic">Rp <?= number_format($total_price, 0, ',', '.'); ?></p>
                    </div>
                    
                    <div class="flex flex-col items-center gap-4">
                        <a href="products.php" class="text-[10px] uppercase tracking-widest text-gray-400 hover:text-black transition underline underline-offset-8">
                            Continue Browsing
                        </a>
                    </div>
                </div>

            </div>
        <?php else: ?>
            <div class="py-32 text-center border-2 border-dashed border-gray-100 rounded-[60px]">
                <p class="text-gray-400 italic mb-8 uppercase tracking-widest text-xs">Your collection is empty.</p>
                <a href="products.php" class="inline-block bg-black text-white px-12 py-5 rounded-full text-[10px] font-bold uppercase tracking-[0.3em]">
                    Back to Collection
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php include 'components/footer.php'; ?>