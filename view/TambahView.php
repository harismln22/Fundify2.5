<?php
include_once("model/Template.php");
class TambahView {

    public function renderAddPemasukan()
    {
        $isiJudul = "Tambah pemasukan data";
        $views = new Template("layout/tambah.html");
        $views->replace("JUDUL", $isiJudul);
        $views->write();
    }
    public function renderAddPengeluaran()
    {
        $isiJudul = "Tambah pengeluaran data";
        $views = new Template("layout/tambah.html");
        $views->replace("JUDUL", $isiJudul);
        $views->write();
    }
}