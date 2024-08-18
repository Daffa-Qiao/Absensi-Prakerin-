<!DOCTYPE html>
<html lang="en">
<head>
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
            /* font-family: poppins; */
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
            background-color: #333;
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

    <?php foreach ($attendance_data as $v) { ?>
    <tr>
        <td><?= $v['no']; ?></td>
        <td><?= $v['nama_lengkap']; ?></td>
        <td><?= $v['username']; ?></td>
        <td><?= $v['nama_instansi']; ?></td>
        <?php
        $attendance = $v['attendance']; // $v['attendance'] untuik data yg hadir tiap hari
        $total_a = 0;
        $total_absences = 0;
        foreach ($attendance as $day) {
            if ($day === 'A') $total_a++;
            if (in_array($day, ['A', 'AB'])) $total_absences++;
            $class = $day === 'WEEKEND' ? 'weekend' : '';
            echo "<td class='$class'>$day</td>";
        }
        ?>
        <td><?php echo $total_a; ?></td>
        <td><?php echo $total_absences; ?></td>
    </tr>
    <?php } ?>

</table>

<div class="legend">
    <p>S = SICK/SABIT</p>
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
