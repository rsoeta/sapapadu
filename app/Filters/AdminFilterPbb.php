<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilterPbb implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $noRole = session()->get('pu_role_id');
        $noStat = session()->get('pu_status');
        // Do something here
        if ($noRole > 1 || $noStat > 1 || session()->get('logPbb') === false) {
            return redirect()->to(base_url('lockscreen'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        // if (session()->get('log') == true) {
        //     return redirect()->to(base_url('pbb/user'));
        // }
    }
}
