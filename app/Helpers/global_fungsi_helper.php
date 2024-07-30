<?php
function kirim_email($attachment, $to, $title, $message)
{
    $email = \Config\Services::email();
    $email_pengirim = EMAIL_ALAMAT;
    $email_nama = EMAIL_NAMA;

    $config['protocol'] = 'smtp';
    $config['SMTPHost'] = 'smtp.gmail.com';
    $config['SMTPUser'] = $email_pengirim;
    $config['SMTPPass'] = EMAIL_PASSWORD;
    $config['SMTPPort'] = 465;
    $config['SMTPCrypto'] = 'ssl';
    $config['mailType'] = 'html';

    $email->initialize($config);
    $email->setFrom($email_pengirim, $email_nama);
    $email->setTo($to);

    if ($attachment) {
        $email->attach($attachment);
    }

    $email->setSubject($title);
    $email->setMessage($message);


    if (!$email->send()) {
        $data = $email->printDebugger(['headers']);
        print_r($data);
        return false;
    } else {
        return true;
    }

    /**
     * Summary of nomor
     * @param mixed $currentPage
     * @param mixed $jumlahBaris
     * @return float|int
     */

}
function nomor($currentPage, $jumlahBaris)
{
    if (is_null($currentPage)) {
        $nomor = 1;
    } else {
        $nomor = 1 + ($jumlahBaris * ($currentPage - 1));
    }
    return $nomor;
}

function tanggal_indo($date) {
    // Array nama bulan
    $bulan = [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ];

    // Array nama hari
    $hari = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday',
    ];

    // Konversi tanggal ke format yang diinginkan
    $timestamp = strtotime($date);
    $day = date('d', $timestamp);
    $month = date('n', $timestamp);
    $year = date('Y', $timestamp);
    $dayOfWeek = date('N', $timestamp);

    // Format tanggal menjadi string
    $formatted_date = $hari[$dayOfWeek] . ', ' . sprintf('%02d', $day) . ' ' . $bulan[$month] . ' ' . $year;
    
    return $formatted_date;
}


               

function purify($dirty_html)
{
    $config = HTMLPurifier_Config::createDefault();
    $config->set('URI.AllowedSchemes', array('data' => true));
    $purifier = new HTMLPurifier($config);
    $clean_html = $purifier->purify($dirty_html);
    return $clean_html;
}

function notif_swal($icon, $title)
{
    session()->setFlashdata('swal_icon', $icon);
    session()->setFlashdata('swal_title', $title);
}

/** Buat halaman index */
function notif_swal_dua($icon, $text)
{
    session()->setFlashdata('swal_icon2', $icon);
    session()->setFlashdata('swal_text2', $text);
}

/** Buat berhasil absen */
function notif_swal_tiga($icon, $text, $title)
{
    session()->setFlashdata('swal_icon3', $icon);
    session()->setFlashdata('swal_text3', $text);
    session()->setFlashdata('swal_title3', $title);
}
function notif_role($icon, $title)
{
    session()->setFlashdata('role_icon', $icon);
    session()->setFlashdata('role_title', $title);
}