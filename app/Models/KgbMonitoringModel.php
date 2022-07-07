<?php

namespace App\Models;

use CodeIgniter\Model;

class KgbMonitoringModel extends Model
{
    protected $table      = 'kgb_monitoring';
    protected $allowedFields = ['nip', 'jabatan', 'golongan', 'no_sk', 'tanggal_sk', 'tmt', 'masa_kerja_tahun', 'masa_kerja_bulan', 'gaji_pokok_lama', 'gaji_pokok_baru', 'createdAt', 'createdBy'];
}
