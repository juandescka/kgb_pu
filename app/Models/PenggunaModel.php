<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table      = 'pengguna';
    protected $allowedFields = ['username', 'password', 'tipePengguna', 'status', 'createdAt', 'createdBy', 'updatedAt', 'updatedBy'];

    // public function getEmployeeDetail()
    // {
    //     $query = $this->select('tb_pegawai.id as personId, tb_pegawai.nama as personName, tb_pegawai.nip as personNo, tb_jabatan.nama_jabatan as jobName, tb_unor.nama_unor as orgName, tb_unor.id as orgId')
    //         ->join('db_d_ekin.tb_jabatan', 'tb_jabatan.id_pegawai = tb_pegawai.id')
    //         ->join('db_d_ekin.tb_unor', 'tb_unor.id = tb_jabatan.id_unor');
    //     return $query;
    // }
}
