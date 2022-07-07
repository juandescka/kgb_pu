<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use App\Models\PegawaiModel;

class Pengguna extends BaseController
{
    public function __construct()
    {
        $this->PenggunaModel = new PenggunaModel();
        $this->PegawaiModel = new PegawaiModel();
        date_default_timezone_set("Asia/Makassar");
        session();
    }

    public function ganti_password()
    {
        return view('pengguna/ganti_password');
    }

    public function simpan_password()
    {
        if (!$this->validate([
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong'
                ]
            ],
            'password_confirmation' => [
                'required', 'matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Password tidak boleh kosong',
                    'matches' => 'Password dan konfirmasi password tidak sama'
                ]
            ]
        ])) {
            // dd($this->request->getFile('sk_pangkat_terakhir'));
            session()->setFlashdata('error_input', $this->validator->listErrors());
            return redirect()->to(base_url() . '/pengguna/ganti_password')->withInput();
        }

        $password = $this->request->getPost('password');
        $pengguna = $this->PenggunaModel->where('username', session()->get('nip'))->first();

        $this->PenggunaModel->save([
            'id' => $pengguna['id'],
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        session()->remove(['nip', 'nama', 'nama_jabatan', 'induk', 'pd', 'tipePengguna', 'isLoggedIn']);
        session()->setFlashData('success', 'Harap login dengan password baru!');
        return redirect()->to(base_url() . '/authentication');
    }

    public function get_pegawai()
    {
        $nip = $this->request->getPost('nip');
        $pegawai = $this->PegawaiModel->where('nip', $nip)->where('pd', session()->get('pd'))->first();
        if ($pegawai) {
            $data = [
                'status' => 'success',
                'nama' => $pegawai['nama'],
                'nip' => $pegawai['nip'],
                'pd' => $pegawai['pd'],
            ];
            return json_encode($data);
        }
        $data = [
            'status' => 'failed',
            'message' => 'DATA TIDAK DITEMUKAN'
        ];
        return json_encode($data);
    }
}
