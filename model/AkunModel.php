<?php

class AkunModel extends DB
{
    function registration($data)
    {
        $fullname = $data['fullname'];
        $email = $data['email'];
        $username = $data['username'];
        $jabatan = $data['jabatan'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT); // Menggunakan password_hash untuk keamanan

        $query = "INSERT INTO akun (fullname, email, username, jabatan, password) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $this->db_link->prepare($query)) {
            $stmt->bind_param("sssss", $fullname, $email, $username, $jabatan, $password);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                return true;
            }
        }
        return false;
    }

    function verifyUser($data)
{
    // Mulai sesi jika belum dimulai
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $username = $data['username'];
    $password = $data['password'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $this->db_link->prepare("SELECT * FROM akun WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah ada satu baris hasil
    if ($result->num_rows == 1)
    {
        $hasil = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $hasil['password']))
        {
            // Setel variabel sesi
            return $hasil;
        }
    }
    return false;
}

}