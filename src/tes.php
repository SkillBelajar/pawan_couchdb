<?php

namespace skillbelajar\pawan_couchdb;

class Buku
{
    // Properties
    public $judul;
    public $penulis;
    public $tahunTerbit;

    // Method
    public function getInfoBuku($judul)
    {
        echo $judul;
    }
}
