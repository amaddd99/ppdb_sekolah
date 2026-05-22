<?php
session_start();
$conn = mysqli_connect("localhost","root","","dbsiswa");

$message = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // cek admin
    $admin = mysqli_query($conn, "SELECT * FROM tbadmin WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($admin) > 0) {
        $_SESSION['role'] = "admin";
        $_SESSION['username'] = $username;
        header("Location: dashboard_admin.php");
        exit;
    }

    // cek siswa
    $siswa = mysqli_query($conn, "SELECT * FROM tbsiswa WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($siswa) > 0) {
        $_SESSION['role'] = "siswa";
        $_SESSION['username'] = $username;
        header("Location: dashboard_siswa.php");
        exit;
    }

    $message = "Username atau Password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Siswa & Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#06b6d4);
    overflow:hidden;
}

.login-container{
    width:380px;
    padding:40px;
    border-radius:25px;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.2);
    backdrop-filter:blur(15px);
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
    color:white;
}

h2{
    text-align:center;
    font-size:30px;
    margin-bottom:10px;
}

p{
    text-align:center;
    margin-bottom:25px;
    color:#d1d5db;
}

.input-box{
    margin-bottom:20px;
}

.input-box input{
    width:100%;
    padding:15px;
    border:none;
    border-radius:14px;
    outline:none;
    background:rgba(255,255,255,0.12);
    color:white;
    font-size:15px;
}

.input-box input::placeholder{
    color:#d1d5db;
}

.input-box input:focus{
    border:1px solid #38bdf8;
    box-shadow:0 0 10px rgba(56,189,248,0.5);
}

.login-btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:14px;
    background:linear-gradient(135deg,#06b6d4,#3b82f6);
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
}

.login-btn:hover{
    transform:translateY(-2px);
}

.message{
    text-align:center;
    margin-bottom:15px;
    color:yellow;
    font-weight:500;
}
</style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <p>Masuk sebagai Admin atau Siswa</p>

    <?php if($message != ""): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-box">
            <input type="text" name="username" placeholder="Masukkan Username" required>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Masukkan Password" required>
        </div>

        <button type="submit" name="login" class="login-btn">
            Masuk
        </button>
    </form>
</div>

</body>
</html>