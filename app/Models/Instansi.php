<?php

namespace App\Models;

use CodeIgniter\Model;

class Instansi extends Model
{
    protected $table = 'instansi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_instansi', 'foto_instansi'];

    public function getLogo($nama_instansi)
    {
        return $this->where('nama_instansi', $nama_instansi)->first();
    }
}