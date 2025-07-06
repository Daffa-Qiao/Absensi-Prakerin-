<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.jqueryui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.jqueryui.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Data Recap Monthly</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
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
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #2C4250;
            color: white;
        }

        .weekend {
            background-color: red;
            color: black;
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
        }

        .legend p {
            margin: 5px 0;
        }

        .buttons-container {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <!-- <img src="path/to/your/logo.png" alt="Logo"> -->
        <h1>PUSAT DATA DAN TEKNOLOGI INFORMASI <br>SEKRETARIAT JENDERAL <br>KEMENTERIAN PERHUBUNGAN</h1>
    </div>

    <div class="header1">
        <p><b>MONTHLY ATTENDANCE SUMMARY</b></p>
        <p><b><?= strtoupper(date('F Y', strtotime($tahun . '-' . $bulan))) ?></b></p>
    </div>

    <table id="table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Name</th>
                <th rowspan="2">NIM/NIS</th>
                <th rowspan="2">School Name</th>
                <th colspan="31">Date</th>
                <th colspan="5">Total Absences</th>
            </tr>
            <tr>
                <?php
                for ($day = 1; $day <= $jumlahTanggal; $day++) {
                    echo "<th>$day</th>";
                }
                ?>
                <th>A</th>
                <th>AB</th>
                <th>S</th>
                <th>P</th>
                <th>T</th>
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
                        if ($day < 10) {
                            $day = '0' . $day;
                        }
                        $statusUser = $absensiModel->getStatusByDateSsw($v->nim_nis, $day);
                        if (in_array($day, $weekend)) {
                            echo '<td style="background-color: red"></td>';
                        } else {
                            // Check user status
                            if ($statusUser) {
                                if ($statusUser->status == 'Masuk') {
                                    echo '<td>A</td>';
                                } else if ($statusUser->status == 'Alpa') {
                                    echo '<td>AP</td>';
                                } else if ($statusUser->status == 'Sakit') {
                                    echo '<td>S</td>';
                                } else if ($statusUser->status == 'Izin') {
                                    echo '<td>P</td>';
                                }
                            } else {
                                // If no status is found, use default placeholder
                                echo '<td>-</td>';
                            }
                        }
                    }

                    ?>

                    <td><?= $totalAbsensi[$v->nim_nis]['masuk']; ?></td>
                    <td><?= $totalAbsensi[$v->nim_nis]['alpa']; ?></td>
                    <td><?= $totalAbsensi[$v->nim_nis]['sakit']; ?></td>
                    <td><?= $totalAbsensi[$v->nim_nis]['izin']; ?></td>
                    <td><?= $totalAbsensi[$v->nim_nis]['izin'] + $totalAbsensi[$v->nim_nis]['sakit'] + $totalAbsensi[$v->nim_nis]['alpa']; ?></td>
                </tr>
            <?php $nomor++;
            } ?>
        </tbody>
    </table>

    <div class="legend">
        <p><b>S = SICK/SAKIT</b></p>
        <p><b>P = PERMIT/IZIN</b></p>
        <p><b>AB = ALPA/BOLOS</b></p>
        <p><b>A = ATTEND/HADIR</b></p>
        <p><b>T = TOTAL ABSENCE</b></p>
    </div>

    <div class="footer">
        <p><b>Created on <?= date('F d Y') ?></b></p>
    </div>

</body>

</html>
