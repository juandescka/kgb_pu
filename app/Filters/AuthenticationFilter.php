<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthenticationFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn') != TRUE) {
            return redirect()->to(base_url() . '/authentication');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->get('isLoggedIn') == TRUE) {
            // if (session()->get('tipePengguna') != 'pegawai') {
            //     return redirect()->to(base_url() . '/admin');
            // }
            return redirect()->to(base_url() . '/dashboard');
        }
    }
}
