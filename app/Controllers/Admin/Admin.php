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

        $jumlahSekolah = $user->getJumlahInstansi('sekolah');
        $jumlahUniv = $user->getJumlahInstansi('universitas');
        $totalSiswa = $user->getUser('Siswa');
        $totalMahasiswa = $user->getUser('Mahasiswa');
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
        $dataSiswa = $user->where('jenis_user', 'Siswa')->findAll();
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
        $dataMahasiswa = $user->where('jenis_user', 'Mahasiswa')->findAll();

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
                'halaman' => 'Admin | Sekolah',
                'title' => 'Instansi Sekolah',
                'aktif_instansi' => 'active',
                'aktif_universitas' => 'active',
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

        $rules = $this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi',
                ]
            ],
            'nim_nis' => [
                'rules' => 'required|is_unique[member.nim_nis, member_id, ' . $userID . ']',
                'errors' => [
                    'required' => 'NIM / NIS harus diisi',
                    'is_unique' => 'NIM / NIS sudah terdaftar'
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[member.username, member_id, ' . $userID . ']|regex_match[/^\S+$/]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah terdaftar',
                    'regex_match' => 'Username tidak boleh menggunakan spasi'
                ]
            ],
            'password' => [
                'rules' => 'required|regex_match[/^\S+$/]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'regex_match' => 'Password tidak boleh menggunakan spasi'
                ]
            ],
            'no_hp' => [
                'rules' => 'required|is_unique[member.no_hp, member_id, ' . $userID . ']|regex_match[/^08\d{8,12}$/]',
                'errors' => [
                    'required' => 'Nomor Telepon harus diisi',
                    'is_unique' => 'Nomor Telepon sudah terdaftar',
                    'regex_match' => 'Nomor Telepon tidak valid'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[member.email, member_id, ' . $userID . ']',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'nama_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Instansi harus diisi',
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
            ];
            $user->save($dataUpdate);
            $sesi = [
                'member_nama_lengkap' => $nama_lengkap,
                'member_foto' => $namaFile
            ];
            session()->set($sesi);
            notif_swal('success', 'Berhasil Update Data');
            return redirect()->to('admin/profile');
        }
    }

    public function rekap_siswa()
    {
        $absensi = new Absensi();
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_absensi');
        $dataAbsen = $absensi->orderBy('waktu_absen', 'desc')->orderBy('id', 'desc')->where('jenis_user', 'Siswa')->findAll();
        $dataUser = $user->where('jenis_user', 'Siswa')->orderBy('nama_lengkap', 'asc')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);
        $aktif_rekapSiswa = 'aktif';
        $halaman = 'Admin | Student Recap';
        $title = 'Student Recap';

        $data = [
            'dataUser' => $dataUser,
            'dataAbsen' => $dataAbsen,
            'nomor' => $nomor,
            'aktif_rekapSiswa' => $aktif_rekapSiswa,
            'aktif_rekapAbsensi' => 'active',
            'halaman' => $halaman,
            'title' => $title,
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
        $dataAbsen = $absensi->orderBy('waktu_absen', 'desc')->orderBy('id', 'desc')->where('jenis_user', 'Mahasiswa')->findAll();
        $dataUser = $user->where('jenis_user', 'Mahasiswa')->orderBy('nama_lengkap', 'asc')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);
        $halaman = 'Admin | Collage Student Recap';
        $title = 'Collage Student Recap';

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
}
