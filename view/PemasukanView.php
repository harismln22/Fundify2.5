<?php
include_once("model/Template.php");
class PemasukanView {

    public function render($data)
    {
        $no = 1;
        $dataMasuk = null;
        $isijudul = "Pemasukan";
        foreach($data['pemasukan'] as $val)
        {
            list($id, $nama, $jabatan, $tanggal, $jumlah) = $val;
            $dataMasuk .= "<tr>";
            $dataMasuk .= "<td>" . $no . "</td>";
            $dataMasuk .= "<td>" . $nama . "</td>";
            $dataMasuk .= "<td>" . $jabatan . "</td>";
            $dataMasuk .= "<td>" . $tanggal . "</td>"; 
            $dataMasuk .= "<td>" . $jumlah . "</td>"; 
            $dataMasuk .= "<td>";
            $dataMasuk .= "<a href='pemasukan.php?id_edit=" . $id .  "' class='btn btn-warning'>Edit</a> ";
            $dataMasuk .= "<a href='pemasukan.php?id_hapus=" . $id . "' class='btn btn-danger' name='hapus'>Hapus</a>";
            $dataMasuk .= "</td>";
            $dataMasuk .= "</tr>";
            $no++;
        }
        $views = new Template("layout/pemasukan.html");
        $views->replace("ISI_MASUK", $dataMasuk);
        $views->replace("ISI_JUDUL", $isijudul);
        $views->write();
    }
}

