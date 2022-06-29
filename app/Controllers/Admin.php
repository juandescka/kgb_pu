<?php

namespace App\Controllers;

use App\Models\KgbModel;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->KgbModel = new KgbModel();
        date_default_timezone_set("Asia/Makassar");
        session();
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function kgb()
    {
        $data = [
            'kgb' => $this->KgbModel->select('kgb.*, pegawai.nip, pegawai.nama, pegawai.induk, pegawai.pd')->join('pegawai', 'pegawai.nip = kgb.nip')->where('status', 'accepted')->orderBy('id', 'DESC')->findAll()
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
            'file_kgb' => [
                'max_size[file_kgb,5120]', 'mime_in[file_kgb,file_kgb,application/pdf,application/force-download,application/x-download]', 'uploaded[file_kgb]',
                'errors' => [
                    'max_size' => 'Ukuran berkas SK Pangkat Terakhir harus  kurang dari 5 MB',
                    'mime_in' => 'Berkas SK Pangkat terakhir harus memiliki format PDF',
                    'uploaded' => 'SK Pangkat terakhir tidak boleh kosong',
                ]
            ]
        ])) {
            session()->setFlashdata('error_input', $this->validator->listErrors());
            return redirect()->to(base_url() . '/admin/usulan_kgb/detail/' . $id)->withInput();
        }

        // SK PANGKAT TERAKHIR
        $file_kgb = $this->request->getFile('file_kgb');
        $file_kgb_nama = $nip . '-kgb-' . $file_kgb->getRandomName();
        $file_kgb->move('public/files/kgb', $file_kgb_nama);

        $this->KgbModel->save([
            'id' => $id,
            'file_kgb' => $file_kgb_nama,
            'status' => 'accepted',
            'updatedAt' => time(),
            'updatedBy' => session()->get('nip')
        ]);

        session()->setFlashdata('success', 'Berhasil menerima usulan KGB');
        return redirect()->to(base_url() . '/admin/kgb/detail/' . $id);
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

    public function verifikasi()
    {
        return view('admin/verifikasi');
    }
}
