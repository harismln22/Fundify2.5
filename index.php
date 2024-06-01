<?php

session_start();

// Periksa apakah variabel sesi untuk status login telah diatur
if (!isset($_SESSION['is_logged_in'])) {
    // Jika tidak, arahkan ke halaman login
    header('Location: login.php');
    exit;
}

// Sisanya dari kode index.php Anda
include_once("koneksi.php");
include_once("model/db.php");
include_once("model/Template.php");
include_once("controller/IndexController.php");

$Index = new IndexController();
$Index->index();
