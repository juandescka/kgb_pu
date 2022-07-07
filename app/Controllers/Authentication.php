<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use App\Models\PegawaiModel;

class Authentication extends BaseController
{
    public function __construct()
    {
        $this->PenggunaModel = new PenggunaModel();
        $this->PegawaiModel = new PegawaiModel();
        date_default_timezone_set("Asia/Makassar");
        session();
    }

    public function index()
    {
        return view('authentication/index');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $pengguna = $this->PenggunaModel->where('username', $username)->first();
        if ($pengguna) {
            if (password_verify($password, $pengguna['password'])) {

                if ($pengguna['tipePengguna'] != 'super-admin') {
                    $pegawai = $this->PegawaiModel->where('nip', $username)->first();
                    if (!$pegawai) {
                        session()->setFlashdata('error', 'Anda tidak terdaftar sebagai pegawai Dinas Pekerjaan Umum Provinsi Sulawesi Utara');
                        return redirect()->to(base_url() . '/authentication');
                    }

                    $data = [
                        'nip' => $pegawai['nip'],
                        'nama' => $pegawai['nama'],
                        'nama_jabatan' => $pegawai['nama_jabatan'],
                        'induk' => $pegawai['induk'],
                        'pd' => $pegawai['pd'],
                        'tipePengguna' => $pengguna['tipePengguna'],
                        'isLoggedIn' => TRUE
                    ];
                }

                session()->set($data);
                session()->setFlashdata('success', 'Selamat datang ' . $pegawai['nama']);
                return redirect()->to(base_url() . '/dashboard');
            }
            session()->setFlashdata('error', 'Kata sandi yang anda masukkan salah!');
            return redirect()->to(base_url() . '/authentication');
        }

        session()->setFlashdata('error', 'Akun anda tidak terdaftar!');
        return redirect()->to(base_url() . '/authentication');
    }

    public function logout()
    {
        session()->remove(['nip', 'nama', 'nama_jabatan', 'induk', 'pd', 'tipePengguna', 'isLoggedIn']);
        session()->setFlashData('success', 'Terima kasih sudah berkunjung!');
        return redirect()->to(base_url() . '/authentication');
    }

    public function register_admin()
    {
        $this->PenggunaModel->save([
            // 'username' => '198301292011021001',
            // 'username' => '199304152019031010',
            // 'username' => '198504252010012005',
            // 'username' => '197310082012121001',
            'username' => '197310082012121001',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'tipePengguna' => 'operator',
            'status' => 'active'
        ]);

        echo "done";
    }
}
