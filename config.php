<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_kampus";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'id';

$translations = [
    'id' => [
        'title' => 'Manajemen Data Mahasiswa',
        'login' => 'Masuk',
        'username' => 'Nama Pengguna',
        'password' => 'Kata Sandi',
        'add_data' => 'Tambah Data',
        'logout' => 'Keluar',
        'name' => 'Nama',
        'nim' => 'NIM',
        'major' => 'Jurusan',
        'action' => 'Aksi',
        'edit' => 'Ubah',
        'delete' => 'Hapus',
        'save' => 'Simpan',
        'cancel' => 'Batal',
        'back' => 'Kembali',
        'empty_field' => 'Semua kolom wajib diisi!',
        'confirm_del' => 'Yakin ingin menghapus data ini?',
        'welcome' => 'Selamat Datang',
        'no_data' => 'Belum ada data mahasiswa.',
        'add_desc' => 'Isi data mahasiswa baru pada form di bawah ini.',
        'edit_desc' => 'Ubah data mahasiswa pada form di bawah ini.'
    ],
    'en' => [
        'title' => 'Student Data Management',
        'login' => 'Login',
        'username' => 'Username',
        'password' => 'Password',
        'add_data' => 'Add Data',
        'logout' => 'Logout',
        'name' => 'Name',
        'nim' => 'NIM',
        'major' => 'Major',
        'action' => 'Action',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'save' => 'Save',
        'cancel' => 'Cancel',
        'back' => 'Back',
        'empty_field' => 'All fields are required!',
        'confirm_del' => 'Are you sure you want to delete this data?',
        'welcome' => 'Welcome',
        'no_data' => 'No student data yet.',
        'add_desc' => 'Fill in the form below to add a new student.',
        'edit_desc' => 'Update the student data in the form below.'
    ]
];

function t($key) {
    global $translations, $lang;
    return $translations[$lang][$key] ?? $key;
}
?>