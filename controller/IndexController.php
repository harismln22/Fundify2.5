<?php

include_once("koneksi.php");
include_once("model/KeuanganModel.php");
include_once("view/IndexView.php");

class IndexController {
    
    private $index;

    function __construct(){
        $this->index = new KeuanganModel(Connecttt::$db_host, Connecttt::$db_user, Connecttt::$db_pass, Connecttt::$db_name);
    }

    public function index() {
      $this->index->open();
      $totalPemasukan = $this->index->getTotalPemasukan(); 
      $totalPengeluaran = $this->index->getTotalPengeluaran(); 
      $selisih = $totalPemasukan - $totalPengeluaran;
  
      $data = array(
          'total_pemasukan' => $totalPemasukan,
          'total_pengeluaran' => $totalPengeluaran,
          'selisih' => $selisih,
      );
      
      $view = new IndexView();
      $view->render($data);
      
  }
  
}