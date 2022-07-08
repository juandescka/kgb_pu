<?php

namespace App\Models;

use CodeIgniter\Model;

class KgbModel extends Model
{
    protected $table      = 'kgb';
    protected $allowedFields = ['nip', 'sk_pangkat_terakhir', 'sk_berkala_terakhir', 'skp_terakhir', 'surat_pengantar', 'tmt', 'status', 'komentar', 'file_kgb', 'createdAt', 'createdBy', 'updatedAt', 'updatedBy'];
}
