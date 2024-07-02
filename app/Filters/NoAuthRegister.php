<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MemberModel;

class NoAuthRegister implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        // Do something here

        if(session()->get('akun_username')) {
            return redirect()->to('user/index');
        }

        $session = session();
        $user = new MemberModel();
        $sesi_id = $session->get("member_id");
        $userRole = $user->where('member_id', $sesi_id)->first();

        if($session->get("logged_in")) {
            if($userRole['level'] == 'Super Admin' or $userRole['level'] == 'Admin') {
                return redirect()->to('admin/dashboard');
            } else if($userRole['level'] == 'User') {
                return redirect()->to('user/my-profile');
            }
        }

        $email = session()->get('member_email');
        $user = new MemberModel();
        $dataAkun = $user->where('email', $email)->get()->getRowArray();
        if ($dataAkun){
            if($dataAkun['is_verifikasi'] == 'yes') {
                session()->set([
                    'logged_in' => true,
                    'member_id' => $dataAkun['member_id'],
                    'member_username' => $dataAkun['username'],
                    'member_password' => $dataAkun['password'],
                    'member_email' => $dataAkun['email'],
                    'member_nama_lengkap' => $dataAkun['nama_lengkap'],
                    'member_nim_nis' => $dataAkun['nim_nis'],
                    'member_jenis_kelamin' => $dataAkun['jenis_kelamin'],
                    'member_no_hp' => $dataAkun['no_hp'],
                    'member_instansi' => $dataAkun['instansi_pendidikan'],
                    'member_nama_instansi' => $dataAkun['nama_instansi'],
                    'member_foto' => $dataAkun['foto'],
                ]);
                if($dataAkun['level'] == 'User') {
                    session()->set('redirected', 'user');
                }
                session()->setFlashdata('sudah_verifikasi', true);
                return redirect()->to('login');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something here
    }
}