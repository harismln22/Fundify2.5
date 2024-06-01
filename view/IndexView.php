<?php
include_once("model/Template.php");
class IndexView {
    
    public function render($data)
    {
        $views = new Template("layout/index.html");
        $views->replace("TOTAL_MASUK", "Rp." . number_format($data['total_pemasukan'], 2, ',', '.'));
        $views->replace("TOTAL_KELUAR", "Rp." . number_format($data['total_pengeluaran'], 2, ',', '.'));
        $views->replace("SELISIH", "Rp." . number_format($data['selisih'], 2, ',', '.'));
        $views->write();
    }

}
