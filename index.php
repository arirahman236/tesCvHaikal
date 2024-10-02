<!DOCTYPE html>
<html>
<head>
    <title>Fahri Ari Rahman - Tes Skil Programmer</title>
</head>
<body>
    <h1>Peringkat Wilayah Dengan Menggunakan Decision Support System (DSS)</h1>
    <table border="2">
        <tr>
            <th style="background-color:#00ff00">Peringkat</th>
            <th>Koordinat X</th>
            <th>Koordinat Y</th>
            <th>Akses Jalan</th>
            <th>Harga Tanah</th>
            <th>Kepadatan Penduduk</th>
            <th>Tingkat Kejahatan</th>
            <th style="background-color:#FFFF00">Total Skor</th>
        </tr>
        <?php 
        include('proses.php');
        $rank = 1;
        foreach ($rank_data as $row) { ?>
            <tr>
                <td style="background-color:#00ff00"><?php echo $rank++; ?></td>
                <td><?php echo round($row['koordinat_x'], 2); ?></td>
                <td><?php echo round($row['koordinat_y'], 2); ?></td>
                <td><?php echo round($row['akses_jalan'], 2); ?></td>
                <td><?php echo round($row['harga_tanah'], 2); ?></td>
                <td><?php echo round($row['kepadatan_penduduk'], 2); ?></td>
                <td><?php echo round($row['tingkat_kejahatan'], 2); ?></td>
                <td style="background-color:#FFFF00"><?php echo round($row['score'], 2); ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
