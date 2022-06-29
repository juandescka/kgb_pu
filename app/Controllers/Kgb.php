<?php

namespace App\Controllers;

use App\Models\KgbModel;

class Kgb extends BaseController
{
    public function __construct()
    {
        $this->KgbModel = new KgbModel();
        date_default_timezone_set("Asia/Makassar");
        session();
    }

    public function tambah()
    {
        return view('kgb/tambah');
    }

    public function simpan()
    {
        if (!$this->validate([
            'nip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIP tidak boleh kosong'
                ]
            ],
            'tahun_usulan' => [
                'required',
                'errors' => [
                    'required' => 'Tahun usulan tidak boleh kosong'
                ]
            ],
            'sk_pangkat_terakhir' => [
                'max_size[sk_pangkat_terakhir,5120]', 'mime_in[sk_pangkat_terakhir,sk_pangkat_terakhir,application/pdf,application/force-download,application/x-download]', 'uploaded[sk_pangkat_terakhir]',
                'errors' => [
                    'max_size' => 'Ukuran berkas SK Pangkat Terakhir harus  kurang dari 5 MB',
                    'mime_in' => 'Berkas SK Pangkat terakhir harus memiliki format PDF',
                    'uploaded' => 'SK Pangkat terakhir tidak boleh kosong',
                ]
            ],
            'sk_berkala_terakhir' => [
                'max_size[sk_berkala_terakhir,5120]', 'mime_in[sk_berkala_terakhir,sk_berkala_terakhir,application/pdf,application/force-download,application/x-download]', 'uploaded[sk_berkala_terakhir]',
                'errors' => [
                    'max_size' => 'Ukuran berkas SK Berkala Terakhir harus  kurang dari 5 MB',
                    'mime_in' => 'Berkas SK Berkala terakhir harus memiliki format PDF',
                    'uploaded' => 'SK Berkala terakhir tidak boleh kosong',
                ]
            ],
            'skp_terakhir' => [
                'max_size[skp_terakhir,5120]', 'mime_in[skp_terakhir,skp_terakhir,application/pdf,application/force-download,application/x-download]', 'uploaded[skp_terakhir]',
                'errors' => [
                    'max_size' => 'Ukuran berkas SKP Terakhir harus  kurang dari 5 MB',
                    'mime_in' => 'Berkas SKP Terakhir harus memiliki format PDF',
                    'uploaded' => 'SKP Terakhir tidak boleh kosong',
                ]
            ],
            'surat_pengantar' => [
                'max_size[surat_pengantar,5120]', 'mime_in[surat_pengantar,surat_pengantar,application/pdf,application/force-download,application/x-download]', 'uploaded[surat_pengantar]',
                'errors' => [
                    'max_size' => 'Ukuran berkas Surat Pengantar harus  kurang dari 5 MB',
                    'mime_in' => 'Berkas Surat Pengantar harus memiliki format PDF',
                    'uploaded' => 'Surat Pengantar tidak boleh kosong',
                ]
            ],
        ])) {
            // dd($this->request->getFile('sk_pangkat_terakhir'));
            session()->setFlashdata('error_input', $this->validator->listErrors());
            return redirect()->to(base_url() . '/kgb/tambah')->withInput();
        }
        $nip = $this->request->getPost('nip');
        $tahun_usulan = $this->request->getPost('tahun_usulan');

        // SK PANGKAT TERAKHIR
        $sk_pangkat_terakhir = $this->request->getFile('sk_pangkat_terakhir');
        $sk_pangkat_terakhir_nama = $nip . '-sk-pangkat-terakhir-' . $sk_pangkat_terakhir->getRandomName();
        $sk_pangkat_terakhir->move('public/files/dokumen_pendukung', $sk_pangkat_terakhir_nama);

        // SK BERKALA TERAKHIR
        $sk_berkala_terakhir = $this->request->getFile('sk_berkala_terakhir');
        $sk_berkala_terakhir_nama = $nip . '-sk-berkala-terakhir-' . $sk_berkala_terakhir->getRandomName();
        $sk_berkala_terakhir->move('public/files/dokumen_pendukung', $sk_berkala_terakhir_nama);

        // SKP TERAKHIR
        $skp_terakhir = $this->request->getFile('skp_terakhir');
        $skp_terakhir_nama = $nip . '-skp-terakhir-' . $skp_terakhir->getRandomName();
        $skp_terakhir->move('public/files/dokumen_pendukung', $skp_terakhir_nama);

        // SURAT PENGANTAR
        $surat_pengantar = $this->request->getFile('surat_pengantar');
        $surat_pengantar_nama = $nip . '-skp-terakhir-' . $surat_pengantar->getRandomName();
        $surat_pengantar->move('public/files/dokumen_pendukung', $surat_pengantar_nama);

        $this->KgbModel->save([
            'nip' => $nip,
            'tahun_usulan' => $tahun_usulan,
            'sk_pangkat_terakhir' => $sk_pangkat_terakhir_nama,
            'sk_berkala_terakhir' => $sk_berkala_terakhir_nama,
            'skp_terakhir' => $skp_terakhir_nama,
            'surat_pengantar' => $surat_pengantar_nama,
            'status' => 'pending',
            'createdBy' => session()->get('nip'),
            'createdAt' => time()
        ]);

        session()->setFlashdata('success', 'Berhasil menambahkan usulan KGB, harap menunggu verifikasi dari admin');
        return redirect()->to(base_url() . '/kgb/riwayat');
    }

    public function edit($id)
    {
        $kgb = $this->KgbModel->where('id', $id)->where('status', 'declined')->first();

        if (!$kgb) {
            session()->setFlashdata('error', 'Usulan KGB tidak ditemukan/masih belum ditolak');
            return redirect()->to(base_url() . '/kgb/riwayat');
        }

        $data = [
            'kgb' => $kgb
        ];
        return view('kgb/edit', $data);
    }

    public function riwayat()
    {
        return view('kgb/riwayat');
    }

    public function riwayat_diterima()
    {
        $data = [
            'kgb' => $this->KgbModel->where('nip', session()->get('nip'))->where('status', 'accepted')->findAll()
        ];
        return view('kgb/riwayat/diterima', $data);
    }

    public function riwayat_ditolak()
    {
        $data = [
            'kgb' => $this->KgbModel->where('nip', session()->get('nip'))->where('status', 'declined')->findAll()
        ];
        return view('kgb/riwayat/ditolak', $data);
    }

    public function riwayat_menunggu_verifikasi()
    {
        $data = [
            'kgb' => $this->KgbModel->where('nip', session()->get('nip'))->where('status', 'pending')->findAll()
        ];
        return view('kgb/riwayat/menunggu_verifikasi', $data);
    }
}
