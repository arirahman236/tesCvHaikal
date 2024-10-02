<?php 
include('proses.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fahri Ari Rahman - Tes Skil Programmer</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Peringkat Wilayah Dengan Menggunakan Decision Support System (DSS)</h1>
    <table border="2">
        <tr>
            <th style="background-color:#00ff00">Peringkat</th>
            <th>Koordinat X</th>
            <th>Koordinat Yy</th>
            <th>Akses Jalan</th>
            <th>Harga Tanah</th>
            <th>Kepadatan Penduduk</th>
            <th>Tingkat Kejahatan</th>
            <th style="background-color:#FFFF00">Total Skor</th>
        </tr>
        <?php 
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

    <canvas id="scatterPlot" width="800" height="400"></canvas>
    <div id="map"></div>
    
    <script>
        const scatterData = <?php echo json_encode($rank_data); ?>; // Mengambil data dari PHP
        const koordinatX = scatterData.map(item => item.koordinat_x);
        const koordinatY = scatterData.map(item => item.koordinat_y);
        const hargaTanah = scatterData.map(item => item.harga_tanah);

        const ctx = document.getElementById('scatterPlot').getContext('2d');

        const scatterPlot = new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Scatter Plot Harga Tanah',
                    data: koordinatX.map((x, index) => ({ x: x, y: koordinatY[index] })),
                    backgroundColor: hargaTanah.map(harga => {
                        const red = harga / Math.max(...hargaTanah) * 255; 
                        return `rgba(${red}, 255, 0, 0.6)`; // Skala warna sesuai harga tanah
                    }),
                    pointRadius: 5,
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Koordinat X'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Koordinat Y'
                        }
                    }
                }
            }
        });
    </script>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Data peta dari PHP
        const mapData = <?php echo json_encode($rank_data); ?>;

        // Inisialisasi peta
        const map = L.map('map').setView([mapData[0].koordinat_x, mapData[0].koordinat_y], 13); // Menyesuaikan dengan koordinat pertama dari data

        // Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Fungsi untuk menentukan warna berdasarkan harga tanah
        function getColor(harga_tanah) {
            return harga_tanah > 1000 ? '#800026' :
                   harga_tanah > 500  ? '#BD0026' :
                   harga_tanah > 200  ? '#E31A1C' :
                   harga_tanah > 100  ? '#FC4E2A' :
                   harga_tanah > 50   ? '#FD8D3C' :
                   harga_tanah > 20   ? '#FEB24C' :
                   harga_tanah > 10   ? '#FED976' :
                                        '#FFEDA0';
        }

        // Tambahkan marker ke peta
        mapData.forEach(item => {
            const marker = L.circleMarker([item.koordinat_x, item.koordinat_y], {
                radius: 8,
                fillColor: getColor(item.harga_tanah),
                color: "#000",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            }).addTo(map);

            // Tambahkan popup ke setiap marker
            marker.bindPopup(`
                <b>Koordinat</b>: ${item.koordinat_x}, ${item.koordinat_y}<br>
                <b>Harga Tanah</b>: Rp ${item.harga_tanah}
            `);
        });

        // Mengecek apakah browser mendukung Geolocation API
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, error);
        } else {
            document.getElementById('status').innerText = "Geolocation tidak didukung oleh browser ini.";
        }

        function success(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Tambahkan marker posisi pengguna di peta
            const marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Lokasi Anda Saat Ini')
                .openPopup();

            // Pindahkan tampilan peta ke lokasi pengguna
            map.setView([latitude, longitude], 13);
        }

        function error(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
            document.getElementById('status').innerText = "Tidak dapat mengambil lokasi: " + err.message;
        }
    </script>
</body>
</html>
