<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Makassar");
        session();
    }

    public function index()
    {
        $db = db_connect();
        $pegawai = $db->query("SELECT kgb_monitoring.*, DATE_ADD(tmt, INTERVAL 2 YEAR) as tmtBerkalaBerikut, pegawai.nip, pegawai.nama, pegawai.pd FROM pegawai
        INNER JOIN kgb_monitoring ON kgb_monitoring.nip = pegawai.nip
        WHERE (
            kgb_monitoring.tmt = (
                SELECT MAX(tmt) FROM kgb_monitoring WHERE nip = pegawai.nip
            ) OR kgb_monitoring.tmt IS NULL
        ) 
        ORDER BY tmtBerkalaBerikut ASC")->getResult('array');

        $data = [
            'pegawai' => $pegawai
        ];
        return view('dashboard/index', $data);
    }

    public function test()
    {
        dd('a');
    }
}
