<?php

include "koneksi.php";

if (isset($_POST['submit'])) {

    $nis               = $_POST['nis'];
    $nama              = $_POST['nama'];
    $jenis_kelamin     = $_POST['jenis_kelamin'];
    $tempat_lahir      = $_POST['tempat_lahir'];
    $tanggal_lahir     = $_POST['tanggal_lahir'];
    $alamat            = $_POST['alamat'];
    $asal_sekolah      = $_POST['asal_sekolah'];
    $pl_jurusan1       = $_POST['pl_jurusan1'];
    $pl_jurusan2       = $_POST['pl_jurusan2'];

    $query = "INSERT INTO tb_siswa
    (
        id_users,
        nis,
        nama,
        jenis_kelamin,
        tempat_lahir,
        tanggal_lahir,
        alamat,
        asal_sekolah,
        pl_jurusan1,
        pl_jurusan2,
        status_pendaftaran
    )

    VALUES
    (
        '1',
        '$nis',
        '$nama',
        '$jenis_kelamin',
        '$tempat_lahir',
        '$tanggal_lahir',
        '$alamat',
        '$asal_sekolah',
        '$pl_jurusan1',
        '$pl_jurusan2',
        'proses'
    )";

    $simpan = mysqli_query($conn, $query);

    if ($simpan) {
        echo "
        <script>
            alert('Data berhasil ditambahkan');
            window.location='table.php';
        </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Form PPDB</title>

    <style>

        body{
            font-family: Arial;
            background: #f4f7f9;
            padding: 20px;
        }

        .kotak-form{
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            border-top: 5px solid #0056b3;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2{
            text-align: center;
            color: #0056b3;
            margin-bottom: 30px;
        }

        .baris-input{
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .item-input{
            flex: 1;
            min-width: 250px;
        }

        label{
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select,
        textarea{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button{
            background: #0056b3;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover{
            background: #003f85;
        }

        .tombol{
            text-align: right;
            margin-top: 20px;
        }

    </style>

</head>
<body>

<div class="kotak-form">

    <h2>FORM PENDAFTARAN PPDB</h2>

    <form method="POST">

        <div class="baris-input">

            <div class="item-input">
                <label>NIS</label>
                <input type="text" name="nis" required>
            </div>

            <div class="item-input">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" required>
            </div>

        </div>

        <div class="baris-input">

            <div class="item-input">
                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="item-input">
                <label>Tempat Lahir</label>
                <input type="text" name="tempat_lahir" required>
            </div>

            <div class="item-input">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" required>
            </div>

        </div>

        <div class="baris-input">

            <div class="item-input">
                <label>Alamat</label>
                <textarea name="alamat" rows="3" required></textarea>
            </div>

        </div>

        <div class="baris-input">

            <div class="item-input">
                <label>Asal Sekolah</label>
                <input type="text" name="asal_sekolah" required>
            </div>

        </div>

        <div class="baris-input">

            <div class="item-input">
                <label>Pilihan Jurusan 1</label>

                <select name="pl_jurusan1" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="RPL">RPL</option>
                    <option value="TKJ">TKJ</option>
                    <option value="DKV">DKV</option>
                    <option value="AKL">AKL</option>
                </select>
            </div>

            <div class="item-input">
                <label>Pilihan Jurusan 2</label>

                <select name="pl_jurusan2">
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="RPL">RPL</option>
                    <option value="TKJ">TKJ</option>
                    <option value="DKV">DKV</option>
                    <option value="AKL">AKL</option>
                </select>
            </div>

        </div>

        <div class="tombol">
            <button type="submit" name="submit">
                Daftar Sekarang
            </button>
        </div>

    </form>

</div>

</body>
</html>