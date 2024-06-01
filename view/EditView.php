<?php
include_once("model/Template.php");
class EditView {

    public function renderEditPemasukan()
    {
        $isiJudul = "Edit pemasukan data";
        $views = new Template("layout/edit.html");
        $views->replace("JUDUL", $isiJudul);
        $views->write();
    }
    public function renderEditPengeluaran()
    {
        $isiJudul = "Edit pengeluaran data";
        $views = new Template("layout/edit.html");
        $views->replace("JUDUL", $isiJudul);
        $views->write();
    }
}