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

    // Menghitung total absensi masuk (status "A" untuk hadir)
    public function getTotalAbsensiMasuk($nimUser)
    {
        return $this->where('nim_nis', $nimUser)
            ->where('status', 'A')
            ->where('DATE_FORMAT(waktu_absen, "%Y-%m")', date('Y-m'))
            ->countAllResults();
    }

    // Fungsi untuk mengecek apakah sudah ada absensi pada tanggal tertentu untuk siswa
    public function isAlreadyCheckedIn($nim_nis, $date)
    {
        return $this->where('nim_nis', $nim_nis)
            ->where('DATE(waktu_absen)', $date)
            ->countAllResults() > 0;
    }

    // Fungsi untuk menyimpan data absen jika belum ada absen untuk tanggal tersebut
    public function saveAttendance($data)
    {
        // Ekstrak tanggal dari waktu_absen
        $date = date('Y-m-d', strtotime($data['waktu_absen']));

        if (!$this->isAlreadyCheckedIn($data['nim_nis'], $date)) {
            return $this->insert($data);
        } else {
            return false;  // Mengembalikan false jika absen sudah ada
        }
    }

    public function getTotalAbsensiByStatus($nimUser, $status)
    {
        return $this->where('nim_nis', $nimUser)
            ->where('status', $status)
            ->where('DATE_FORMAT(waktu_absen, "%Y-%m")', date('Y-m'))
            ->countAllResults();
    }

    public function getDataByDateRange($startDate, $endDate,$nimUser)
    {
        return $this->where('waktu_absen >=', $startDate)
            ->where('waktu_absen <=', $endDate)
            ->orderBy('waktu_absen', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->getResultArray();
    }

    public function getDataByDateRangeSSW($startDate, $endDate)
    {
        return $this->where('waktu_absen >=', $startDate)
            ->where('waktu_absen <=', $endDate)
            ->where('jenis_user', 'Student')
            ->orderBy('waktu_absen', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->getResultArray();
    }

    public function getDataByDateRangeMHS($startDate, $endDate)
    {
        return $this->where('waktu_absen >=', $startDate)
            ->where('waktu_absen <=', $endDate)
            ->where('jenis_user', 'College Student')
            ->orderBy('waktu_absen', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->getResultArray();
    }
    public function getStatusByDateSsw($nimUser, $date = null)
    {
        $currentYearMonth = date('Y-m');
        $fullDate = $currentYearMonth . '-' . $date;
        return $this->select('status, waktu_absen')->where('nim_nis', $nimUser)
            ->where('DATE_FORMAT(waktu_absen, "%Y-%m-%d")', date($fullDate))->get()->getRow();
    }
}