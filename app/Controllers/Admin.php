<?php

namespace App\Controllers;

use App\Models\KgbModel;
use App\Models\KgbMonitoringModel;
use App\Models\PenggunaModel;
use App\Models\PegawaiModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->KgbModel = new KgbModel();
        $this->KgbMonitoringModel = new KgbMonitoringModel();
        $this->PenggunaModel = new PenggunaModel();
        $this->PegawaiModel = new PegawaiModel();
        date_default_timezone_set("Asia/Makassar");
        session();
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function kgb()
    {
        $kgb = $this->KgbMonitoringModel->select('kgb_monitoring.*, pegawai.nama, pegawai.induk, pegawai.pd')->join('pegawai', 'pegawai.nip = kgb_monitoring.nip')->orderBy('tmt', 'DESC')->findAll();
        $data = [
            'kgb' => $kgb
        ];
        return view('admin/kgb', $data);
    }

    public function kgb_detail($id)
    {
        $kgb = $this->KgbModel->select('kgb.*, pegawai.nip, pegawai.nama, pegawai.induk, pegawai.pd')->join('pegawai', 'pegawai.nip = kgb.nip')->where('kgb.id', $id)->where('status', 'accepted')->first();

        if (!$kgb) {
            return redirect()->back();
        }

        $data = [
            'kgb' => $kgb
        ];
        return view('admin/kgb/detail', $data);
    }

    public function usulan_kgb()
    {
        $data = [
            'kgb' => $this->KgbModel->select('kgb.*, pegawai.nip, pegawai.nama, pegawai.induk, pegawai.pd')->join('pegawai', 'pegawai.nip = kgb.nip')->where('status !=', 'accepted')->orderBy('id', 'DESC')->findAll()
        ];
        return view('admin/usulan_kgb', $data);
    }

    public function usulan_kgb_detail($id)
    {
        $kgb = $this->KgbModel->select('kgb.*, pegawai.nip, pegawai.nama, pegawai.induk, pegawai.pd')->join('pegawai', 'pegawai.nip = kgb.nip')->where('kgb.id', $id)->where('status !=', 'accepted')->first();

        if (!$kgb) {
            return redirect()->back();
        }

        $data = [
            'kgb' => $kgb
        ];
        return view('admin/usulan_kgb/detail', $data);
    }


    public function usulan_kgb_terima()
    {
        $id = $this->request->getPost('id');
        $nip = $this->request->getPost('nip');

        if (!$this->validate([
            'nip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIP tidak boleh kosong'
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan tidak boleh kosong'
                ]
            ],
            'golongan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Golongan tidak boleh kosong'
                ]
            ],
            'tanggal_sk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal SK tidak boleh kosong'
                ]
            ],
            'no_sk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No SK tidak boleh kosong'
                ]
            ],
            'tmt' => [
                'required',
                'errors' => [
                    'required' => 'TMT Berkala tidak boleh kosong'
                ]
            ],
            'masa_kerja_tahun' => [
                'required',
                'errors' => [
                    'required' => 'Masa kerja tahun tidak boleh kosong'
                ]
            ],
            'masa_kerja_bulan' => [
                'required',
                'errors' => [
                    'required' => 'Masa kerja bulan tidak boleh kosong'
                ]
            ],
            'gaji_pokok_lama' => [
                'required',
                'errors' => [
                    'required' => 'Gaji pokok lama tidak boleh kosong'
                ]
            ],
            'gaji_pokok_baru' => [
                'required',
                'errors' => [
                    'required' => 'Gaji pokok baru tidak boleh kosong'
                ]
            ],
            'file_sk' => [
                'max_size[file_sk,5120]', 'mime_in[file_sk,file_sk,application/pdf,application/force-download,application/x-download]', 'uploaded[file_sk]',
                'errors' => [
                    'max_size' => 'Ukuran berkas SK KGB harus  kurang dari 5 MB',
                    'mime_in' => 'Berkas SK KGB harus memiliki format PDF',
                    'uploaded' => 'Berkas SK KGB tidak boleh kosong',
                ]
            ]
        ])) {
            session()->setFlashdata('error_input', $this->validator->listErrors());
            return redirect()->to(base_url() . '/admin/usulan_kgb/detail/' . $id)->withInput();
        }

        $tmt = $this->request->getPost('tmt');

        // SK KGB
        $file_sk = $this->request->getFile('file_sk');
        $file_sk_nama = $nip . '-kgb-' . $file_sk->getRandomName();
        $file_sk->move('public/files/kgb', $file_sk_nama);

        $this->KgbMonitoringModel->save([
            'nip' => $nip,
            'tmt' => $tmt,
            'jabatan' => $this->request->getPost('jabatan'),
            'golongan' => $this->request->getPost('golongan'),
            'tanggal_sk' => $this->request->getPost('tanggal_sk'),
            'no_sk' => $this->request->getPost('no_sk'),
            'tmt' => $this->request->getPost('tmt'),
            'masa_kerja_tahun' => $this->request->getPost('masa_kerja_tahun'),
            'masa_kerja_bulan' => $this->request->getPost('masa_kerja_bulan'),
            'gaji_pokok_lama' => str_replace('.', '', $this->request->getPost('gaji_pokok_lama')),
            'gaji_pokok_baru' => str_replace('.', '', $this->request->getPost('gaji_pokok_baru')),
            'file_sk' => $file_sk_nama,
            'createdBy' => session()->get('nip'),
            'createdAt' => time()
        ]);

        $this->KgbModel->save([
            'id' => $id,
            'file_kgb' => $file_sk_nama,
            'status' => 'accepted',
            'updatedAt' => time(),
            'updatedBy' => session()->get('nip')
        ]);

        session()->setFlashdata('success', 'Berhasil menerima usulan KGB milik ' . $nip);
        return redirect()->to(base_url() . '/admin/kgb/');
    }

    public function usulan_kgb_tolak()
    {
        $id = $this->request->getPost('id');
        if (!$this->validate([
            'komentar' => [
                'required',
                'errors' => [
                    'required' => 'Komentar tidak boleh kosong'
                ]
            ],
        ])) {
            session()->setFlashdata('error_input', $this->validator->listErrors());
            return redirect()->to(base_url() . '/admin/usulan_kgb/detail/' . $id)->withInput();
        }

        $this->KgbModel->save([
            'id' => $id,
            'komentar' => $this->request->getPost('komentar'),
            'status' => 'declined',
            'updatedAt' => time(),
            'updatedBy' => session()->get('nip')
        ]);

        session()->setFlashdata('success', 'Berhasil menolak usulan KGB');
        return redirect()->to(base_url() . '/admin/usulan_kgb/detail/' . $id);
    }

    public function kelola_pengguna()
    {
        $pengguna = $this->PegawaiModel->select('pengguna.id as penggunaId, pengguna.tipePengguna, pengguna.status, pegawai.*')->join('pengguna', 'pengguna.username = pegawai.nip', 'left')->findAll();
        $data = [
            'title' => 'Kelola Pengguna',
            'pengguna' => $pengguna
        ];
        return view('admin/kelola_pengguna', $data);
    }

    public function perbaharui_pengguna()
    {
        $penggunaId = $this->request->getPost('penggunaId');
        $tipePengguna = $this->request->getPost('tipePengguna');
        $statusPengguna = $this->request->getPost('statusPengguna');
        $password = $this->request->getPost('password');

        $this->PenggunaModel->save([
            'id' => $penggunaId,
            'tipePengguna' => $tipePengguna,
            'status' => $statusPengguna
        ]);

        if ($password != '') {
            $this->PenggunaModel->save([
                'id' => $penggunaId,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
        }

        session()->setFlashdata('success', 'Berhasil memperbaharui data pengguna');
        return redirect()->to(base_url() . '/admin/kelola_pengguna');
    }

    public function daftar_pengguna()
    {
        $nip = $this->request->getPost('nip');
        $tipePengguna = $this->request->getPost('tipePengguna');
        $statusPengguna = $this->request->getPost('statusPengguna');
        $password = $this->request->getPost('password');

        $this->PenggunaModel->save([
            'username' => $nip,
            'tipePengguna' => $tipePengguna,
            'status' => $statusPengguna,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        session()->setFlashdata('success', 'Berhasil mendaftarkan pengguna');
        return redirect()->to(base_url() . '/admin/kelola_pengguna');
    }
}
