<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tabel Input Nilai Mahasiswa</title>
    <style>
        body {
            padding: 0 auto;
            margin: 0 auto;
            margin-top: 7%;
            padding-top: 2%;
            width: 30%;
            height: 520px;
            background-color: aliceblue;
            color: black;
            text-align: center;
            justify-content: center;
            box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.2),
                0 10px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            -ms-border-radius: 10px;
            -o-border-radius: 10px;
        }

        h2 {
            margin: 10px;
        }

        select,
        input {
            margin: 5px;
            padding: 8px;
        }

        table {
            margin: 10px auto;
            border-collapse: collapse;
            width: 90%;
        }

        th,
        td {
            justify-content: center;
            margin: 5px;
            border-collapse: collapse;
        }

        button {
            margin: 5px;
            padding: 8px;
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }
    </style>
</head>

<body>
    <h2>TABEL INPUT NILAI AKHIR MAHASISWA</h2>
    <form method="POST">
        <label>
            <tr>
                <td>
                    <select name="nama" required>
                        <option value=""> -- Pilih Mahasiswa -- </option>
                        <option value="Ahmad"> Ahmad</option>
                        <option value="Sahroni"> Sahroni</option>
                        <option value="Susi"> Susi</option>
                        <option value="Fatimah"> fatimah</option>
                    </select>
                </td><br>
            </tr>
            <tr>
                <td>Kehadiran 20%</td><br>
                <td><input type="number" name="kehadiran"></td><br>
            </tr>
            <tr>
                <td>Tugas 30%</td><br>
                <td><input type="number" name="tugas"></td><br>
            </tr>
            <tr>
                <td>UTS 25%</td><br>
                <td><input type="number" name="uts"></td><br>
            </tr>
            <tr>
                <td>UAS 25%</td><br>
                <td><input type="number" name="uas"></td><br>
            </tr>
        </label>
        <button type="submit"> Hitung Nilai Akhir</button>
    </form>
</body>
<?php

$persentase = [
    'kehadiran' => 20,
    'tugas' => 30,
    'uts' => 25,
    'uas' => 25
];

$mahasiswa = [
    'Ahmad',
    'Sahroni',
    'Susi',
    'Fatimah'
];

function hitung($nilai, $persentase)
{
    return round(($nilai['kehadiran'] * $persentase['kehadiran'] +
        $nilai['tugas'] * $persentase['tugas'] +
        $nilai['uts'] * $persentase['uts'] +
        $nilai['uas'] * $persentase['uas']) / 100, 2);
}

function huruf($angka)
{
    if ($angka >= 100) {
        return "A";
    } elseif ($angka >= 90) {
        return "AB";
    } elseif ($angka >= 80) {
        return "B";
    } elseif ($angka >= 70) {
        return "BC";
    } elseif ($angka >= 60) {
        return "C";
    } elseif ($angka >= 50) {
        return "D";
    } else {
        return "E";
    }
}

$hasil = ' ';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nilai = [
        'kehadiran' => (int)($_POST['kehadiran']),
        'tugas' => (int)($_POST['tugas']),
        'uts' => (int)($_POST['uts']),
        'uas' => (int)($_POST['uas'])
    ];

    $validasi = true;
    foreach ($nilai as $secor) {
        if ($secor < 0 || $secor > 100) $validasi = false;
    }
    if ($validasi) {
        $akhir = hitung($nilai, $persentase);
        $huruf = huruf($akhir);
        $hasil = "<br> mahasiswa : $nama<br> Nilai Akhir : $akhir <br> Nilai huruf : $huruf<br>";

        echo "<hr><table>

                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Nilai Akhir</th>
                        <th>Nilai Huruf</th>
                    </tr>
                    <tr>
                        <td>$nama</td>
                        <td>$akhir</td>
                        <td>$huruf</td>
                    </tr>
                  </table> <hr>";
    } else {
        echo "<p style='color:red;'>Maaf, nilai harus antara 0 dan 100!</p>";
    }
}
?>

</html>