<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
// 1. Array multidimensi mata kuliah (key: nama, sks, nilai)
$matkul = [
    ["nama" => "Pemrograman Web",   "sks" => 3, "nilai" => 88],
    ["nama" => "Basis Data",        "sks" => 3, "nilai" => 76],
    ["nama" => "Algoritma",         "sks" => 4, "nilai" => 58],
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 45],
    ["nama" => "Matematika Diskrit","sks" => 2, "nilai" => 32],
    ["nama" => "Bahasa Inggris",    "sks" => 2, "nilai" => 91],
];

// 2. Fungsi helper: nilai angka -> huruf & bobot
function hitungBobot($nilai)
{
    if ($nilai >= 85)      return ["huruf" => "A", "bobot" => 4.0];
    elseif ($nilai >= 70)  return ["huruf" => "B", "bobot" => 3.0];
    elseif ($nilai >= 55)  return ["huruf" => "C", "bobot" => 2.0];
    elseif ($nilai >= 40)  return ["huruf" => "D", "bobot" => 1.0];
    else                   return ["huruf" => "E", "bobot" => 0.0];
}

// Hitung total untuk IPS
$totalSks = 0;
$totalMutu = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan Individu</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; max-width: 800px; }
        th, td { border: 1px solid #999; padding: 8px 12px; text-align: center; }
        th { background: #eee; }
        td.kiri { text-align: left; }
        .mengulang { color: red; }
    </style>
</head>
<body>
    <h2>Daftar Nilai Mata Kuliah</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Status</th>
        </tr>
        <?php foreach ($matkul as $i => $mk): ?>
            <?php
            // 3. Hitung huruf, bobot, status
            $hasil  = hitungBobot($mk["nilai"]);
            $status = ($hasil["bobot"] >= 2.0) ? "LULUS" : "MENGULANG";

            $totalSks  += $mk["sks"];
            $totalMutu += $mk["sks"] * $hasil["bobot"];

            // 4. Warna merah untuk MENGULANG
            $kelas = ($status === "MENGULANG") ? "mengulang" : "";
            ?>
            <tr class="<?= $kelas ?>">
                <td><?= $i + 1 ?></td>
                <td class="kiri"><?= $mk["nama"] ?></td>
                <td><?= $mk["sks"] ?></td>
                <td><?= $mk["nilai"] ?></td>
                <td><?= $hasil["huruf"] ?></td>
                <td><?= $status ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    // 4 (kedua). Ringkasan IPS
    $ips = ($totalSks > 0) ? $totalMutu / $totalSks : 0;

    // 5. Batas maksimal SKS semester depan
    $maksSks = ($ips >= 3.00) ? 24 : 20;
    ?>

    <h3>Ringkasan IPS</h3>
    <p>Total SKS: <strong><?= $totalSks ?></strong></p>
    <p>Total Mutu (SKS x Bobot): <strong><?= number_format($totalMutu, 2) ?></strong></p>
    <p>IPS: <strong><?= number_format($ips, 2) ?></strong></p>

    <h3>Batas SKS Semester Depan</h3>
    <p>Berdasarkan IPS <?= number_format($ips, 2) ?>, Anda maksimal boleh mengambil
        <strong><?= $maksSks ?> SKS</strong>.</p>
    
</body>
</html>