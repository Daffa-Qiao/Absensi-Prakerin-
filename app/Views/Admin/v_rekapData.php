<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
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
        }

        .header1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
            float: left;
        }

        .header h1 {
            margin: 0;
            font-size: 15px;
        }

        .header h2, .header h3 {
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

<div class="img">
        <img src="<?= base_url('admin') ?>/img/pusdatin.jpg"/>
    </div>

    <div class="header">
        <h1>PUSAT DATA DAN TEKNOLOGI INFORMASI</h1>
        <h2>SEKRETARIAT JENDERAL</h2>
        <h3>KEMENTERIAN PERHUBUNGAN</h3>
    </div>

    <div class="header1">
        <p><b>ATTENDANCE DATA RECAP MONTHLY</b></p>
        <p><b><?= date('F Y') ?></b></p>
    </div>

    <table id="table">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">FULL NAME</th>
                <th rowspan="2">NIM/NIS</th>
                <th rowspan="2">SCHOOL NAME</th>
                <th colspan="30">DATE</th> 
                <th colspan="5">Total Absences</th>
            </tr>
            <tr>
                <?php
                $currentMonth = date('m');
                $currentYear = date('Y');
                $numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); 

                for ($day = 1; $day <= $numDays; $day++) {
                    echo "<th>$day</th>";
                }
                ?>
                <th>A</th>
                <th>AB</th>
                <th>S</th>
                <th>P</th>
                <th>TA</th>
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
                $jenis_user = $dataUser ? $dataUser->jenis_user : $v->jenis_user; ?>
                <tr>
                    <td><?= $nomor; ?></td>
                    <td><?= $namaLengkap; ?></td>
                    <td><?= $nim_nis ?></td>
                    <td><?= $nama_instansi ?></td>

                    <?php
                    for ($day = 1; $day <= $numDays; $day++) {
                        echo "<td> - </td>";
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
        <p>S = SICK/SAKIT</p>
        <p>P = PERMIT/IZIN</p>
        <p>AP = ALPA/BOLOS</p>
        <p>A = ATTEND/HADIR</p>
        <p>TA = TOTAL ABSENCE</p>
    </div>

    <div class="footer">
        <p>Created on <?= date('Y-m-d') ?></p>
    </div>

</body>

</html>