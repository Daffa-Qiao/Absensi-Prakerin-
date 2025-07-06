<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            text-align: left;
            transform: translateY(30px);
            font-family: "Poppins", sans-serif;
        }

        .header1 {
            text-align: center;
            margin-bottom: 20px;
            font-family: "Poppins", sans-serif;
        }

        .header img {
            width: 100px;
            float: left;
        }

        .header h1, .header h2, .header h3 {
            margin: 0;
            font-size: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 8px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 4px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #2C4250;
            color: white;
            font-weight: bold;
        }

        .weekend {
            background-color: #ffcccc;
            color: black;
        }

        .date-header {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 7px;
        }

        .day-name {
            font-size: 6px;
            color: #666;
        }

        .status-masuk {
            background-color: #90EE90;
            font-weight: bold;
        }

        .status-izin {
            background-color: #FFD700;
            font-weight: bold;
        }

        .status-sakit {
            background-color: #FFB6C1;
            font-weight: bold;
        }

        .status-alpa {
            background-color: #FF6B6B;
            color: white;
            font-weight: bold;
        }

        .footer {
            text-align: left;
            font-size: 12px;
            margin-top: 20px;
            position: fixed;
            bottom: 0;
            left: 20px;
            width: 100%;
            font-family: "Poppins", sans-serif;
        }

        .legend {
            background-color: #2C4250;
            color: white;
            padding: 10px;
            text-align: left;
            max-width: 300px;
            border-radius: 5px;
            float: right;
            margin-right: 2px;
            font-family: "Poppins", sans-serif;
            font-size: 10px;
        }

        .legend p {
            margin: 5px 0;
        }

        .total-section {
            background-color: #e8f4f8;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>PUSAT DATA DAN TEKNOLOGI INFORMASI <br>SEKRETARIAT JENDERAL <br>KEMENTERIAN PERHUBUNGAN</h1>
    </div>

    <div class="header1">
        <p><b>DETAILED DAILY ATTENDANCE REPORT</b></p>
        <p><b><?= strtoupper(date('F Y', strtotime($tahun . '-' . $bulan))) ?></b></p>
    </div>

    <table id="table">
        <thead>
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Name</th>
                <th rowspan="3">NIM/NIS</th>
                <th rowspan="3">School Name</th>
                <th colspan="<?= $jumlahTanggal ?>">Daily Attendance</th>
                <th colspan="5" class="total-section">Total Summary</th>
            </tr>
            <tr>
                <?php
                for ($day = 1; $day <= $jumlahTanggal; $day++) {
                    $dayName = date('D', strtotime("$tahun-$bulan-$day"));
                    $isWeekend = in_array($day, $weekend);
                    $weekendClass = $isWeekend ? 'weekend' : '';
                    echo "<th class='date-header $weekendClass'>";
                    echo "<div>$day</div>";
                    echo "<div class='day-name'>$dayName</div>";
                    echo "</th>";
                }
                ?>
                <th rowspan="2" class="total-section">(A)</th>
                <th rowspan="2" class="total-section">(AB)</th>
                <th rowspan="2" class="total-section">(S)</th>
                <th rowspan="2" class="total-section">(P)</th>
                <th rowspan="2" class="total-section">(TA)</th>
            </tr>
            <tr>
                <?php
                for ($day = 1; $day <= $jumlahTanggal; $day++) {
                    $formattedDay = str_pad($day, 2, '0', STR_PAD_LEFT);
                    $date = "$tahun-$bulan-$formattedDay";
                    $isWeekend = in_array($day, $weekend);
                    $weekendClass = $isWeekend ? 'weekend' : '';
                    echo "<th class='$weekendClass'>";
                    echo date('d/m', strtotime($date));
                    echo "</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor = 1;
            foreach ($dataAbsen as $v) {
                $dataUser = $user->where('nim_nis', $v->nim_nis)->get()->getRow();

                $namaLengkap = $dataUser ? $dataUser->nama_lengkap : 'User Telah Dihapus';
                $nama_instansi = $dataUser ? $dataUser->nama_instansi : '';
                $nim_nis = $dataUser ? $dataUser->nim_nis : '';
                $jenis_user = $dataUser ? $dataUser->jenis_user : $v->jenis_user;

            ?>
                <tr>
                    <td><?= $nomor; ?></td>
                    <td><?= $namaLengkap; ?></td>
                    <td><?= $nim_nis ?></td>
                    <td><?= $nama_instansi ?></td>

                    <?php
                    for ($day = 1; $day <= $jumlahTanggal; $day++) {
                        $isWeekend = in_array($day, $weekend);
                        $weekendClass = $isWeekend ? 'weekend' : '';
                        
                        if ($isWeekend) {
                            echo '<td class="weekend">-</td>';
                        } else {
                            $status = $dailyAttendance[$v->nim_nis][$day] ?? null;
                            $statusClass = '';
                            $statusText = '-';
                            
                            if ($status) {
                                switch ($status) {
                                    case 'Masuk':
                                        $statusClass = 'status-masuk';
                                        $statusText = 'A';
                                        break;
                                    case 'Alpa':
                                        $statusClass = 'status-alpa';
                                        $statusText = 'AB';
                                        break;
                                    case 'Sakit':
                                        $statusClass = 'status-sakit';
                                        $statusText = 'S';
                                        break;
                                    case 'Izin':
                                        $statusClass = 'status-izin';
                                        $statusText = 'P';
                                        break;
                                }
                            }
                            
                            echo "<td class='$weekendClass $statusClass'>$statusText</td>";
                        }
                    }
                    ?>

                    <td class="total-section"><?= $totalAbsensi[$v->nim_nis]['masuk']; ?></td>
                    <td class="total-section"><?= $totalAbsensi[$v->nim_nis]['alpa']; ?></td>
                    <td class="total-section"><?= $totalAbsensi[$v->nim_nis]['sakit']; ?></td>
                    <td class="total-section"><?= $totalAbsensi[$v->nim_nis]['izin']; ?></td>
                    <td class="total-section"><?= $totalAbsensi[$v->nim_nis]['izin'] + $totalAbsensi[$v->nim_nis]['sakit'] + $totalAbsensi[$v->nim_nis]['alpa']; ?></td>
                </tr>
            <?php $nomor++;
            } ?>
        </tbody>
    </table>

    <div class="legend">
        <p><b>LEGEND:</b></p>
        <p><b>A = Present/Hadir</b></p>
        <p><b>AB = Absent/Alpa</b></p>
        <p><b>S = Sick/Sakit</b></p>
        <p><b>P = Leave/Izin</b></p>
        <p><b>TA = Total Absent</b></p>
        <p><b>- = No Record</b></p>
        <p><b>Red = Weekend</b></p>
    </div>

    <div class="footer">
        <p><b>Generated on: <?= date('F d, Y H:i:s') ?></b></p>
        <p><b>Period: <?= strtoupper(date('F Y', strtotime($tahun . '-' . $bulan))) ?></b></p>
    </div>

</body>

</html> 