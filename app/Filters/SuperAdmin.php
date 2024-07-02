<?php

namespace App\Filters;

use App\Models\MemberModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SuperAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        // Do something here
        $session = session();
        helper("global_fungsi_helper");

        $user = new MemberModel();
        $sesi_id = $session->get('member_id');
        $userRole = $user->where('member_id', $sesi_id)->first();

        if ($userRole['level'] == 'User') {
            return redirect()->to('user/my-profile');
        } else if ($userRole['level'] == 'Admin') {
            return redirect()->to('admin/dashboard');
        } else if ($userRole['level'] == 'Super Admin' && $session->get('redirected') != 'superadmin') {
            $session->set('redirected', 'superadmin');
            notif_role('success', 'Anda Telah Menjadi Super Admin');
            return redirect()->to('admin/super-admin');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}