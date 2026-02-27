<?php
include '../config/database.php';
session_start();

$error = "";
if (isset($_GET['msg']) && $_GET['msg'] == 'login_to_purchase') {
    $error = "Authentication required to continue shopping.";
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SakuMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,800;1,200;1,800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-grain { background-image: url("https://grainy-gradients.vercel.app/noise.svg"); }
    </style>
</head>
<body class="bg-[#ffffff] min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none bg-grain"></div>

    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-50 rounded-full blur-[120px] opacity-50"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-gray-100 rounded-full blur-[100px] opacity-50"></div>

    <div class="w-full max-w-[450px] relative z-10">
        
        <div class="mb-12 text-center">
            <a href="../index.php" class="flex items-center justify-center mb-5 font-medium">
                <i class="bi bi-flower3 font-semibold text-[30px] transition-transform duration-700 group-hover:rotate-90"></i>
                <span class="font-bold text-lg ml-2">SakuMarket</span>
            </a>
            <h1 class="text-5xl font-black tracking-tighter leading-none">Welcome <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-400 to-gray-900 italic">Back.</span></h1>
        </div>

        <div class="bg-white/40 backdrop-blur-xl border border-gray-100 p-10 rounded-[40px] shadow-2xl shadow-gray-200/50">
            
            <?php if ($error): ?>
                <div class="mb-6 p-4 bg-black text-white rounded-2xl flex items-center gap-3 animate-pulse">
                    <i class="bi bi-exclamation-circle text-xs"></i>
                    <p class="text-[10px] uppercase font-bold tracking-widest"><?= $error; ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] uppercase font-black tracking-[0.3em] text-gray-400 ml-4">Username</label>
                    <input type="text" name="username" required
                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-full focus:bg-white focus:border-indigo-500 focus:outline-none transition-all duration-300 font-medium" 
                        placeholder="Enter your username">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] uppercase font-black tracking-[0.3em] text-gray-400 ml-4">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-full focus:bg-white focus:border-indigo-500 focus:outline-none transition-all duration-300 font-medium" 
                        placeholder="••••••••">
                </div>

                <div class="pt-4">
                    <button type="submit" name="login" 
                        class="w-full bg-black text-white py-6 rounded-full font-black uppercase tracking-[0.2em] text-[13px] hover:shadow-xl hover:opacity-75 transition-all duration-500">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-xs text-gray-400 font-medium">Don't have an account? 
                    <a href="register.php" class="text-black font-black uppercase tracking-widest ml-1 hover:opacity-75 transition">Register</a>
                </p>
            </div>
        </div>

        <p class="mt-12 text-center text-[9px] uppercase tracking-[0.5em] text-gray-300 font-bold italic">
            &copy; 2026 SakuMarket Curated Studio
        </p>
    </div>

</body>
</html>