<?php
    
function pengumpulan_data() {
    $mysqli = new mysqli("localhost", "root", "", "data_wilayah");

    if ($mysqli->connect_error) {
        die("Koneksi gagal: " . $mysqli->connect_error);
    }
    $data = array();
    
    $query = "SELECT koordinat_x, koordinat_y, akses_jalan, harga_tanah, kepadatan_penduduk, tingkat_kejahatan FROM lowokwaru";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = array(
                'koordinat_x' => $row['koordinat_x'],
                'koordinat_y' => $row['koordinat_y'],
                'akses_jalan' => $row['akses_jalan'],
                'harga_tanah' => $row['harga_tanah'],
                'kepadatan_penduduk' => $row['kepadatan_penduduk'],
                'tingkat_kejahatan' => $row['tingkat_kejahatan']
            );
        }
    }

    return $data;
    // $data = array(
    //     array('koordinat_x' => rand(1, 100), 'koordinat_y' => rand(1, 100), 'akses_jalan' => rand(0, 1), 'harga_tanah' => rand(100, 1000), 'kepadatan_penduduk' => rand(1, 500), 'tingkat_kejahatan' => rand(1, 100)),
    // );
    // return $data;
}

function normalisasi_data($data) {
    $min_max = array();
    foreach ($data[0] as $key => $value) {
        $min_max[$key] = array('min' => PHP_INT_MAX, 'max' => PHP_INT_MIN);
    }

    foreach ($data as $row) {
        foreach ($row as $key => $value) {
            if ($value < $min_max[$key]['min']) $min_max[$key]['min'] = $value;
            if ($value > $min_max[$key]['max']) $min_max[$key]['max'] = $value;
        }
    }

    foreach ($data as &$row) {
        foreach ($row as $key => &$value) {
            $value = ($value - $min_max[$key]['min']) / ($min_max[$key]['max'] - $min_max[$key]['min']);
        }
    }

    return $data;
}

function pengelompokan_data($data) {
    $clustering = array(0 => array(), 1 => array(), 2 => array());

    foreach ($data as $index => $row) {
        if ($row['harga_tanah'] < 0.33) {
            $clustering[0][] = $index;
        } elseif ($row['harga_tanah'] < 0.66) {
            $clustering[1][] = $index;
        } else {
            $clustering[2][] = $index;
        }
    }

    return $clustering;
}

function hitung_ranking($data) {
    $bobot = array('harga_tanah' => 0.4, 'kepadatan_penduduk' => 0.3, 'tingkat_kejahatan' => 0.3);
    foreach ($data as &$row) {
        $row['score'] = (
            $row['harga_tanah'] * $bobot['harga_tanah'] +
            $row['kepadatan_penduduk'] * $bobot['kepadatan_penduduk'] +
            $row['tingkat_kejahatan'] * $bobot['tingkat_kejahatan']
        );
    }

    usort($data, function($a, $b) {
        return $b['score'] <=> $a['score'];
    });

    return $data;
}

$data = pengumpulan_data();
$data_normal = normalisasi_data($data);
$pengelompokan = pengelompokan_data($data_normal);
$rank_data = hitung_ranking($data_normal);

?>
