<!DOCTYPE html>
<html lang="                                                                                                             en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Data Recap Monthly</title>
    <a href=""></a>
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
        }
        .legend {
            background-color: #2C4250;
            color: white;
            padding: 10px;
            text-align: left;
            
            display: inline-block;
            max-width: 300px;
            border-radius: 5px; 
        }
        .legend p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="img">
<img src="<?= base_url('admin') ?>/img/pusdatin.jpg" />
</div>

<div class="header">
    <h1>PUSAT DATA DAN TEKNOLOGI INFORMASI</h1>
    <h2>SEKRETARIAT JENDERAL</h2>
    <h3>KEMENTERIAN PERHUBUNGAN</h3>
</div>

<div class="header1">
<p><b>ATTENDANCE DATA RECAP MONTHLY</b></p>
<p><b>JULY 2024</b></p>
</div>

<table>
    <tr>
        <th>NO</th>
        <th>FULL NAME</th>
        <th>NIM/NIS</th>
        <th>SCHOOL NAME</th>
        <?php for ($i = 1; $i <= 31; $i++) { ?>
            <th><?php echo $i; ?></th>
        <?php } ?>
        <th>Total Absences</th>
    </tr>
    <?php
    $no = 1;
    foreach ($dataUser as $usr) { ?>
        <tr>
            <td><?= $nomor; ?></td>
            <td><?= $nama_lengkap['nama_lengkap']; ?></td>
            <td><?= $nim_nis['nim_nis']; ?></td>
            <td><?= $nama_instansi['nama_instansi']; ?></td>
            <?php 
            $totalAbsences = 0;
            for ($i = 1; $i <= 31; $i++) {
                $day = 'day' . $i;
                $attendance = isset($user['attendance'][$day]) ? $user['attendance'][$day] : 'A'; // Default to 'A' if not set
                if ($attendance == 'S' || $attendance == 'P' || $attendance == 'AB') {
                    $totalAbsences++;
                }
                echo "<td>{$attendance}</td>";
            } ?>
            <td><?= $totalAbsences; ?></td>
        </tr>
    <?php } ?>
</table>

<div class="legend">
    <p>S = SICK/SAKIT</p>
    <p>P = PERMIT/IZIN</p>
    <p>AB = ABSENCES/ALPHA</p>
    <p>A = ATTEND/HADIR</p>
    <p>T = TOTAL</p>
</div>

<div class="footer">
    <p>Created on July 17 2024</p>
</div>

</body>
</html>
