<?php

class Nama
{
  public $nama;
  public $jumlahHuruf;
  public $jumlahKata;
  public $kebalikan;
  public $jumlahVokal;
  public $jumlahKonsonan;


  public function __construct($nama)
  {
    $this->nama = $nama;
    $this->jumlahHuruf = strlen(str_replace(" ", "", $nama));
    $this->jumlahKata = str_word_count($nama);
    $this->kebalikan = strrev($nama);

    $VOKAL = ["a", "i", "u", "e", "o"];

    $this->jumlahVokal = 0;
    foreach ($VOKAL as $vokal) {
      $this->jumlahVokal += substr_count(strtolower($nama), $vokal);
    }

    $this->jumlahKonsonan = strlen(str_replace(" ", "", $nama)) - $this->jumlahVokal;
  }

  public function __toString()
  {
    return "Nama: " . $this->nama . "<br>" .
      "Jumlah huruf: " . $this->jumlahHuruf . "<br>" .
      "Jumlah kata: " . $this->jumlahKata . "<br>" .
      "Kebalikan: " . $this->kebalikan . "<br>" .
      "Jumlah vokal: " . $this->jumlahVokal . "<br>" .
      "Jumlah konsonan: " . $this->jumlahKonsonan . "<br>" .
      "<br>";
  }
}

$names = ["John", "Smith", "Jane", "Doe", "Jordi Irawan"];

foreach ($names as $name) {
  echo (new Nama($name));
}
