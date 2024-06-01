<?php

class KeuanganModel extends DB 
{
    function getDataMasuk() 
    {
        $query = "SELECT akun.id_akun, akun.fullname, akun.jabatan, pemasukan.tanggal, pemasukan.jumlah 
                    FROM akun 
                    JOIN pemasukan ON akun.id_akun = pemasukan.id_akun";
        return $this->execute($query);
    }
    function getDataKeluar() 
    {
        $query = "SELECT akun.id_akun, akun.fullname, akun.jabatan, pengeluaran.tanggal, pengeluaran.jumlah 
                    FROM akun 
                    JOIN pengeluaran ON akun.id_akun = pengeluaran.id_akun";
        return $this->execute($query);
    }

    function MasukaddDataKeuangan($data)
    {
        // Menambahkan data ke tabel akun
        $nama = $data['name'];
        $jabatan = $data['jabatan'];
        $queryAkun = "INSERT INTO akun (fullname, jabatan) VALUES ('$nama', '$jabatan')";
        $this->execute($queryAkun);

        // Mendapatkan id_akun yang baru saja ditambahkan
        $id_akun = mysqli_insert_id($this->db_link);

        // Menambahkan data ke tabel pemasukan
        $jumlah = $data['jumlah'];
        $queryPemasukan = "INSERT INTO pemasukan (id_akun, tanggal, jumlah) VALUES ('$id_akun', CURRENT_TIMESTAMP(), '$jumlah')";
        $this->execute($queryPemasukan);

        $queryJoin = "SELECT akun.id_akun, akun.fullname, akun.jabatan, pemasukan.tanggal, pemasukan.jumlah 
                      FROM akun 
                      JOIN pemasukan ON akun.id_akun = pemasukan.id_akun
                      WHERE akun.id_akun = '$id_akun'";
        return $this->execute($queryJoin);
    }

    function KeluaraddDataKeuangan($data)
    {
        // Menambahkan data ke tabel akun
        $nama = $data['name'];
        $jabatan = $data['jabatan'];
        $queryAkun = "INSERT INTO akun (fullname, jabatan) VALUES ('$nama', '$jabatan')";
        $this->execute($queryAkun);

        // Mendapatkan id_akun yang baru saja ditambahkan
        $id_akun = mysqli_insert_id($this->db_link);

        // Menambahkan data ke tabel pengeluaran
        $jumlah = $data['jumlah'];
        $queryPengeluaran = "INSERT INTO pengeluaran (id_akun, tanggal, jumlah) VALUES ('$id_akun', CURRENT_TIMESTAMP(), '$jumlah')";
        $this->execute($queryPengeluaran);

        $queryJoin = "SELECT akun.id_akun, akun.fullname, akun.jabatan, pengeluaran.tanggal, pengeluaran.jumlah 
                      FROM akun 
                      JOIN pengeluaran ON akun.id_akun = pengeluaran.id_akun
                      WHERE akun.id_akun = '$id_akun'";
        return $this->execute($queryJoin);
    }

    function MasukDelDatakeuangan($id)
    {
        $query = "DELETE FROM pemasukan WHERE id_akun = '$id'";

        return $this->execute($query);
    }

    function KeluarDelDatakeuangan($id)
    {
        $query = "DELETE FROM pengeluaran WHERE id_akun = '$id'";

        return $this->execute($query);
    }

    function MasukEditDataKeuangan($id_akun, $data)
    {
        // Mengedit data di tabel akun
        $nama = $data['name'];
        $jabatan = $data['jabatan'];
        $queryAkun = "UPDATE akun SET fullname = '$nama', jabatan = '$jabatan' WHERE id_akun = '$id_akun'";
        $this->execute($queryAkun);

        // Mengedit data di tabel pemasukan
        $jumlah = $data['jumlah'];
        $queryPemasukan = "UPDATE pemasukan SET jumlah = '$jumlah', tanggal = CURRENT_TIMESTAMP() WHERE id_akun = '$id_akun'";
        $this->execute($queryPemasukan);

        // Mengambil data yang telah diupdate untuk verifikasi
        $queryJoin = "SELECT akun.id_akun, akun.fullname, akun.jabatan, pemasukan.tanggal, pemasukan.jumlah 
                    FROM akun 
                    JOIN pemasukan ON akun.id_akun = pemasukan.id_akun
                    WHERE akun.id_akun = '$id_akun'";
        return $this->execute($queryJoin);
    }

    function KeluarEditDataKeuangan($id_akun, $data)
    {
        // Mengedit data di tabel akun
        $nama = $data['name'];
        $jabatan = $data['jabatan'];
        $queryAkun = "UPDATE akun SET fullname = '$nama', jabatan = '$jabatan' WHERE id_akun = '$id_akun'";
        $this->execute($queryAkun);

        // Mengedit data di tabel pemasukan
        $jumlah = $data['jumlah'];
        $queryPengeluaran = "UPDATE pengeluaran SET jumlah = '$jumlah', tanggal = CURRENT_TIMESTAMP() WHERE id_akun = '$id_akun'";
        $this->execute($queryPengeluaran);

        // Mengambil data yang telah diupdate untuk verifikasi
        $queryJoin = "SELECT akun.id_akun, akun.fullname, akun.jabatan, pengeluaran.tanggal, pengeluaran.jumlah 
                    FROM akun 
                    JOIN pengeluaran ON akun.id_akun = pengeluaran.id_akun
                    WHERE akun.id_akun = '$id_akun'";
        return $this->execute($queryJoin);
    }

    function getTotalPemasukan() {
        // Membuka koneksi ke database
        $this->open();
    
        // Query untuk menghitung total pemasukan
        $query = "SELECT SUM(jumlah) AS total_pemasukan FROM pemasukan";
        
        // Menjalankan query
        $result = $this->execute($query);
        
        // Mengambil hasil query
        $row = mysqli_fetch_assoc($result);
        
        // Menutup koneksi database
        $this->close();
        
        // Mengembalikan total pemasukan
        return $row['total_pemasukan'];
    }

    function getTotalPengeluaran() {
        // Membuka koneksi ke database
        $this->open();
    
        // Query untuk menghitung total pemasukan
        $query = "SELECT SUM(jumlah) AS total_pengeluaran FROM pengeluaran";
        
        // Menjalankan query
        $result = $this->execute($query);
        
        // Mengambil hasil query
        $row = mysqli_fetch_assoc($result);
        
        // Menutup koneksi database
        $this->close();
        
        // Mengembalikan total pemasukan
        return $row['total_pengeluaran'];
    }

    function getIncomeDataPerMonth() 
    {
        $incomeDataPerMonth = array();
        for ($month = 1; $month <= 12; $month++) {
            $query = "SELECT SUM(jumlah) AS total_income 
                      FROM pemasukan 
                      WHERE MONTH(tanggal) = $month";
            $result = $this->execute($query);
            $row = mysqli_fetch_assoc($result);
            $incomeDataPerMonth[$month - 1] = $row['total_income'];
        }
        return $incomeDataPerMonth;
    }

    function getExpenseDataPerMonth() 
    {
        $expenseDataPerMonth = array();
        for ($month = 1; $month <= 12; $month++) {
            $query = "SELECT SUM(jumlah) AS total_expense 
                      FROM pengeluaran 
                      WHERE MONTH(tanggal) = $month";
            $result = $this->execute($query);
            $row = mysqli_fetch_assoc($result);
            $expenseDataPerMonth[$month - 1] = $row['total_expense'];
        }
        return $expenseDataPerMonth;
    }
    
}