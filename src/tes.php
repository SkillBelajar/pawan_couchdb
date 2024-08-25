<?php

namespace pc;

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

    public function tes()
    {
        echo "ok2";
    }
}
