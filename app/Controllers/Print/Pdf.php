<?php

namespace App\Controllers\Print;

use App\Controllers\BaseController;
use App\Models\Absensi;
use App\Models\MemberModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use DateTime;

class Pdf extends BaseController
{
    private function countDaysInMonth($year, $month)
    {
        return (int)date('t', strtotime("$year-$month-01"));
    }

    private function getWeekendsInMonth($year, $month)
    {
        $weekends = [];
        $daysInMonth = $this->countDaysInMonth($year, $month);

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = "$year-$month-$day";
            $timestamp = strtotime($date);
            $dayOfWeek = date('l', $timestamp);

            if ($dayOfWeek === 'Saturday' || $dayOfWeek === 'Sunday') {
                $weekends[] = $day;
            }
        }
        return $weekends;
    }

    private function getDayName($year, $month, $day)
    {
        $date = "$year-$month-$day";
        $timestamp = strtotime($date);
        return date('D', $timestamp); // Returns Mon, Tue, Wed, etc.
    }
    
    public function generatePDF()
    {
        $absensi = new Absensi();
        $user = new MemberModel();
        $bulan = $this->request->getVar('bulan') ?? date('m');
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $namaLengkap = $this->request->getVar('namaLengkap');

        $dataUser = $user->where('jenis_user', 'Student')->orderBy('nama_lengkap', 'asc')->findAll();
        
        $absensiQuery = $absensi->where("DATE_FORMAT(waktu_absen, '%Y-%m')", "$tahun-$bulan")
                               ->select('nim_nis, jenis_user')
                               ->distinct('nim_nis');
        
        if ($namaLengkap && $namaLengkap !== 'all') {
            $nim_nis_result = $user->where('nama_lengkap', $namaLengkap)->first();
            if ($nim_nis_result) {
                $absensiQuery->where('nim_nis', $nim_nis_result['nim_nis']);
            } else {
                $absensiQuery->where('nim_nis', null);
            }
        }

        $absensiInfo = $absensiQuery->get()->getResult();

        $totalAbsensi = [];
        $dailyAttendance = [];
        
        foreach ($absensiInfo as $nim_nis) {
            $nimUser = $nim_nis->nim_nis;
            $totalAbsensi[$nimUser]['masuk'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Masuk', $bulan, $tahun);
            $totalAbsensi[$nimUser]['izin'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Izin', $bulan, $tahun);
            $totalAbsensi[$nimUser]['sakit'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Sakit', $bulan, $tahun);
            $totalAbsensi[$nimUser]['alpa'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Alpa', $bulan, $tahun);
            
            // Get daily attendance for this user
            $daysInMonth = $this->countDaysInMonth($tahun, $bulan);
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $formattedDay = str_pad($day, 2, '0', STR_PAD_LEFT);
                $statusUser = $absensi->getStatusByDateSsw($nimUser, $tahun, $bulan, $formattedDay);
                $dailyAttendance[$nimUser][$day] = $statusUser ? $statusUser->status : null;
            }
        }

        $data = [
            'absensiModel' => $absensi,
            'dataAbsen' => $absensiInfo,
            'dataUser' => $dataUser,
            'user' => $user,
            'totalAbsensi' => $totalAbsensi,
            'dailyAttendance' => $dailyAttendance,
            'jumlahTanggal' => $this->countDaysInMonth($tahun, $bulan),
            'weekend' => $this->getWeekendsInMonth($tahun, $bulan),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];
        
        // Load detailed view by default
        $html = view('admin/v_rekapDataDetailed', $data);

        // Initialize DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML to DOMPDF
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A2', 'landscape');

        // Render PDF
        $dompdf->render();

        // Stream the PDF to the browser
        $dompdf->stream('attendance_rekap.pdf', ['Attachment' => 0]);
    }

    // New method for detailed daily attendance report
    public function generateDetailedPDF()
    {
        $absensi = new Absensi();
        $user = new MemberModel();
        $bulan = $this->request->getVar('bulan') ?? date('m');
        $tahun = $this->request->getVar('tahun') ?? date('Y');
        $namaLengkap = $this->request->getVar('namaLengkap');

        $dataUser = $user->where('jenis_user', 'Student')->orderBy('nama_lengkap', 'asc')->findAll();
        
        $absensiQuery = $absensi->where("DATE_FORMAT(waktu_absen, '%Y-%m')", "$tahun-$bulan")
                               ->select('nim_nis, jenis_user')
                               ->distinct('nim_nis');
        
        if ($namaLengkap && $namaLengkap !== 'all') {
            $nim_nis_result = $user->where('nama_lengkap', $namaLengkap)->first();
            if ($nim_nis_result) {
                $absensiQuery->where('nim_nis', $nim_nis_result['nim_nis']);
            } else {
                $absensiQuery->where('nim_nis', null);
            }
        }

        $absensiInfo = $absensiQuery->get()->getResult();

        $totalAbsensi = [];
        foreach ($absensiInfo as $nim_nis) {
            $nimUser = $nim_nis->nim_nis;
            $totalAbsensi[$nimUser]['masuk'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Masuk', $bulan, $tahun);
            $totalAbsensi[$nimUser]['izin'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Izin', $bulan, $tahun);
            $totalAbsensi[$nimUser]['sakit'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Sakit', $bulan, $tahun);
            $totalAbsensi[$nimUser]['alpa'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Alpa', $bulan, $tahun);
        }

        $data = [
            'absensiModel' => $absensi,
            'dataAbsen' => $absensiInfo,
            'dataUser' => $dataUser,
            'user' => $user,
            'totalAbsensi' => $totalAbsensi,
            'jumlahTanggal' => $this->countDaysInMonth($tahun, $bulan),
            'weekend' => $this->getWeekendsInMonth($tahun, $bulan),
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];
        
        // Load summary view for comparison
        $html = view('admin/v_rekapData', $data);

        // Initialize DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML to DOMPDF
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A2', 'landscape');

        // Render PDF
        $dompdf->render();

        // Stream the PDF to the browser
        $dompdf->stream('attendance_summary_rekap.pdf', ['Attachment' => 0]);
    }
}