<?php
include_once("model/Template.php");
class PengeluaranView {

    public function render($data)
    {
        $no = 1;
        $dataKeluar = null;
        $isijudul = "Pengeluaran";
        foreach($data['pengeluaran'] as $val)
        {
            list($id, $nama, $jabatan, $tanggal, $jumlah) = $val;
            $dataKeluar .= "<tr>";
            $dataKeluar .= "<td>" . $no . "</td>";
            $dataKeluar .= "<td>" . $nama . "</td>";
            $dataKeluar .= "<td>" . $jabatan . "</td>";
            $dataKeluar .= "<td>" . $tanggal . "</td>"; 
            $dataKeluar .= "<td>" . $jumlah . "</td>"; 
            $dataKeluar .= "<td>";
            $dataKeluar .= "<a href='pengeluaran.php?id_edit=" . $id .  "' class='btn btn-warning'>Edit</a> ";
            $dataKeluar .= "<a href='pengeluaran.php?id_hapus=" . $id . "' class='btn btn-danger'>Hapus</a>";
            $dataKeluar .= "</td>";
            $dataKeluar .= "</tr>";
            $no++;
        }
        $views = new Template("layout/pengeluaran.html");
        $views->replace("ISI_MASUK", $dataKeluar);
        $views->replace("ISI_JUDUL", $isijudul);
        $views->write();
    }
}

