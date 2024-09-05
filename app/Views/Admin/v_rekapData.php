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

    .header h2,
    .header h3 {
        margin: 0;
        font-size: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
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

    .buttons-container {
        margin-top: 10px;
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

    <table id="table">
        <thead>
            <tr>
                <th rowspan="2">NO</th>
                <th rowspan="2">FULL NAME</th>
                <th rowspan="2">NIM/NIS</th>
                <th rowspan="2">SCHOOL NAME</th>
                <th colspan="5">Total Absences</th>
            </tr>
            <tr>
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
            foreach ($dataAbsen as $v) { ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $v->nama_lengkap; ?></td>
                <td><?= $v->nim_nis ?></td>
                <td><?= $v->nama_instansi ?></td>

                <td>20</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
            </tr>
            <?php $nomor++;
            } ?>
        </tbody>
    </table>

    <div class="legend">
        <p>S = SICK/SAKIT</p>
        <p>P = PERMIT/IZIN</p>
        <p>AB = ABSENCES/ALPHA</p>
        <p>A = ATTEND/HADIR</p>
        <p>T = TOTAL</p>
    </div>


    <div class="footer">
        <p>Created on <?= $date ?></p>
    </div>

</body>

</html>
