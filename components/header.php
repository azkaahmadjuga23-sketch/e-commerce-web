<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SakuMarket | Curated Goods Indonesia</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body class="overflow-x-hidden">

<div class="page-overlay"></div>

<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
?>

<nav class="fixed top-0 left-0 w-full z-50 px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center bg-white/70 backdrop-blur-md px-6 py-2 rounded-2xl border border-white/20 shadow-sm">
        
        <a href="index.php" class="group flex items-center text-2xl font-medium tracking-tighter text-black relative z-[60]">
            <i class="bi bi-flower3 font-semibold text-[30px] transition-transform duration-700 group-hover:rotate-90"></i>
            <span class="ml-2">SakuMarket</span>
        </a>

        <div class="hidden md:flex items-center space-x-8 text-[14px] tracking-widest font-medium uppercase">
            <a href="index.php" class="hover:opacity-50 transition">Home</a>
            <a href="products.php" class="hover:opacity-50 transition">Collections</a>
            
            <?php if(isset($_SESSION['login'])): ?>
                <a href="cart.php" class="hover:opacity-50 transition">Cart</a>
                <a href="auth/logout.php" class="text-red-500 hover:opacity-50 transition">Logout</a>
            <?php else: ?>
                <a href="auth/login.php" class="border-[1.5px] border-black rounded-md px-6 py-2 hover:bg-black hover:text-white transition-all duration-300">Login</a>
            <?php endif; ?>
        </div>

        <button id="menu-btn" class="md:hidden relative z-[60] p-2 text-2xl focus:outline-none">
            <i class="bi bi-list" id="menu-icon"></i>
        </button>
    </div>
</nav>

<div id="mobile-menu" class="fixed inset-0 bg-white z-[55] flex flex-col items-center justify-center space-y-8 translate-x-full transition-transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]">
    <a href="index.php" class="text-4xl font-black uppercase tracking-tighter hover:italic transition-all">Home</a>
    <a href="products.php" class="text-4xl font-black uppercase tracking-tighter hover:italic transition-all">Collections</a>
    
    <?php if(isset($_SESSION['login'])): ?>
        <a href="cart.php" class="text-4xl font-black uppercase tracking-tighter hover:italic transition-all">Cart</a>
        <a href="auth/logout.php" class="text-4xl font-black uppercase tracking-tighter text-red-500 italic">Logout</a>
    <?php else: ?>
        <a href="auth/login.php" class="text-4xl font-black uppercase tracking-tighter hover:italic transition-all">Login</a>
    <?php endif; ?>

    <p class="absolute bottom-12 text-[10px] uppercase tracking-[0.5em] text-gray-300 font-bold italic">
        SakuMarket Curated Studio &copy; 2026
    </p>
</div>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const body = document.body;

    menuBtn.addEventListener('click', () => {
        // Toggle Menu Position
        mobileMenu.classList.toggle('translate-x-0');
        mobileMenu.classList.toggle('translate-x-full');

        // Toggle Icon
        menuIcon.classList.toggle('bi-list');
        menuIcon.classList.toggle('bi-x-lg');

        // Prevent Scroll when menu open
        body.classList.toggle('overflow-hidden');
    });

    // Close menu when clicking links
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('translate-x-full');
            menuIcon.classList.add('bi-list');
            menuIcon.classList.remove('bi-x-lg');
            body.classList.remove('overflow-hidden');
        });
    });
</script>

<style>
    /* Tambahan style untuk efek teks di mobile menu */
    #mobile-menu a {
        position: relative;
        transition: transform 0.3s ease;
    }
    #mobile-menu a:hover {
        transform: translateX(10px);
    }
</style>