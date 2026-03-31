<?php

namespace App\Controllers;

use App\Models\Pbb\AuthModel;
use App\Models\Pbb\DetailTransModel;
use App\Controllers\BaseController;
use App\Models\Pbb\DhkpModel22;
use App\Models\DusunModel;
use App\Models\Pbb\TrxModel22;
use App\Models\WilayahModel;


class Auth extends BaseController
{
    protected $authModel;
    protected $det_trans;
    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->det_trans = new DetailTransModel();
        $this->trans = new TrxModel22();
        $this->DhkpModel22 = new DhkpModel22();
    }
    public function index()
    {
        // ini_set('max_execution_time', 0);
        // ini_set('memory_limit', '2048M');

        $dhkpModel22 = new DhkpModel22();

        $targetPerDusun = $this->DhkpModel22->getDataRekDus()->getResultArray();
        $setoranPerDusun = $this->DhkpModel22->getDataRekDus()->getResultArray();
        $setoranPerRw = $this->DhkpModel22->getDataRekRw()->getResultArray();
        $targetPerRw = $this->DhkpModel22->getDataRekRw()->getResultArray();

        $dataPerDusun = $dhkpModel22->select('SUM(pbb_dhkp22.pajak) AS jumlah, tbl_dusun.no_dusun AS dusun')
            ->join('tbl_dusun', 'pbb_dhkp22.dusun = tbl_dusun.no_dusun')
            ->groupBy('pbb_dhkp22.dusun')
            ->get();

        $dataPerRw = $dhkpModel22->select('SUM(pbb_dhkp22.pajak) AS jumlah, tbl_rw.no_rw AS rw')
            ->join('tbl_rw', 'pbb_dhkp22.rw = tbl_rw.no_rw')
            ->groupBy('pbb_dhkp22.rw')
            ->get();

        $setorPerDusun = $dhkpModel22->select('SUM(pbb_dhkp22.pajak) AS jumlah, tbl_dusun.no_dusun AS dusun')
            ->join('tbl_dusun', 'pbb_dhkp22.dusun = tbl_dusun.no_dusun')
            ->where('pbb_dhkp22.ket', 0)
            ->groupBy('pbb_dhkp22.dusun')
            ->get();

        $setorPerRw = $dhkpModel22->select('SUM(pbb_dhkp22.pajak) AS jumlah, tbl_rw.no_rw AS rw')
            ->join('tbl_rw', 'pbb_dhkp22.rw = tbl_rw.no_rw')
            ->where('pbb_dhkp22.ket', 0)
            ->groupBy('pbb_dhkp22.rw')
            ->get();

        // $data = [
        //     'title' => 'Home',
        //     'targetPerDusun' => $targetPerDusun,
        //     'setoranPerDusun' => $setoranPerDusun,
        //     'dataPerDusun' => $dataPerDusun,
        //     'dataPerRw' => $dataPerRw,
        //     'setorPerDusun' => $setorPerDusun,
        //     'setorPerRw' => $setorPerRw,
        //     'targetPerRw' => $targetPerRw,
        //     'setoranPerRw' => $setoranPerRw,
        //     // 'jumlahTotalBelumLunasPerDusun' => $this->DhkpModel22->jumlahTotalBelumLunasPerDusun()->getResultArray(),
        // ];

        // var_dump($data['jumlahTotalBelumLunasPerDusun']);
        // die;

        return view('pbb/index');
    }

    public function cari()
    {

        if ($this->request->isAJAX()) {

            $model = new DhkpModel22();
            $nop = $this->request->getPost('nop');
            $nama_wp = $this->request->getPost('nama_wp');

            $data = [
                'tampildata' => $model->getLunas(),
                'ket' => 0
            ];
            $db = \Config\Database::connect();
            $cek = $db->table("pbb_dhkp22");
            // $cek->select('*');
            // $cek->join('pbb_detailtrans22', 'pbb_detailtrans22.nop = pbb_dhkp22.nop');
            // $cek->join('pbb_transaksi22', 'pbb_transaksi22.tr_faktur = pbb_detailtrans22.dettr_faktur');
            $cek = $cek->where(array(
                "nop" => $nop,
                "nama_wp" => $nama_wp,
            ));

            // select all data
            $data = $cek->get()->getRowArray();
            // var_dump($data);
            // die;

            if ($nop == "" || $nama_wp == "") {
                $msg = [
                    'title' => 'Home',
                    'error' => 'Silahkan isi data terlebih dahulu!'
                ];
            } else if ($data == null) {
                $msg = [
                    'title' => 'Home',
                    'null' => 'Mohon Maaf, data tidak ditemukan!'
                ];
            } else {
                $msg  = [
                    'title' => 'Home',
                    'data' => view('pbb/hasil_pencarian', $data)
                ];
            }

            echo json_encode($msg);
        }
    }

    public function login()
    {

        $data = [];

        if ($this->request->getPost()) {

            // var_dump($this->request->getvar());
            // $nik = $this->request->getVar('nik');

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateUser[pu_email,pu_password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email atau Password tidak sesuai",
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                $session = session();
                $session->setFlashdata('message', 'User atau Password tidak sesuai!');
                return view('pbb/auth/login', [
                    "validation" => $this->validator,
                    "title" => 'Sign In',
                ]);
            } else {

                $model = new AuthModel();

                $user = $model->where('pu_email', $this->request->getVar('email'))->first();
                // dd($user);
                $this->setUserSession($user);


                // dd($this->setUserSession($user));
                // Redirecting to dashboard after login
                if ($user['pu_status'] !== 1) {
                    $session = session();
                    $session->setFlashdata('message', 'User Non-Aktif, Silakan hubungi Admin!');
                    return redirect()->to('login');
                }
            }
        }
        // echo 'test';
        $data = [
            'title' => 'Sign In',
        ];

        return view('pbb/auth/login', $data);
    }

    private function setUserSession($user)
    {
        $data = [
            'pu_id' => $user['pu_id'],
            'pu_nik' => $user['pu_nik'],
            'pu_email' => $user['pu_email'],
            'pu_username' => $user['pu_username'],
            'pu_fullname' => $user['pu_fullname'],
            'pu_user_image' => $user['pu_user_image'],
            'pu_level' => $user['pu_level'],
            'pu_jabatan' => $user['pu_jabatan'],
            'pu_status' => $user['pu_status'],
            'pu_role_id' => $user['pu_role_id'],
            'pu_kode_desa' => $user['pu_kode_desa'],
            'pu_kode_kec' => $user['pu_kode_kec'],
            'pu_kode_kab' => $user['pu_kode_kab'],
            'pu_kode_prov' => $user['pu_kode_prov'],
            'logPbb' => true,
        ];

        session()->set($data);
        return true;
    }

    public function register()
    {
        // $data = [];\
        $kode_kec = profilAdmin()->pu_kode_kec;
        $this->WilayahModel = new WilayahModel();

        $data = [
            'title' => 'Registration',
            'desa' => $this->WilayahModel->orderBy('name', 'asc')->where('district_id', $kode_kec)->findAll(),

        ];

        if ($this->request->getPost()) {
            // let's do the validation here
            $rules = [
                'pu_role_id' => [
                    'label' => 'Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ],
                'pu_kode_desa' => [
                    'label' => 'Nama Desa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ],
                'pu_fullname' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|min_length[3]|max_length[100]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} terlalu pendek',
                        'max_length' => '{field} terlalu panjang',
                    ]
                ],
                'pu_nik' => [
                    'label' => 'NIK',
                    'rules' => 'required|numeric|min_length[16]|max_length[16]|is_unique[pbb_users.pu_nik,pu_nik,{pu_id}]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'numeric' => '{field} harus berupa angka',
                        'min_length' => '{field} terlalu pendek',
                        'max_length' => '{field} terlalu panjang',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                'pu_email' => [
                    'label' => 'Email',
                    'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[pbb_users.pu_email,pu_email,{pu_id}]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} terlalu pendek',
                        'max_length' => '{field} terlalu panjang',
                        'valid_email' => '{field} tidak valid',
                        'is_unique' => '{field} sudah terdaftar',

                    ]
                ],
                'pu_password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[6]|max_length[255]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} terlalu pendek',
                        'max_length' => '{field} terlalu panjang',
                    ]
                ],
                'pass_confirm' => [
                    'label' => 'Konfirmasi Password',
                    'rules' => 'matches[pu_password]',
                    'errors' => [
                        'matches' => '{field} tidak sama'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                return view('pbb/auth/register', [
                    "validation" => $this->validator,
                    'title' => 'Register',
                    'desa' => $this->WilayahModel->orderBy('name', 'asc')->where('district_id', $kode_kec)->findAll(),
                ]);
            } else {
                //strore the user to database
                $model = new AuthModel();

                $data = [
                    'pu_role_id' => $this->request->getPost('pu_role_id'),
                    'pu_kode_desa' => $this->request->getPost('pu_kode_desa'),
                    'pu_kode_kec' => $kode_kec,
                    'pu_kode_kab' => profilAdmin()->pu_kode_kab,
                    'pu_kode_prov' => profilAdmin()->pu_kode_prov,
                    'pu_level' => $this->request->getPost('pu_level'),
                    'pu_fullname' => $this->request->getPost('pu_fullname'),
                    'pu_nik' => $this->request->getPost('pu_nik'),
                    'pu_email' => $this->request->getPost('pu_email'),
                    'pu_password' => $this->request->getPost('pu_password'),
                    'pu_status' => 0,
                    'pu_created_at' => date('Y-m-d H:i:s'),
                ];
                // dd($data);
                $model->save($data);
                $session = session();
                $session->setFlashdata('success', 'Registrasi Berhasil, silahkan hubungi Admin untuk aktivasi');
                return redirect()->to('/login');
            }
        }

        return view('pbb/auth/register', $data);
    }

    public function logout()
    {
        session()->remove('logPbb');
        session()->remove('pu_nik');
        session()->remove('pu_email');
        session()->remove('pu_fullname');
        session()->remove('pu_level');
        session()->remove('pu_user_image');
        session()->destroy();
        session()->setFlashdata('info', 'Logout sukses..');
        return redirect()->to(base_url());
    }

    public function forgotPassword()
    {
        return view('pbb/auth/forgot_password', [
            'title' => 'Lupa Password'
        ]);
    }

    public function sendResetLink()
    {
        $email = $this->request->getPost('email');
        $nik = $this->request->getPost('nik');
        $fullname = $this->request->getPost('fullname');

        $user = $this->authModel
            ->where('pu_email', $email)
            ->where('pu_nik', $nik)
            ->where('pu_fullname', $fullname)
            ->first();

        if (!$user) {
            return redirect()->back()->with('message', 'Data tidak ditemukan. Pastikan semuanya sesuai.');
        }

        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', time() + 3600); // 1 jam

        $db = \Config\Database::connect();
        $db->table('password_reset_tokens')->insert([
            'email'      => $email,
            'token'      => $token,
            'expires_at' => $expires,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $resetLink = base_url("reset-password/$token");

        // Kirim email
        $waNumber = $user['pu_nope']; // Ambil nomor WA dari database

        $this->sendResetEmail(
            $email,
            $user['pu_fullname'],
            $resetLink,
            $waNumber // dikirim ke fungsi
        );


        return redirect()->to('/login')->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    public function resetPassword($token)
    {
        $db = \Config\Database::connect();
        $row = $db->table('password_reset_tokens')
            ->where('token', $token)
            ->where('used', 0)
            ->get()
            ->getRow();

        if (!$row || strtotime($row->expires_at) < time()) {
            return redirect()->to('/login')->with('message', 'Token tidak valid atau sudah kedaluwarsa.');
        }

        return view('pbb/auth/reset_password', [
            'title' => 'Reset Password',
            'token' => $token
        ]);
    }

    public function processResetPassword()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $confirm = $this->request->getPost('confirm');

        if ($password !== $confirm) {
            return redirect()->back()->with('message', 'Password tidak sama.');
        }

        $db = \Config\Database::connect();
        $row = $db->table('password_reset_tokens')
            ->where('token', $token)
            ->where('used', 0)
            ->get()
            ->getRow();

        if (!$row || strtotime($row->expires_at) < time()) {
            return redirect()->to('/login')->with('message', 'Token tidak valid atau kadaluwarsa.');
        }

        // Update password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $db->table('pbb_users')->where('pu_email', $row->email)->update([
            'pu_password' => $hash,
            'pu_updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Tandai token terpakai
        $db->table('password_reset_tokens')
            ->where('token', $token)
            ->update(['used' => 1]);

        return redirect()->to('/login')->with('success', 'Password berhasil direset. Silakan login kembali.');
    }

    private function sendResetEmail($email, $fullname, $resetLink, $waNumber = null)
    {
        $emailService = \Config\Services::email();

        // Setup email
        $emailService->setFrom('no-reply@sapapadu.pasirlangu.desa.id', 'SAPAPADU');
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password SAPAPADU');

        $message = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; border:1px solid #e3e3e3; border-radius:8px;'>
            <div style='background:#0066cc; padding:20px; color:white; text-align:center; font-size:22px;'>
                <strong>SAPAPADU</strong>
            </div>

            <div style='padding:25px; font-size:15px; color:#333;'>
                <p>Halo <strong>$fullname</strong>,</p>
                <p>Kami menerima permintaan untuk mereset password akun Anda.</p>
                <p>Silakan klik tombol di bawah ini untuk membuat password baru:</p>

                <div style='text-align:center; margin:30px 0;'>
                    <a href='$resetLink' 
                       style='background:#28a745; padding:12px 22px; color:white; text-decoration:none; border-radius:5px; font-size:16px;'>
                       Reset Password
                    </a>
                </div>

                <p>Link ini hanya berlaku selama <strong>1 jam</strong>.</p>
                <p>Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini.</p>

                <br>
                <p>Salam Hangat,<br>
                <strong>Desa Pasirlangu</strong></p>
            </div>

            <div style='text-align:center; padding:15px; font-size:12px; color:#777; background:#f7f7f7;'>
                Email ini dikirim otomatis oleh sistem SAPAPADU.
            </div>
        </div>
    ";

        $emailService->setMessage($message);
        $emailService->setMailType('html');

        // 🟢 Coba kirim email
        if ($emailService->send()) {
            return true;
        }

        // 🔴 Email gagal → fallback WhatsApp
        if ($waNumber) {

            try {
                $waMsg = "Halo *$fullname*,\n\n"
                    . "Kami menerima permintaan untuk mereset password akun SAPAPADU.\n\n"
                    . "Klik link berikut untuk mereset password (berlaku 1 jam):\n"
                    . "$resetLink\n\n"
                    . "Jika Anda tidak merasa meminta reset ini, abaikan pesan ini.\n\n"
                    . "- Desa Pasirlangu";

                // kirim WA
                $this->sendWhatsAppMessage($waNumber, $waMsg);

                return true;
            } catch (\Exception $e) {
                log_message('error', '😢 WhatsApp reset password gagal: ' . $e->getMessage());
                return false;
            }
        }

        return false;
    }

    private function sendWhatsAppMessage($phone, $message)
    {
        $apiKey = getenv('alatwa.api_key');
        $sender = getenv('alatwa.sender');

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.alatwa.com/api/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'api_key' => $apiKey,
                'sender'  => $sender,
                'number'  => $phone,
                'message' => $message,
            ]
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
