<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'member_id';
    protected $allowedFields = [
        'username',
        'no_hp',
        'email',
        'password',
        'nama_lengkap',
        'nim_nis',
        'jenis_kelamin',
        'foto',
        'instansi_pendidikan',
        'nama_instansi',
        'level',
        'is_verifikasi',
        'token',
        'nama_pembimbing',
        'no_pembimbing',
        'status',
    ];

    public function getUser($jenis_user)
    {
        return $this->where('jenis_user', $jenis_user)->countAllResults();
    }
    public function getTotalUser($jenis_user)
    {
        return $this->table->findALL()->countAllResults();
    }

    public function getJumlahInstansi($jenis_instansi)
    {
        return $this->where('instansi_pendidikan', $jenis_instansi)->select('nama_instansi')->distinct()->countAllResults();
    }

    public function getSuperAdmin($role)
    {
        return $this->where('level', $role)->countAllResults();
    }
}
