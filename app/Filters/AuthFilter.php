<?php

namespace App\Filters;

use App\Models\MemberModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {

        // Do something here
        $session = session();
        helper("global_fungsi_helper");

        $user = new MemberModel();
        $sesi_id = $session->get('member_id');
        $userRole = $user->where('member_id', $sesi_id)->first();

        if ($sesi_id != null){
            if(!$userRole) {
                $dataSesi = [ 
                'logged_in',
                'member_id' ,
                'member_username',
                'member_password',
                'member_email',
                'member_nama_lengkap',
                'member_nim_nis',
                'member_jenis_kelamin',
                'member_no_hp',
                'member_instansi',
                'member_nama_instansi',
                'member_foto'];
                $session->remove($dataSesi);
                $session->setFlashdata('error', 'Akun anda telah dihapus');
                return redirect()->to('login');
            }
        }

        if($session->get('logged_in')) {
            if($userRole['level'] == 'User') {
                return redirect()->to('user/my-profile');
            } else if($userRole['level'] == 'Admin' && $session->get('redirected') != 'admin') {
                $session->set('redirected', 'admin');
                notif_swal('success', 'Anda Telah Menjadi Admin');
                return redirect()->to('admin/dashboard');
            } else if($userRole['level'] == 'Super Admin' && $session->get('redirected') != 'superadmin') {
                return redirect()->to('admin/super-admin');
            }
        } else {
            return redirect()->to('/login');
        }


    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something here
    }
}