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

        <div class="hidden md:flex items-center space-x-8 text-[15px] tracking-widest font-medium">
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

<?php if (isset($_GET['status']) && $_GET['status'] == 'added'): ?>
    <div id="toast-success" class="fixed top-10 right-10 z-[100] bg-black text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-4 border border-white/10 animate-[slideInRight_0.5s_cubic-bezier(0.16,1,0.3,1)]">
        <div class="flex items-center justify-center w-6 h-6 bg-white/10 rounded-full">
            <i class="bi bi-check2 text-white text-sm"></i>
        </div>
        <div class="flex flex-col">
            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Success</span>
            <span class="text-[10px] text-gray-400 uppercase tracking-widest">Added to collection</span>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-success');
            if(toast) {
                toast.style.animation = 'none'; 
                toast.style.transition = 'all 0.6s cubic-bezier(0.16,1,0.3,1)';
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(40px) scale(0.95)';
                toast.style.filter = 'blur(10px)';
                setTimeout(() => toast.remove(), 600);
            }
        }, 2500);
    </script>
<?php endif; ?>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const body = document.body;

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('translate-x-0');
        mobileMenu.classList.toggle('translate-x-full');
        menuIcon.classList.toggle('bi-list');
        menuIcon.classList.toggle('bi-x-lg');
        body.classList.toggle('overflow-hidden');
    });

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
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; filter: blur(10px); }
        to { transform: translateX(0); opacity: 1; filter: blur(0); }
    }
    #mobile-menu a {
        position: relative;
        transition: transform 0.3s ease;
    }
    #mobile-menu a:hover {
        transform: translateX(10px);
    }
</style>