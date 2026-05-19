<?php

include "koneksi.php";

// REGISTER
if(isset($_POST['register'])){

  $nama       = mysqli_real_escape_string($conn, $_POST['nama']);
  $email      = mysqli_real_escape_string($conn, $_POST['email']);
  $password   = mysqli_real_escape_string($conn, $_POST['password']);
  $konfirmasi = mysqli_real_escape_string($conn, $_POST['konfirmasi']);

  // VALIDASI PASSWORD
  if($password != $konfirmasi){

    echo "
    <script>
      alert('Konfirmasi password tidak sama!');
    </script>
    ";

  } else {

    // CEK EMAIL SUDAH ADA ATAU BELUM
    $cekEmail = mysqli_query($conn,
    "SELECT * FROM tb_users WHERE email='$email'");

    if(mysqli_num_rows($cekEmail) > 0){

      echo "
      <script>
        alert('Email sudah digunakan!');
      </script>
      ";

    } else {

      // ENKRIPSI PASSWORD
      $passwordHash =
      password_hash($password, PASSWORD_DEFAULT);

      // INSERT DATABASE
      $query = "INSERT INTO tb_users
      (nama,email,password)

      VALUES

      ('$nama','$email','$passwordHash')";

      $insert = mysqli_query($conn,$query);

      if($insert){

        echo "
        <script>
          window.onload = function(){

            const popup =
            document.getElementById('popup');

            popup.classList.add('show');

            setTimeout(() => {
              popup.classList.remove('show');
            },3000);

          }
        </script>
        ";

      } else {

        echo "
        <script>
          alert('Pendaftaran gagal!');
        </script>
        ";

      }

    }

  }

}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport"
  content="width=device-width, initial-scale=1.0"/>

  <title>PPDB Negeri 2026</title>

  <!-- Bootstrap -->
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  rel="stylesheet">

  <!-- Font Awesome -->
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

  <!-- Font -->
  <link
  href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
  rel="stylesheet">

  <style>

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:'Poppins',sans-serif;
    }

    body{
      min-height:100vh;
      background:
      linear-gradient(135deg,#e0f2fe,#f8fbff,#ffffff);
      display:flex;
      justify-content:center;
      align-items:center;
      overflow-x:hidden;
      padding:40px 15px;
      position:relative;
    }

    .circle{
      position:absolute;
      border-radius:50%;
      filter:blur(80px);
      z-index:0;
    }

    .circle1{
      width:300px;
      height:300px;
      background:#60a5fa;
      top:-100px;
      left:-100px;
      opacity:.25;
    }

    .circle2{
      width:350px;
      height:350px;
      background:#2563eb;
      bottom:-120px;
      right:-120px;
      opacity:.18;
    }

    .particles span{
      position:absolute;
      width:12px;
      height:12px;
      background:rgba(37,99,235,.15);
      border-radius:50%;
      animation:float 15s linear infinite;
    }

    .particles span:nth-child(1){left:10%;animation-duration:14s;}
    .particles span:nth-child(2){left:25%;animation-duration:20s;}
    .particles span:nth-child(3){left:45%;animation-duration:16s;}
    .particles span:nth-child(4){left:70%;animation-duration:24s;}
    .particles span:nth-child(5){left:85%;animation-duration:18s;}

    @keyframes float{
      0%{
        transform:translateY(100vh) scale(0);
        opacity:0;
      }

      50%{
        opacity:1;
      }

      100%{
        transform:translateY(-100px) scale(1.5);
        opacity:0;
      }
    }

    .register-card{
      width:100%;
      max-width:470px;
      background:rgba(255,255,255,.85);
      backdrop-filter:blur(20px);
      border:1px solid rgba(37,99,235,.12);
      border-radius:35px;
      padding:35px;
      box-shadow:
      0 10px 40px rgba(37,99,235,.12);
      position:relative;
      z-index:2;
      overflow:hidden;
      animation:fadeUp 1s ease;
    }

    @keyframes fadeUp{
      from{
        opacity:0;
        transform:translateY(30px);
      }

      to{
        opacity:1;
        transform:translateY(0);
      }
    }

    .top-line{
      position:absolute;
      top:0;
      left:0;
      width:100%;
      height:7px;
      background:
      linear-gradient(90deg,#60a5fa,#2563eb,#93c5fd);
    }

    .logo{
      width:95px;
      height:95px;
      border-radius:28px;
      background:
      linear-gradient(135deg,#60a5fa,#2563eb);
      margin:auto;
      display:flex;
      justify-content:center;
      align-items:center;
      color:white;
      font-size:38px;
      box-shadow:
      0 10px 25px rgba(37,99,235,.25);
      animation:pulse 2s infinite;
    }

    @keyframes pulse{
      50%{
        transform:scale(1.05);
      }
    }

    h1{
      text-align:center;
      margin-top:20px;
      font-size:33px;
      font-weight:700;
      color:#1e3a8a;
    }

    .subtitle{
      text-align:center;
      color:#64748b;
      font-size:14px;
      margin-bottom:25px;
    }

    .status-box{
      background:#eff6ff;
      border:1px solid #bfdbfe;
      color:#1d4ed8;
      padding:13px;
      border-radius:16px;
      text-align:center;
      font-size:14px;
      margin-bottom:25px;
      font-weight:500;
    }

    .form-label{
      font-weight:600;
      color:#1e3a8a;
      margin-bottom:8px;
    }

    .input-box{
      position:relative;
      margin-bottom:20px;
    }

    .input-box input{
      width:100%;
      padding:15px 50px 15px 15px;
      border-radius:17px;
      border:1px solid #cbd5e1;
      background:white;
      color:#1e293b;
      outline:none;
      transition:.3s;
      font-size:14px;
    }

    .input-box input:focus{
      border-color:#2563eb;
      box-shadow:
      0 0 0 4px rgba(37,99,235,.12);
      transform:scale(1.01);
    }

    .input-box input::placeholder{
      color:#94a3b8;
    }

    .input-box i{
      position:absolute;
      top:17px;
      right:18px;
      color:#2563eb;
      cursor:pointer;
    }

    .strength{
      width:100%;
      height:8px;
      background:#dbeafe;
      border-radius:30px;
      overflow:hidden;
      margin-top:-8px;
      margin-bottom:10px;
    }

    .strength-bar{
      width:85%;
      height:100%;
      background:
      linear-gradient(90deg,#60a5fa,#2563eb);
      animation:glow 2s infinite alternate;
    }

    @keyframes glow{
      from{
        filter:brightness(1);
      }

      to{
        filter:brightness(1.3);
      }
    }

    .strength-text{
      font-size:13px;
      color:#2563eb;
      margin-bottom:18px;
      font-weight:500;
    }

    .btn-register{
      width:100%;
      padding:15px;
      border:none;
      border-radius:18px;
      background:
      linear-gradient(135deg,#60a5fa,#2563eb);
      color:white;
      font-weight:600;
      font-size:15px;
      transition:.3s;
      position:relative;
      overflow:hidden;
    }

    .btn-register:hover{
      transform:translateY(-3px);
      box-shadow:
      0 12px 25px rgba(37,99,235,.25);
    }

    .btn-register::before{
      content:"";
      position:absolute;
      width:120px;
      height:250%;
      background:rgba(255,255,255,.3);
      transform:rotate(25deg);
      top:-80px;
      left:-140px;
      transition:.7s;
    }

    .btn-register:hover::before{
      left:130%;
    }

    .bottom-text{
      margin-top:20px;
      text-align:center;
      color:#64748b;
      font-size:14px;
    }

    .bottom-text a{
      color:#2563eb;
      text-decoration:none;
      font-weight:600;
    }

    .bottom-text a:hover{
      text-decoration:underline;
    }

    .ai-box{
      margin-top:20px;
      background:#f8fbff;
      border:1px solid #dbeafe;
      border-radius:16px;
      padding:13px;
      font-size:13px;
      color:#1e3a8a;
      animation:blink 2s infinite;
    }

    @keyframes blink{
      50%{
        opacity:.75;
      }
    }

    .popup{
      position:fixed;
      top:20px;
      right:20px;
      background:#2563eb;
      color:white;
      padding:15px 20px;
      border-radius:15px;
      font-weight:600;
      box-shadow:
      0 10px 25px rgba(37,99,235,.2);
      transform:translateX(400px);
      transition:.5s;
      z-index:999;
    }

    .popup.show{
      transform:translateX(0);
    }

    @media(max-width:500px){

      .register-card{
        padding:25px;
        border-radius:28px;
      }

      h1{
        font-size:28px;
      }

    }

  </style>
</head>

<body>

  <div class="circle circle1"></div>
  <div class="circle circle2"></div>

  <div class="particles">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>

  <div class="popup" id="popup">
    ✅ Akun berhasil dibuat!
  </div>

  <div class="register-card">

    <div class="top-line"></div>

    <div class="logo">
      <i class="fa-solid fa-school"></i>
    </div>

    <h1>PPDB SMKN 4 Palembang 2026</h1>

    <p class="subtitle">
      Sistem PPDB (Penerimaan Peserta Didik Baru)
    </p>

    <div class="status-box">
      🚀 Pendaftaran Gelombang 1 Sedang Dibuka
    </div>

    <form method="POST">

      <label class="form-label">
        Username
      </label>

      <div class="input-box">
        <input
        type="text"
        name="nama"
        placeholder="Masukkan username"
        required>

        <i class="fa-solid fa-user"></i>
      </div>

      <label class="form-label">
        Email
      </label>

      <div class="input-box">
        <input
        type="email"
        name="email"
        placeholder="Masukkan email aktif"
        required>

        <i class="fa-solid fa-envelope"></i>
      </div>

      <label class="form-label">
        Password
      </label>

      <div class="input-box">
        <input
        type="password"
        id="password"
        name="password"
        placeholder="Masukkan password"
        required>

        <i class="fa-solid fa-eye"
        onclick="togglePassword()"></i>
      </div>

      <div class="strength">
        <div class="strength-bar"></div>
      </div>

      <div class="strength-text">
        Password Strength: Strong 🔥
      </div>

      <label class="form-label">
        Konfirmasi Password
      </label>

      <div class="input-box">
        <input
        type="password"
        name="konfirmasi"
        placeholder="Konfirmasi password"
        required>

        <i class="fa-solid fa-lock"></i>
      </div>

      <button
      type="submit"
      name="register"
      class="btn-register">

        <i class="fa-solid fa-paper-plane"></i>
        Register Sekarang

      </button>

      <div class="bottom-text">
        Sudah punya akun?
        <a href="#">Login</a>
      </div>

      <div class="ai-box">
        Gunakan email aktif untuk menerima informasi hasil seleksi PPDB.
      </div>

    </form>

  </div>

  <script>

    function togglePassword(){

      const password =
      document.getElementById("password");

      if(password.type === "password"){
        password.type = "text";
      }else{
        password.type = "password";
      }

    }

  </script>

</body>
</html>