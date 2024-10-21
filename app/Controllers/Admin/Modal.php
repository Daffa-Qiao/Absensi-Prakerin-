<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\Absensi;
use App\Models\Instansi;
use App\Models\Laporan;

class Modal extends BaseController
{
    protected $validation;
    protected $helpers = (['url', 'form']);
    function __construct()
    {
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    public function tambahUser()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Full name must be filled in',
                ]
            ],
            'nim_nis' => [
                'rules' => 'required|is_unique[member.nim_nis]|numeric',
                'errors' => [
                    'required' => 'NIM/NIS must be filled in',
                    'is_unique' => 'NIM/NIS is already registered',
                    'numeric' => 'NIM/NIS must only contain numbers',
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[member.username]|regex_match[/^\S+$/]',
                'errors' => [
                    'required' => 'Username must be filled in',
                    'is_unique' => 'Username is already registered',
                    'regex_match' => 'Username must not use spaces'
                ]
            ],
            'gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gender must be filled in',
                ]
            ],
            'no_hp' => [
                'rules' => 'required|is_unique[member.no_hp]|regex_match[/^08\d{8,12}$/]',
                'errors' => [
                    'required' => 'Phone number must be filled in',
                    'is_unique' => 'Phone number is already registered',
                    'regex_match' => 'Invalid phone number'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[member.email]|valid_email',
                'errors' => [
                    'required' => 'Email must be filled in',
                    'is_unique' => 'Email is already registered',
                    'valid_email' => 'Email invalid'
                ]
            ],
            'instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Educational institutions must be filled in',
                ]
            ],
            'nama_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Educational Institutions must be filled in',
                ]
            ],
            'nama_pembimbing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name of Supervisor Teacher must be filled in',
                ]
            ],
            'no_pembimbing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supervisor Phone Number must be filled in',
                ]
            ]
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $nama_lengkap = ucwords($this->request->getPost('nama_lengkap'));
            $nim_nis = $this->request->getPost('nim_nis');
            $username = $this->request->getPost('username');
            $gender = $this->request->getPost('gender');
            $no_hp = $this->request->getPost('no_hp');
            $email = $this->request->getPost('email');
            $instansi = $this->request->getPost('instansi');
            $nama_guru = $this->request->getPost('nama_pembimbing');
            $no_guru=$this->request->getPost('no_pembimbing');
            $nama_instansi = strtoupper($this->request->getPost('nama_instansi'));

            $data = [
                'nama_lengkap' => $nama_lengkap,
                'nim_nis' => $nim_nis,
                'username' => $username,
                'jenis_kelamin' => $gender,
                'email' => $email,
                'foto' => 'profile.png',
                'password' => '12345678',
                'no_hp' => $no_hp,
                'instansi_pendidikan' => $instansi,
                'nama_instansi' => $nama_instansi,
                'nama_pembimbing' => $nama_guru,
                'no_pembimbing'=> $no_guru,
                'is_verifikasi' => 'yes'
            ];
            $user = new MemberModel();
            $user->save($data);

            $hasil['sukses'] = true;
            notif_swal('success', 'Successfully Add User');
        } else {
            // $hasil['sukses'] = false;
            $hasil = [
                // 'sukses' => false,
                'error' => [
                    'nama_lengkap' => $validasi->getError('nama_lengkap'),
                    'nim_nis' => $validasi->getError('nim_nis'),
                    'username' => $validasi->getError('username'),
                    'gender' => $validasi->getError('gender'),
                    'no_hp' => $validasi->getError('no_hp'),
                    'email' => $validasi->getError('email'),
                    'instansi' => $validasi->getError('instansi'),
                    'nama_instansi' => $validasi->getError('nama_instansi'),
                    'nama_pembimbing' => $validasi->getError('nama_pembimbing'),
                    'no_pembimbing' => $validasi->getError('no_pembimbing')
                ],
            ];
        }

        return json_encode($hasil);
    }

    public function editUserModal()
    {
        $id = $this->request->getPost('id');
        $dataNim_Nis = $this->request->getPost('dataNim_Nis');

        $validasi = \Config\Services::validation();
        $aturan = [
            'edit_nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Full name must be filled in',
                ]
            ],
            'edit_nim_nis' => [
                'rules' => 'required|is_unique[member.nim_nis, member_id,' . $id . ']',
                'errors' => [
                    'required' => 'NIM/NIS must be filled in',
                    'is_unique' => 'NIM/NIS is already registered',
                ]
            ],
            'edit_username' => [
                'rules' => 'required|is_unique[member.username, member_id,' . $id . ']|regex_match[/^\S+$/]',
                'errors' => [
                    'required' => 'Username must be filled in',
                    'is_unique' => 'Username is already registered',
                    'regex_match' => 'Username must not use spaces'
                ]
            ],
            'edit_password' => [
                'rules' => 'required|regex_match[/^\S+$/]|min_length[5]',
                'errors' => [
                    'required' => 'Password must be filled in',
                    'regex_match' => 'Password must not use spaces',
                    'min_length' => 'Minimum password length is 5 characters'
                ]
            ],
            'edit_gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gender must be filled in',
                ]
            ],
            'edit_no_hp' => [
                'rules' => 'required|is_unique[member.no_hp, member_id,' . $id . ']|regex_match[/^08\d{8,12}$/]',
                'errors' => [
                    'required' => 'Phone number must be filled in',
                    'is_unique' => 'Phone number is already registered',
                    'regex_match' => 'Invalid phone number'
                ]
            ],
            'edit_email' => [
                'rules' => 'required|is_unique[member.email, member_id,' . $id . ']|valid_email',
                'errors' => [
                    'required' => 'Email must be filled in',
                    'is_unique' => 'Email is already registered',
                    'valid_email' => 'Email invalid'
                ]
            ],
            'edit_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Educational institutions must be filled in',
                ]
            ],
            'edit_nama_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Educational institutions must be filled in',
                ]
            ],

            'edit_nama_pembimbing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Educational institutions must be filled in',
                ]
            ],
            'edit_no_pembimbing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Educational institutions must be filled in',
                ]
            ],
        ];

        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $nama_lengkap = ucwords($this->request->getPost('edit_nama_lengkap'));
            $nim_nis = $this->request->getPost('edit_nim_nis');
            $username = $this->request->getPost('edit_username');
            $password = $this->request->getPost('edit_password');
            $gender = $this->request->getPost('edit_gender');
            $no_hp = $this->request->getPost('edit_no_hp');
            $email = $this->request->getPost('edit_email');
            $instansi = $this->request->getPost('edit_instansi');
            $nama_instansi = strtoupper($this->request->getPost('edit_nama_instansi'));
            $nama_guru = $this->request->getPost('edit_nama_pembimbing');
            $no_guru = $this->request->getPost('edit_no_pembimbing');

            $data = [
                'member_id' => $id,
                'nama_lengkap' => $nama_lengkap,
                'nim_nis' => $nim_nis,
                'username' => $username,
                'password' => $password,
                'jenis_kelamin' => $gender,
                'email' => $email,
                'no_hp' => $no_hp,
                'instansi_pendidikan' => $instansi,
                'nama_instansi' => $nama_instansi,
                'nama_pembimbing'=> $nama_guru,
                'no_pembimbing'=> $no_guru,
                'foto_instansi' => null,
            ];
            $user = new MemberModel();
            $user->save($data);
            $absensi = new Absensi();
            $absensi->where('nim_nis', $dataNim_Nis)->set(['nim_nis' => $nim_nis])->update();

            $hasil_edit['sukses'] = true;
            notif_swal('success', 'Data edited successfully');
        } else {
            $hasil_edit = [
                'error' => [
                    'edit_nama_lengkap' => $validasi->getError('edit_nama_lengkap'),
                    'edit_nim_nis' => $validasi->getError('edit_nim_nis'),
                    'edit_username' => $validasi->getError('edit_username'),
                    'edit_password' => $validasi->getError('edit_password'),
                    'edit_gender' => $validasi->getError('edit_gender'),
                    'edit_no_hp' => $validasi->getError('edit_no_hp'),
                    'edit_email' => $validasi->getError('edit_email'),
                    'edit_instansi' => $validasi->getError('edit_instansi'),
                    'edit_nama_instansi' => $validasi->getError('edit_nama_instansi'),
                    'edit_nama_pembimbing'=> $validasi->getError('edit_nama_pembimbing'),
                    'edit_no_pembimbing'=> $validasi->getError('edit_no_pembimbing')
                ],
            ];
        }

        return json_encode($hasil_edit);
    }

    public function editUser($id)
    {
        $user = new MemberModel();
        $data = $user->find($id);
        return json_encode($data);
    }

    public function hapus($id)
    {
        $user = new MemberModel();
        $dataUser = $user->find($id);
        $file = (FCPATH . 'uploadFoto/' . $dataUser['foto']);
        if (file_exists($file)) {
            if ($dataUser['foto'] != 'profile.png' && $dataUser['foto'] != '') {
                unlink($file);
            }
        }
        $user->delete($id);
        notif_swal('success', 'Terhapus');
        return redirect()->back();
    }

    public function hapus_absen($id)
    {
        $absensi = new Absensi();
        $dataAbsen = $absensi->find($id);
        $file = (FCPATH . 'uploadFoto/' . $dataAbsen['foto_absen']);
        if (file_exists($file)) {
            if ($dataAbsen['foto_absen'] != '') {
                unlink($file);
            }
        }
        $absensi->delete($id);
        notif_swal('success', 'Terhapus');

        return redirect()->back();
    }

    public function tambahAbsensi()
    {
        $validasi = \Config\Services::validation();
        $status = $this->request->getPost('status');
        $aturan = [
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Date of absence must be filled in',
                ]
            ],
            'absen_nim_nis' => [
                'rules' => 'required|is_not_unique[member.nim_nis]',
                'errors' => [
                    'required' => 'NIM / NIS must be filled in',
                    'is_not_unique' => 'NIM / NIS not registered',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Absence status must be filled in',
                ]
            ],
            'checkin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Checkin time must be filled',
                ]
            ],
        ];
        if ($status == 'Izin' or $status == 'Sakit') {
            $aturan = [
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Date of absence must be filled in',
                    ]
                ],
                'absen_nim_nis' => [
                    'rules' => 'required|is_not_unique[member.nim_nis]',
                    'errors' => [
                        'required' => 'NIM / NIS must be filled in',
                        'is_not_unique' => 'NIM / NIS is not registered',
                    ]
                ],
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Absence status must be filled in',
                    ]
                ],
                'checkin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Checkin time must be filled',
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Description required',
                    ]
                ],
            ];
        }
        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $hasil['sukses'] = true;
        } else {
            $hasil = [
                'error' => [
                    'tanggal' => $validasi->getError('tanggal'),
                    'absen_nama_lengkap' => $validasi->getError('absen_nama_lengkap'),
                    'absen_nim_nis' => $validasi->getError('absen_nim_nis'),
                    'absen_jenis_user' => $validasi->getError('absen_jenis_user'),
                    'status' => $validasi->getError('status'),
                    'checkin' => $validasi->getError('checkin'),
                    'keterangan' => $validasi->getError('keterangan'),
                    'foto' => $validasi->getError('foto'),
                ]
            ];
        }
        return json_encode($hasil);
    }

    public function tambahAbsensiProcess()
    {
        $rules = $this->validate([
            'foto' => [
                'rules' => 'is_image[foto]|ext_in[foto,jpg,png,jpeg]',
                'errors' => [
                    'is_image' => 'Foto tidak valid',
                    'ext_in' => 'Hanya .jpg, .jpeg, dan .png yang dapat diupload'
                ]
            ]
        ]);
        if (!$rules) {
            notif_swal('error', 'Foto tidak valid');
            return redirect()->back();
        }
        $tanggal = $this->request->getPost('tanggal');
        $nim_nis = $this->request->getPost('absen_nim_nis');
        $status = $this->request->getPost('status');
        $nim_nis = $this->request->getPost('absen_nim_nis');
        $keterangan = $this->request->getPost('keterangan');
        $checkin = $this->request->getVar('checkin');
        $foto = $this->request->getFile('foto');

        if ($foto->isValid()) {
            $namaFile = date("Y.m.d") . " - " . date("H.i.s") . ".jpeg";
            $foto->move(FCPATH . "uploadFoto", $namaFile);
        } else {
            $namaFile = '';
        }
        $user = new MemberModel();
        $infoUser = $user->where('nim_nis', $nim_nis)->first();
        $data = [
            'nama_lengkap' => $infoUser['nama_lengkap'],
            'nim_nis' => $nim_nis,
            'jenis_user' => $infoUser['jenis_user'],
            'status' => $status,
            'keterangan' => $keterangan,
            'waktu_absen' => $tanggal,
            'foto_profile' => $infoUser['foto'],
            'nama_instansi' => $infoUser['nama_instansi'],
            'instansi_pendidikan' => $infoUser['instansi_pendidikan'],
            'checkin_time' => $checkin,
            'foto_absen' => $namaFile
        ];
        $tambahAbsensi = new Absensi();
        $tambahAbsensi->save($data);

        notif_swal('success', 'Data uploaded succesfully');
        return redirect()->to('admin/data-absen');
    }

    public function checkout($id)
    {
        $absensi = new Absensi();
        $data = $absensi->find($id);

        return json_encode($data);
    }

    public function checkoutModal()
    {
        $validation = \Config\Services::validation();
        $aturan = [
            'checkout' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Waktu Checkout harus diisi!'
                ]
            ],
        ];
        $validation->setRules($aturan);
        if ($validation->withRequest($this->request)->run()) {
            $id = $this->request->getVar('id');
            $checkout = $this->request->getVar('checkout');

            if ($checkout > '17:00') {
                $checkout = 'Overtime : ' . $checkout;
            } else {
                $checkout;
            }
            $data = [
                'id' => $id,
                'checkout_time' => $checkout,
            ];
            $absensi = new Absensi();
            $absensi->save($data);

            $hasil['sukses'] = true;
            notif_swal('success', 'Checkout Successfully');
        } else {
            $hasil = [
                'error' => [
                    'checkout' => $validation->getError('checkout'),
                ]
            ];
        }

        return json_encode($hasil);
    }

    public function instansi($nama)
    {
        $user = new MemberModel();
        $jumlahSiswa = $user->where('nama_instansi', $nama)->countAllResults();
        $dataUser = $user->where('nama_instansi', $nama)->first();

        $data = [
            'namaInstansi' => $dataUser['nama_instansi'],
            'jumlahSiswa' => $jumlahSiswa,
            'instansiPendidikan' => $dataUser['instansi_pendidikan'],
        ];

        return json_encode($data);
    }

    public function instansi_modal()
    {
        $logo = $this->request->getFile('foto_logo');
        $nama_instansi = $this->request->getVar('instansi_nama');
        $user = new MemberModel();
        $instansi = new Instansi();
        if ($logo->isValid()) {
            $dataInstansi = $instansi->where('nama_instansi', $nama_instansi)->first();
            if ($dataInstansi != null) {
                if ($dataInstansi['foto_instansi'] != '') {
                    $foto_lama = (FCPATH . 'uploadFoto/' . $dataInstansi['foto_instansi']);
                    if (file_exists($foto_lama)) {
                        unlink($foto_lama);
                    }
                }
            }

            $namaFile = date("Y.m.d") . " - " . date("H.i.s") . '.jpeg';
            $logo->move(FCPATH . 'uploadFoto/', $namaFile);

            $data = [
                'nama_instansi' => $nama_instansi,
                'foto_instansi' => $namaFile
            ];
            $dataInstansi = $instansi->where('nama_instansi', $nama_instansi)->first();
            if ($dataInstansi) {
                $instansi->where('nama_instansi', $nama_instansi)->set($data)->update();
            } else if (!$dataInstansi) {
                $instansi->insert($data);
            }
            notif_swal('success', 'Uploaded logo succesfully');
            return redirect()->back();
        } else {
            notif_swal('warning', 'Silahkan pilih file logo');
            return redirect()->back();
        }
    }
    public function tambahAktifitas()
    {
        $validasi = \Config\Services::validation();
        $aturan = [
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Date of absence must be filled in',
                ]
            ],
            'laporan_nim_nis' => [
                'rules' => 'required|is_not_unique[member.nim_nis]',
                'errors' => [
                    'required' => 'NIM / NIS must be filled in',
                    'is_not_unique' => 'NIM / NIS not registered',
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Activity status must be filled in',
                ]
            ],
            'waktu_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Start time must be filled',
                ]
            ],
            'waktu_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'End time must be filled',
                ]
            ],
            'lokasi'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Location must be filled',
                ]
            ]
        ];
        $validasi->setRules($aturan);
        if ($validasi->withRequest($this->request)->run()) {
            $hasil['sukses'] = true;
        } else {
            $hasil = [
                'error' => [
                    'tanggal' => $validasi->getError('tanggal'),
                    'laporan_nama_lengkap' => $validasi->getError('laporan_nama_lengkap'),
                    'laporan_nim_nis' => $validasi->getError('laporan_nim_nis'),
                    'laporan_jenis_user' => $validasi->getError('laporan_jenis_user'),
                    'lokasi'=> $validasi->getError('lokasi'),
                    'status' => $validasi->getError('status'),
                    'waktu_mulai' => $validasi->getError('waktu_mulai'),
                    'waktu_selesai'=>$validasi -> getError('waktu_selesai'),
                    'keterangan' => $validasi->getError('keterangan'),
                    'foto' => $validasi->getError('foto'),
                ]
            ];
        }
        return json_encode($hasil);
    }
    public function tambahAktifitasProcess()
    {
        $rules = $this->validate([
            'foto' => [
                'rules' => 'is_image[foto]|ext_in[foto,jpg,png,jpeg]',
                'errors' => [
                    'is_image' => 'Foto tidak valid',
                    'ext_in' => 'Hanya .jpg, .jpeg, dan .png yang dapat diupload'
                ]
            ]
        ]);
        if (!$rules) {
            notif_swal('error', 'Foto tidak valid');
            return redirect()->back();
        }
        $tanggal = $this->request->getPost('tanggal');
        $status = $this->request->getPost('status');
        $nim_nis = $this->request->getPost('nim_nis');
        $keterangan = $this->request->getPost('keterangan');
        $lokasi = $this->request->getPost('lokasi');
        $waktu_mulai = $this->request->getVar('waktu_mulai');
        $waktu_selesai= $this->request->getVar('waktu_selesai');
        $foto = $this->request->getFile('foto');

        if ($foto->isValid()) {
            $namaFile = date("Y.m.d") . " - " . date("H.i.s") . ".png";
            $foto->move(FCPATH . "uploadFoto", $namaFile);
        } else {
            $namaFile = '';
        }
        $user = new MemberModel();
        $infoUser = $user->where('nim_nis', $nim_nis)->first();
        $data = [
            'nim_nis' => $nim_nis,
            'nama_lengkap' => $infoUser['nama_lengkap'],
            'jenis_user' => $infoUser['jenis_user'],
            'status' => $status,
            'lokasi' => $lokasi,
            'kegiatan' => $keterangan,
            'waktu_laporan' => $tanggal,
            'foto_profile' => $infoUser['foto'],
            'nama_instansi' => $infoUser['nama_instansi'],
            'instansi_pendidikan' => $infoUser['instansi_pendidikan'],
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai'=> $waktu_selesai,
            'foto_laporan' => $namaFile
        ];
        $tambahLaporan = new Laporan();
        $tambahLaporan->save($data);

        notif_swal('success', 'Data uploaded succesfully');
        return redirect()->to('admin/rekap-aktifitas-siswa');
    }
    public function hapus_laporan($id)
    {
        $laporan  = new Laporan();
        $dataLaporan = $laporan->find($id);
        $file = (FCPATH . 'uploadFoto/' . $dataLaporan['foto_laporan']);
        if (file_exists($file)) {
            if ($dataLaporan['foto_laporan'] != '') {
                unlink($file);
            }
        }
        $laporan->delete($id);
        notif_swal('success', 'Terhapus');

        return redirect()->back();
    }
}
