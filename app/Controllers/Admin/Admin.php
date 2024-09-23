<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Instansi;
use App\Models\MemberModel;
use App\Models\Laporan;
use App\Models\Absensi;

class Admin extends BaseController
{
    protected $validation;
    protected $helpers = (['url', 'form']);
    function __construct()
    {
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function dashboard()
    {
        $absensi = new Absensi();
        $user = new MemberModel();
        $bulanIni = date('Y-m');

        $absensiInfo = $absensi->where("DATE_FORMAT(waktu_absen,'%Y-%m')", $bulanIni)->select('nim_nis, jenis_user')->distinct('nim_nis')->get()->getResult();
        $totalAbsensi = [];
        foreach ($absensiInfo as $nim_nis) {
            $nimUser = $nim_nis->nim_nis;
            $totalAbsensi[$nimUser]['masuk'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Masuk');
            $totalAbsensi[$nimUser]['izin'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Izin');
            $totalAbsensi[$nimUser]['sakit'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Sakit');
        }

        $jumlahSekolah = $user->getJumlahInstansi('School');
        $jumlahUniv = $user->getJumlahInstansi('College School');
        $totalSiswa = $user->getUser('Student');
        $totalMahasiswa = $user->getUser('College Student');
        $totalUser = $user->where('is_verifikasi', 'yes')->countAllResults();
        $totalSuperAdmin = $user->getSuperAdmin('Super Admin');

        $aktif_dashboard = 'aktif';
        $halaman = 'Admin | Dashboard';
        $title = 'Dashboard';

        $data = [
            'totalAbsensi' => $totalAbsensi,
            'dataAbsen' => $absensiInfo,
            'totalSekolah' => $jumlahSekolah,
            'totalUniv' => $jumlahUniv,
            'totalMahasiswa' => $totalMahasiswa,
            'totalSiswa' => $totalSiswa,
            'aktif_dashboard' => $aktif_dashboard,
            'halaman' => $halaman,
            'title' => $title,
            'totalUser' => $totalUser,
            'totalSuperAdmin' => $totalSuperAdmin,
            'user' => $user
        ];

        return view('Admin/v_dashboard', $data);
    }

    public function data_absen()
    {
        $absensi = new Absensi();
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_absensi');
        $dataAbsen = $absensi->orderBy('waktu_absen', 'desc')->orderBy('id', 'desc')->findAll();
        $nama_lengkap = [];
        foreach ($dataAbsen as $v) {
            $nimUser = $v['nim_nis'];
            $data = $user->where('nim_nis', $nimUser)->get()->getRowArray();
            $nama_lengkap[$nimUser] = $data ? $data['nama_lengkap'] : $v['nama_lengkap'];
        }
        $dataUser = $user->orderBy('nama_lengkap', 'asc')->where('is_verifikasi', 'yes')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);
        $aktif_dataAbsen = 'aktif';
        $halaman = 'Admin | Attendance Data';
        $title = 'Attendance Data';

        $data = [
            'nama_lengkap' => $nama_lengkap,
            'dataUser' => $dataUser,
            'dataAbsen' => $dataAbsen,
            'nomor' => $nomor,
            'aktif_dataAbsen' => $aktif_dataAbsen,
            'halaman' => $halaman,
            'title' => $title,
            'titleSuperAdmin' => 'Super Admin',
        ];

        return view('Admin/v_dataAbsen', $data);
    }

    public function data_absen_filter()
    {
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Load model
        $absensi = new Absensi();
        $dataAbsen = $absensi->getDataByDateRange($startDate, $endDate);

        $data = [
            'dataFilter' => $dataAbsen,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
        session()->setFlashdata('data', $data);

        return redirect()->to('admin/data-absen');
    }

    public function data_siswa()
    {
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_siswa');
        $dataSiswa = $user->where('jenis_user', 'Student')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);
        $aktif_dataUser = 'aktif';
        $aktif_dataSiswa = 'aktif';
        $halaman = 'Admin | Student Data';
        $title = 'Student Data';

        $data = [
            'dataSiswa' => $dataSiswa,
            'nomor' => $nomor,
            'aktif_dataSiswa' => $aktif_dataSiswa,
            'aktif_dataUser' => $aktif_dataUser,
            'halaman' => $halaman,
            'title' => $title,
            'titleSuperAdmin' => 'Super Admin',
        ];

        return view('Admin/v_dataSiswa', $data);
    }
    public function data_mahasiswa()
    {
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_mahasiswa');
        $dataMahasiswa = $user->where('jenis_user', 'College Student')->findAll();

        $nomor = nomor($currentPage, $jumlahBaris);
        $aktif_dataUser = 'aktif';
        $aktif_dataMahasiswa = 'aktif';
        $halaman = 'Admin | Student Data';
        $title = 'Collage Student Data';

        $data = [
            'dataMahasiswa' => $dataMahasiswa,
            'nomor' => $nomor,
            'aktif_dataMahasiswa' => $aktif_dataMahasiswa,
            'aktif_dataUser' => $aktif_dataUser,
            'halaman' => $halaman,
            'title' => $title,
            'titleSuperAdmin' => 'Super Admin',
        ];

        return view('Admin/v_dataMahasiswa', $data);
    }


    public function instansi_sekolah()
    {
        $user = new MemberModel();
        $instansi = new Instansi();
        $dataInstansi = $user->select('nama_instansi, instansi_pendidikan')->where('instansi_pendidikan', 'Sekolah')->distinct('nama_instansi')->get()->getResult();

        foreach ($dataInstansi as $v) {
            $jumlahSiswa[$v->nama_instansi] = $user->where('nama_instansi', $v->nama_instansi)->countAllResults();
            $instansiResult = $instansi->select('nama_instansi, foto_instansi')->where('nama_instansi', $v->nama_instansi)->get()->getRow();
            $namaFile[$v->nama_instansi] = $instansiResult ? $instansiResult->foto_instansi : 'sekolah.png';
        }

        if ($dataInstansi) {
            $data = [
                'namaFile' => $namaFile,
                'jumlahSiswa' => $jumlahSiswa,
                'halaman' => 'Admin | Sekolah',
                'title' => 'Instansi Sekolah',
                'aktif_instansi' => 'active',
                'aktif_sekolah' => 'active',
                'dataInstansi' => $dataInstansi,
            ];
        } else {
            $data = [
                'halaman' => 'Admin | Sekolah',
                'title' => 'Instansi Sekolah',
                'aktif_instansi' => 'active',
                'aktif_sekolah' => 'active',
                'dataInstansi' => $dataInstansi,
            ];
        }
        return view('Admin/v_instansiSekolah', $data);
    }
    public function instansi_universitas()
    {
        $user = new MemberModel();
        $instansi = new Instansi();
        $dataInstansi = $user->select('nama_instansi, instansi_pendidikan')->where('instansi_pendidikan', 'Universitas')->distinct('nama_instansi')->get()->getResult();

        foreach ($dataInstansi as $v) {
            $jumlahSiswa[$v->nama_instansi] = $user->where('nama_instansi', $v->nama_instansi)->countAllResults();
            $instansiResult = $instansi->select('nama_instansi, foto_instansi')->where('nama_instansi', $v->nama_instansi)->get()->getRow();
            $namaFile[$v->nama_instansi] = $instansiResult ? $instansiResult->foto_instansi : 'sekolah.png';
        }

        if ($dataInstansi) {
            $data = [
                'namaFile' => $namaFile,
                'jumlahSiswa' => $jumlahSiswa,
                'halaman' => 'Admin | School',
                'title' => 'School Name',
                'aktif_instansi' => 'active',
                'aktif_universitas' => 'active',
                'dataInstansi' => $dataInstansi,
            ];
        } else {
            $data = [
                'halaman' => 'Admin | Sekolah',
                'title' => 'School Name',
                'aktif_instansi' => 'active',
                'aktif_sekolah' => 'active',
                'dataInstansi' => $dataInstansi,
            ];
        }

        return view('Admin/v_instansiUniversitas', $data);
    }

    public function profile_admin()
    {
        $user = new MemberModel();
        $userID = session()->get('member_id');
        $dataUser = $user->where('member_id', $userID)->first();

        $data = [
            'validation' => null,
            'halaman' => 'Admin | Profile',
            'title' => 'Profile',
            'dataUser' => $dataUser,
            'titleSuperAdmin' => 'Super Admin',
        ];
        return view('Admin/v_profile_admin', $data);
    }

    public function profile_adminProcess()
    {
        $user = new MemberModel();
        $userID = session()->get('member_id');
        $dataUser = $user->where('member_id', $userID)->first();

        // input user
        $nama_lengkap = ucwords($this->request->getVar('nama_lengkap'));
        $nim_nis = $this->request->getVar('nim_nis');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $no_hp = $this->request->getVar('no_hp');
        $email = $this->request->getVar('email');
        $nama_instansi = strtoupper($this->request->getVar('nama_instansi'));
        $foto_profile = $this->request->getFile('foto_profile');
        $nama_pembimbing = $this->request->getVar('nama_pembimbing');
        $no_pembimbing = $this->request->getVar('no_pembimbing');


        $rules = $this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Full name must be filled in',
                ]
            ],
            'nim_nis' => [
                'rules' => 'required|is_unique[member.nim_nis, member_id, ' . $userID . ']',
                'errors' => [
                    'required' => 'NIM / NIS must be filled in',
                    'is_unique' => 'NIM/NIS is already registered'
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[member.username, member_id, ' . $userID . ']|regex_match[/^\S+$/]',
                'errors' => [
                    'required' => 'Username must be filled in',
                    'is_unique' => 'Username is already registered',
                    'regex_match' => 'Username must not use spaces'
                ]
            ],
            'password' => [
                'rules' => 'required|regex_match[/^\S+$/]',
                'errors' => [
                    'required' => 'Password required',
                    'regex_match' => 'Password must not use spaces'
                ]
            ],
            'no_hp' => [
                'rules' => 'required|is_unique[member.no_hp, member_id, ' . $userID . ']|regex_match[/^08\d{8,12}$/]',
                'errors' => [
                    'required' => 'Phone Number must be filled in',
                    'is_unique' => 'Phone number already registered',
                    'regex_match' => 'Invalid phone number'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[member.email, member_id, ' . $userID . ']',
                'errors' => [
                    'required' => 'Email must be filled in',
                    'is_unique' => 'Email already registered'
                ]
            ],
            'nama_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Educational Institutions required',
                ]
            ],
            'nama_pembimbing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supervisors name required',
                ]
            ],
            'no_pembimbing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supervisors phone number Required',
                ]
            ],
        ]);
        if (!$rules) {
            return view('Admin/v_profile_admin', [
                'validation' => $this->validator->getErrors(),
                'halaman' => 'Admin | Profile',
                'title' => 'Profile'
            ]);
        } else {
            $dataUser = $user->where('member_id', $userID)->first();
            if ($foto_profile->isValid()) {
                $foto_lama = (FCPATH . 'uploadFoto/' . $dataUser['foto']);
                if (file_exists($foto_lama)) {
                    if ($dataUser['foto'] != 'profile.png' && $dataUser['foto'] != '') {
                        unlink($foto_lama);
                    }
                }
                $namaFile = date("Y.m.d") . " - " . date("H.i.s") . '.jpeg';
                $foto_profile->move(FCPATH . 'uploadFoto', $namaFile);
            } else {
                $namaFile = $dataUser['foto'];
            }
            $dataUpdate = [
                'member_id' => $userID,
                'nama_lengkap' => $nama_lengkap,
                'nim_nis' => $nim_nis,
                'username' => $username,
                'password' => $password,
                'no_hp' => $no_hp,
                'email' => $email,
                'foto' => $namaFile,
                'nama_instansi' => $nama_instansi,
                'nama_pembimbing' => $nama_pembimbing,
                'no_pembimbing' => $no_pembimbing,
            ];
            $user->save($dataUpdate);
            $sesi = [
                'member_nama_lengkap' => $nama_lengkap,
                'member_foto' => $namaFile
            ];
            session()->set($sesi);
            notif_swal('success', 'Data Updated Successfully');
            return redirect()->to('admin/profile');
        }
    }

    public function rekap_siswa()
    {
        $absensi = new Absensi();
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_absensi');
        //$dataAbsen = $absensi->select('nama_lengkap, nim_nis, nama_instansi, status, waktu_absen')->orderBy('id', 'desc')->where('jenis_user', 'Student')->distinct('nim_nis')->get()->getResult();
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
        $nomor = nomor($currentPage, $jumlahBaris);
        $aktif_rekapSiswa = 'aktif';
        $halaman = 'Admin | Attendance Recap';
        $title = 'Attendance Recap';


        function countTanggal()
        {
            // Mendapatkan tahun dan bulan saat ini
            $year = date('Y');
            $month = date('m');

            // Menghitung jumlah hari dalam bulan ini
            $daysInMonth = date('t', strtotime("$year-$month-01"));

            return $daysInMonth;
        }


        function getWeekend()
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

        $data = [
            'dataUser' => $dataUser,
            'dataAbsen' => $absensiInfo,
            'totalAbsensi' => $totalAbsensi,
            // 'dataAbsen' => $absensiInfo,
            'nomor' => $nomor,
            'aktif_rekapSiswa' => $aktif_rekapSiswa,
            'aktif_rekapAbsensi' => 'active',
            'halaman' => $halaman,
            'title' => $title,
            'jumlahTanggal' => countTanggal(),
            'user' => $user,
            'weekend' => getWeekend(),
        ];
        return view('Admin/v_rekapSiswa', $data);
    }

    public function rekap_siswaFilter()
    {
        $absensi = new Absensi();
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');
        $dataAbsen = $absensi->getDataByDateRangeSSW($startDate, $endDate);

        $data = [
            'dataFilter' => $dataAbsen,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
        session()->setFlashdata('data', $data);

        return redirect()->to('admin/rekap-siswa');
    }
    public function rekap_mahasiswa()
    {
        $absensi = new Absensi();
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_absensi');
        $dataAbsen = $absensi->orderBy('waktu_absen', 'desc')->orderBy('id', 'desc')->where('jenis_user', 'College Student')->findAll();
        $dataUser = $user->where('jenis_user', 'College Student')->orderBy('nama_lengkap', 'asc')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);
        $halaman = 'Admin | Collage Student Recap';
        $title = 'Attendance Recap';

        $data = [
            'dataUser' => $dataUser,
            'dataAbsen' => $dataAbsen,
            'nomor' => $nomor,
            'aktif_rekapMahasiswa' => 'active',
            'aktif_rekapAbsensi' => 'active',
            'halaman' => $halaman,
            'title' => $title,
        ];
        return view('Admin/v_rekapMahasiswa', $data);
    }
    public function rekap_mahasiswaFilter()
    {
        $absensi = new Absensi();
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');
        $dataAbsen = $absensi->getDataByDateRangeMHS($startDate, $endDate);

        $data = [
            'dataFilter' => $dataAbsen,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
        session()->setFlashdata('data', $data);
        return redirect()->to('admin/rekap-mahasiswa');
    }

    public function data_laporan_filter()
    {
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Load model
        $laporan = new Laporan();
        $dataLaporan = $laporan->getDataByDateRange($startDate, $endDate);

        $data = [
            'dataFilter' => $dataLaporan,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
        session()->setFlashdata('data', $data);

        return redirect()->to('admin/data-laporan');
    }
    public function data_laporan()
    {
        $laporan = new Laporan();
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_laporan');
        $dataLaporan = $laporan->orderBy('waktu_laporan', 'desc')->orderBy('id_laporan', 'desc')->findAll();
        $nama_lengkap = [];
        foreach ($dataLaporan as $v) {
            $nimUser = $v['nim_nis'];
            $data = $user->where('nim_nis', $nimUser)->get()->getRowArray();
            $nama_lengkap[$nimUser] = $data ? $data['nama_lengkap'] : $v['nama_lengkap'];
        }
        $dataUser = $user->orderBy('nama_lengkap', 'asc')->where('is_verifikasi', 'yes')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);
        $halaman = 'Admin | Report Data';
        $title = 'Report Data';

        $data = [
            'nama_lengkap' => $nama_lengkap,
            'dataUser' => $dataUser,
            'dataLaporan' => $dataLaporan,
            'nomor' => $nomor,
            'halaman' => $halaman,
            'title' => $title,
            'titleSuperAdmin' => 'Super Admin',
        ];

        return view('Admin/v_dataLaporan', $data);
    }

    public function rekap_aktifitasSiswa()
    {
        $laporan = new Laporan();
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_laporan');
        $dataLaporan = $laporan->orderBy('waktu_laporan', 'desc')->orderBy('id_laporan', 'desc')->where('jenis_user', 'Student')->findAll();
        $dataUser = $user->where('jenis_user', 'Student')->orderBy('nama_lengkap', 'asc')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);
        $aktif_rekapAktifitasSiswa = 'aktif';
        $halaman = 'Admin | Log Activity';
        $title = 'Log Activity';

        $data = [
            'dataUser' => $dataUser,
            'dataLaporan' => $dataLaporan,
            'nomor' => $nomor,
            'aktif_rekapAktifitasSiswa' => $aktif_rekapAktifitasSiswa,
            'aktif_rekapAktifitas' => 'active',
            'halaman' => $halaman,
            'title' => $title,
        ];
        return view('Admin/v_rekapAktifitasSsw', $data);
    }

    public function rekap_aktifitasSiswaFilter()
    {
        $laporan = new Laporan();
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');
        $dataAbsen = $laporan->getDataByDateRangeSSW($startDate, $endDate);

        $data = [
            'dataFilter' => $dataAbsen,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
        session()->setFlashdata('data', $data);

        return redirect()->to('admin/rekap-siswa');
    }
    public function rekap_aktifitasMahasiswa()
    {
        $laporan = new Laporan();
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_absensi');
        $dataLaporan = $laporan->orderBy('waktu_laporan', 'desc')->orderBy('id_laporan', 'desc')->where('jenis_user', 'College Student')->findAll();
        $dataUser = $user->where('jenis_user', 'College Student')->orderBy('nama_lengkap', 'asc')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);
        $halaman = 'Admin | Log Activity';
        $title = 'Log Activity';

        $data = [
            'dataUser' => $dataUser,
            'dataLaporan' => $dataLaporan,
            'nomor' => $nomor,
            'aktif_rekapAktifitasMahasiswa' => 'active',
            'aktif_rekapAktifitas' => 'active',
            'halaman' => $halaman,
            'title' => $title,
        ];
        return view('Admin/v_rekapAktifitasMssw', $data);
    }
    public function rekap_aktivitasMahasiswaFilter()
    {
        $absensi = new Absensi();
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');
        $dataAbsen = $absensi->getDataByDateRangeMHS($startDate, $endDate);

        $data = [
            'dataFilter' => $dataAbsen,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
        session()->setFlashdata('data', $data);
        return redirect()->to('admin/rekap-aktifitas-mahasiswa');
    }

    public function rekapAbsensi()
    {
        // Instansiasi model
        $absensi = new Absensi();
        $user = new MemberModel();
         $bulanIni = date('Y-m');
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_laporan');
        $dataAbsen = $absensi->orderBy('waktu_absen', 'desc')->orderBy('id', 'desc')->where('jenis_user', 'Student')->findAll();
        $dataUser = $user->where('jenis_user', 'Student')->orderBy('nama_lengkap', 'asc')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);
        // Dapatkan semua data user
        $dataUser = $user->findAll();
        $absensiInfo = $absensi->where("DATE_FORMAT(waktu_absen,'%Y-%m')", $bulanIni)->select('nim_nis, jenis_user')->distinct('nim_nis')->get()->getResult();
        $totalAbsensi = [];
        foreach ($absensiInfo as $nim_nis) {
            $nimUser = $nim_nis->nim_nis;
            $totalAbsensi[$nimUser]['masuk'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Masuk');
            $totalAbsensi[$nimUser]['izin'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Izin');
            $totalAbsensi[$nimUser]['sakit'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Sakit');
            $totalAbsensi[$nimUser]['alpa'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Alpa');
        }

        // Array untuk menyimpan rekap absensi
        $rekapAbsensi = [];

        // Looping melalui semua user untuk menghitung absensi "Masuk"
        foreach ($dataUser as $user) {
            $nim_nis = $user['nim_nis'];

            // Menghitung total absensi "Masuk"
            $totalMasuk = $absensi->where('nim_nis', $nim_nis)
                ->where('status', 'Masuk')
                ->countAllResults();

            // Menyimpan hasil ke dalam array
            $rekapAbsensi[$nim_nis] = [
                'nama_lengkap' => $user['nama_lengkap'],
                'totalMasuk' => $totalMasuk
            ];
        }

        // Data yang akan dikirimkan ke view
        $data = [
            'rekapAbsensi' => $rekapAbsensi,
            'dataAbsen' => $absensiInfo,
            'dataUser'=> $dataUser,
            'user' => $user,
            'nomor' => $nomor,
            'halaman' => 'Admin | Rekap Absensi',
            'title' => 'Rekap Absensi',
        ];

        // Memuat view dengan data rekap absensi
        return view('Admin/v_rekapData', $data);
    }
}