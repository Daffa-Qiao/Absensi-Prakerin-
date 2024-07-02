<?php

namespace App\Filters;

use App\Models\MemberModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoAuthFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        // Do something here
        $session = session();
        helper('global_fungsi_helper');
        $user = new MemberModel();
        $sesi_id = $session->get("member_id");
        $userRole = $user->where('member_id', $sesi_id)->first();

        if($session->get("logged_in")) {
            if($userRole['level'] == 'Super Admin' or $userRole['level'] == 'Admin') {
                return redirect()->to('admin/dashboard');
            } else if($userRole['level'] == 'User') {
                if($session->getFlashdata('sudah_verifikasi')) {
                    notif_swal('success', 'Berhasil Verifikasi Akun');
                }
                return redirect()->to('user/my-profile');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Do something here
    }
}