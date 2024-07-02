<?php

namespace App\Models;

use CodeIgniter\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_lengkap',
        'email',
        'nim_nis',
        'jenis_user',
        'instansi_pendidikan',
        'nama_instansi',
        'keterangan',
        'status',
        'lokasi',
        'foto_profile',
        'foto_absen',
        'checkin_time',
        'checkout_time',
        'waktu_absen'
    ];

    public function getTotalAbsensiByStatus($nimUser, $status)
    {
        return $this->where('nim_nis', $nimUser)->where('status', $status)->where('DATE_FORMAT(waktu_absen, "%Y-%m")', date('Y-m'))->countAllResults();
    }

    public function getDataByDateRange($startDate, $endDate)
    {
        return $this->where('waktu_absen >=', $startDate)->where('waktu_absen <=', $endDate)->orderBy('waktu_absen', 'asc')->orderBy('id', 'asc')->get()->getResultArray();
    }
    public function getDataByDateRangeSSW($startDate, $endDate)
    {
        return $this->where('waktu_absen >=', $startDate)->where('waktu_absen <=', $endDate)->where('jenis_user', 'Siswa')->orderBy('waktu_absen', 'asc')->orderBy('id', 'asc')->get()->getResultArray();
    }
    public function getDataByDateRangeMHS($startDate, $endDate)
    {
        return $this->where('waktu_absen >=', $startDate)->where('waktu_absen <=', $endDate)->where('jenis_user', 'Mahasiswa')->orderBy('waktu_absen', 'asc')->orderBy('id', 'asc')->get()->getResultArray();
    }


}