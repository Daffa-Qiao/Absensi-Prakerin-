<?php

namespace App\Controllers\Print;

use App\Controllers\BaseController;
use App\Models\Absensi;
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



        $data = [
            'dataAbsen' => session('dataAbsen'),
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
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Stream the PDF to the browser
        $dompdf->stream('attendance_recap.pdf', ['Attachment' => 1]);
    }




}