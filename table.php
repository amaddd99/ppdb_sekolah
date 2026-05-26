<?php

include "koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM tb_siswa");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data PPDB</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial, Helvetica, sans-serif;
            background: #eef2f7;
            padding: 30px;
        }

        .container{
            max-width: 1250px;
            margin: auto;
        }

        .card{
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        .judul{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .judul h2{
            color: #0f172a;
            font-size: 28px;
        }

        .btn{
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn:hover{
            background: #1d4ed8;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        table thead{
            background: #2563eb;
            color: white;
        }

        table th{
            padding: 15px;
            font-size: 14px;
            text-transform: uppercase;
        }

        table td{
            padding: 14px;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
            color: #334155;
        }

        table tbody tr{
            transition: 0.2s;
        }

        table tbody tr:hover{
            background: #f8fafc;
        }

        .status{
            background: #facc15;
            color: #854d0e;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .kosong{
            text-align: center;
            padding: 30px;
            color: gray;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="card">

        <div class="judul">
            <h2>Data Pendaftaran PPDB</h2>

            <a href="halaman_pendaftaran.php" class="btn">
                + Tambah Data
            </a>
        </div>

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Asal Sekolah</th>
                    <th>Jurusan 1</th>
                    <th>Jurusan 2</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no = 1;

            if(mysqli_num_rows($query) > 0){

                while($data = mysqli_fetch_array($query)){
            ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nis'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['jenis_kelamin'] ?></td>
                    <td><?= $data['tempat_lahir'] ?></td>
                    <td><?= $data['tanggal_lahir'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['asal_sekolah'] ?></td>
                    <td><?= $data['pl_jurusan1'] ?></td>
                    <td><?= $data['pl_jurusan2'] ?></td>
                    <td>
                        <span class="status">
                            <?= $data['status_pendaftaran'] ?>
                        </span>
                    </td>
                </tr>

            <?php
                }

            } else {
            ?>

                <tr>
                    <td colspan="11" class="kosong">
                        Data belum ada
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
