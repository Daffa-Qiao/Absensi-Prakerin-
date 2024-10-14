<?php

namespace App\Models;

use CodeIgniter\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    protected $allowedFields = [
        'nama_lengkap',
        'email',
        'nim_nis',
        'jenis_user',
        'instansi_pendidikan',
        'nama_instansi',
        'kegiatan',
        'status',
        'lokasi',
        'foto_profile',
        'foto_laporan',
        'waktu_mulai',
        'waktu_selesai'
    ];

    public function getTotalLaporanByStatus($nimUser, $status)
    {
        return $this->where('nim_nis', $nimUser)->where('status', $status)->where('DATE_FORMAT(waktu_absen, "%Y-%m")', date('Y-m'))->countAllResults();
    }

    public function getDataByDateRange($startDate, $endDate)
    {
        return $this->where('waktu_laporan >=', $startDate)->where('waktu_laporan <=', $endDate)->orderBy('waktu_laporan', 'asc')->orderBy('laporan_id', 'asc')->get()->getResultArray();
    }
    public function getDataByDateRangeSSW($startDate, $endDate)
    {
        return $this->where('waktu_laporan >=', $startDate)->where('waktu_laporan <=', $endDate)->where('jenis_user', 'Siswa')->orderBy('waktu_absen', 'asc')->orderBy('laporan_id', 'asc')->get()->getResultArray();
    }
    public function getDataByDateRangeMHS($startDate, $endDate)
    {
        return $this->where('waktu_laporan >=', $startDate)->where('waktu_laporan <=', $endDate)->where('jenis_user', 'Mahasiswa')->orderBy('waktu_absen', 'asc')->orderBy('laporan_id', 'asc')->get()->getResultArray();
    }


}
