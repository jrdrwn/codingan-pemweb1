<?php

session_start();

if (!isset($_SESSION['data'])) {
  $_SESSION['data'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $idx = $_GET['idx'];
    unset($_SESSION['data'][$idx]);
    $_SESSION['data'] = array_values($_SESSION['data']);
  }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $role = $_POST['role'];

  $_SESSION['data'][] = [
    'name' => $name,
    'role' => $role
  ];
}

function get_jumlah_vokal_konsonan($name)
{
  $vokal = ['a', 'i', 'u', 'e', 'o'];
  $jumlah_vokal = 0;
  foreach ($vokal as $v) {
    $jumlah_vokal += substr_count(strtolower($name), $v);
  }

  return [
    'vokal' => $jumlah_vokal,
    'konsonan' => strlen(str_replace(" ", "", $name)) - $jumlah_vokal
  ];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modul 1</title>
</head>

<style>
  div:has(> table) {
    margin-top: 20px;
    overflow-x: auto;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th,
  td {
    border: 1px solid black;
    padding: 10px;
    text-align: center;
  }
</style>

<body>
  <h1>Mengelola Nama Anggota Keluarga</h1>
  <form method="post" action="ui.php">
    <input type="text" name="name" placeholder="Nama" required />
    <input type="text" name="role" placeholder="Sebagai apa?" required />
    <button type="submit">Tambah</button>
  </form>
  <div>
    <?php
    if (!count($_SESSION['data'])) {
    ?>
      <h3>Data masih kosong!</h3>
    <?php
    } else {
    ?>
      <h3>Data Anggota Keluarga</h3>
      <table>
        <thead>
          <tr>
            <th>Nama</th>
            <th>Sebagai</th>
            <th>Jumlah Kata</th>
            <th>Jumlah Huruf</th>
            <th>Kebalikan Nama</th>
            <th>Jumlah Vokal</th>
            <th>Jumlah Konsonan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $idx = 0;
          foreach (array_reverse($_SESSION['data']) as $data) {
            $name = $data["name"];
            $role = $data["role"];
          ?>
            <tr>
              <td><?= $name ?></td>
              <td><?= $role ?></td>
              <td><?= str_word_count($name) ?></td>
              <td><?= strlen(str_replace(" ", "", $name)) ?></td>
              <td><?= strrev($name) ?></td>
              <td><?= get_jumlah_vokal_konsonan($name)['vokal'] ?></td>
              <td><?= get_jumlah_vokal_konsonan($name)['konsonan'] ?></td>
              <td><a href="ui.php?aksi=hapus&idx=<?= $idx ?>" style="display: inline;"><button>Kick</button></a></td>
            </tr>
          <?php
            $idx++;
          } ?>
        </tbody>

      </table>
    <?php
    }
    ?>
  </div>

</body>

</html>
