<?php
include '../config/database.php';
session_start();

$error = "";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Cek apakah username sudah ada
    $check_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    
    if (mysqli_num_rows($check_user) > 0) {
        $error = "Username already exists.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: login.php?msg=registration_success");
            exit;
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — SakuMarket</title>
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

    <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-50 rounded-full blur-[120px] opacity-50"></div>
    <div class="absolute bottom-[-10%] left-[-10%] w-[30%] h-[30%] bg-gray-100 rounded-full blur-[100px] opacity-50"></div>

    <div class="w-full max-w-[450px] relative z-10">
        
        <div class="mb-12 text-center">
            <a href="../index.php" class="flex items-center justify-center mb-5 font-medium hover:opacity-50 transition">
                <i class="bi bi-flower3 font-semibold text-[30px]"></i>
                <span class="font-bold text-lg ml-2">SakuMarket</span>
            </a>
            <h1 class="text-5xl font-black tracking-tighter leading-none">Join the <br><span class="italic text-transparent bg-clip-text bg-gradient-to-r from-gray-400 to-gray-900">Club.</span></h1>
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
                    <label class="text-[10px] uppercase font-black tracking-[0.3em] text-gray-400 ml-4">New Username</label>
                    <input type="text" name="username" required
                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-full focus:bg-white focus:border-indigo-500 focus:outline-none transition-all duration-300 font-medium" 
                        placeholder="Choose your username">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] uppercase font-black tracking-[0.3em] text-gray-400 ml-4">Secret Password</label>
                    <input type="password" name="password" required
                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-full focus:bg-white focus:border-indigo-500 focus:outline-none transition-all duration-300 font-medium" 
                        placeholder="••••••••">
                </div>

                <div class="pt-4">
                    <button type="submit" name="register" 
                        class="w-full bg-black text-white py-6 rounded-full font-black uppercase tracking-[0.2em] text-[13px] hover:shadow-xl hover:opacity-75 transition-all duration-500">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-xs text-gray-400 font-medium">Already a member? 
                    <a href="login.php" class="text-black font-black uppercase tracking-widest ml-1 hover:opacity-75 transition">Sign In</a>
                </p>
            </div>
        </div>

        <p class="mt-12 text-center text-[9px] uppercase tracking-[0.5em] text-gray-300 font-bold italic">
            &copy; 2026 SakuMarket Curated Studio
        </p>
    </div>

</body>
</html>