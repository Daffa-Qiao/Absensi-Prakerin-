<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\Absensi;

class SuperAdmin extends BaseController
{
    protected $validation;
    protected $helpers = (['url', 'form']);
    function __construct()
    {
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }
    public function super_admin()
    {
        $user = new MemberModel();
        $sesi_id = session()->get("member_id");
        $dataUser = $user->where('is_verifikasi', 'yes')->findAll();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_siswa');
        $nomor = nomor($currentPage, $jumlahBaris);
        $aktif_superAdmin = 'aktif';
        $halaman = 'Admin | Super Admin';
        $title = 'Super Admin';

        $data = [
            'dataUser' => $dataUser,
            'nomor' => $nomor,
            'aktif_superAdmin' => $aktif_superAdmin,
            'halaman' => $halaman,
            'title' => $title,
            'titleSuperAdmin' => 'Super Admin',
        ];

        return view('Admin/v_superadmin', $data);
    }

    public function super_admin_edit($id)
    {
        $user = new MemberModel();
        $data = $user->find($id);
        return json_encode($data);
    }

    public function super_admin_modal()
    {
        $id = $this->request->getPost('super_id');
        $dataNim_Nis = $this->request->getPost('dataNim_Nis');

        $validasi = \Config\Services::validation();
        $aturan = [
            'super_nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi',
                ]
            ],
            'super_nim_nis' => [
                'rules' => 'required|is_unique[member.nim_nis, member_id,' . $id . ']',
                'errors' => [
                    'required' => 'NIM/NIS harus diisi',
                    'is_unique' => 'NIM/NIS sudah terdaftar'
                ]
            ],
            'super_username' => [
                'rules' => 'required|is_unique[member.username, member_id,' . $id . ']|regex_match[/^\S+$/]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah terdaftar',
                    'regex_match' => 'Username tidak boleh menggunakan spasi'
                ]
            ],
            'super_password' => [
                'rules' => 'required|regex_match[/^\S+$/]|min_length[5]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'regex_match' => 'Password tidak boleh menggunakan spasi',
                    'min_length' => 'Minimum panjang password adalah 5 karakter'
                ]
            ],
            'super_no_hp' => [
                'rules' => 'required|is_unique[member.no_hp, member_id,' . $id . ']|regex_match[/^08\d{8,12}$/]',
                'errors' => [
                    'required' => 'Nomor Telepon harus diisi',
                    'is_unique' => 'Nomor Telepon sudah terdaftar',
                    'regex_match' => 'Nomor Telepon tidak valid'
                ]
            ],
            'super_email' => [
                'rules' => 'required|is_unique[member.email, member_id,' . $id . ']|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'is_unique' => 'Email sudah terdaftar',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'super_role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role harus diisi',
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $nama_lengkap = ucwords($this->request->getPost('super_nama_lengkap'));
            $nim_nis = $this->request->getPost('super_nim_nis');
            $username = $this->request->getPost('super_username');
            $password = $this->request->getPost('super_password');
            $no_hp = $this->request->getPost('super_no_hp');
            $email = $this->request->getPost('super_email');
            $role = $this->request->getPost('super_role');

            $data = [
                'member_id' => $id,
                'nama_lengkap' => $nama_lengkap,
                'nim_nis' => $nim_nis,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'no_hp' => $no_hp,
                'level' => $role,
            ];
            $user = new MemberModel();
            $user->save($data);
            $absensi = new Absensi();
            $absensi->where('nim_nis', $dataNim_Nis)->set(['nim_nis' => $nim_nis])->update();

            $hasil_super['sukses'] = true;
            notif_swal('success', 'Berhasil Edit User');
        } else {
            $hasil_super = [
                'error' => [
                    'super_nama_lengkap' => $validasi->getError('super_nama_lengkap'),
                    'super_nim_nis' => $validasi->getError('super_nim_nis'),
                    'super_username' => $validasi->getError('super_username'),
                    'super_password' => $validasi->getError('super_password'),
                    'super_no_hp' => $validasi->getError('super_no_hp'),
                    'super_email' => $validasi->getError('super_email'),
                    'super_role' => $validasi->getError('super_role'),
                ],
            ];
        }

        return json_encode($hasil_super);
    }

    public function list_super_admin()
    {
        $user = new MemberModel();
        $dataUser = $user->where('level', 'Super Admin')->findAll();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_siswa');
        $nomor = nomor($currentPage, $jumlahBaris);
        $halaman = 'Admin | List Super Admin';
        $title = 'Data Super Admin';

        $data = [
            'dataUser' => $dataUser,
            'nomor' => $nomor,
            'aktif_listSuperAdmin' => 'active',
            'halaman' => $halaman,
            'title' => $title,
            'titleSuperAdmin' => 'Super Admin',
        ];
        return view('Admin/v_listSuperAdmin', $data);
    }
}