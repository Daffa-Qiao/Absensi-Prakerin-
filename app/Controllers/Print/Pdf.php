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
    public function generatePDF()
    {
        function countDaysInCurrentMonth()
        {
            // Mendapatkan tahun dan bulan saat ini
            $year = date('Y');
            $month = date('m');

            // Menghitung jumlah hari dalam bulan ini
            $daysInMonth = date('t', strtotime("$year-$month-01"));

            return $daysInMonth;
        }

        function getWeekendsInCurrentMonth()
        {
            $year = date('Y');
            $month = date('m');

            // Array untuk menyimpan tanggal Sabtu dan Minggu
            $weekends = [];

            // Menentukan jumlah hari dalam bulan ini
            $daysInMonth = date('t', strtotime("$year-$month-01"));

            // Loop untuk setiap hari dalam bulan ini
            for ($day = 1; $day <= $daysInMonth; $day++) {
                // Membuat tanggal dari tahun, bulan, dan hari
                $date = "$year-$month-$day";
                $timestamp = strtotime($date);

                // Mengambil nama hari dari timestamp
                $dayOfWeek = date('l', $timestamp);

                // Memeriksa apakah hari adalah Sabtu atau Minggu
                if ($dayOfWeek == 'Saturday' || $dayOfWeek == 'Sunday') {
                    $weekends[] = $date;
                }
            }

            return $weekends;
        }

        function formatedDate()
        {
            $currentDate = new DateTime();

            $formattedDate = $currentDate->format('j F Y');

            return $formattedDate;
        }

        $absensi = new Absensi();
        $user = new MemberModel();
        $dataUser = $user->where('jenis_user', 'Student')->orderBy('nama_lengkap', 'asc')->findAll();
        $absensiInfo = $absensi->where("DATE_FORMAT(waktu_absen,'%Y-%m')", date('Y-m'))->select('nim_nis, jenis_user')->distinct('nim_nis')->get()->getResult();
        $totalAbsensi = [];
        foreach ($absensiInfo as $nim_nis) {
            $nimUser = $nim_nis->nim_nis;
            $totalAbsensi[$nimUser]['masuk'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Masuk');
            $totalAbsensi[$nimUser]['izin'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Izin');
            $totalAbsensi[$nimUser]['sakit'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Sakit');
            $totalAbsensi[$nimUser]['alpa'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Alpa');
        }

        $data = [
            'absensiModel' => $absensi,
            'dataAbsen' => $absensiInfo,
            'dataUser' => $dataUser,
            'user' => $user,
            'totalAbsensi' => $totalAbsensi,
            'jumlahTanggal' => countDaysInCurrentMonth(),
            'weekend' => getWeekendsInCurrentMonth(),
            'date' => formatedDate()
        ];
        // Load view with data
        $html = view('admin/v_rekapData', $data);

        // Initialize DOMPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML to DOMPDF
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A2', 'landscape');

        // Render PDF
        $dompdf->render();

        // Stream the PDF to the browser
        $dompdf->stream('attendance_recap.pdf', ['Attachment' => 1]);
    }




}